<?php
/**
 * Created by PhpStorm.
 * User: leosjoberg
 * Date: 13/08/15
 * Time: 14:37
 */

namespace Mondido\Models;


class Plan extends BaseModel
{
    protected $allowedAttributes = array(
        'interval_unit',
        'periods',
        'interval',
        'prices',
        'name',
        'description',
        'trial_length',
    );
}