<?php
/**
 * Class to create basket details
 */

namespace dwmsw\sagepay;

class Item
{
    /**
     * The item description
     *
     * @var string
     */
    private $description = '';

    /**
     * The unique product identifier code
     *
     * @var string
     */
    private $productSku;

    /**
     * Item product code
     *
     * @var string
     */
    private $productCode;

    /**
     * Quantity of the item ordered
     *
     * @var integer
     */
    private $quantity = 0;

    /**
     * The cost of the item before tax
     *
     * @var float
     */
    private $unitNetAmount = 0.0;

    /**
     * The amount of tax on the item
     *
     * @var float
     */
    private $unitTaxAmount = 0.0;

    /**
     * The total cost of the item with tax
     *
     * @var float
     */
    private $unitGrossAmount;

    /**
     * The total cost of the line including quantity and tax
     *
     * @var float
     */
    private $totalGrossAmount;


    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set description
     *
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Get unique product identifier code
     *
     * @return string
     */
    public function getProductSku()
    {
        return $this->productSku;
    }

    /**
     * Set unique product identifier code
     *
     * @param string $productSku
     */
    public function setProductSku($productSku)
    {
        $this->productSku = $productSku;
    }

    /**
     * Get product code
     *
     * @return string
     */
    public function getProductCode()
    {
        return $this->productCode;
    }

    /**
     * Set product code
     *
     * @param string $productCode
     */
    public function setProductCode($productCode)
    {
        $this->productCode = $productCode;
    }

    /**
     * Get quantity of the item ordered
     *
     * @return integer
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set quantity of the item ordered
     *
     * @param integer $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = intval($quantity);
    }

    /**
     * Get cost of the item before tax
     *
     * @return float
     */
    public function getUnitNetAmount()
    {
        return $this->unitNetAmount;
    }

    /**
     * Set cost of the item before tax
     *
     * @param float $unitNetAmount
     */
    public function setUnitNetAmount($unitNetAmount)
    {
        $this->unitNetAmount = floatval($unitNetAmount);
    }

    /**
     * Get amount of tax on the item
     *
     * @return float
     */
    public function getUnitTaxAmount()
    {
        return $this->unitTaxAmount;
    }

    /**
     * Set amount of tax on the item
     *
     * @param float $unitTaxAmount
     */
    public function setUnitTaxAmount($unitTaxAmount)
    {
        $this->unitTaxAmount = floatval($unitTaxAmount);
    }

    /**
     * Get total cost of the item with tax
     *
     * @return float
     */
    public function getUnitGrossAmount()
    {
        return $this->unitNetAmount + $this->unitTaxAmount;
    }

    /**
     * Get total cost of the line including quantity and tax
     *
     * @return float
     */
    public function getTotalGrossAmount()
    {
        return $this->getUnitGrossAmount() * $this->getQuantity();
    }


    /**
     * Return a array of the item properties
     *
     * @return array
     */
    public function asArray()
    {
        return array(
            'item' => $this->getDescription(),
            'quantity' => $this->getQuantity(),
            'value' => $this->getUnitNetAmount(),
            'tax' => $this->getUnitTaxAmount(),
            'itemTotal' => $this->getUnitGrossAmount(),
            'lineTotal' => $this->getTotalGrossAmount()
        );
    }}
