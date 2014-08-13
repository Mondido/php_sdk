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

require_once(dirname(__FILE__) . '/test_base.php');

class api_transaction_Test extends test_base {

    public function testGetTransaction(){
        echo "Testing transaction::get\n";

        $transaction = transaction::get(443);
        print_r($transaction);
        $this->assertEquals(443, $transaction['id']);
    }

    public function testGetTransactionsLimitOffset(){
        echo "Testing transaction::index\n";
        $transactions = transaction::index(10,0);
        print_r($transactions);
        $this->assertEquals(10, count($transactions));
    }

    public function testCreateTransaction(){
        echo "Testing transaction::create\n";
        $ref = rand(10, 100000);

        $payment = array(
            "card_number" => "4111111111111111",
            "card_holder" => "php sdk",
            "card_expiry" => "0116",
            "card_cvv" => "200",
            "card_type" => "VISA",
            "amount" => "10.00",
            "payment_ref" => $ref,
            "currency" => "eur",
            "test" => "true",
            "hash" => md5(configuration::$app_settings['username'].$ref."10.00"."eur".configuration::$app_settings['secret'])
            //the currency must be lower case while making the hash
        );
        $transaction = transaction::create($payment);
        print_r($transaction);

        $this->assertEquals($transaction['payment_ref'], $ref);
    }


}
