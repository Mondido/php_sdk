<?php

require_once(dirname(__FILE__) . '/../src/mondido_sdk.php');

use mondido\models\transaction;
use mondido\models\credit_card;

$transaction = new transaction(array(
	#"MerchantId" => "",
	"Amount" => 10,
	"PaymentRef" => "MyOrderId",
	"Payment" => new credit_card(array(
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

$response = mondido\api\transaction::create($transaction);
print_r($response);