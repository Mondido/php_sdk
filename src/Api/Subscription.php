<?php

namespace Mondido\Api;


use Mondido\HttpHelper;

class Subscription extends ApiBase
{
    /**
     * Retrieve all subscriptions.
     * 
     * @param  array  $options
     * @return array
     */
    public function all($options = array())
    {
        return $this->request('get', 'subscriptions', $options);
    }

    /**
     * Update a given subscription.
     * 
     * @param  int $id
     * @param  array  $params
     * @return array
     */
    public function update($id, array $params)
    {
        return $this->request('put', 'subscriptions/'.$id, $params);
    }

    /**
     * Fetch a given subscription.
     * 
     * @param  int $id
     * @return array
     */
    public function get($id)
    {
        return $this->request('get', 'subscriptions/'.$id);
    }

    /**
     * Create a new subscription.
     * @param  string $planId
     * @param  int|string $identifier
     * @param  string $identifierType
     * @return array
     */
    public function create($planId, $identifier, $identifierType = 'ref')
    {
        $types = [
            'card' => 'stored_card_id',
            'ref' => 'customer_ref',
            'customer' => 'customer_id'
        ];
        
        $type = isset($types[$identifierType]) ? $types[$identifierType] : $identifierType;

        return $this->request('post', 'subscriptions', array(
            'plan_id'   => $planId,
            $type       => $identifier,
            'quantity'  => 1,
        ));
    }
}