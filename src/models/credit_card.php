<?php namespace mondido\models;

use mondido\settings\configuration;

class credit_card extends base_model {
	private $card_cvv;
	private $card_number;
	private $card_expiry;
	private $card_holder;
	private $card_type;

	public function __construct($arguments){
		parent::__construct();

		foreach ($arguments as $attribute => $value)
		{
		    $methodName = "set" . $attribute;
		    $this->$methodName($value);
		}
	}

	public function getCvv(){
		return $this->card_cvv;
	}

	public function setCvv($cvv){
		$this->card_cvv = $cvv;
	}

	public function getNumber(){
		return $this->card_number;
	}

	public function setNumber($number){
		$this->card_number = $number;
	}

	public function getExpiry(){
		return $this->card_expiry;
	}

	public function setExpiry($expiry){
		$this->card_expiry = $expiry;
	}

	public function getHolder(){
		return $this->card_holder;
	}

	public function setHolder($holder){
		$this->card_holder = $holder;
	}

	public function getType(){
		return $this->card_type;
	}

	public function setType($type){
		$this->card_type = $type;
	}

	public function getAllAttributes(){
		return get_object_vars($this);
	}
}