<?php
/**
 * Swiss Payment Slip
 *
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 * @copyright 2012-2015 Some nice Swiss guys
 * @author Manuel Reinhard <manu@sprain.ch>
 * @author Peter Siska <pesche@gridonic.ch>
 * @author Marc Würth ravage@bluewin.ch
 * @link https://github.com/sprain/class.Einzahlungsschein.php
 */

namespace SwissPaymentSlip\SwissPaymentSlip\Tests;

use SwissPaymentSlip\SwissPaymentSlip\PaymentSlip;
use SwissPaymentSlip\SwissPaymentSlip\PaymentSlipData;

// Include Composer's autoloader
require __DIR__.'/../vendor/autoload.php';

/**
 * A wrapping class to allow testing the abstract class PaymentSlipData
 */
class TestablePaymentSlipData extends PaymentSlipData
{
}

/**
 * A wrapping class to allow testing the abstract class PaymentSlip
 */
class TestablePaymentSlip extends PaymentSlip
{
    public function getAllElements($formatted = true, $fillZeroes = true)
    {
    }
}
