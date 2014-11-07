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
$sagepay->setApply3dSecure(1);
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

$output = $sagepay->register('PAYMENT');
print '<h2>PAYMENT</h2>';
?>
<form action="<?=$output['ACSURL']?>" method="post">
    <input type="hidden" name="MD" value="<?=$output['MD']?>">
    <input type="hidden" name="PaReq" value="<?=$output['PAReq']?>">
    <input type="hidden" name="TermUrl" value="return.php">
    <input type="submit" value="Go to 3D Secure">
</form>