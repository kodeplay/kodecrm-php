<?php

require 'chatwidget.php';
require 'feed.php';


class KodeCRM_PHP_Test extends PHPUnit_Framework_TestCase {

    public function test_kodecrm_chatwidget_settings() {
        $custom = 'color:#000;text:Chat with us;bg:#000099';
        $settings = kodecrm_chatwidget_settings($custom);
        $this->assertEquals($settings, array(
            'color' => '#000',
            'text' => 'Chat with us',
            'bg' => '#000099',
        ));

        $custom = 'color:#000; text:Chat with us; bg:#000099 ';
        $settings = kodecrm_chatwidget_settings($custom);
        $this->assertEquals($settings, array(
            'color' => '#000',
            'text' => 'Chat with us',
            'bg' => '#000099',
        ));

        $custom = '';
        $settings = kodecrm_chatwidget_settings($custom);
        $this->assertEquals($settings, array());
    }

    public function test_kodecrm_chatwidget_render() {
        $appid = '1234567890ABCDEFGHIJ';
        $custom = 'color:#000; text:Chat with us; bg:#000099 ';
        $snippet = kodecrm_chatwidget_render($appid, $custom);
        
        $expected = "var _kcrm = {};";
        $expected .= "_kcrm['app_id'] = '$appid';";
        $expected .= "_kcrm['iframe'] = true;";
        $expected .= "_kcrm['cs'] = {};";
        $expected .= "_kcrm['cs']['color'] = '#000';";
        $expected .= "_kcrm['cs']['text'] = 'Chat with us';";
        $expected .= "_kcrm['cs']['bg'] = '#000099';";
        $expected .= "(function (w, d, undefined) {";
        $expected .= "    var k = document.createElement(\"script\"),";
        $expected .= "    r = document.getElementsByTagName('script')[0],";
        $expected .= "    p = ('https:' == document.location.protocol ? 'https://' : 'http://');";
        $expected .= "    k.type = \"text/javascript\";";
        $expected .= "    k.src =  p + 'kodecrm.com/static/javascript/widget.js';";
        $expected .= "    r.parentNode.appendChild(k);";
        $expected .= "}) (window, document);";
        
        $this->assertEquals($snippet, $expected);

        $snippet = kodecrm_chatwidget_render($appid, '', false);

        $expected = "var _kcrm = {};";
        $expected .= "_kcrm['app_id'] = '$appid';";
        $expected .= "_kcrm['iframe'] = false;";
        $expected .= "_kcrm['cs'] = {};";
        $expected .= "(function (w, d, undefined) {";
        $expected .= "    var k = document.createElement(\"script\"),";
        $expected .= "    r = document.getElementsByTagName('script')[0],";
        $expected .= "    p = ('https:' == document.location.protocol ? 'https://' : 'http://');";
        $expected .= "    k.type = \"text/javascript\";";
        $expected .= "    k.src =  p + 'kodecrm.com/static/javascript/widget.js';";
        $expected .= "    r.parentNode.appendChild(k);";
        $expected .= "}) (window, document);";

        $this->assertEquals($snippet, $expected);
    }

    public function test_kodecrm_feed_create() {
        $feedarr = array(
            'title' => 'A',
            'link' => 'B',
            'item' => array(
                array(
                    'title' => 'C',
                    'brand' => 'D',
                    'description' => 'E',
                    'pid' => 'F',
                    'link' => 'G',
                    'image_link' => 'H',
                    'price' => 'I',
                    'currency' => 'J',
                    'availability' => 'K',
                    'category' => array(
                        'L',
                        'M',
                        'N'
                    )
                ),
                array(
                    'title' => 'O',
                    'brand' => 'P',
                    'description' => 'Q',
                    'pid' => 'R',
                    'link' => 'S',
                    'image_link' => 'T',
                    'price' => 'U',
                    'currency' => 'V',
                    'availability' => 'W',
                    'category' => array(
                        'X',
                        'Y'                
                    )
                )
            )
        );
        $feed = kodecrm_feed_create($feedarr);
        
        $xml = '<?xml version="1.0" encoding="utf-8"?>';
        $xml .= '<rss version="2.0"><channel>';
        $xml .= '  <title>A</title>';
        $xml .= '  <link>B</link>';
        $xml .= '  <item>';
        $xml .= '    <title>C</title>';
        $xml .= '    <brand>D</brand>';
        $xml .= '    <description>E</description>';
        $xml .= '    <pid>F</pid>';
        $xml .= '    <link>G</link>';
        $xml .= '    <image_link>H</image_link>';
        $xml .= '    <price>I</price>';
        $xml .= '    <currency>J</currency>';
        $xml .= '    <availability>K</availability>';
        $xml .= '    <category>L</category>';
        $xml .= '    <category>M</category>';
        $xml .= '    <category>N</category>';
        $xml .= '  </item>';
        $xml .= '  <item>';
        $xml .= '    <title>O</title>';
        $xml .= '    <brand>P</brand>';
        $xml .= '    <description>Q</description>';
        $xml .= '    <pid>R</pid>';
        $xml .= '    <link>S</link>';
        $xml .= '    <image_link>T</image_link>';
        $xml .= '    <price>U</price>';
        $xml .= '    <currency>V</currency>';
        $xml .= '    <availability>W</availability>';
        $xml .= '    <category>X</category>';
        $xml .= '    <category>Y</category>';
        $xml .= '  </item>';
        $xml .= '</channel></rss>';
        
        $expected = new DOMDocument;
        $expected->loadXML($xml);
        
        $actual = new DOMDocument;
        $actual->loadXML($feed);

        $this->assertEqualXMLStructure($expected->firstChild, $actual->firstChild);
        
    }
}
