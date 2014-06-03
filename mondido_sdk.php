<?php namespace mondido;
include_once 'http_helper.php';
/**
 * Created by JetBrains PhpStorm.
 * User: robertpohl
 * Date: 03/06/14
 * Time: 15:50
 * To change this template use File | Settings | File Templates.
 * version 1.0
 */

class mondido_sdk {
    public $raw_data = null;
    public $transaction = null;
    private static $username = "1";
    private static $password = "custom00";
    private static $apiUrl = "http://api.localmondido.com:3000/v1/";

    /*
     * parse POST JSON data from WebHook
     */
    public function __construct()
    {
    }

    public static function getWebHook(){
        $raw_data = file_get_contents('php://input');
        if($raw_data != null){
            return json_decode($raw_data, TRUE);
        }
        return null;
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

    //returns a transaction
    public static function getTransaction($id){
        $remote_url = self::$apiUrl.'transactions/'.$id;
        $uname = self::$username;
        $pass = self::$password;
        return http_helper::get($uname,$pass,$remote_url);
    }
    public static function createTransaction($params){

    }

    /*
     * list transactions with a offset and a limit
     */
    public static function listTransactions($limit, $offset){
        $remote_url = self::$apiUrl.'transactions/?limit='.$limit.'&offset='.$offset;
        $uname = self::$username;
        $pass = self::$password;
        return http_helper::get($uname,$pass,$remote_url);
    }

    public static function createRefund($transaction_id,$reason,$amount){
        $remote_url = self::$apiUrl.'refunds';
        $uname = self::$username;
        $pass = self::$password;
        $data = array('transaction_id' => $transaction_id, 'reason' => $reason, 'amount' => $amount);
        return http_helper::post($uname,$pass,$remote_url,$data);
    }
}