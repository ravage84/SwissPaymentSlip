<?php
/**
 * Swiss Payment Slip
 *
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 * @copyright 2012-2015 Some nice Swiss guys
 * @author Manuel Reinhard <manu@sprain.ch>
 * @author Peter Siska <pesche@gridonic.ch>
 * @author Marc Würth ravage@bluewin.ch
 * @link https://github.com/ravage84/SwissPaymentSlip/
 */

namespace SwissPaymentSlip\SwissPaymentSlip\Tests;

use SwissPaymentSlip\SwissPaymentSlip\PaymentSlipData;
use SwissPaymentSlip\SwissPaymentSlip\PaymentSlip;

/**
 * A test case for all common payment slip test code
 */
class PaymentSlipTestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * The data container for the object under test
     *
     * @var PaymentSlipData
     */
    protected $slipData;

    /**
     * The object under test
     *
     * @var PaymentSlip
     */
    protected $paymentSlip;

    /**
     * The default attributes to test against
     *
     * @var array
     */
    protected $defaultAttributes;

    /**
     * The set attributes to test against
     *
     * @var array
     */
    protected $setAttributes;

    /**
     * Assert an array of elements with their lines and attributes
     *
     * @param array $expectedElements The expected elements array.
     * @param array $elements The actual elements array.
     */
    protected function assertElementsArray($expectedElements, $elements)
    {
        foreach ($expectedElements as $elementNr => $element) {
            $this->assertArrayHasKey($element, $elements);

            $this->assertArrayHasKey('lines', $elements[$element]);
            $this->assertArrayHasKey('attributes', $elements[$element]);
        }
    }
}
