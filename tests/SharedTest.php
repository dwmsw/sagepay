<?php

class SharedTest extends PHPUnit_Framework_TestCase
{

    public function testSetConnectionModeException()
    {
        $shared = new dwmsw\sagepay\Shared();

        try {
           $shared->setConnectionMode('test12');
        } catch (InvalidArgumentException $expected) {
            return;
        }

        $this->fail('An expected exception has not been raised.');
        
    }

    public function testSetConnectionMode()
    {
        $shared = new dwmsw\sagepay\Shared();

        $return = $shared->setConnectionMode('test');
        
        $this->assertTrue($return);
        
    }

    public function testGetConnectionMode()
    {
        $shared = new dwmsw\sagepay\Shared();

        $shared->setConnectionMode('test');

        $connection = $shared->getConnectionMode();

        $this->assertEquals('test', $connection);

    }

    public function testVendorName()
    {
        $shared = new dwmsw\sagepay\Shared();

        $shared->setVendorName('vendorname');

        $vendorName = $shared->getVendorName();

        $this->assertEquals($vendorName, 'vendorname');
    }

    public function testSetCurrencyException()
    {
        $shared = new dwmsw\sagepay\Shared();

        try {
           $shared->setCurrency('test12');
        } catch (InvalidArgumentException $expected) {
            return;
        }

        $this->fail('An expected exception has not been raised.');
    }

    public function testSetCurrency()
    {
        $shared = new dwmsw\sagepay\Shared();

        $return = $shared->setCurrency('GBP');
        
        $currency = $shared->getCurrency();

        $this->assertEquals($currency, 'GBP');
        
    }

    public function testSetApplyAvsCv2Exception()
    {
        $shared = new dwmsw\sagepay\Shared();

        try {
           $shared->setApplyAvsCv2(4);
        } catch (InvalidArgumentException $expected) {
            return;
        }

        $this->fail('An expected exception has not been raised.');
    }

    public function testSetApplyAvsCv2()
    {
        $shared = new dwmsw\sagepay\Shared();

        $return = $shared->setApplyAvsCv2(2);
        
        $applyAvsCv2 = $shared->getApplyAvsCv2();

        $this->assertEquals($applyAvsCv2, 2);
        
    }

    public function testSetApply3dSecureException()
    {
        $shared = new dwmsw\sagepay\Shared();

        try {
           $shared->setApply3dSecure(4);
        } catch (InvalidArgumentException $expected) {
            return;
        }

        $this->fail('An expected exception has not been raised.');
    }

    public function testSetApply3dSecure()
    {
        $shared = new dwmsw\sagepay\Shared();

        $return = $shared->setApply3dSecure(2);
        
        $apply3dSecure = $shared->getApply3dSecure();

        $this->assertEquals($apply3dSecure, 2);
        
    }
}
