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

    public function update($id, array $params)
    {
        $remote_url = $this->endpoint('plans/'.$id);

        return HttpHelper::put($this->username, $this->password, $remote_url, $params);
    }
}