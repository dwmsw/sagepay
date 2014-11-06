<?php

class DirectTest extends PHPUnit_Framework_TestCase
{
    public function testRegisterPaymentAndRefund()
    {
        // New Basket instance
        $basket = new dwmsw\sagepay\Basket();
        // Add an item to the basket
        $basket->addItem(new dwmsw\sagepay\Item('Test Item', 30.00, 6, 1));

        // Create instance of Direct
        $sagepay = new dwmsw\sagepay\Direct();
        // Set the Basket
        $sagepay->setBasket($basket);

        // Set up the config
        $sagepay->setConnectionMode('test');
        $sagepay->setVendorName('testdigitalweb');
        $sagepay->setCurrency('GBP');
        $sagepay->setApplyAvsCv2(1);
        $sagepay->setApply3dSecure(0);
        $sagepay->setGiftAid(0);

        $vendorTxCode = md5(rand(1, 1000));

        // TX Specific bits
        $sagepay->setVendorTxCode($vendorTxCode);
        $sagepay->setDescription('Test Payment');
        $sagepay->setCustomerEmail('daryll@digitalwebmedia.co.uk');

        // Set up addresses
        $BillingAddress = new dwmsw\sagepay\Address();
        $BillingAddress->setName('Daryll', 'Doyle');
        $BillingAddress->setPhone('46554789658');
        $BillingAddress->setAddress('88', 'Test Address', 'Town', 'GB', '412');

        // Set Addresses into the class
        $sagepay->setBillingAddress($BillingAddress);
        $sagepay->setDeliveryAddress($BillingAddress);

        // New card instance
        $card = new dwmsw\sagepay\Card();
        // Card details
        $card->setCardHolder('Mr D Doyle');
        $card->setCardType('VISA');
        $card->setCardNumber('4929000000006');
        $card->setStartDate(false);
        $card->setExpiryDate('1216');
        $card->setCV2('123');

        $sagepay->setCard($card);

        // Make the payment
        $output = $sagepay->register('PAYMENT');
        // Test the Payment
        $this->assertEquals('OK', $output['Status']);
        // Make the refund
        $output = $sagepay->refund('REF'.$vendorTxCode, '20.00', $output['VPSTxId'], $vendorTxCode, $output['SecurityKey'], $output['TxAuthNo'], 'This is a test refund');
        // Test the refund
        $this->assertEquals('OK', $output['Status']);
    }

    public function testDeferredPaymentAndRelease()
    {
        // New Basket instance
        $basket = new dwmsw\sagepay\Basket();
        // Add an item to the basket
        $basket->addItem(new dwmsw\sagepay\Item('Test Item', 30.00, 6, 1));

        // Create instance of Direct
        $sagepay = new dwmsw\sagepay\Direct();
        // Set the Basket
        $sagepay->setBasket($basket);

        // Set up the config
        $sagepay->setConnectionMode('test');
        $sagepay->setVendorName('testdigitalweb');
        $sagepay->setCurrency('GBP');
        $sagepay->setApplyAvsCv2(1);
        $sagepay->setApply3dSecure(0);
        $sagepay->setGiftAid(0);

        $vendorTxCode = md5(rand(1, 1000));

        // TX Specific bits
        $sagepay->setVendorTxCode($vendorTxCode);
        $sagepay->setDescription('Test Payment');
        $sagepay->setCustomerEmail('daryll@digitalwebmedia.co.uk');

        // Set up addresses
        $BillingAddress = new dwmsw\sagepay\Address();
        $BillingAddress->setName('Daryll', 'Doyle');
        $BillingAddress->setPhone('46554789658');
        $BillingAddress->setAddress('88', 'Test Address', 'Town', 'GB', '412');

        // Set Addresses into the class
        $sagepay->setBillingAddress($BillingAddress);
        $sagepay->setDeliveryAddress($BillingAddress);

        // New card instance
        $card = new dwmsw\sagepay\Card();
        // Card details
        $card->setCardHolder('Mr D Doyle');
        $card->setCardType('VISA');
        $card->setCardNumber('4929000000006');
        $card->setStartDate(false);
        $card->setExpiryDate('1216');
        $card->setCV2('123');

        $sagepay->setCard($card);

        // Make a deferred payment
        $output = $sagepay->register('DEFERRED');

        // Test the deferred payment
        $this->assertEquals('OK', $output['Status']);

        // Make a release
        $output = $sagepay->release($output['VPSTxId'], $output['SecurityKey'], $vendorTxCode, $output['TxAuthNo'], '25.07');

        // Test the release
        $this->assertEquals('OK', $output['Status']);
    }
}
