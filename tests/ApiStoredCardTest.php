<?php
use Mondido\Api\StoredCard;

/**
 * Created by JetBrains PhpStorm.
 * User: robertpohl
 * Date: 25/07/14
 * Time: 23:37
 * To change this template use File | Settings | File Templates.
 */

class ApiStoredCardTest extends TestBase
{

    private $card;

    protected function setUp()
    {
        parent::setUp();
        $data = array(
            "card_number" => "4111111111111111",
            "card_holder" => "php sdk",
            "card_expiry" => "0116",
            "card_cvv" => "200",
            "card_type" => "VISA",
            "currency" => "eur",
            "test" => "true"
        );
        $this->card = $this->api->storedCard()->create($data);
    }

    public function testGetStoredcard()
    {
        echo "Testing stored_card::get\n";

        $res = $this->api->storedCard()->get($this->card['id']);
        print_r($res);
        $this->assertEquals($res['id'], $this->card['id']);
    }

    public function testGetStoredcardsLimitOffset()
    {
        echo "Testing stored_card::index\n";
        $res = $this->api->storedCard()->index(2, 0);
        print_r($res);
        $this->assertEquals(2, count($res));
    }

    public function testDeleteStoredcards()
    {
        echo "Testing stored_card::delete\n";
        $res = $this->api->storedCard()->delete($this->card['id']);
        print_r($res);

        $this->assertEquals('deleted', $res['status']);
    }

    public function testCreateStoredCard()
    {
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

        $res = $this->api->storedCard()->create($data);
        print_r($res);

        $this->assertEquals($res['card_holder'], $ref);
    }


}
