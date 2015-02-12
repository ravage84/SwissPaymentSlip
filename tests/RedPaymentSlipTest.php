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
     * Tests the default background
     *
     * @return void
     * @covers ::setDefaults
     */
    public function testSlipBackgroundDefaultValues()
    {
        $this->assertEquals('ezs_red.gif', basename($this->paymentSlip->getSlipBackground()));
    }

    /**
     * Tests the default attributes of the payment reason element
     *
     * @return void
     * @covers ::setDefaults
     * @todo Implement once the defaults are set properly in RedPaymentSlip::setDefaults()
     */
    public function testPaymentReasonAttrDefaultValues()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * Tests the default attributes of the left IBAN element
     *
     * @return void
     * @covers ::setDefaults
     * @todo Implement once the defaults are set properly in RedPaymentSlip::setDefaults()
     */
    public function testIbanLeftAttrDefaultValues()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * Tests the default attributes of the right IBAN element
     *
     * @return void
     * @covers ::setDefaults
     * @todo Implement once the defaults are set properly in RedPaymentSlip::setDefaults()
     */
    public function testIbanRightAttrDefaultValues()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * Tests the setPaymentReasonAttr method
     *
     * @return void
     * @covers ::setPaymentReasonAttr
     * @covers ::setAttributes
     * @covers ::getPaymentReasonAttr
     */
    public function testSetPaymentReasonAttr()
    {
        $returned = $this->paymentSlip->setPaymentReasonAttr(123, 456, 987, 654, '#123456', 'Courier', '1', '#654321', '15', 'C');
        $this->assertInstanceOf('SwissPaymentSlip\SwissPaymentSlip\RedPaymentSlip', $returned);
        $this->assertEquals($this->setAttributes, $this->paymentSlip->getPaymentReasonAttr());
    }

    /**
     * Tests the setIbanLeftAttr method
     *
     * @return void
     * @covers ::setIbanLeftAttr
     * @covers ::setAttributes
     * @covers ::getIbanLeftAttr
     */
    public function testSetIbanLeftAttr()
    {
        $returned = $this->paymentSlip->setIbanLeftAttr(123, 456, 987, 654, '#123456', 'Courier', '1', '#654321', '15', 'C');
        $this->assertInstanceOf('SwissPaymentSlip\SwissPaymentSlip\RedPaymentSlip', $returned);
        $this->assertEquals($this->setAttributes, $this->paymentSlip->getIbanLeftAttr());
    }

    /**
     * Tests the setIbanRightAttr method
     *
     * @return void
     * @covers ::setIbanRightAttr
     * @covers ::setAttributes
     * @covers ::getIbanRightAttr
     */
    public function testSetIbanRightAttr()
    {
        $returned = $this->paymentSlip->setIbanRightAttr(123, 456, 987, 654, '#123456', 'Courier', '1', '#654321', '15', 'C');
        $this->assertInstanceOf('SwissPaymentSlip\SwissPaymentSlip\RedPaymentSlip', $returned);
        $this->assertEquals($this->setAttributes, $this->paymentSlip->getIbanRightAttr());
    }

    /**
     * Tests the setDisplayIban method
     *
     * @return void
     * @covers ::setDisplayIban
     * @covers ::getDisplayIban
     * @covers ::isBool
     */
    public function testSetDisplayIban()
    {
        // Test the default value
        $this->assertTrue($this->paymentSlip->getDisplayIban());

        // Disable the feature, also assert returned instance
        $returned = $this->paymentSlip->setDisplayIban(false);
        $this->assertInstanceOf('SwissPaymentSlip\SwissPaymentSlip\RedPaymentSlip', $returned);
        $this->assertFalse($this->paymentSlip->getDisplayIban());

        // Re-enable the feature
        $this->paymentSlip->setDisplayIban();
        $this->assertTrue($this->paymentSlip->getDisplayIban());
    }

    /**
     * Tests the setDisplayIban method with an invalid parameter
     *
     * @return void
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $displayIban is not a boolean.
     * @covers ::setDisplayIban
     * @covers ::isBool
     */
    public function testSetDisplayIbanInvalidParameter()
    {
        $this->paymentSlip->setDisplayIban('true');
    }

    /**
     * Tests the setDisplayPaymentReason method
     *
     * @return void
     * @covers ::setDisplayPaymentReason
     * @covers ::getDisplayPaymentReason
     * @covers ::isBool
     */
    public function testSetDisplayPaymentReason()
    {
        // Test the default value
        $this->assertTrue($this->paymentSlip->getDisplayPaymentReason());

        // Disable the feature, also assert returned instance
        $returned = $this->paymentSlip->setDisplayPaymentReason(false);
        $this->assertInstanceOf('SwissPaymentSlip\SwissPaymentSlip\RedPaymentSlip', $returned);
        $this->assertFalse($this->paymentSlip->getDisplayPaymentReason());

        // Re-enable the feature
        $this->paymentSlip->setDisplayPaymentReason();
        $this->assertTrue($this->paymentSlip->getDisplayPaymentReason());
    }

    /**
     * Tests the setDisplayPaymentReason method with an invalid parameter
     *
     * @return void
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $displayPaymentReason is not a boolean.
     * @covers ::setDisplayPaymentReason
     * @covers ::isBool
     */
    public function testSetDisplayPaymentReasonInvalidParameter()
    {
        $this->paymentSlip->setDisplayPaymentReason('true');
    }

    /**
     * Tests the getAllElements method
     *
     * @return void
     * @expectedException \Exception
     * @expectedExceptionMessage Not yet implemented!
     * @covers ::getAllElements
     * @todo Remove exception expectation once RedPaymentSlipData::getCodeLine() is implemented
     */
    public function testGetAllElements()
    {
        $elements = $this->paymentSlip->getAllElements();

        $expectedElements = array(
            'bankLeft',
            'bankRight',
            'recipientLeft',
            'recipientRight',
            'accountLeft',
            'accountRight',
            'amountFrancsLeft',
            'amountFrancsRight',
            'amountCentsLeft',
            'amountCentsRight',
            'payerLeft',
            'payerRight',
            'codeLine',
            'IbanLeft',
            'IbanRight',
            'paymentReason',
        );

        $this->assertElementsArray($expectedElements, $elements);
    }
}
