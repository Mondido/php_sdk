<?php namespace mondido\models;

use mondido\settings\configuration;

class transaction extends base_model {
	private $merchant_id;
	private $amount;
	private $payment_ref;
	private $payment;
	private $test;
	private $metadata;
	private $currency;
	private $store_card;
	private $plan_id;
	private $customer_ref;
	private $hash;
	private $webhook;
	private $encrypted;
	private $process;
	private $success_url;
	private $error_url;

	public function __construct($arguments){
		parent::__construct();

		foreach ($arguments as $attribute => $value)
		{
		    $methodName = "set" . $attribute;
		    $this->$methodName($value);
		}

		if(!isset($arguments["MerchantId"]))
			$this->setMerchantId( configuration::$app_settings['username'] );

		if(!isset($arguments["Hash"]))
			$this->setHash();
	}

	public function getMerchantId(){
		return $this->merchant_id;
	}

	public function setMerchantId($merchantId){
		$this->merchant_id = $merchantId;
	}

	public function getAmount(){
		return $this->amount;
	}

	public function setAmount($amount){
		$this->amount = $amount;
	}

	public function getPaymentRef(){
		return $this->payment_ref;
	}

	public function setPaymentRef($paymentRef){
		$this->payment_ref = $paymentRef;
	}


	public function getPayment(){
		return $this->payment;
	}

	public function setPayment($payment){
		$this->payment = $payment;
	}

	public function getTest(){
		return $this->test;
	}

	public function setTest($test){
		$this->test = $test;
	}

	public function getMetadata(){
		return $this->metadata;
	}

	public function setMetadata($metadata){
		$this->metadata = $metadata;
	}

	public function getCurrency(){
		return $this->currency;
	}

	public function setCurrency($currency){
		$this->currency = $currency;
	}

	public function getStoreCard(){
		return $this->store_card;
	}

	public function setStoreCard($storeCard){
		$this->store_card = $storeCard;
	}

	public function getPlanId(){
		return $this->plan_id;
	}

	public function setPlanId($planId){
		$this->plan_id = $planId;
	}

	public function getCustomerRef(){
		return $this->customer_ref;
	}

	public function setCustomerRef($customerRef){
		$this->customer_ref = $customerRef;
	}

	public function getHash(){
		return $this->hash;
	}

	public function setHash($options=array("secret" => null, "algorithm" => null)){
		if(!$options["secret"]) $secret = configuration::$app_settings['secret'];
		if(!$options["algorithm"]) $algorithm = configuration::$app_settings['algorithm'];
		$this->hash = $this->calculateHash($secret, $algorithm);
	}

	public function getWebhook(){
		return $this->webhook;
	}

	public function setWebhook($webhook){
		$this->webhook = $webhook;
	}

	public function getEncrypted(){
		return $this->encrypted;
	}

	public function setEncrypted($encrypted){
		$this->encrypted = $encrypted;
	}

	public function getProcess(){
		return $this->process;
	}

	public function setProcess($process){
		$this->process = $process;
	}

	public function getSuccessUrl(){
		return $this->success_url;
	}

	public function setSuccessUrl($successUrl){
		$this->success_url = $successUrl;
	}

	public function getErrorUrl(){
		return $this->error_url;
	}

	public function setErrorUrl($errorUrl){
		$this->error_url = $errorUrl;
	}

	# Custom

	private function calculateHash($secret, $algorithm){
		$recipe = (string) $this->getMerchantId();
		$recipe .= (string )$this->getPaymentRef();
		$recipe .= (string) $this->getCustomerRef();
		$recipe .= (string) number_format( (float) $this->getAmount(), 2, '.', '');
		$recipe .= (string) $this->getCurrency();
		$recipe .= ($this->getTest()) ? "test" : "";
		$recipe .= $secret;

		return $algorithm($recipe);
	}

	public function getAllAttributes(){
		return get_object_vars($this);
	}

}