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
    public function get($id)
    {
        $remote_url = $this->endpoint('refunds/' . $id);
        return HttpHelper::get($this->username, $this->password, $remote_url);
    }

    public function create($data)
    {
        $remote_url = $this->endpoint('refunds');
        return HttpHelper::post($this->username, $this->password, $remote_url, $data);
    }
}