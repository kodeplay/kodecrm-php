<?php

require 'chatwidget.php';

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
    }

    public function test_kodecrm_chatwidget_render() {
        $appid = '1234567890ABCDEFGHIJ';
        $custom = 'color:#000; text:Chat with us; bg:#000099 ';
        $snippet = kodecrm_chatwidget_render($appid, $custom);
        
        $expected = "var _kcrm = {};";
        $expected .= "_kcrm['app_id'] = '$appid';";
        $expected .= "_kcrm['cs'] = {};";
        $expected .= "_kcrm['cs']['color'] = '#000';";
        $expected .= "_kcrm['cs']['text'] = 'Chat with us';";
        $expected .= "_kcrm['cs']['bg'] = '#000099';";
        $expected .= "(function (w, d, undefined) {";
        $expected .= "    var script = document.createElement(\"script\");";
        $expected .= "    script.type = \"text/javascript\";";
        $expected .= "    script.src = \"http://kodecrm.com/static/javascript/widget.js\";";
        $expected .= "    d.body.appendChild(script);";
        $expected .= "}) (window, document);";
        
        $this->assertEquals($snippet, $expected);
    }
}