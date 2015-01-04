<?php

use dwmsw\sagepay\Item;

class ItemTest extends PHPUnit_Framework_TestCase
{
    private $item;

    public function setUp()
    {
        $this->item = new Item('Test Item', 30.00, 6, 2, '123', 'abc');;
    }

    public function testConstructor()
    {
        $output = $this->item->asArray();

        $this->assertEquals('Test Item', $output['item']);
        $this->assertEquals(30.00, $output['value']);
        $this->assertEquals(6, $output['tax']);
        $this->assertEquals(2, $output['quantity']);
        $this->assertEquals(36, $output['itemTotal']);
        $this->assertEquals(72, $output['lineTotal']);

        // Here we'll test the getters
        $this->assertEquals('Test Item', $this->item->getDescription());
        $this->assertEquals(30.00, $this->item->getUnitNetAmount());
        $this->assertEquals(6, $this->item->getUnitTaxAmount());
        $this->assertEquals(2, $this->item->getQuantity());
        $this->assertEquals(36, $this->item->getUnitGrossAmount());
        $this->assertEquals(72, $this->item->getTotalGrossAmount());
    }

    public function testItemDescription()
    {
        $this->item->setDescription('Test Desc');

        $description = $this->item->getDescription();

        $this->assertEquals('Test Desc', $description);
    }

    public function testItemSKU()
    {
        $this->item->setProductSku('thisisatestSKU');

        $SKU = $this->item->getProductSku();

        $this->assertEquals('thisisatestSKU', $SKU);
    }

    public function testProductCode()
    {
        $this->item->setProductCode('TestCode');

        $productCode = $this->item->getProductCode();

        $this->assertEquals('TestCode', $productCode);
    }

    public function testQuantity()
    {
        $this->item->setQuantity(4);

        $quantity = $this->item->getQuantity();

        $this->assertEquals(4, $quantity);
    }

    public function testNetAmount()
    {
        $this->item->setUnitNetAmount(1.00);

        $NET = $this->item->getUnitNetAmount();

        $this->assertEquals(1.00, $NET);
    }

    public function testTaxAmount()
    {
        $this->item->setUnitTaxAmount(.20);

        $Tax = $this->item->getUnitTaxAmount();

        $this->assertEquals(0.20, $Tax);
    }

    public function testGrossAmount()
    {
        $this->item->setQuantity(4);
        $this->item->setUnitNetAmount(1.00);
        $this->item->setUnitTaxAmount(.2);

        $unitGross = $this->item->getUnitGrossAmount();
        $totalGross = $this->item->getTotalGrossAmount();

        $this->assertEquals(1.20, $unitGross);
        $this->assertEquals(4.80, $totalGross);
    }

    public function testAsArray()
    {
        $array = $this->item->asArray();

        $this->assertArrayHasKey('item', $array);
        $this->assertArrayHasKey('quantity', $array);
        $this->assertArrayHasKey('value', $array);
        $this->assertArrayHasKey('tax', $array);
        $this->assertArrayHasKey('itemTotal', $array);
        $this->assertArrayHasKey('lineTotal', $array);
    }

}
