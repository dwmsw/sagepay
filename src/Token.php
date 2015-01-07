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
}