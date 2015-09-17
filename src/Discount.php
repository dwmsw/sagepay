<?php


namespace dwmsw\sagepay;


/**
 * Class Discount
 * @package dwmsw\sagepay
 */
class Discount
{

    /**
     * The Discount Total
     *
     * @var float
     */
    private $amount = 0.00;

    /**
     * The Discount Description
     *
     * @var string
     */
    private $description = '';

    /**
     * Discount constructor.
     * @param float $amount
     * @param string $description
     */
    public function __construct($amount, $description)
    {
        $this->amount = $amount;
        $this->description = $description;
    }

    /**
     * Get the amount
     *
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set the amount
     *
     * @param float $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * Get the description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the description
     *
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

}