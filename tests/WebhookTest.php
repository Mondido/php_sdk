<?php
/**
 * Created by JetBrains PhpStorm.
 * User: robertpohl
 * Date: 25/07/14
 * Time: 23:49
 * To change this template use File | Settings | File Templates.
 */

use Mondido\Request\webhook;
use Mondido\Api\Transaction;


class WebhookTest extends TestBase
{

    /**
     * @covers webhook::get
     */
    public function testGetwebhook()
    {
        echo "Testing webhook::get\n";
        $ref = mt_rand(10, 100000);
        $transaction = $this->api->transaction()->create(array(
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
        $path = 'wh.json';
        file_put_contents($path, json_encode($transaction));

        $transaction2 = webhook::get($path);
        $this->assertEquals($transaction['id'], $transaction2['id']);
    }
}
