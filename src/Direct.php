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

    /**
     * Register a Payment with Sagepay
     *
     * @param $txType
     * @return mixed
     */
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

            'CreateToken'        => $this->getCreateToken(),

            // Basket
            'BasketXML'             => $this->basket->getItems(true)
        );

        if ($this->card->hasToken()) {
            // Token details
            $data['Token'] = $this->card->getToken();
            $data['CV2'] = $this->card->getCV2();
            $data['StoreToken'] = 1;
        } else {
            // Card details
            $data['CardHolder'] = $this->card->getCardHolder();
            $data['CardNumber'] = $this->card->getCardNumber();
            $data['StartDate'] = ($this->card->getStartDate() ? $this->card->getStartDate() : '');
            $data['ExpiryDate'] = $this->card->getExpiryDate();
            $data['CV2'] = $this->card->getCV2();
            $data['CardType'] = $this->card->getCardType();
        }

        if ($this->card->getCardType() == 'PAYPAL') {
            $data['PayPalCallbackURL'] = $this->PayPalCallbackURL;
        }

        return $this->makeRequest($this->directEndPoints[$this->mode]['register'], $data);
    }

    /**
     * Release a deferred payment
     *
     * @param $VPSTxId
     * @param $SecurityKey
     * @param $VendorTxCode
     * @param $TxAuthNo
     * @param $ReleaseAmount
     * @return mixed
     */
    public function release($VPSTxId, $SecurityKey, $VendorTxCode, $TxAuthNo, $ReleaseAmount)
    {
        $data = array(
            'VPSProtocol'        => $this->protocol,
            'TxType'             => 'RELEASE',
            'Vendor'             => $this->vendorName,
            'VendorTxCode'       => $VendorTxCode,
            'VPSTxId'            => $VPSTxId,
            'SecurityKey'        => $SecurityKey,
            'TxAuthNo'           => $TxAuthNo,
            'Amount'             => number_format($ReleaseAmount, 2, '.', '')
        );

        return $this->makeRequest($this->directEndPoints[$this->mode]['release'], $data);
    }

    /**
     * Refund a payment
     *
     * @param        $VendorTxCode
     * @param        $Amount
     * @param        $RelatedVPSTxId
     * @param        $RelatedVendorTxCode
     * @param        $RelatedSecurityKey
     * @param        $RelatedTxAuthNo
     * @param string $Description
     * @return mixed
     */
    public function refund($VendorTxCode, $Amount, $RelatedVPSTxId, $RelatedVendorTxCode, $RelatedSecurityKey, $RelatedTxAuthNo, $Description = '')
    {
        $data = array(
            'VPSProtocol'           => $this->protocol,
            'TxType'                => 'REFUND',
            'Vendor'                => $this->vendorName,
            'VendorTxCode'          => $VendorTxCode,
            'Currency'              => $this->currency,
            'Description'           => $Description,
            'RelatedVPSTxId'        => $RelatedVPSTxId,
            'RelatedVendorTxCode'   => $RelatedVendorTxCode,
            'RelatedSecurityKey'    => $RelatedSecurityKey,
            'RelatedTxAuthNo'       => $RelatedTxAuthNo,
            'Amount'                => number_format($Amount, 2, '.', '')
        );

        return $this->makeRequest($this->directEndPoints[$this->mode]['refund'], $data, true);
    }


    /**
     * Respond to the 3D secure callback
     *
     * @param $MD
     * @param $PARes
     * @return mixed
     */
    public function threeDResponse($MD, $PARes)
    {
        $data = array(
            'VPSProtocol'   => $this->protocol,
            'MD'            => $MD,
            'PARes'         => $PARes
        );

        return $this->makeRequest($this->directEndPoints[$this->mode]['3dsecure'], $data);
    }

    /**
     * Authorise an Authenticated or Registered payment
     *
     * @param        $VendorTxCode
     * @param        $Amount
     * @param        $RelatedVPSTxId
     * @param        $RelatedVendorTxCode
     * @param        $RelatedSecurityKey
     * @param        $RelatedTxAuthNo
     * @param string $Description
     * @return mixed
     */
    public function authorise($VendorTxCode, $Amount, $RelatedVPSTxId, $RelatedVendorTxCode, $RelatedSecurityKey, $RelatedTxAuthNo, $Description = '')
    {
        $data = array(
            'VPSProtocol'           => $this->protocol,
            'TxType'                => 'AUTHORISE',
            'Vendor'                => $this->vendorName,
            'VendorTxCode'          => $VendorTxCode,
            'Description'           => $Description,
            'RelatedVPSTxId'        => $RelatedVPSTxId,
            'RelatedVendorTxCode'   => $RelatedVendorTxCode,
            'RelatedSecurityKey'    => $RelatedSecurityKey,
            'RelatedTxAuthNo'       => $RelatedTxAuthNo,
            'ApplyAVSCV2'           => $this->getApplyAvsCv2(),
            'Amount'                => number_format($Amount, 2, '.', '')
        );

        return $this->makeRequest($this->directEndPoints[$this->mode]['authorise'], $data);
    }

}
