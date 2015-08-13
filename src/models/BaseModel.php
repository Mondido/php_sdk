<?php namespace Mondido\Models;

class BaseModel
{

    public function __construct()
    {
        // ...
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
