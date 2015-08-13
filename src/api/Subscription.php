<?php

namespace Mondido\Api;


use Mondido\HttpHelper;

class Subscription extends ApiBase
{
    public function all($options = array())
    {
        $remote_url = $this->endpoint('subscriptions') . '?' . http_build_query($options);

        return HttpHelper::get($this->username, $this->password, $remote_url);
    }
}