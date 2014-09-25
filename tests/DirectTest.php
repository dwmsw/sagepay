<?php

class DirectTest extends PHPUnit_Framework_TestCase
{
	public function testSetTxTypeException()
    {
        $direct = new dwmsw\sagepay\Direct();

        try {
           $direct->setTxType('thisisnotvalid');
        } catch (InvalidArgumentException $expected) {
            return;
        }

        $this->fail('An expected exception has not been raised.');
    }

    public function testTxType()
    {
        $direct = new dwmsw\sagepay\Direct();

        $direct->setTxType('PAYMENT');

        $txType = $direct->getTxType();

        $this->assertEquals($txType, 'PAYMENT');
    }
}
