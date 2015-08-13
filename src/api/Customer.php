<?php
/**
 * Created by PhpStorm.
 * User: leosjoberg
 * Date: 13/08/15
 * Time: 10:39
 */

namespace Mondido\Api;


use Mondido\HttpHelper;

class Customer extends ApiBase
{
    public function get($id)
    {
        $remote_url = $this->endpoint('customers/' . $id);
        return HttpHelper::get($this->username, $this->password, $remote_url);
    }

    public function index()
    {
        $remote_url = $this->endpoint('customers');
        return HttpHelper::get($this->username, $this->password, $remote_url);
    }

    public function create($customer)
    {
        if (!($customer instanceof \Mondido\Models\Customer)) {
            $customer = new \Mondido\Models\Customer($this->username, $this->secret, $transaction);
        }

        $params = $customer->getAllAttributes();

        foreach ($params as $attr => $value) {
            if ($value == null) {
                unset($params[$attr]);
            } else {
                if (is_bool($params[$attr])) {
                    if ($params[$attr]) {
                        $params[$attr] = 'true';
                    } else {
                        $params[$attr] = 'false';
                    }
                }
            }
        }
        
        $remote_url = $this->endpoint('customers');
        return HttpHelper::post($this->username, $this->password, $remote_url, $params);
    }

    public function update($customer)
    {
        if (!($customer instanceof \Mondido\Models\Customer)) {
            $customer = new \Mondido\Models\Customer($this->username, $this->secret, $customer);
        }

        $remote_url = $this->endpoint('customers/' . $customer->id);
        return HttpHelper::put($this->username, $this->password, $remote_url, $customer->getAllAttributes());
    }

    public function delete($id)
    {
        $remote_url = $this->endpoint('customers/' . $id);
        return HttpHelper::delete($this->username, $this->password, $remote_url);
    }
}