<?php namespace mondido\api;
use mondido\http_helper;


/**
 * Created by JetBrains PhpStorm.
 * User: robertpohl
 * Date: 12/06/14
 * Time: 13:48
 * To change this template use File | Settings | File Templates.
 */



class stored_card extends api_base{
    //returns a sc
    public static function get($id){
        $remote_url = self::getApiUrl().'stored_cards/'.$id;
        return http_helper::get(self::getUsername(),self::getPassword(),$remote_url);
    }

    public static function index($limit, $offset){
        $remote_url = self::getApiUrl().'stored_cards/?limit='.$limit.'&offset='.$offset;
        return http_helper::get(self::getUsername(),self::getPassword(),$remote_url);
    }

    public static function create($card){
        $remote_url = self::getApiUrl().'stored_cards';
        return http_helper::post(self::getUsername(),self::getPassword(),$remote_url,$card);
    }

    public static function delete($id){
        $remote_url = self::getApiUrl().'stored_cards/'.$id;
        return http_helper::delete(self::getUsername(),self::getPassword(),$remote_url);
    }

}