<?php
/**
 * Class to create basket details
 */

namespace dwmsw\sagepay;

class Basket
{
    /**
     * Array to hold added items
     * @var array
     */
    protected $items = array();

    /**
     * Delivery tax amount
     * @var float
     */
    protected $deliveryTaxAmount;

    /**
     * Delivery net amount
     * @var float
     */
    protected $deliveryNetAmount;

    /**
     * Add the item to basket
     *
     * @param Item $item
     */
    public function addItem(Item $item) 
    {
        $this->items[] = $item;
    }

    /**
     * Get delivery net amount
     *
     * @return float
     */
    public function getDeliveryNetAmount()
    {
        return $this->deliveryNetAmount;
    }

    /**
     * Set delivery net amount
     *
     * @param float $deliveryNetAmount
     */
    public function setDeliveryNetAmount($deliveryNetAmount)
    {
        $this->deliveryNetAmount = $deliveryNetAmount;
    }

    /**
     * Get delivery tax
     *
     * @return float
     */
    public function getDeliveryTaxAmount()
    {
        return $this->deliveryTaxAmount;
    }

    /**
     * Set delivery tax
     *
     * @param float $deliveryTaxAmount
     */
    public function setDeliveryTaxAmount($deliveryTaxAmount)
    {
        $this->deliveryTaxAmount = $deliveryTaxAmount;
    }

    /**
     * Get delivery gross amount
     *
     * @return float
     */
    public function getDeliveryGrossAmount()
    {
        return $this->deliveryNetAmount + $this->deliveryTaxAmount;
    }

    /**
     * Get the total amount of basket
     *
     * @return float
     */
    public function getAmount()
    {
        $amount = $this->getDeliveryGrossAmount();
        foreach ($this->items as $item)
        {
            $amount += $item->getTotalGrossAmount();
        }
        return $amount;
    }

    public function getItems($xml = false)
    {   
        if ($xml === false) {
            return $this->items;
        } else {
            return $this->toXml();
        }
    }

    /**
     * Export Basket as XML
     *
     * @return string
     */
    private function toXml()
    {
        $dom = new \DOMDocument();
        $dom->formatOutput = true;
        $dom->loadXML('<basket></basket>');
        foreach ($this->getItems() as $item) {
            $value = NULL;

            if ($item->getQuantity() <= 0) {
                continue;
            }

            $node = $dom->createElement('item');

            $node->appendChild($dom->createElement('description', $item->getDescription()));
            $node->appendChild($dom->createElement('quantity', $item->getQuantity()));
            $node->appendChild($dom->createElement('unitNetAmount', $item->getUnitNetAmount()));
            $node->appendChild($dom->createElement('unitTaxAmount', $item->getUnitTaxAmount()));
            $node->appendChild($dom->createElement('unitGrossAmount', $item->getUnitGrossAmount()));
            $node->appendChild($dom->createElement('TotalGrossAmount', $item->getTotalGrossAmount()));

            if ($tmp = $item->getProductSku()) {
                $node->appendChild($dom->createElement('productSKU', $tmp));
            }

            if ($tmp = $item->getProductCode()) {
                $node->appendChild($dom->createElement('productCode', $tmp));
            }

            $dom->documentElement->appendChild($node);
        }

        if ($this->deliveryNetAmount) {
            $dom->documentElement->appendChild($dom->createElement('deliveryNetAmount', $this->deliveryNetAmount));
        }

        if ($this->deliveryTaxAmount) {
            $dom->documentElement->appendChild($dom->createElement('deliveryTaxAmount', $this->deliveryTaxAmount));
        }

        if ($tmp = $this->getDeliveryGrossAmount()) {
            $dom->documentElement->appendChild($dom->createElement('deliveryGrossAmount', $tmp));
        }

        return $dom->saveXML($dom);
    }
}
