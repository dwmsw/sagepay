<?php
/**
 * Common functions that can be used across all methods
 */

namespace dwmsw\sagepay;

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
            // Supplied connection mode not supported.
            throw new \InvalidArgumentException("Invalid connection mode name '{$mode}'");
        }

        return true;
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

}