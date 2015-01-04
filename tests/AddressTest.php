<?php

use dwmsw\sagepay\Address;

class AddressTest extends PHPUnit_Framework_TestCase
{

    public function testGet()
    {
        // New Address instance
        $address = new Address();

        $output = $address->Test;
        $this->assertFalse($output);

        $address->setName('Daryll', 'Doyle');
        $output = $address->firstnames;

        $this->assertEquals('Daryll', $output);
    }

    public function testWrongCountry()
    {
        // New Address instance
        $address = new Address();

        try {
            $address->setAddress('88', 'Test Address', 'Town', 'GBP', '412');
        } catch (InvalidArgumentException $e) {
            return;
        }

        $this->fail('Address accepted invalid country code');
    }

    public function testAsWhole()
    {
        // Set up addresses
        $address = new Address();
        $address->setName('Daryll', 'Doyle');
        $address->setPhone('46554789658');
        $address->setAddress('88', 'Test Address', 'Town', 'GB', '412');

        $this->assertEquals('Daryll', $address->firstnames);
        $this->assertEquals('Doyle', $address->surname);
        $this->assertEquals('46554789658', $address->phone);
        $this->assertEquals('88', $address->address1);
        $this->assertEquals('Test Address', $address->address2);
        $this->assertEquals('Town', $address->city);
        $this->assertEquals('GB', $address->country);
        $this->assertEquals('412', $address->postcode);
    }

}
