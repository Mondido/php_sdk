<?
error_reporting(E_ALL);
include 'src/mondido_sdk.php';

//get the transaction id from the POST
$transaction = mondido\request\webhook::get();
//get the id
$transaction_id = $transaction['id'];
//log to file

mondido\mondido_sdk::logToFile('log.txt',$transaction);

$transaction = mondido\api\transaction::get(1986);
print_r($transaction);

$transactions = mondido\api\transaction::index(10,0);
print_r($transactions);

$refund = mondido\api\refund::create($transaction['id'],'wrong payment',$transaction['amount']);
print_r($refund);