<?php
/**
 * Created by JetBrains PhpStorm.
 * User: robertpohl
 * Date: 25/07/14
 * Time: 23:37
 * To change this template use File | Settings | File Templates.
 */

namespace mondido\test;
use mondido\api\transaction;
use mondido\settings\configuration;
use mondido\models\transaction as transaction_model;
use mondido\models\credit_card;

require_once(dirname(__FILE__) . '/test_base.php');

class api_transaction_Test extends test_base {

    public function testGetTransaction(){
        echo "Testing transaction::get\n";
        $tid = 29621;

        $transaction = transaction::get($tid);
        print_r($transaction);
        $this->assertEquals($tid, $transaction['id']);
    }

    public function testGetTransactionsLimitOffset(){
        echo "Testing transaction::index\n";
        $transactions = transaction::index(10,0);
        print_r($transactions);
        $this->assertEquals(10, count($transactions));
    }

    public function testCreateTransaction(){
        echo "Testing transaction::create\n";
        $ref = "MyOrderId" . (string) rand(10, 100000);

        $transaction = new transaction_model(array(
            #"MerchantId" => "",
            "Amount" => 10,
            "PaymentRef" => $ref,
            "Payment" => new credit_card(array(
                "Holder" => "PHP SDK Test",
                "Cvv" => "200",
                "Expiry" => "0116",
                "Number" => "4111111111111111",
                "Type" => "VISA"
            )),
            "Test" => true,
            "Metadata" => json_encode(array(
                "name" => "PHP SDK"
            )),
            "Currency" => "usd",
            "StoreCard" => true,
            "PlanId" => '',
            #"CustomerRef" => "",
            #"Hash" => "",
            "Webhook" => json_encode(array(
                "trigger" => "payment_success",
                "email" => "myname@domain.com"
            )),
            "Encrypted" => "",
            "Process" => true,
            "SuccessUrl" => "",
            "ErrorUrl" => ""
        ));

        $response = transaction::create($transaction);
        print_r($response);

        $this->assertEquals($ref, $response['payment_ref']);
    }


}
