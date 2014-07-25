<?php namespace mondido\api;
/**
 * Created by JetBrains PhpStorm.
 * User: robertpohl
 * Date: 12/06/14
 * Time: 13:50
 * To change this template use File | Settings | File Templates.
 */




class refund {
    public static function create($transaction_id,$reason,$amount){
        $remote_url = self::$apiUrl.'refunds';
        $uname = self::$username;
        $pass = self::$password;
        $data = array('transaction_id' => $transaction_id, 'reason' => $reason, 'amount' => $amount);
        return http_helper::post($uname,$pass,$remote_url,$data);
    }
}