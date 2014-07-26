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

require_once(dirname(__FILE__) . '/test_base.php');

class api_transaction_Test extends test_base {

    public function testGetTransaction(){
        $transaction = transaction::get(443);
        $this->assertEquals(443, $transaction['id']);
    }

    public function testGetTransactionsLimitOffset(){
        $transactions = transaction::index(10,0);
        $this->assertEquals(10, count($transactions));
    }
}
