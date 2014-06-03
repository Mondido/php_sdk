<?
error_reporting(-1);
include_once 'mondido_sdk.php';

//get the transaction id from the POST
$transaction = mondido\mondido_sdk::getWebHook();
//get the id
$transaction_id = $transaction['id'];
//log to file

mondido\mondido_sdk::logToFile('log.txt',$transaction);

$transaction = mondido\mondido_sdk::getTransaction(1986);
print_r($transaction);

$transactions = mondido\mondido_sdk::listTransactions(10,0);
print_r($transactions);

$refund = mondido\mondido_sdk::createRefund($transaction['id'],'wrong payment',$transaction['amount']);
print_r($refund);