<?php

/**
 * Common settings that can be used across all methods
 */

namespace dwmsw\sagepay;

class AbstractSettings
{

    /**
     * The version of tha API to use
     *
     * @var int
     */
    protected $protocol = 3.00;

    /**
     * The currency being used
     *
     * @var string
     */
    protected $currency = null;

    /**
     * The vendor name to be used with Sagepay
     *
     * @var string
     */
    protected $vendorName = null;

    /**
     * The method to be used to access the Sagepay API
     *
     * @var string
     */
    protected $method = 'direct';

    /**
     * The basket items to be passed to Sagepay
     *
     * @var array
     */
    protected $basket = array();

    /**
     * The mode of connection to the API
     * V3 currently only supports live and test
     *
     * @var string
     */
    protected $mode = null;

    /**
     * Set this value for callback url called by PayPal
     *
     * @var string
     */
    protected $paypalCallbackUrl = '';

    /**
     * Which type of Sagepay account is to be used
     * E = Use the e-commerce merchant account (default).
     * M = Use the mail
     * C = Use the continuous authority merchant account (if present).
     *
     * @var string
     */
    protected $accountType = 'E';

    /**
     * Apply Address Verification Status / Card Verification Value
     * 0 = If AVS/CV2 enabled then check them.  If rules apply, use rules (default).
     * 1 = Force AVS/CV2 checks even if not enabled for the account. If rules apply, use rules.
     * 2 = Force NO AVS/CV2 checks even if enabled on account.
     * 3 = Force AVS/CV2 checks even if not enabled for the account but DON'T apply any rules.
     *
     * @var int
     */
    protected $applyAvsCv2 = 0;

    /**
     * Apply 3D-Secure
     * 0 = If 3D-Secure checks are possible and rules allow, perform the checks and apply the authorisation rules. (default)
     * 1 = Force 3D-Secure checks for this transaction if possible and apply rules for authorisation.
     * 2 = Do not perform 3D-Secure checks for this transaction and always authorise.
     * 3 = Force 3D-Secure checks for this transaction if possible but ALWAYS obtain an auth code, irrespective of rule base.
     *
     * @var int
     */
    protected $apply3dSecure = 0;

    /**
     * An array holding the endpoints available to the Direct API
     *
     * @var array
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

    /**
     * Timeout limit for cURL requests
     * 
     * @var integer
     */
    protected $timeOut = 30;
}
