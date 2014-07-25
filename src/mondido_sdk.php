<?php
namespace mondido;

require(dirname(__FILE__) . '/http_helper.php');
require(dirname(__FILE__) . '/request/webhook.php');
require(dirname(__FILE__) . '/api/transaction.php');
require(dirname(__FILE__) . '/api/refund.php');
require(dirname(__FILE__) . '/settings/configuration.php');


class mondido_sdk {

    /*
     * parse POST JSON data from WebHook
     */
    public function __construct()
    {
    }


    /*
     *Log data to file
     */
    public static function logToFile($path,$transaction){

        $log = 'id: '.$transaction['id'].PHP_EOL;
        $log .= 'created_at: '.$transaction['created_at'].PHP_EOL;
        $log .= 'amount: '.$transaction['amount'].PHP_EOL;
        $log .= 'payment_ref: '.$transaction['payment_ref'].PHP_EOL;
        $log .= 'card_holder: '.$transaction['card_holder'].PHP_EOL;
        $log .= 'card_number: '.$transaction['card_number'].PHP_EOL;
        $log .= 'metadata: '.$transaction['metadata'].PHP_EOL;
        $log .= 'currency: '.$transaction['currency'].PHP_EOL;
        $log .= 'status: '.$transaction['status'].PHP_EOL;
        $log .= 'card_type: '.$transaction['card_type'].PHP_EOL;
        $log .= 'error: '.$transaction['error'].PHP_EOL;
        $log .= 'cost: '.$transaction['cost'].PHP_EOL;
        $log .= 'stored_card: '.$transaction['stored_card'].PHP_EOL;
        $log .= 'customer: '.$transaction['customer'].PHP_EOL;
        $log .= 'transaction_type: '.$transaction['transaction_type'].PHP_EOL;
        $log .= 'subscription: '.$transaction['subscription'].PHP_EOL;
        $log .= 'webhooks: '.$transaction['webhooks'].PHP_EOL;
        file_put_contents($path, $log);
    }
}