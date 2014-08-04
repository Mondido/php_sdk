<?php
/**
 * Created by JetBrains PhpStorm.
 * User: robertpohl
 * Date: 25/07/14
 * Time: 23:49
 * To change this template use File | Settings | File Templates.
 */

namespace mondido\test;
use mondido\request\webhook;
use mondido\api\transaction;

require_once(dirname(__FILE__) . '/test_base.php');

class webhook_Test extends test_base {

    /**
     * @covers webhook::get
     */
    public function testGetwebhook(){
        echo "Testing webhook::get\n";
        $transaction = transaction::get(443);
        $path = 'wh.json';
        file_put_contents($path, json_encode($transaction));

        $transaction2 = webhook::get($path);
        $this->assertEquals($transaction['id'], $transaction2['id']);
    }
}
