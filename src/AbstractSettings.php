<?php

/**
 * Common settings that can be used across all methods
 */

namespace dwmsw\sagepay;

class AbstractSettings
{

    /**
     * The version of tha API to use
     */
    protected $protocol = '3.00';

    /**
     * The currency being used
     */
    protected $currency = null;

    /**
     * The vendor code to be used with Sagepay
     */
    protected $vendorCode = null;

    /**
     * The method to be used to access the Sagepay API
     */
    protected $method = 'direct';

    /**
     * The basket items to be passed to Sagepay
     */
    protected $basket = null;

    /**
     * The mode of connection to the API
     * V3 currently only supports live and test
     */
    protected $mode = null;

    /**
     * An array holding the endpoints available to the Direct API
     */
    protected $directEndPoints = array(
            'live' => array(
                'register'  => 'https://live.sagepay.com/gateway/service/vspdirect-register.vsp',
                '3dsecure'  => 'https://live.sagepay.com/gateway/service/direct3dcallback.vsp',
                'abort'     => 'https://live.sagepay.com/gateway/service/abort.vsp',
                'authorise' => 'https://live.sagepay.com/gateway/service/authorise.vsp',
                'cancel'    => 'https://live.sagepay.com/gateway/service/cancel.vsp',
                'refund'    => 'https://live.sagepay.com/gateway/service/refund.vsp',
                'release'   => 'https://live.sagepay.com/gateway/service/release.vsp',
                'repeat'    => 'https://live.sagepay.com/gateway/service/repeat.vsp',
                'void'      => 'https://live.sagepay.com/gateway/service/void.vsp',
                'complete'  => 'https://live.sagepay.com/gateway/service/complete.vsp'
            ),
            'test' => array(
                'register'  => 'https://test.sagepay.com/gateway/service/vspdirect-register.vsp',
                '3dsecure'  => 'https://test.sagepay.com/gateway/service/direct3dcallback.vsp',
                'abort'     => 'https://test.sagepay.com/gateway/service/abort.vsp',
                'authorise' => 'https://test.sagepay.com/gateway/service/authorise.vsp',
                'cancel'    => 'https://test.sagepay.com/gateway/service/cancel.vsp',
                'refund'    => 'https://test.sagepay.com/gateway/service/refund.vsp',
                'release'   => 'https://test.sagepay.com/gateway/service/release.vsp',
                'repeat'    => 'https://test.sagepay.com/gateway/service/repeat.vsp',
                'void'      => 'https://test.sagepay.com/gateway/service/void.vsp',
                'complete'  => 'https://test.sagepay.com/gateway/service/complete.vsp'
            ),
        );
}
