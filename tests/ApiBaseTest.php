<?php

/**
 * Created by JetBrains PhpStorm.
 * User: robertpohl
 * Date: 25/07/14
 * Time: 22:44
 * To change this template use File | Settings | File Templates.
 */
//require('TestBase.php');

class ApiBaseTest extends TestBase
{

    public function testGetApiUrl()
    {
        echo "Testing api_base::getApiUrl()\n";

        $url = $this->api->getApiUrl();
        $this->assertEquals('https://api.mondido.com/v1/', $url);
    }

    public function testPassword()
    {
        echo "Testing api_base::getPassword()\n";
        $val = $this->api->getPassword();
        $this->assertEquals('custom00', $val);
    }

    public function testUsername()
    {
        echo "Testing api_base::getUsername()\n";
        $val = $this->api->getUsername();
        $this->assertEquals('3', $val);
    }

}