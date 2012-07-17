KodeCRM Helper library
======================

This is a helper library for implementing modules in various platforms
such as opencart and magento

Feeds
-----

To convert an associative array to xml feed, include the ``feed.php``
file and then call the function ``kodecrm_feed_create`` with that
array, it will return a string of xml. Please see the comment for this
function for the format of the array as the generated xml will depend
upon it

