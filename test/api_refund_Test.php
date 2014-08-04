<?php
namespace mondido\test;
use mondido\api\refund;
use mondido\api\transaction;
use mondido\settings\configuration;
/**
 * Created by JetBrains PhpStorm.
 * User: robertpohl
 * Date: 25/07/14
 * Time: 23:37
 * To change this template use File | Settings | File Templates.
 */


require_once(dirname(__FILE__) . '/test_base.php');

class api_transaction_Test extends test_base {

    public static $refund;
    public static $trans;

    public static function setUpBeforeClass()
    {
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
            "hash" => md5(configuration::$app_settings['username'].$ref."10.00".configuration::$app_settings['secret'])
        );
        echo "Testing refund, setting up a transaction\n";
        self::$trans = transaction::create($payment);
        $data = array(
            "transaction_id" => self::$trans['id'],
            "amount" => "10.00",
            "reason" => "oops"
        );
        echo "Testing refund, setting up a refund\n";
        self::$refund = refund::create($data);
    }

    public function testGetRefund(){
        echo "Testing refund::get\n";

        $res = refund::get(self::$refund['id']);
        $this->assertEquals($res['id'], self::$refund['id']);
    }

    public function testCreateRefund(){
        echo "Testing refund::create\n";
        $ref = rand(10, 100000);

        $data = array(
            "transaction_id" => self::$trans['id'],
            "amount" => "10.00",
            "reason" => $ref
        );

        $res = refund::create($data);

        $this->assertEquals($res['reason'], $ref);
    }


}
