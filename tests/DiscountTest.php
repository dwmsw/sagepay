<?php

use dwmsw\sagepay\Discount;

class DiscountTest extends PHPUnit_Framework_TestCase
{


    public function testConstruct()
    {
        $discount = new Discount(12.00, 'This is a test');

        $this->assertEquals(12.00, $discount->getAmount());
        $this->assertEquals('This is a test', $discount->getDescription());
    }

    public function testGetterSetters()
    {
        $discount = new Discount('', '');

        $discount->setAmount(12.00);
        $discount->setDescription('This is a test');

        $this->assertEquals(12.00, $discount->getAmount());
        $this->assertEquals('This is a test', $discount->getDescription());

        /**
         * And again
         */

        $discount->setAmount(100.00);
        $discount->setDescription('This is another test');

        $this->assertEquals(100.00, $discount->getAmount());
        $this->assertEquals('This is another test', $discount->getDescription());
    }
}