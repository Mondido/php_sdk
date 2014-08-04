<?php namespace mondido\api;
use mondido\http_helper;
/**
 * Created by JetBrains PhpStorm.
 * User: robertpohl
 * Date: 12/06/14
 * Time: 13:50
 * To change this template use File | Settings | File Templates.
 */

class refund extends api_base{

    public static function get($id){
        $remote_url = self::getApiUrl().'refunds/'.$id;
        return http_helper::get(self::getUsername(),self::getPassword(),$remote_url);
    }

    public static function create($data){
        $remote_url = self::getApiUrl().'refunds';
        return http_helper::post(self::getUsername(),self::getPassword(),$remote_url,$data);
    }
}