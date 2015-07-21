<?php
namespace Mondido;

use Mondido\Api\Refund;
use Mondido\Api\StoredCard;
use Mondido\Api\Transaction;
use Mondido\Settings\Configuration;

class Mondido
{
    private $username;
    private $password;
    private $secret;
    private $apiUrl;
    private $algorithm;
    /*
     * parse POST JSON data from WebHook
     */
    public function __construct($username = null, $password = null, $secret = null, $apiUrl = null, $algorithm = null)
    {
        $this->setIfExists('username', $username);
        $this->setIfExists('password', $password);
        $this->setIfExists('secret', $secret);
        $this->setIfExists('apiUrl', $apiUrl);
        $this->setIfExists('algorithm', $algorithm);
    }

    private function setIfExists($attribute, $value)
    {
        if ($value) {
            $this->$attribute = $value;
        } else {
            $this->$attribute = Configuration::$app_settings[snakify($attribute)];
        }
    }

    public function refund()
    {
        return new Refund($this->username, $this->password, $this->secret, $this->apiUrl);
    }

    public function storedCard()
    {
        return new storedCard($this->username, $this->password, $this->secret, $this->apiUrl);
    }

    public function transaction()
    {
        return new Transaction($this->username, $this->password, $this->secret, $this->apiUrl);
    }

    public function getApiUrl()
    {
        return $this->apiUrl;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getSecret()
    {
        return $this->secret;
    }

    /*
     *Log data to file
     */
    public static function logToFile($path, $transaction)
    {

        $log = 'id: ' . $transaction['id'] . PHP_EOL;
        $log .= 'created_at: ' . $transaction['created_at'] . PHP_EOL;
        $log .= 'amount: ' . $transaction['amount'] . PHP_EOL;
        $log .= 'payment_ref: ' . $transaction['payment_ref'] . PHP_EOL;
        $log .= 'card_holder: ' . $transaction['card_holder'] . PHP_EOL;
        $log .= 'card_number: ' . $transaction['card_number'] . PHP_EOL;
        $log .= 'metadata: ' . $transaction['metadata'] . PHP_EOL;
        $log .= 'currency: ' . $transaction['currency'] . PHP_EOL;
        $log .= 'status: ' . $transaction['status'] . PHP_EOL;
        $log .= 'card_type: ' . $transaction['card_type'] . PHP_EOL;
        $log .= 'error: ' . $transaction['error'] . PHP_EOL;
        $log .= 'cost: ' . $transaction['cost'] . PHP_EOL;
        $log .= 'stored_card: ' . $transaction['stored_card'] . PHP_EOL;
        $log .= 'customer: ' . $transaction['customer'] . PHP_EOL;
        $log .= 'transaction_type: ' . $transaction['transaction_type'] . PHP_EOL;
        $log .= 'subscription: ' . $transaction['subscription'] . PHP_EOL;
        $log .= 'webhooks: ' . $transaction['webhooks'] . PHP_EOL;
        file_put_contents($path, $log);
    }
}