<?php

namespace Mondido\Models;


class Customer extends BaseModel
{
    protected $attributes = array();

    protected $allowedAttributes = array(
        'ref',
        'metadata',
    );

    /**
     * Customer constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes)
    {
        foreach ($attributes as $attribute => $value) {
            if (in_array($attribute, $this->allowedAttributes)) {
                $this->attributes[$attribute] = $value;
            } else {
                $this->attributes['metadata'][$attribute] = $value;
            }
        }

        $this->attributes = $attributes;
    }


}