<?php namespace Mondido\Api;

use Mondido\HttpHelper;


/**
 * Created by JetBrains PhpStorm.
 * User: robertpohl
 * Date: 12/06/14
 * Time: 13:48
 * To change this template use File | Settings | File Templates.
 */
class Transaction extends ApiBase
{
    //returns a transaction
    public static function get($id)
    {
        $remote_url = self::getApiUrl() . 'transactions/' . $id;
        return HttpHelper::get(self::getUsername(), self::getPassword(), $remote_url);
    }

    /*
     * list transactions with a offset and a limit
     */
    public static function index($limit, $offset)
    {
        $remote_url = self::getApiUrl() . 'transactions/?limit=' . $limit . '&offset=' . $offset;
        return HttpHelper::get(self::getUsername(), self::getPassword(), $remote_url);
    }

    public static function create(\Mondido\Models\Transaction $transaction)
    {
        $transaction_fields = $transaction->getAllAttributes();
        $card_fields = $transaction->getPayment()->getAllAttributes();

        unset($transaction_fields["payment"]);
        $params = array_merge($transaction_fields, $card_fields);
        $params["amount"] = (string)number_format((float)$params["amount"], 2, '.', '');

        // Remove Null and Update Booleans
        foreach ($params as $attr => $value) {
            if ($value == null) {
                unset($params[$attr]);
            } else {
                if (is_bool($params[$attr])) {
                    if ($params[$attr]) {
                        $params[$attr] = 'true';
                    } else {
                        $params[$attr] = 'false';
                    }
                }
            }
        }

        $remote_url = self::getApiUrl() . 'transactions';
        return HttpHelper::post(self::getUsername(), self::getPassword(), $remote_url, $params);
    }

}