<?php

namespace dwmsw\sagepay;

class Direct extends Shared
{
    /**
     * Allowed values for the register TxType
     *
     * @var array
     */
    protected $validTxTypes = array('PAYMENT', 'DEFERRED', 'AUTHENTICATE');


    /**
     * Returns all variables set in $this
     *
     * @return object $this
     */
    public function dumpAll()
    {
        return $this;
    }

    public function register($txType)
    {
        if (in_array(strtoupper($txType), $this->validTxTypes)) {
            $txType = strtoupper($txType);
        } else {
            throw new \InvalidArgumentException("Invalid TxType given");
        }



        $data = array(
            'VPSProtocol'        => $this->protocol,
            'TxType'             => $txType,
            'Vendor'             => $this->vendorName,
            'VendorTxCode'       => $this->vendorTxCode,
            'Amount'             => number_format($this->basket->getAmount(), 2, '.', ''),
            'Currency'           => $this->currency,
            'Description'        => $this->description,

            // Card details
            'CardHolder'         => $this->card->getCardHolder(),
            'CardNumber'         => $this->card->getCardNumber(),
            'StartDate'          => ($this->card->getStartDate() ? $this->card->getStartDate() : ''),
            'ExpiryDate'         => $this->card->getExpiryDate(),
            'CV2'                => $this->card->getCV2(),
            'CardType'           => $this->card->getCardType(),

            // Address details
            'BillingSurname'     => $this->billingAddress->surname,
            'BillingFirstnames'  => $this->billingAddress->firstnames,
            'BillingAddress1'    => $this->billingAddress->address1,
            'BillingAddress2'    => ($this->billingAddress->address2 ? $this->billingAddress->address2 : ''),
            'BillingCity'        => $this->billingAddress->city,
            'BillingPostCode'    => $this->billingAddress->postcode,
            'BillingCountry'     => $this->billingAddress->country,
            'BillingState'       => ($this->billingAddress->state ? $this->billingAddress->state : ''),
            'BillingPhone'       => $this->billingAddress->phone,
            'DeliverySurname'    => $this->deliveryAddress->surname,
            'DeliveryFirstnames' => $this->deliveryAddress->firstnames,
            'DeliveryAddress1'   => $this->deliveryAddress->address1,
            'DeliveryAddress2'   => ($this->deliveryAddress->address2 ? $this->deliveryAddress->address2 : ''),
            'DeliveryCity'       => $this->deliveryAddress->city,
            'DeliveryPostCode'   => $this->deliveryAddress->postcode,
            'DeliveryCountry'    => $this->deliveryAddress->country,
            'DeliveryState'      => ($this->deliveryAddress->state ? $this->deliveryAddress->state : ''),
            'DeliveryPhone'      => $this->deliveryAddress->phone,

            // A few settings
            'CustomerEmail'      => $this->customerEmail,
            'GiftAidPayment'     => $this->giftAid,
            'AccountType'        => $this->accountType,
            'ClientIPAddress'    => ($_SERVER['REMOTE_ADDR'] == '::1' ? '127.0.0.1' : $_SERVER['REMOTE_ADDR']),
            'ApplyAVSCV2'        => $this->applyAvsCv2,
            'Apply3DSecure'      => $this->apply3dSecure,

            // Basket
            'BasketXML'             => $this->basket->getItems(true)
        );

        if ($this->card->getCardType() == 'PAYPAL') {
            $data['PayPalCallbackURL'] = $this->PayPalCallbackURL;
        }

        return $this->makeRequest($this->directEndPoints[$this->mode]['register'], $data);
    }
}
