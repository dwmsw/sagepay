<?php

class BasketTest extends PHPUnit_Framework_TestCase
{

    public function testAddToBasket()
    {
        $basket = new dwmsw\sagepay\Basket();
        $basket->addItem(new dwmsw\sagepay\Item('Test Item', 30.00, 6, 1));
        $amount = $basket->getAmount();

        $this->assertEquals($amount, 36);
    }

    public function testAddToBasketMultiple()
    {
        $basket = new dwmsw\sagepay\Basket();
        $basket->addItem(new dwmsw\sagepay\Item('Test Item', 30.00, 6, 1));
        $basket->addItem(new dwmsw\sagepay\Item('Test Item', 30.00, 6, 2));
        $amount = $basket->getAmount();

        $this->assertEquals($amount, 108);
    }

    public function testFailureWithDifferentNodeNames()
    {
        $basket = new dwmsw\sagepay\Basket();
        $basket->addItem(new dwmsw\sagepay\Item('Test Item', 30.00, 6, 1));
        $output = $basket->getItems(true);

        $expected = '<basket>
                      <item>
                        <description>Test Item</description>
                        <quantity>1</quantity>
                        <unitNetAmount>30.00</unitNetAmount>
                        <unitTaxAmount>6.00</unitTaxAmount>
                        <unitGrossAmount>36.00</unitGrossAmount>
                        <totalGrossAmount>36.00</totalGrossAmount>
                      </item>
                    </basket>';

        $this->assertXmlStringEqualsXmlString($expected, $output);
    }
}
