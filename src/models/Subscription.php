<?php
/**
 * Created by PhpStorm.
 * User: leosjoberg
 * Date: 13/08/15
 * Time: 14:37
 */

namespace Mondido\Models;


class Subscription extends BaseModel
{
    protected $allowedAttributes = array(
        'plan_id',
        'stored_card_id',
        'customer_ref',
        'customer_id',
        'quantity',
        'debt',
        'status',
    );
}