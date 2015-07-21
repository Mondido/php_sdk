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

require('TestBase.php');

class WebhookTest extends TestBase
{

    /**
     * @covers webhook::get
     */
    public function testGetwebhook()
    {
        echo "Testing webhook::get\n";
        $transaction = Transaction::get(443);
        $path = 'wh.json';
        file_put_contents($path, json_encode($transaction));

        $transaction2 = webhook::get($path);
        $this->assertEquals($transaction['id'], $transaction2['id']);
    }
}
