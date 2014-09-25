<?php
/**
 * Common functions that can be used across all methods
 */

namespace dwmsw\sagepay;

use dwmsw\sagepay\Utilities;

class Shared extends AbstractSettings
{

    /**
     * Sets the connection mode for the API
     * @param string $mode The mode to connect with
     */
    public function setConnectionMode($mode)
    {
        $mode = strtolower($mode);

        if (isset($this->directEndPoints[$mode])) {
            $this->mode = $mode;
        } else {
            throw new \InvalidArgumentException("Invalid connection mode name '{$mode}'");
        }

        return true;
    }

    /**
     * Gets the connection mode to the API
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
        $currencies = Utilities::getCountryCodes();

        if (isset($currencies[$currency])) {
            $this->currency = $currency;
        } else {
            throw new \InvalidArgumentException("Invalid currency code, ISO 4217 Expected" . $currency . " given");
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
            throw new \InvalidArgumentException("Invalid Apply AVS/CV2 value, [0, 1, 2, 3] expected, " . $applyAvsCv2 . " given");
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
     * @param int $apply3dSecure  3D Secure Verification option
     */
    public function setApply3dSecure($apply3dSecure)
    {
        if (in_array($apply3dSecure, range(0, 3))) {
            $this->apply3dSecure = $apply3dSecure;
        } else {
            throw new \InvalidArgumentException("Invalid Apply 3D Secure value, [0, 1, 2, 3] expected, " . $apply3dSecure . " given");
        }
    }

}
