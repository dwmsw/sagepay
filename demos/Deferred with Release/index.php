<?php
include('../../vendor/autoload.php');

// New Basket instance
$basket = new dwmsw\sagepay\Basket();
// Add an item to the basket
$basket->addItem(new dwmsw\sagepay\Item('Test Item', 30.00, 6, 1));
// Add another item to the basket
$basket->addItem(new dwmsw\sagepay\Item('Test Item Two', 30.00, 6, 2));

// Create instance of Direct
$sagepay = new dwmsw\sagepay\Direct();
// Set the Basket
$sagepay->setBasket($basket);

// Set up the config
$sagepay->setVendorName('YOUR VENDOR NAME');
$sagepay->setConnectionMode('test');
$sagepay->setCurrency('GBP');
$sagepay->setApplyAvsCv2(1);
$sagepay->setApply3dSecure(0);
$sagepay->setGiftAid(0);

$vendorTxCode = md5(rand(1, 1000).date('U'));

// TX Specific bits
$sagepay->setVendorTxCode($vendorTxCode);
$sagepay->setDescription('Test Payment');
$sagepay->setCustomerEmail('daryll@digitalwebmedia.co.uk');
$sagepay->setCreateToken(1);

// Set up addresses
$BillingAddress = new dwmsw\sagepay\Address();
$BillingAddress->setName('Test', 'Person');
$BillingAddress->setPhone('01589658741');
$BillingAddress->setAddress('88', 'Street 2', 'City', 'GB', '412');

// Set Addresses into the class
$sagepay->setBillingAddress($BillingAddress);
$sagepay->setDeliveryAddress($BillingAddress);

// New card instance
$card = new dwmsw\sagepay\Card();
// Card details
$card->setCardHolder('Mr T Person');
$card->setCardType('VISA');
$card->setCardNumber('4929000000006');
$card->setStartDate(false);
$card->setExpiryDate('1216');
$card->setCV2('123');

$sagepay->setCard($card);

$output = $sagepay->register('DEFERRED');
print '<h2>DEFERRED</h2>';
var_dump($output);


/**
 * Below here is the release code.
 *
 * This releases £25.07 of the deferred payment above
 */
$output = $sagepay->release($output['VPSTxId'], $output['SecurityKey'], $vendorTxCode, $output['TxAuthNo'], '25.07');
print '<h2>RELEASE</h2>';
var_dump($output);
