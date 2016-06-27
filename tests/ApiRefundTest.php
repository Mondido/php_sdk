<?php
use Mondido\Api\Refund;
use Mondido\Api\Transaction;
use Mondido\Settings\Configuration;

/**
 * Created by JetBrains PhpStorm.
 * User: robertpohl
 * Date: 25/07/14
 * Time: 23:37
 * To change this template use File | Settings | File Templates.
 */

class ApiRefundTest extends TestBase
{

    public $refund;
    public $trans;

    protected function setUp()
    {
        parent::setUp();
        $ref = rand(10, 100000);
        $payment = array(
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
//            "hash" => md5($this->api->getUsername() . $ref . "10.00" . $this->api->getSecret())
        );
        echo "Testing refund, setting up a transaction\n";
        $this->trans = $this->api->transaction()->create($payment);
        $data = array(
            "transaction_id" => $this->trans['id'],
            "amount" => "10.00",
            "reason" => "oops"
        );
        echo "Testing refund, setting up a refund\n";
        $this->refund = $this->api->refund()->create($data);
    }

    public function testGetRefund()
    {
        echo "Testing refund::get\n";

        $res = $this->api->refund()->get($this->refund['id']);
        $this->assertEquals($res['id'], $this->refund['id']);
    }

    public function testCreateRefund()
    {
        echo "Testing refund::create\n";
        $ref = rand(10, 100000);

        $data = array(
            "transaction_id" => $this->trans['id'],
            "amount" => "10.00",
            "reason" => $ref
        );

        $res = $this->api->refund()->create($data);
        $this->assertEquals($res['reason'], $ref);
    }


}
