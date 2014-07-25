<?php namespace mondido\api;
use mondido\http_helper;


/**
 * Created by JetBrains PhpStorm.
 * User: robertpohl
 * Date: 12/06/14
 * Time: 13:48
 * To change this template use File | Settings | File Templates.
 */



class transaction  extends api_base{
    //returns a transaction
    public static function get($id){
        $remote_url = self::getApiUrl().'transactions/'.$id;
        return http_helper::get(self::getUsername(),self::getPassword(),$remote_url);
    }
    public static function create($params){

    }

    /*
     * list transactions with a offset and a limit
     */
    public static function index($limit, $offset){
        $remote_url = self::getApiUrl().'transactions/?limit='.$limit.'&offset='.$offset;
        return http_helper::get(self::getUsername(),self::getPassword(),$remote_url);
    }

}