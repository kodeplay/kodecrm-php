KodeCRM PHP Helper library
==========================

This is a helper library for generating XML products feeds for
integrating KodeCRM with an ecommerce platform written in PHP.

Feeds
-----

This library provides a useful function for converting an associative
array to xml format that KodeCRM recognizes. All you need to do is
fetch products from the database and build an associative array out of
them in the following format. 


.. sourcecode:: php

    <?php

    $feed_arr = array(
       'title' => 'This is the name of my store',
       'link' => 'http://mystore.com',
       'item' => array(
           array(
               'title' => 'Title of an example product',
               'brand' => 'Brand name of an example product',
               'description' => 'Some description here',
               'pid' => '1',
               'link' => 'http://mystore.com/?pid=1',
               'image_link' => 'http://mystore.com/image/?pid=1',
               'price' => '200',
               'currency' => 'USD',
               'availability' => '1',
               'category' => array(
                   'Phones',
                   'Guns',
                   'Mirrors',
               )
           ),
           array(
               'title' => 'Title of another example product',
               'brand' => 'Brand name of another example product',
               'description' => 'Some description here',
               'pid' => '1',
               'link' => 'http://mystore.com/?pid=1',
               'image_link' => 'http://mystore.com/image/?pid=1',
               'price' => '200',
               'currency' => 'USD',
               'availability' => '0',
               'category' => array(
                   'Code Readers',
                   'Editors'                
               )
           )
       )
    );
    
    // There are only two products in the above feed. In your case you
    // would probably want to fetch all products from the database and
    // loop over them to generate the ``item`` array.

    // now include the helper library
    require('/path/to/kodecrm_php/feed.php');

    // and call the function to convert the feed_array to xml string
    $feed = kodecrm_feed_create($feedarr);

    // send correct headers and echo the xml so that it's available as
    // rss feed at some url
    header('Content-Type: application/rss+xml; charset=utf-8');
    echo $feed;


Now login to your KodeCRM admin and provide this url there as the
Product Feed URL and you are done!

Note: If you haven't yet added the javascript snippet to your website
then please so that the chat widget appears on it.

For any queries or difficulties, please send an email to
sales@kodeplay.com, info@kodeplay.com or create an issue here on
github.

