<?php namespace mondido\api;
use mondido\http_helper;


/**
 * Created by JetBrains PhpStorm.
 * User: robertpohl
 * Date: 12/06/14
 * Time: 13:48
 * To change this template use File | Settings | File Templates.
 */



class transaction  extends api_base{
    //returns a transaction
    public static function get($id){
        $remote_url = self::getApiUrl().'transactions/'.$id;
        return http_helper::get(self::getUsername(),self::getPassword(),$remote_url);
    }

    /*
     * list transactions with a offset and a limit
     */
    public static function index($limit, $offset){
        $remote_url = self::getApiUrl().'transactions/?limit='.$limit.'&offset='.$offset;
        return http_helper::get(self::getUsername(),self::getPassword(),$remote_url);
    }

    public static function create($transaction){
        $transaction_fields = $transaction->getAllAttributes();
        $card_fields = $transaction->getPayment()->getAllAttributes();

        unset($transaction_fields["payment"]);
        $params = array_merge($transaction_fields, $card_fields);
        $params["amount"] = (string) number_format( (float) $params["amount"], 2, '.', '');

        // Remove Null and Update Booleans
        foreach( $params as $attr => $value ){
            if($value == null)
                unset($params[$attr]);
            else if(is_bool($params[$attr])){
                if($params[$attr])
                    $params[$attr] = 'true';
                else
                    $params[$attr] = 'false';
            }
        }

        $remote_url = self::getApiUrl().'transactions';
        return http_helper::post(self::getUsername(),self::getPassword(),$remote_url,$params);
    }

}