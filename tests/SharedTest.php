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

    public function testVendorTxCode()
    {
        $shared = new dwmsw\sagepay\Shared();

        $shared->setVendorTxCode('12345');

        $this->assertEquals('12345', $shared->getVendorTxCode());
    }

    public function testVendorTxCodeException()
    {
        $shared = new dwmsw\sagepay\Shared();

        try {
            $shared->setVendorTxCode('12345jasnfjkdfbjksdfbskf1231nmkasd1knasdasdasdasdasdasdasdasdada');
        } catch (InvalidArgumentException $expected) {
            return;
        }

        $this->fail('An expected exception has not been raised.');
    }

    public function testDescription()
    {
        $shared = new dwmsw\sagepay\Shared();

        $shared->setDescription('12345');

        $this->assertEquals('12345', $shared->getDescription());
    }

    public function testDescriptionException()
    {
        $shared = new dwmsw\sagepay\Shared();

        try {
            $shared->setDescription('Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, tot');
        } catch (InvalidArgumentException $expected) {
            return;
        }

        $this->fail('An expected exception has not been raised.');
    }

    public function testEmail()
    {
        $shared = new dwmsw\sagepay\Shared();

        $shared->setCustomerEmail('test@test.test');

        $this->assertEquals('test@test.test', $shared->getCustomerEmail());
    }

    public function testEmailException()
    {
        $shared = new dwmsw\sagepay\Shared();

        try {
            $shared->setCustomerEmail('Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas');
        } catch (InvalidArgumentException $expected) {
            return;
        }

        $this->fail('An expected exception has not been raised.');
    }

    public function testGiftAid()
    {
        $shared = new dwmsw\sagepay\Shared();

        $shared->setGiftAid(1);

        $this->assertEquals(1, $shared->getGiftAid());
    }

    public function testGiftAidException()
    {
        $shared = new dwmsw\sagepay\Shared();

        try {
            $shared->setGiftAid(5);
        } catch (InvalidArgumentException $expected) {
            return;
        }

        $this->fail('An expected exception has not been raised.');
    }

    public function testBillingAddress()
    {
        $shared = new dwmsw\sagepay\Shared();

        $shared->setBillingAddress(new dwmsw\sagepay\Address());

        $this->assertEquals(new dwmsw\sagepay\Address(), $shared->getBillingAddress());
    }

    public function testDeliveryAddress()
    {
        $shared = new dwmsw\sagepay\Shared();

        $shared->setDeliveryAddress(new dwmsw\sagepay\Address());

        $this->assertEquals(new dwmsw\sagepay\Address(), $shared->getDeliveryAddress());
    }

    public function testBasket()
    {
        $shared = new dwmsw\sagepay\Shared();

        $shared->setBasket(new dwmsw\sagepay\Basket());

        $this->assertEquals(array(), $shared->getBasketItems(false));
    }

    public function testTokens()
    {
        $shared = new dwmsw\sagepay\Shared();

        $shared->setCreateToken(1);

        $token = $shared->getCreateToken();

        $this->assertEquals(1, $token);
    }

    public function testCard()
    {
        $shared = new dwmsw\sagepay\Shared();

        $shared->setCard(new dwmsw\sagepay\Card());

        $card = $shared->getCard();

        $this->assertEquals(new dwmsw\sagepay\Card(), $card);
    }
}
