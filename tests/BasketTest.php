<?php

class BasketTest extends PHPUnit_Framework_TestCase
{

    private $basket;

    public function setUp()
    {
        $this->basket = new dwmsw\sagepay\Basket();
    }

    public function testDeliveryNetAmount()
    {
        $this->basket->setDeliveryNetAmount(3.00);

        $amount = $this->basket->getDeliveryNetAmount();

        $this->assertEquals(3.00, $amount);
    }

    public function testDeliveryTaxAmount()
    {
        $this->basket->setDeliveryTaxAmount(.6);

        $amount = $this->basket->getDeliveryTaxAmount();

        $this->assertEquals(0.60, $amount);
    }

    public function testDeliveryGrossAmount()
    {
        $this->basket->setDeliveryNetAmount(3.00);
        $this->basket->setDeliveryTaxAmount(.6);

        $amount = $this->basket->getDeliveryGrossAmount();

        $this->assertEquals(3.60, $amount);
    }

    public function testItems()
    {
        $this->basket->setDeliveryNetAmount(3.00);
        $this->basket->setDeliveryTaxAmount(.6);

        $item = new dwmsw\sagepay\Item('Test Item',2.00, .4, 1);

        $this->basket->addItem($item);

        $amount = $this->basket->getAmount();

        $this->assertEquals(6.00, $amount);
    }

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
