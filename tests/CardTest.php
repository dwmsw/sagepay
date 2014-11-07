<?php

use dwmsw\sagepay\Card;

class CardTest extends PHPUnit_Framework_TestCase
{

    public function testCardTypeException()
    {
        // New card instance
        $card = new Card();

        try {
            // Card details
            $card->setCardType('NOCARDTYPE');
        } catch (InvalidArgumentException $expected) {
            return;
        }

        $this->fail('Card excepted a random card type');
    }

    public function testCardGettersSetters()
    {
        // New card instance
        $card = new dwmsw\sagepay\Card();
        // Card details
        $card->setCardHolder('Mr D P Doyle');
        $card->setCardType('VISA');
        $card->setCardNumber('4929000000006');
        $card->setStartDate(false);
        $card->setExpiryDate('1216');
        $card->setCV2('123');

        $this->assertEquals('Mr D P Doyle', $card->getCardHolder());
        $this->assertEquals('VISA', $card->getCardType());
        $this->assertEquals('4929000000006', $card->getCardNumber());
        $this->assertEquals(false, $card->getStartDate());
        $this->assertEquals('1216', $card->getExpiryDate());
        $this->assertEquals('123', $card->getCV2());
    }

    public function testCardToken()
    {
        // New card instance
        $card = new dwmsw\sagepay\Card();
        // Card details
        $card->setToken('1234567890abcdefghijklmnopqrstuvwxyz');

        $this->assertTrue($card->hasToken());
        $this->assertEquals('1234567890abcdefghijklmnopqrstuvwxyz', $card->getToken());
    }

}
