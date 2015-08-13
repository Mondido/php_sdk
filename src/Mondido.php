<?php
namespace Mondido;

use Mondido\Api\Customer;
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

    public $refund;
    public $storedCard;
    public $transaction;
    public $customer;

    private $hostedWindowUrl = 'https://pay.mondido.com/v1/form';
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

        $this->refund = new Refund($this->username, $this->password, $this->secret, $this->apiUrl);
        $this->storedCard = new storedCard($this->username, $this->password, $this->secret, $this->apiUrl);
        $this->transaction = new Transaction($this->username, $this->password, $this->secret, $this->apiUrl);
        $this->customer = new Customer($this->username, $this->password, $this->secret, $this->apiUrl);
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
    private function setIfExists($attribute, $value)
    {
        if ($value) {
            $this->$attribute = $value;
        } else {
            $this->$attribute = Configuration::$app_settings[snakify($attribute)];
        }
    }

    public function generateHash($paymentRef, $customerRef, $amount, $currency, $test = null)
    {
        $recipe = (string) $this->username;
        $recipe .= (string )$paymentRef;
        $recipe .= (string)$customerRef;
        $recipe .= (string)number_format((float)$amount, 2, '.', '');
        $recipe .= (string)$currency;
        $recipe .= $test ? "test" : "";
        $recipe .= $this->secret;

        $algorithm = $this->algorithm;

        return $algorithm($recipe);
    }

    public function generatePostForm($payload)
    {
        if (!isset ($payload['amount'])) {
            throw new \Exception('You need to specify an amount');
        }

        $payload['amount'] = number_format((float)$payload['amount'], 2, '.', '');

        if (!isset($payload['hash'])) {
            $test = null;
            if (isset($payload['test'])) {
                $test = $payload['test'];
            }

            $paymentRef = $payload['payment_ref'];
            $customerRef = $payload['customer_ref'];
            $amount = $payload['amount'];
            $currency = $payload['currency'];

            if (! (
                isset ($paymentRef) &&
                isset ($customerRef) &&
                isset ($amount) &&
                isset ($currency)
            )) {
                throw new \Exception('You need to define payment and customer reference, amount and currency to generate a correct hash');
            }

            $payload['hash'] = $this->generateHash($paymentRef, $customerRef, $amount, $currency, $test);
        }

        $form = '<form id="mondido-redirect" method="post" action="' . $this->hostedWindowUrl . '">';
        $form .= '<input type="hidden" name="merchant_id" value="' . $this->username . '">';

        foreach ($payload as $dataType => $data) {
            if (is_array($data)) {
                $data = json_encode($data);
            }
            $form .= '<input type="hidden" name="' . $dataType . '" value="' . $data . '">';
        }

        $form .= '<input type="submit" value="submit">';
        $form .= '</form>';

        // The JS to make this work
        $form .=
            '<script>' .
                'document.getElementById("mondido-redirect").submit()' .
            '</script>';

        return $form;
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