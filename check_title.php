<?php
/**
 *  Checks title and description
 *
 */

function file_get_contents_curl($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    $data = curl_exec($ch);
    curl_close($ch);

    return $data;
}

// I set 3 different pages to check (home, webform, and page)
$pages = ['/','/contact-us/request-quote/','/services/'];
$msg = '';
$sbj = '';
$send = 0;

// Create a loop to iterate through each page
foreach ($pages as $page) {

      $doc = new DOMDocument();
      @$doc->loadHTML(file_get_contents_curl('http[s]://[DOMAIN]' . $page));
      $nodes = $doc->getElementsByTagName('title');

      $title = $nodes->item(0)->nodeValue;
      $metas = $doc->getElementsByTagName('meta');

     for ($i = 0; $i < $metas->length; $i++)
       {
          $meta = $metas->item($i);
            if($meta->getAttribute('name') == 'description')
              $description = $meta->getAttribute('content');
                if($meta->getAttribute('name') == 'keywords')
                  $keywords = $meta->getAttribute('content');
       }


    $msg .= 'page: http[s]://[DOMAIN]' . $page . "\n";
    $msg .= 'title: ' . $title . "\n";
    $msg .= 'description: ' . $description . "\n\n";
    $sbj .= 'Title Check';

       // This is a little sloppy, but it works (for now)
       // Basically setting a bug to see if the current
       // entry passes muster.
       if (strlen($title) < 1) {
        $send = 1;
       }
 }

  // Do something with that data
  if ($send == 1) {
    $eml = [YOUR EMAIL];
    mail($eml, $sbj, $msg);
    print $msg;
  }
    else {
        print $msg;
   }
