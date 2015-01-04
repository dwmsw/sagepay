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

        $item = new dwmsw\sagepay\Item();
        $item->setDescription('Test Item');
        $item->setQuantity(1);
        $item->setUnitNetAmount(2.00);
        $item->setUnitTaxAmount(.4);

        $this->basket->addItem($item);

        $amount = $this->basket->getAmount();

        $this->assertEquals(6.00, $amount);
    }
}
