### Fix for disappearing page titles ###

This module should not be needed, but then "should not" sometimes means it should.

The issue is two-fold: I have a Drupal 7 site where the page title tokens would disappear until the cache was cleared.

This is a problem. The solution I proposed was to update core and some modules. That idea was nixed for reasons above my paygrade. But I still needed a fix.
Hopefully this module will help you as well.

Included is check_title.php which can be adjusted, and set in your cron, to watch title and description entries on set pages.
