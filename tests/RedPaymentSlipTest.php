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

use SwissPaymentSlip\SwissPaymentSlip\RedPaymentSlip;
use SwissPaymentSlip\SwissPaymentSlip\RedPaymentSlipData;

/**
 * Tests for the RedPaymentSlip class
 *
 * @coversDefaultClass SwissPaymentSlip\SwissPaymentSlip\RedPaymentSlip
 */
class RedPaymentSlipTest extends PaymentSlipTestCase
{
    /**
     * The object under test
     *
     * @var RedPaymentSlip
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
     * Setup a slip to test and some default and set attributes to test
     *
     * @return void
     */
    protected function setUp()
    {
        $slipData = new RedPaymentSlipData();
        $this->paymentSlip = new RedPaymentSlip($slipData);

        $attributes = array();
        $attributes['PosX'] = 0;
        $attributes['PosY'] = 0;
        $attributes['Width'] = 0;
        $attributes['Height'] = 0;
        $attributes['Background'] = 'transparent';
        $attributes['FontFamily'] = 'Helvetica';
        $attributes['FontSize'] = '10';
        $attributes['FontColor'] = '#000';
        $attributes['LineHeight'] = 4;
        $attributes['TextAlign'] = 'L';

        $this->defaultAttributes = $attributes;

        $attributes = array();
        $attributes['PosX'] = 123;
        $attributes['PosY'] = 456;
        $attributes['Width'] = 987;
        $attributes['Height'] = 654;
        $attributes['Background'] = '#123456';
        $attributes['FontFamily'] = 'Courier';
        $attributes['FontSize'] = '1';
        $attributes['FontColor'] = '#654321';
        $attributes['LineHeight'] = '15';
        $attributes['TextAlign'] = 'C';

        $this->setAttributes = $attributes;
    }

    /**
     * Test the constructor method with a null parameter
     *
     * @return void
     * @covers ::__construct
     * @expectedException \PHPUnit_Framework_Error
     * @expectedExceptionMessage Argument 1 passed to SwissPaymentSlip\SwissPaymentSlip\RedPaymentSlip::__construct() must be an instance of SwissPaymentSlip\SwissPaymentSlip\RedPaymentSlipData, null given
     */
    public function testNullSlipDataParameter()
    {
        new RedPaymentSlip(null);
    }

    /**
     * Test the constructor method with a invalid object parameter
     *
     * @return void
     * @covers ::__construct
     * @expectedException \PHPUnit_Framework_Error
     * @expectedExceptionMessage Argument 1 passed to SwissPaymentSlip\SwissPaymentSlip\RedPaymentSlip::__construct() must be an instance of SwissPaymentSlip\SwissPaymentSlip\RedPaymentSlipData, instance of ArrayObject given
     */
    public function testInvalidSlipDataParameter()
    {
        if (defined('HHVM_VERSION')) {
            $this->markTestSkipped('This test fails with HHVM');
        }
        new RedPaymentSlip(new \ArrayObject());
    }

    /**
     * Tests the getPaymentSlipData method
     *
     * @return void
     * @covers ::getPaymentSlipData
     */
    public function testGetPaymentSlipDataIsInstanceOf()
    {
        $this->assertInstanceOf(
            'SwissPaymentSlip\SwissPaymentSlip\RedPaymentSlipData',
            $this->paymentSlip->getPaymentSlipData()
        );
    }

    /**
     * Tests the default background for a red slip
     *
     * @return void
     * @covers ::setDefaults
     */
    public function testSlipBackgroundDefaultValues()
    {
        $this->assertEquals('ezs_red.gif', basename($this->paymentSlip->getSlipBackground()));
    }

    /**
     * Tests the setDisplayPaymentReason method
     *
     * @return void
     * @covers ::setDisplayPaymentReason
     * @covers ::getDisplayPaymentReason
     */
    public function testSetDisplayPaymentReason()
    {
        $this->paymentSlip->setDisplayPaymentReason();
        $this->assertEquals(true, $this->paymentSlip->getDisplayPaymentReason());

        $this->paymentSlip->setDisplayPaymentReason(false);
        $this->assertEquals(false, $this->paymentSlip->getDisplayPaymentReason());

        $this->paymentSlip->setDisplayPaymentReason(true);
        $this->assertEquals(true, $this->paymentSlip->getDisplayPaymentReason());

        $this->paymentSlip->setDisplayPaymentReason('XXX');
    }

    /**
     * Tests the getAllElements method
     *
     * @return void
     * @covers ::getAllElements
     * @todo Implement testGetAllElements
     */
    public function testGetAllElements()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }
}
