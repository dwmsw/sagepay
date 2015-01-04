<?php

use dwmsw\sagepay\Item;

class ItemTest extends PHPUnit_Framework_TestCase
{

    public function testItem()
    {
        $item = new Item('Test Item', 30.00, 6, 2, '123', 'abc');

        $output = $item->asArray();

        $this->assertEquals('Test Item', $output['item']);
        $this->assertEquals(30.00, $output['value']);
        $this->assertEquals(6, $output['tax']);
        $this->assertEquals(2, $output['quantity']);
        $this->assertEquals(36, $output['itemTotal']);
        $this->assertEquals(72, $output['lineTotal']);

        // Here we'll test the getters
        $this->assertEquals('Test Item', $item->getDescription());
        $this->assertEquals(30.00, $item->getUnitNetAmount());
        $this->assertEquals(6, $item->getUnitTaxAmount());
        $this->assertEquals(2, $item->getQuantity());
        $this->assertEquals(36, $item->getUnitGrossAmount());
        $this->assertEquals(72, $item->getTotalGrossAmount());
    }

}
