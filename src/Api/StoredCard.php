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

    public function get($id)
    {
        $remote_url = $this->endpoint('stored_cards/' . $id);
        return HttpHelper::get($this->username, $this->password, $remote_url);
    }

    public function index($limit, $offset)
    {
        $remote_url = $this->endpoint('stored_cards/?limit=' . $limit . '&offset=' . $offset);
        return HttpHelper::get($this->username, $this->password, $remote_url);
    }

    public function create($card)
    {
        $remote_url = $this->endpoint('stored_cards');
        return HttpHelper::post($this->username, $this->password, $remote_url, $card);
    }

    public function delete($id)
    {
        $remote_url = $this->endpoint('stored_cards/' . $id);
        return HttpHelper::delete($this->username, $this->password, $remote_url);
    }

}