<?php
/**
 * Created by JetBrains PhpStorm.
 * User: robertpohl
 * Date: 24/07/14
 * Time: 16:29
 * To change this template use File | Settings | File Templates.
 */

namespace mondido\api;
use mondido\settings\configuration;

class api_base {
    public static function getApiUrl(){
      return configuration::$app_settings['api_url'];
    }
    public static function getUsername(){
        return configuration::$app_settings['username'];
    }
    public static function getPassword(){
        return configuration::$app_settings['password'];
    }
}