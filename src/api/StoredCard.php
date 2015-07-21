<?php namespace Mondido\Api;

use Mondido\HttpHelper;


/**
 * Created by JetBrains PhpStorm.
 * User: robertpohl
 * Date: 12/06/14
 * Time: 13:48
 * To change this template use File | Settings | File Templates.
 */
class StoredCard extends ApiBase
{
    //returns a sc
    public static function get($id)
    {
        $remote_url = self::getApiUrl() . 'stored_cards/' . $id;
        return HttpHelper::get(self::getUsername(), self::getPassword(), $remote_url);
    }

    public static function index($limit, $offset)
    {
        $remote_url = self::getApiUrl() . 'stored_cards/?limit=' . $limit . '&offset=' . $offset;
        return HttpHelper::get(self::getUsername(), self::getPassword(), $remote_url);
    }

    public static function create($card)
    {
        $remote_url = self::getApiUrl() . 'stored_cards';
        return HttpHelper::post(self::getUsername(), self::getPassword(), $remote_url, $card);
    }

    public static function delete($id)
    {
        $remote_url = self::getApiUrl() . 'stored_cards/' . $id;
        return HttpHelper::delete(self::getUsername(), self::getPassword(), $remote_url);
    }

}