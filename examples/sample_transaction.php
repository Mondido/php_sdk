<?php

require_once(dirname(__FILE__) . '/../vendor/autoload.php');

use Mondido\Models\Transaction;
use Mondido\Models\CreditCard;

$transaction = new Transaction(array(
	#"MerchantId" => "",
	"Amount" => 10,
	"PaymentRef" => "MyOrderId",
	"Payment" => new CreditCard(array(
		"Holder" => "PHPSDKTest",
		"Cvv" => "200",
		"Expiry" => "0116",
		"Number" => "4111111111111111",
		"Type" => "VISA"
	)),
	"Test" => true,
	#"Metadata" => json_encode(array("name" => "Anderson")),
	"Currency" => "usd",
	"StoreCard" => true,
	"PlanId" => 100,
	#"CustomerRef" => "",
	#"Hash" => "",
	#"Webhook" => json_encode(array("trigger" => "payment_success", "email" => "myname@domain.com")),
	"Encrypted" => "",
	#"Process" => true,
	"SuccessUrl" => "",
	"ErrorUrl" => ""
));

$response = \Mondido\Api\Transaction::create($transaction);
print_r($response);