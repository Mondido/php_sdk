<?php namespace Mondido\Models;

class BaseModel
{

    protected $allowedAttributes = array();
    protected $attributes = array();

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

    public function getAllAttributes()
    {
        return $this->attributes;
    }

    public function __get($attribute)
    {
        if (isset($this->attributes[$attribute])) {
            return $this->attributes[$attribute];
        }

        return null;
    }

}
