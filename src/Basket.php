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
     * @return type
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

    /**
     * Export Basket as XML
     *
     * @return string
     */
    private function _toXml()
    {
        $dom = new DOMDocument();
        $dom->formatOutput = false;
        $dom->loadXML('<basket></basket>');
        foreach ($this->_exportFields as $name)
        {
            $value = NULL;
            $getter = "get" . ucfirst($name);
            if (method_exists($this, $getter))
            {
                $value = $this->$getter();
            }

            if (empty($value))
            {
                continue;
            }

            $node = $this->_createDomNode($dom, $value, $name);
            if ($node instanceof DOMNode)
            {
                $dom->documentElement->appendChild($node);
            }
            else if ($node instanceof DOMNodeList)
            {
                for ($i = 0, $n = $node->length; $i < $n; $i++)
                {
                    $child = $node->item(0);
                    if ($child instanceof DOMNode)
                    {
                        $dom->documentElement->appendChild($child);
                    }
                }
            }
        }
        return $dom->saveXML($dom->documentElement);
    }
}
