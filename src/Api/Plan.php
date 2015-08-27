<?php

namespace Mondido\Api;


use Mondido\HttpHelper;

class Plan extends ApiBase
{
    public function all($options = array())
    {
    	foreach ($options as $filter => $value) {
    		if (substr($filter, 0, 6) != 'filter') {
    			// The user probably wants to filter the request
    			// but didn't format it correctly, so we do it.
    			$options["filter[{$filter}]"] = $value;
                unset ($options[$filter]);
    		}
    	}
        $remote_url = $this->endpoint('plans') . '?' . http_build_query($options);

        return HttpHelper::get($this->username, $this->password, $remote_url);
    }

    public function get($id)
    {
    	return $this->request('get', 'plans/'.$id);
    }
}