<?php namespace Mondido\Models;

use Mondido\Settings\Configuration;

class CreditCard extends BaseModel
{
//    private $card_cvv;
//    private $card_number;
//    private $card_expiry;
//    private $card_holder;
//    private $card_type;

    protected $attributes = array();

    protected $allowedAttributes = array(
        'card_cvv',
        'card_number',
        'card_expiry',
        'card_holder',
        'card_type',
    );

    protected $aliases = array(
        'cvv',
        'number',
        'expiry',
        'holder',
        'type',
    );

    public function __construct($arguments)
    {
        parent::__construct();

        foreach ($arguments as $attribute => $value) {
            $attribute = snakify($attribute);

            $aliasedAttributes = array_combine($this->aliases, $this->allowedAttributes);

            if (in_array($attribute, $this->aliases)) {
                // The user passed an alias instead of the fully qualified attribute name, so we'll convert it
                $attribute = $aliasedAttributes[$attribute];
            }

            if (in_array($attribute, $this->allowedAttributes)) {
                $this->attributes[$attribute] = $value;
            }
        }
    }

    /**
     * is utilized for reading data from inaccessible members.
     *
     * @param $name string
     * @return mixed
     * @link http://php.net/manual/en/language.oop5.overloading.php#language.oop5.overloading.members
     */
    public function __get($name)
    {
        return $this->attributes[snakify($name)];
    }


    public function getCvv()
    {
        return $this->card_cvv;
    }

    public function setCvv($cvv)
    {
        $this->card_cvv = $cvv;
    }

    public function getNumber()
    {
        return $this->card_number;
    }

    public function setNumber($number)
    {
        $this->card_number = $number;
    }

    public function getExpiry()
    {
        return $this->card_expiry;
    }

    public function setExpiry($expiry)
    {
        $this->card_expiry = $expiry;
    }

    public function getHolder()
    {
        return $this->card_holder;
    }

    public function setHolder($holder)
    {
        $this->card_holder = $holder;
    }

    public function getType()
    {
        return $this->card_type;
    }

    public function setType($type)
    {
        $this->card_type = $type;
    }

    public function getAllAttributes()
    {
        return $this->attributes;
    }
}