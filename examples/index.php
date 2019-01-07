<?
error_reporting(E_ALL);
require_once(dirname(__FILE__) . '/../src/mondido_sdk.php');

//get the transaction id from the POST
$transaction = \Mondido\Request\webhook::get();
//get the id
$transaction_id = $transaction['id'];
//log to file

Mondido\mondido_sdk::logToFile('log.txt',$transaction);

$transaction = \Mondido\Api\Transaction::get(1986);
print_r($transaction);

$transactions = \Mondido\Api\Transaction::index(10,0);
print_r($transactions);

$refund = \Mondido\Api\Refund::create($transaction['id'],'wrong payment',$transaction['amount']);
print_r($refund);