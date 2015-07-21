<?php namespace Mondido\Api;

use Mondido\HttpHelper;

/**
 * Created by JetBrains PhpStorm.
 * User: robertpohl
 * Date: 12/06/14
 * Time: 13:50
 * To change this template use File | Settings | File Templates.
 */
class Refund extends ApiBase
{

    public static function get($id)
    {
        $remote_url = self::getApiUrl() . 'refunds/' . $id;
        return HttpHelper::get(self::getUsername(), self::getPassword(), $remote_url);
    }

    public static function create($data)
    {
        $remote_url = self::getApiUrl() . 'refunds';
        return HttpHelper::post(self::getUsername(), self::getPassword(), $remote_url, $data);
    }
}