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

    public function testFirstNameExceptions()
    {
        // New Address instance
        $address = new Address();

        try {
            $address->setName('Daryll12kjfiredshertfdd', 'Doyle');
        } catch (InvalidArgumentException $e) {
            return;
        }

        $this->fail('Address accepted names that were too long');
    }

    public function testSecondNameExceptions()
    {
        // New Address instance
        $address = new Address();

        try {
            $address->setName('Daryll', 'Doylejuytyedrtfgyhjuy');
        } catch (InvalidArgumentException $e) {
            return;
        }

        $this->fail('Address accepted names that were too long');
    }

    public function testPhoneExceptions()
    {
        // New Address instance
        $address = new Address();

        try {
            $address->setPhone('098765411234567890011');
        } catch (InvalidArgumentException $e) {
            return;
        }

        $this->fail('Phone accepted a value that was too long');
    }

    public function testAddr1Exception()
    {
        // New Address instance
        $address = new Address();

        try {
            $address->setAddress('Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live t', 'Test Address', 'Town', 'GB', '412');
        } catch (InvalidArgumentException $e) {
            return;
        }

        $this->fail('Accepted a value that was too long');
    }

    public function testAddr2Exception()
    {
        // New Address instance
        $address = new Address();

        try {
            $address->setAddress('88', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live t', 'Town', 'GB', '412');
        } catch (InvalidArgumentException $e) {
            return;
        }

        $this->fail('Accepted a value that was too long');
    }

    public function testCityException()
    {
        // New Address instance
        $address = new Address();

        try {
            $address->setAddress('88', 'Test Address', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live t', 'GB', '412');
        } catch (InvalidArgumentException $e) {
            return;
        }

        $this->fail('Accepted a value that was too long');
    }

    public function testPostcodeException()
    {
        // New Address instance
        $address = new Address();

        try {
            $address->setAddress('88', 'Test Address', 'Town', 'GB', '41212345678');
        } catch (InvalidArgumentException $e) {
            return;
        }

        $this->fail('Accepted a value that was too long');
    }

    public function testStateException()
    {
        // New Address instance
        $address = new Address();
        try {
            $address->setAddress('88', 'Test Address', 'Town', 'US', '412');
        } catch (InvalidArgumentException $e) {
            return;
        }

        $this->fail('Allowed an invalid State option');
    }

    public function testInvalidCountryException()
    {
        // New Address instance
        $address = new Address();
        try {
            $address->setAddress('88', 'Test Address', 'Town', 'EN', '412');
        } catch (InvalidArgumentException $e) {
            return;
        }

        $this->fail('Allowed an invalid Country option');
    }

}
