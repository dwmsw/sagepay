<?php
namespace dwmsw\sagepay;

use InvalidArgumentException;

/**
 * Class Card
 *
 * @package dwmsw\sagepay
 */
class Card
{
    /**
     * Cardholder Name
     *
     * @var string
     */
    protected $CardHolder;

    /**
     * Card Number
     *
     * @var string
     */
    protected $CardNumber;

    /**
     * Card Start Date
     *
     * @var string
     */
    protected $StartDate;

    /**
     * Card Expiry Date
     *
     * @var string
     */
    protected $ExpiryDate;

    /**
     * Card CV2
     *
     * @var string
     */
    protected $CV2;

    /**
     * Card Type
     *
     * @var string
     */
    protected $CardType;

    /**
     * Sagepay token
     *
     * @var string
     */
    protected $Token = '';

    /**
     * Allowed Card Types
     *
     * @var array
     */
    protected $allowedTypes = array('VISA', 'MC', 'MCDEBIT', 'DELTA', 'MAESTRO', 'UKE', 'AMEX', 'DC', 'JCB', 'LASER', 'PAYPAL');

    /**
     * @return mixed
     */
    public function getCV2()
    {
        return $this->CV2;
    }

    /**
     * @param mixed $CV2
     */
    public function setCV2($CV2)
    {
        if (strlen($CV2) > 4) {
            throw new InvalidArgumentException('CV2 must be a maximum of 4 chars');
        } else {
            $this->CV2 = $CV2;
        }
    }

    /**
     * @return mixed
     */
    public function getCardHolder()
    {
        return $this->CardHolder;
    }

    /**
     * @param mixed $CardHolder
     */
    public function setCardHolder($CardHolder)
    {
        if (strlen($CardHolder) > 50) {
            throw new InvalidArgumentException('Cardholder must be a maximum of 50 chars');
        } else {
            $this->CardHolder = $CardHolder;
        }
    }

    /**
     * @return mixed
     */
    public function getCardNumber()
    {
        return $this->CardNumber;
    }

    /**
     * @param mixed $CardNumber
     */
    public function setCardNumber($CardNumber)
    {
        if (strlen($CardNumber) > 20) {
            throw new InvalidArgumentException('Card number must be a maximum of 20 chars');
        } else {
            $this->CardNumber = $CardNumber;
        }
    }

    /**
     * @return mixed
     */
    public function getCardType()
    {
        return $this->CardType;
    }

    /**
     * @param mixed $CardType
     */
    public function setCardType($CardType)
    {
        if (!in_array(strtoupper($CardType), $this->allowedTypes)) {
            throw new InvalidArgumentException('Card type is not valid');
        } else {
            $this->CardType = strtoupper($CardType);
        }
    }

    /**
     * @return mixed
     */
    public function getExpiryDate()
    {
        return $this->ExpiryDate;
    }

    /**
     * @param mixed $ExpiryDate
     */
    public function setExpiryDate($ExpiryDate)
    {
        if (strlen($ExpiryDate) != 4) {
            throw new InvalidArgumentException('Expiry Date must be in the MMYY format and a be 4 digits in length');
        } else {
            $this->ExpiryDate = $ExpiryDate;
        }
    }

    /**
     * @return mixed
     */
    public function getStartDate()
    {
        return $this->StartDate;
    }

    /**
     * @param mixed $StartDate
     */
    public function setStartDate($StartDate)
    {
        if ($StartDate !== false && strlen($StartDate) != 4) {
            throw new InvalidArgumentException('Start Date must be in the MMYY format and a be 4 digits in length');
        } else {
            $this->StartDate = $StartDate;
        }
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->Token;
    }

    /**
     * @param string $token
     */
    public function setToken($Token)
    {
        $this->Token = $Token;
    }


    public function hasToken()
    {
        return (empty($this->Token) ? false : true);
    }
}