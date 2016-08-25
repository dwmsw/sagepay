<?php

namespace dwmsw\sagepay;


class Token extends Shared
{

    public function remove($token)
    {
        $data = array(
            'VPSProtocol' => $this->protocol,
            'TxType' => 'REMOVETOKEN',
            'Vendor' => $this->getVendorName(),
            'Token' => $token
        );

        return $this->makeRequest($this->directEndPoints[$this->mode]['removeToken'], $data);
    }

    public function create(Card $card)
    {
        $data = array(
            'VPSProtocol' => $this->protocol,
            'TxType' => 'TOKEN',
            'Vendor' => $this->getVendorName(),
            'Currency' => $this->currency,
            'CardHolder' => $card->getCardHolder(),
            'CardNumber' => $card->getCardNumber(),
            'ExpiryDate' => $card->getExpiryDate(),
            'CV2' => $card->getCV2(),
            'CardType' => $card->getCardType(),
        );

        return $this->makeRequest($this->directEndPoints[$this->mode]['createToken'], $data);
    }
}