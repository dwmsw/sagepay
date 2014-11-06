# dwmsw/sagepay

[![Build Status](https://travis-ci.org/dwmsw/sagepay.svg?branch=master)](https://travis-ci.org/dwmsw/sagepay)
[![Code Climate](https://codeclimate.com/github/dwmsw/sagepay/badges/gpa.svg)](https://codeclimate.com/github/dwmsw/sagepay)
[![Test Coverage](https://codeclimate.com/github/dwmsw/sagepay/badges/coverage.svg)](https://codeclimate.com/github/dwmsw/sagepay)

## Description

dwmsw/sagepay is a library for interacting with the [Sagepay Direct v3.00 protocol](http://www.sagepay.co.uk/file/12236/download-document/DIRECT_Integration_and_Protocol_Guidelines_010814.pdf)

It aims to make interacting with Sagepay as easy as possible and when complete will be added as a [composer](https://getcomposer.org/) package on [packagist](https://packagist.org/)

## What is implemented?

- Payments
- Deferred Payments w/ release
- Refunds


## Basic Usage

**Payment**

```php
// Create instance of Direct
$sagepay = new dwmsw\sagepay\Direct();

// New Basket instance
$basket = new dwmsw\sagepay\Basket();
// Add an item to the basket
$basket->addItem(new dwmsw\sagepay\Item('Test Item', 30.00, 6, 1));
// Add another item to the basket
$basket->addItem(new dwmsw\sagepay\Item('Test Item Two', 30.00, 6, 2));
// Set the Basket
$sagepay->setBasket($basket);

// Set up the config
$sagepay->setConnectionMode(CONNECTION MODE TEST/LIVE);
$sagepay->setVendorName(YOUR VENDOR NAME);
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
// Delivery Address can be a different instance of address if needed
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

$output = $sagepay->register('PAYMENT');

// Do whatever you want with $output
```

**DEFERRED**

```php
// As above, but use the following line
$output = $sagepay->register('DEFERRED');
```

**RELEASE**

```php
// Create instance of Direct
$sagepay = new dwmsw\sagepay\Direct();
// Make the release
$output = $sagepay->release('VPSTxId', 'SecurityKey', 'vendorTxCode', 'TxAuthNo', 'AMOUNT TO RELEASE');
    
// Do whatever with $output
```

**REFUND**

```php
// Create instance of Direct
$sagepay = new dwmsw\sagepay\Direct();
// Make the refund
$output = $sagepay->refund('NEWvendorTxCode', 'AMOUNT TO REFUND', 'OLDVPSTxId', 'OLDvendorTxCode', 'OLDSecurityKey', 'OLDTxAuthNo', 'Refund Message');
    
// Do whatever with $output
```

## To Do
- Payments w/ 3D Secure
- Tokened Paymens
- Paypal Integration

## Getting Involved

- Open an issue with a feature you'd like
- Make a PR
- Write any tests that may be missing!
