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

    public function testVendorName()
    {
        $shared = new dwmsw\sagepay\Shared();

        $shared->setVendorName('vendorname');

        $vendorName = $shared->getVendorName();

        $this->assertEquals($vendorName, 'vendorname');
    }
}