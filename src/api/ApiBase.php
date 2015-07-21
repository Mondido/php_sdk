<?php
/**
 * Created by JetBrains PhpStorm.
 * User: robertpohl
 * Date: 24/07/14
 * Time: 16:29
 * To change this template use File | Settings | File Templates.
 */

namespace Mondido\Api;

use Mondido\Settings\Configuration;

class ApiBase
{
    public static function getApiUrl()
    {
        return Configuration::$app_settings['api_url'];
    }

    public static function getUsername()
    {
        return Configuration::$app_settings['username'];
    }

    public static function getPassword()
    {
        return Configuration::$app_settings['password'];
    }
}