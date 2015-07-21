<?php
/**
 * Created by JetBrains PhpStorm.
 * User: robertpohl
 * Date: 25/07/14
 * Time: 23:37
 * To change this template use File | Settings | File Templates.
 */

use Mondido\Api\Transaction;
use Mondido\Settings\Configuration;
use Mondido\Models\Transaction as transaction_model;
use Mondido\Models\CreditCard;

require('TestBase.php');

class ApiTransactionTest extends TestBase
{

    public function testGetTransaction()
    {
        echo "Testing transaction::get\n";
        $tid = 29621;

        $transaction = Transaction::get($tid);
        print_r($transaction);
        $this->assertEquals($tid, $transaction['id']);
    }

    public function testGetTransactionsLimitOffset()
    {
        echo "Testing transaction::index\n";
        $transactions = Transaction::index(10, 0);
        print_r($transactions);
        $this->assertEquals(10, count($transactions));
    }

    public function testCreateTransaction()
    {
        echo "Testing transaction::create\n";
        $ref = "MyOrderId" . (string)rand(10, 100000);

        $transaction = new transaction_model(array(
            #"MerchantId" => "",
            "Amount" => 10,
            "PaymentRef" => $ref,
            "Payment" => new CreditCard(array(
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

        $response = Transaction::create($transaction);
        print_r($response);

        $this->assertEquals($ref, $response['payment_ref']);
    }


}
