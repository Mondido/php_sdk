<?php namespace Mondido\Api;

use Mondido\HttpHelper;


class Transaction extends ApiBase
{
    //returns a transaction
    public function get($id)
    {
        $remote_url = $this->endpoint('transactions/' . $id);
        return HttpHelper::get($this->username, $this->password, $remote_url);
    }

    /*
     * list transactions with a offset and a limit
     */
    public function index($limit, $offset)
    {
        $remote_url = $this->endpoint('transactions/?limit=' . $limit . '&offset=' . $offset);
        return HttpHelper::get($this->username, $this->password, $remote_url);
    }

    public function create($transaction)
    {
        // Make a check to see if we passed in an actual transaction, or just values for the transaction
        if (!($transaction instanceof \Mondido\Models\Transaction)) {
            $transaction = new \Mondido\Models\Transaction($this->username, $this->secret, $transaction);
        }

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

        $remote_url = $this->endpoint('transactions');
        return HttpHelper::post($this->username, $this->password, $remote_url, $params);
    }

}