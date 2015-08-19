<?php

namespace Mondido\Api;


use Mondido\HttpHelper;

class Subscription extends ApiBase
{
    public function all($options = array())
    {
        return $this->request('get', 'subscriptions', $options);
    }

    public function update($id, array $params)
    {
        return $this->request('put', 'subscriptions/'.$id, $params);
    }

    public function get($id)
    {
        return $this->request('get', 'subscriptions/'.$id);
    }
}