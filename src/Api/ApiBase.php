<?php
/**
 * Created by JetBrains PhpStorm.
 * User: robertpohl
 * Date: 24/07/14
 * Time: 16:29
 * To change this template use File | Settings | File Templates.
 */

namespace Mondido\Api;

use Mondido\HttpHelper;
use Mondido\Settings\Configuration;

class ApiBase
{

    protected $username;
    protected $password;
    protected $secret;
    protected $apiUrl;
    protected $getMethods = array(
        'get',
        'delete',
    );

    /**
     * StoredCard constructor.
     * @param $username
     * @param $password
     * @param $apiUrl
     */
    public function __construct($username, $password, $secret, $apiUrl)
    {
        $this->username = $username;
        $this->password = $password;
        $this->secret = $secret;
        $this->apiUrl = $apiUrl;
    }

    public function endpoint($url)
    {
        return $this->apiUrl . $url;
    }

    public function request($method, $endpoint, array $data = array(), $endpointIsUrl = false)
    {
        if ( ! $endpointIsUrl) {
            $endpoint = $this->endpoint($endpoint);
        }

        $request = array('\Mondido\HttpHelper', $method);

        $arguments = array(
            $this->username,
            $this->password,
            $endpoint,
            $data,
        );

        return call_user_func_array($request, $arguments);
    }
//    public static function getApiUrl()
//    {
//        return Configuration::$app_settings['api_url'];
//    }
//
//    public static function getUsername()
//    {
//        return Configuration::$app_settings['username'];
//    }
//
//    public static function getPassword()
//    {
//        return Configuration::$app_settings['password'];
//    }
}
