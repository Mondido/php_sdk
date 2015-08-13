<?php

namespace Mondido\Api;


use Mondido\HttpHelper;

class Plan extends ApiBase
{
    public function all($options = array())
    {
        $remote_url = $this->endpoint('plans') . '?' . http_build_query($options);

        return HttpHelper::get($this->username, $this->password, $remote_url);
    }
}