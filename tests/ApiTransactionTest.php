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


class ApiTransactionTest extends TestBase
{

    public function testGetTransaction()
    {
        echo "Testing transaction::get\n";
        $ref = rand(10, 100000);
        $testTransaction = $this->api->transaction()->create(array(
            "card_number" => "4111111111111111",
            "card_holder" => "php sdk",
            "card_expiry" => "0116",
            "card_cvv" => "200",
            "card_type" => "VISA",
            "amount" => "20.00",
            "customer_ref" => 1,
            "payment_ref" => $ref,
            "currency" => "eur",
            "test" => "true",
        ));
        $tid = $testTransaction['id'];

        $transaction = $this->api->transaction()->get($tid);
        print_r($transaction);
        $this->assertEquals($tid, $transaction['id']);
        $this->assertEquals($testTransaction, $transaction);
    }

    public function testGetTransactionsLimitOffset()
    {
        echo "Testing transaction::index\n";
        $transactions = $this->api->transaction()->index(10, 0);
        print_r($transactions);
        $this->assertEquals(10, count($transactions));
    }

    public function testCreateTransaction()
    {
        echo "Testing transaction::create\n";
        $ref = "MyOrderId" . (string)rand(10, 100000);

        $transaction = array(
            "Amount" => 10,
            "PaymentRef" => $ref,
            "customerRef" => 1,
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
            "Webhook" => json_encode(array(
                "trigger" => "payment_success",
                "email" => "myname@domain.com"
            )),
            "Encrypted" => "",
            "Process" => true,
            "SuccessUrl" => "",
            "ErrorUrl" => ""
        );

        $response = $this->api->transaction()->create($transaction);
        print_r($response);



        $this->assertEquals($ref, $response['payment_ref']);
    }


}
