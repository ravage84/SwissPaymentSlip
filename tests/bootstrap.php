<?php

/**
 * Swiss Payment Slip
 *
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 * @copyright 2012-2015 Some nice Swiss guys
 *
 * @author Marc Würth ravage@bluewin.ch
 * @author Manuel Reinhard <manu@sprain.ch>
 * @author Peter Siska <pesche@gridonic.ch>
 * @link https://github.com/ravage84/SwissPaymentSlip/
 *
 */

namespace SwissPaymentSlip\SwissPaymentSlip\Tests;

use SwissPaymentSlip\SwissPaymentSlip\PaymentSlipData;
use SwissPaymentSlip\SwissPaymentSlip\PaymentSlip;

// Include Composer's autoloader
require __DIR__.'/../vendor/autoload.php';

/**
 * A wrapping class to allow testing the abstract class PaymentSlipData
 */
class TestablePaymentSlipData extends PaymentSlipData{


}

/**
 * A wrapping class to allow testing the abstract class PaymentSlip
 */
class TestablePaymentSlip extends  PaymentSlip
{
}
