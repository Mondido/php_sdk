<?php
/**
 * Created by JetBrains PhpStorm.
 * User: robertpohl
 * Date: 25/07/14
 * Time: 22:44
 * To change this template use File | Settings | File Templates.
 */
require_once(dirname(__FILE__) . '/test_base.php');

class api_base_Test extends mondido\test\test_base {

    public function testGetApiUrl()
    {
        echo "Testing api_base::getApiUrl()\n";

        $url = mondido\api\api_base::getApiUrl();
        $this->assertEquals('https://api.mondido.com/v1/', $url);
    }

    public function testPassword()
    {
        echo "Testing api_base::getPassword()\n";
        $val = mondido\api\api_base::getPassword();
        $this->assertEquals('custom00', $val);
    }

    public function testUsername()
    {
        echo "Testing api_base::getUsername()\n";
        $val = mondido\api\api_base::getUsername();
        $this->assertEquals('3', $val);
    }

}