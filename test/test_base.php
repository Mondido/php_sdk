<?php
/**
 * Created by JetBrains PhpStorm.
 * User: robertpohl
 * Date: 25/07/14
 * Time: 22:46
 * To change this template use File | Settings | File Templates.
 */
namespace mondido\test;

require(dirname(__FILE__) . '/../src/http_helper.php');
require(dirname(__FILE__) . '/../src/request/webhook.php');
require(dirname(__FILE__) . '/../src/api/api_base.php');
require(dirname(__FILE__) . '/../src/api/transaction.php');
require(dirname(__FILE__) . '/../src/api/refund.php');
require(dirname(__FILE__) . '/../src/settings/configuration.php');

class test_base extends \PHPUnit_Framework_TestCase {

}