<?php namespace Mondido\Models;

use Mondido\Settings\Configuration;

class Transaction extends BaseModel
{
//    private $merchant_id;
//    private $amount;
//    private $payment_ref;
//    private $payment;
//    private $test;
//    private $metadata;
//    private $currency;
//    private $store_card;
//    private $plan_id;
//    private $customer_ref;
//    private $hash;
//    private $webhook;
//    private $encrypted;
//    private $process;
//    private $success_url;
//    private $error_url;
    private $attributes = array();

    protected $allowedAttributes = array(
        'merchant_id',
        'amount',
        'payment_ref',
        'payment',
        'test',
        'metadata',
        'currency',
        'store_card',
        'plan_id',
        'customer_ref',
        'hash',
        'webhook',
        'encrypted',
        'process',
        'success_url',
        'error_url',
    );

    private $cardAttributes = array(
        "card_number",
        "card_holder",
        "card_expiry",
        "card_cvv",
        "card_type",
    );

    public function __construct($merchantId, $secret, $arguments, $paymentRef = null, $customerRef = null)
    {
        parent::__construct();

        $this->attributes['merchant_id'] = $merchantId;
        $this->attributes['payment_ref'] = $paymentRef;
        $this->attributes['customer_ref'] = $customerRef;
        $this->attributes['secret'] = $secret;

        $payment = array();

        foreach ($arguments as $attribute => $value) {
//            $methodName = "set" . $attribute;
//            $this->$methodName($value);
            $attribute = snakify($attribute);
            if(in_array($attribute, $this->cardAttributes)) {
                $payment[$attribute] = $value;
            }

            if(in_array($attribute, $this->allowedAttributes)) {
                $this->attributes[$attribute] = $value;
            }
        }

        if (! ($this->paymentRef && $this->customerRef)) {
            throw new \Exception("You must provide both a payment reference and a customer reference to make a transaction");
        }

        if (!empty($payment) && is_array($payment)) {
            $this->attributes['payment'] = new CreditCard($payment);
        }

//        if (!isset($arguments["MerchantId"])) {
//            $this->setMerchantId(Configuration::$app_settings['username']);
//        }

        if (!isset($arguments["hash"])) {
            $this->setHash($secret);
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


    public function getMerchantId()
    {
        return $this->merchant_id;
    }

    public function setMerchantId($merchantId)
    {
        $this->merchant_id = $merchantId;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    public function getPaymentRef()
    {
        return $this->payment_ref;
    }

    public function setPaymentRef($paymentRef)
    {
        $this->payment_ref = $paymentRef;
    }

    public function getPayment()
    {
        return $this->payment;
    }

    public function setPayment($payment)
    {
        $this->payment = $payment;
    }

    public function getTest()
    {
        return $this->test;
    }

    public function setTest($test)
    {
        $this->test = $test;
    }

    public function getMetadata()
    {
        return $this->metadata;
    }

    public function setMetadata($metadata)
    {
        $this->metadata = $metadata;
    }

    public function getCurrency()
    {
        return $this->currency;
    }

    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    public function getStoreCard()
    {
        return $this->store_card;
    }

    public function setStoreCard($storeCard)
    {
        $this->store_card = $storeCard;
    }

    public function getPlanId()
    {
        return $this->plan_id;
    }

    public function setPlanId($planId)
    {
        $this->plan_id = $planId;
    }

    public function getCustomerRef()
    {
        return $this->customer_ref;
    }

    public function setCustomerRef($customerRef)
    {
        $this->customer_ref = $customerRef;
    }

    public function getHash()
    {
        return $this->hash;
    }

    public function setHash($secret, $algorithm = null)
    {
        if (!$secret) {
            $secret = Configuration::$app_settings['secret'];
        }
        if (!$algorithm) {
            $algorithm = Configuration::$app_settings['algorithm'];
        }
        $this->attributes['hash'] = $this->calculateHash($secret, $algorithm);
    }

    public function getWebhook()
    {
        return $this->webhook;
    }

    public function setWebhook($webhook)
    {
        $this->webhook = $webhook;
    }

    public function getEncrypted()
    {
        return $this->encrypted;
    }

    public function setEncrypted($encrypted)
    {
        $this->encrypted = $encrypted;
    }

    public function getProcess()
    {
        return $this->process;
    }

    public function setProcess($process)
    {
        $this->process = $process;
    }

    public function getSuccessUrl()
    {
        return $this->success_url;
    }

    public function setSuccessUrl($successUrl)
    {
        $this->success_url = $successUrl;
    }

    public function getErrorUrl()
    {
        return $this->error_url;
    }

    public function setErrorUrl($errorUrl)
    {
        $this->error_url = $errorUrl;
    }

    # Custom

    private function calculateHash($secret, $algorithm)
    {
        $recipe = (string)$this->getMerchantId();
        $recipe .= (string )$this->getPaymentRef();
        $recipe .= (string)$this->getCustomerRef();
        $recipe .= (string)number_format((float)$this->getAmount(), 2, '.', '');
        $recipe .= (string)$this->getCurrency();
        $recipe .= ($this->getTest()) ? "test" : "";
        $recipe .= $secret;

        return $algorithm($recipe);
    }

}