<?php
namespace mondido\test;
use mondido\api\stored_card;
/**
 * Created by JetBrains PhpStorm.
 * User: robertpohl
 * Date: 25/07/14
 * Time: 23:37
 * To change this template use File | Settings | File Templates.
 */


require_once(dirname(__FILE__) . '/test_base.php');

class api_transaction_Test extends test_base {

    public static $card;

    public static function setUpBeforeClass()
    {
        $data = array(
            "card_number" => "4111111111111111",
            "card_holder" => "php sdk",
            "card_expiry" => "0116",
            "card_cvv" => "200",
            "card_type" => "VISA",
            "currency" => "eur",
            "test" => "true"
        );
        echo "Testing stored_card, setting up a stored_card\n";
        self::$card = stored_card::create($data);
    }

    public function testGetStoredcard(){
        echo "Testing stored_card::get\n";

        $res = stored_card::get(self::$card['id']);
        $this->assertEquals($res['id'], self::$card['id']);
    }

    public function testGetStoredcardsLimitOffset(){
        echo "Testing stored_card::index\n";
        $res = stored_card::index(2,0);
        $this->assertEquals(2, count($res));
    }

    public function testDeleteStoredcards(){
        echo "Testing stored_card::delete\n";
        $res = stored_card::delete(self::$card['id']);
        $this->assertEquals('deleted', $res['status']);
    }

    public function testCreateStoredCard(){
        echo "Testing stored_card::create\n";
        $ref = rand(10, 100000);

        $data = array(
            "card_number" => "4111111111111111",
            "card_holder" => $ref,
            "card_expiry" => "0116",
            "card_cvv" => "200",
            "card_type" => "VISA",
            "currency" => "eur",
            "test" => "true"
        );

        $res = stored_card::create($data);

        $this->assertEquals($res['card_holder'], $ref);
    }


}
