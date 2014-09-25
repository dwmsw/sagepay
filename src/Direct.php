<?php

namespace dwmsw\sagepay;

class Direct extends Shared
{
    /**
     * Allowed values for the register TxType
     * @var array
     */
    protected $validTxTypes = array('PAYMENT', 'DEFERRED', 'AUTHENTICATE');

    /**
     * The type of transaction to be put through
     * @var [type]
     */
    protected $txType = null;

    /**
     * Sets the TxType to be used
     * @param string $txType TxType
     */
    public function setTxType($txType)
    {
        if (in_array(strtoupper($txType), $this->validTxTypes)) {
            $this->txType = strtoupper($txType);
        } else {
            throw new \InvalidArgumentException("Invalid TxType given");
        }
    }

    /**
     * Gets the currently set TxType
     * @return string TxType
     */
    public function getTxType()
    {
        return $this->txType;
    }

    /**
     * Returns all variables set in $this
     * @return object $this
     */
    public function dumpAll()
    {
        return $this;
    }
}
