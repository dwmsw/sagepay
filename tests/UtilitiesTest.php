<?php

use dwmsw\sagepay\Utilities;

class UtilitiesTest extends PHPUnit_Framework_TestCase
{

    public function testGetCurrencies()
    {
        $currencies = Utilities::getCurrencies();

        $this->assertArrayHasKey('GBP', $currencies);
        $this->assertArrayHasKey('AUD', $currencies);
        $this->assertArrayHasKey('USD', $currencies);
    }

    public function testGetCountryCodes()
    {
        $currencies = Utilities::getCountryCodes();

        $this->assertArrayHasKey('GB', $currencies);
        $this->assertArrayHasKey('RS', $currencies);
        $this->assertArrayHasKey('US', $currencies);
    }

}
