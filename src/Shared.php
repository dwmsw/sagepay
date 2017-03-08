<?php
/**
 * Common functions that can be used across all methods
 */

namespace dwmsw\sagepay;

use InvalidArgumentException;

class Shared extends AbstractSettings
{

    /**
     * Sets the connection mode for the API
     *
     * @param string $mode The mode to connect with
     */
    public function setConnectionMode($mode)
    {
        $mode = strtolower($mode);

        if (isset($this->directEndPoints[$mode])) {
            $this->mode = $mode;
        } else {
            throw new InvalidArgumentException("Invalid connection mode name '{$mode}'");
        }

        return true;
    }

    /**
     * Gets the connection mode to the API
     *
     * @return string Connection Mode
     */
    public function getConnectionMode()
    {
        return $this->mode;
    }

    /**
     * Get vendor name provided by Sagepay service
     *
     * @return string  Vendor name
     */
    public function getVendorName()
    {
        return $this->vendorName;
    }

    /**
     * Set vendor name provided by Sagepay service
     *
     * @param string $vendorName Vendor name
     */
    public function setVendorName($vendorName)
    {
        $this->vendorName = $vendorName;
    }

    /**
     * Get currency in which you wish to trade
     *
     * @return string Currency
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Set currency in which you wish to trade
     *
     * @param string $currency Currency
     */
    public function setCurrency($currency)
    {
        $currencies = Utilities::getCurrencies();

        if (isset($currencies[$currency])) {
            $this->currency = $currency;
        } else {
            throw new InvalidArgumentException("Invalid currency code, ISO 4217 Expected" . $currency . " given");
        }
    }

    /**
     * Get value of Address Verification Status / Card Verification Value option
     *
     * @return int  Apply AVS/CV2 validation option
     */
    public function getApplyAvsCv2()
    {
        return $this->applyAvsCv2;
    }

    /**
     * Set value of Address Verification Status / Card Verification Value option
     *
     * @param int $applyAvsCv2 Apply AVS/CV2 validation option
     */
    public function setApplyAvsCv2($applyAvsCv2)
    {
        if (in_array($applyAvsCv2, range(0, 3))) {
            $this->applyAvsCv2 = $applyAvsCv2;
        } else {
            throw new InvalidArgumentException("Invalid Apply AVS/CV2 value, [0, 1, 2, 3] expected, " . $applyAvsCv2 . " given");
        }
    }

    /**
     * Get value of 3D Secure Verification option
     *
     * @return int  3D Secure Verification option
     */
    public function getApply3dSecure()
    {
        return $this->apply3dSecure;
    }

    /**
     * Set value of 3D Secure Verification option
     *
     * @param int $apply3dSecure 3D Secure Verification option
     */
    public function setApply3dSecure($apply3dSecure)
    {
        if (in_array($apply3dSecure, range(0, 3))) {
            $this->apply3dSecure = $apply3dSecure;
        } else {
            throw new InvalidArgumentException("Invalid Apply 3D Secure value, [0, 1, 2, 3] expected, " . $apply3dSecure . " given");
        }
    }

    /**
     * Set the basket object
     *
     * @param Basket $basket The basket
     */
    public function setBasket(Basket $basket)
    {
        $this->basket = $basket;
    }

    /**
     * Get the items in the basket
     *
     * @param  boolean $xml Whether to return in XML
     * @return XML or array depending on $xml value
     */
    public function getBasketItems($xml = false)
    {
        return $this->basket->getItems($xml);
    }

    /**
     * @return mixed
     */
    public function getBillingAddress()
    {
        return $this->billingAddress;
    }

    /**
     * @param mixed $billingAddress
     */
    public function setBillingAddress(Address $billingAddress)
    {
        $this->billingAddress = $billingAddress;
    }

    /**
     * @return mixed
     */
    public function getDeliveryAddress()
    {
        return $this->deliveryAddress;
    }

    /**
     * @param mixed $deliveryAddress
     */
    public function setDeliveryAddress(Address $deliveryAddress)
    {
        $this->deliveryAddress = $deliveryAddress;
    }

    /**
     * @return mixed
     */
    public function getVendorTxCode()
    {
        return $this->vendorTxCode;
    }

    /**
     * @param mixed $vendorTxCode
     */
    public function setVendorTxCode($vendorTxCode)
    {
        if (strlen($vendorTxCode) > 38) {
            throw new InvalidArgumentException('VendorTxCode must be less than 38 chars');
        } else {
            $this->vendorTxCode = $vendorTxCode;
        }
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        if (strlen($description) > 100) {
            throw new InvalidArgumentException('Description must be less than 100 chars');
        } else {
            $this->description = $description;
        }
    }

    /**
     * @return mixed
     */
    public function getCustomerEmail()
    {
        return $this->customerEmail;
    }

    /**
     * @param mixed $customerEmail
     */
    public function setCustomerEmail($customerEmail)
    {
        if (strlen($customerEmail) > 255) {
            throw new InvalidArgumentException('Email must be less than 255 chars');
        } else {
            $this->customerEmail = $customerEmail;
        }
    }


    /**
     * @return mixed
     */
    public function getGiftAid()
    {
        return $this->giftAid;
    }

    /**
     * @param mixed $giftAid
     */
    public function setGiftAid($giftAid)
    {
        if (!in_array($giftAid, array(0, 1))) {
            throw new InvalidArgumentException('GiftAid must be 1 or 0');
        } else {
            $this->giftAid = $giftAid;
        }
    }

    /**
     * @return mixed
     */
    public function getCard()
    {
        return $this->card;
    }

    /**
     * @param mixed $card
     */
    public function setCard(Card $card)
    {
        $this->card = $card;
    }

    /**
     * @return int
     */
    public function getCreateToken()
    {
        return $this->createToken;
    }

    /**
     * @param int $createToken
     */
    public function setCreateToken($createToken)
    {
        $this->createToken = $createToken;
    }

    /**
     * Make a request to sagepay
     * @param       $url
     * @param array $data
     * @return mixed
     */
    protected function makeRequest($url, array $data, $inURL = false)
    {
        $client = new \GuzzleHttp\Client();

        if ($inURL) {
            $vars =  http_build_query($data);
            $response = $client->post($url . '?' . $vars);
        } else {
            $response = $client->post($url, [
                'form_params' => $data
            ]);
        }

        $output =  explode(PHP_EOL, $response->getBody());

        foreach ($output as $out) {
            $parts = explode('=', $out, 2);
            $this->response[$parts[0]] = trim($parts[1]);
        }

        return $this->response;
    }

    /**
     * Set RelatedVendorTxCode
     *
     * @param string $
     */
    public function setRelatedVendorTxCode ($relatedVendorTxCode)
    {
        $this->relatedVendorTxCode = $relatedVendorTxCode;
    }

    /**
     * Set RelatedSecurityKey
     *
     * @param string $
     */
    public function setRelatedSecurityKey ($relatedSecurityKey )
    {
        $this->relatedSecurityKey  = $relatedSecurityKey ;
    }

    /**
     * Set RelatedTxAuthNo
     *
     * @param string $
     */
    public function setRelatedTxAuthNo ($relatedTxAuthNo  )
    {
        $this->relatedTxAuthNo   = $relatedTxAuthNo  ;
    }


    /**
     * Set RelatedVPSTxId
     *
     * @param string $
     */
    public function setRelatedVPSTxId ($relatedVPSTxId  )
    {
          $this->relatedVPSTxId   = $relatedVPSTxId;
    }

}
