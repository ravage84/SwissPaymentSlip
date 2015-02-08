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

use SwissPaymentSlip\SwissPaymentSlip\OrangePaymentSlip;
use SwissPaymentSlip\SwissPaymentSlip\OrangePaymentSlipData;

/**
 * Tests for the OrangePaymentSlip class
 *
 * @coversDefaultClass SwissPaymentSlip\SwissPaymentSlip\OrangePaymentSlip
 */
class OrangePaymentSlipTest extends PaymentSlipTestCase
{
    /**
     * The object under test
     *
     * @var OrangePaymentSlip
     */
    protected $paymentSlip;

    /**
     * Setup a slip to test and some default and set attributes to test
     *
     * @return void
     */
    protected function setUp()
    {
        $slipData = new OrangePaymentSlipData();
        $this->paymentSlip = new OrangePaymentSlip($slipData);

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
     * @expectedExceptionMessage Argument 1 passed to SwissPaymentSlip\SwissPaymentSlip\OrangePaymentSlip::__construct() must be an instance of SwissPaymentSlip\SwissPaymentSlip\OrangePaymentSlipData, null given
     */
    public function testNullSlipDataParameter()
    {
        new OrangePaymentSlip(null);
    }

    /**
     * Test the constructor method with a invalid object parameter
     *
     * @return void
     * @covers ::__construct
     * @expectedException \PHPUnit_Framework_Error
     * @expectedExceptionMessage Argument 1 passed to SwissPaymentSlip\SwissPaymentSlip\OrangePaymentSlip::__construct() must be an instance of SwissPaymentSlip\SwissPaymentSlip\OrangePaymentSlipData, instance of ArrayObject given
     */
    public function testInvalidSlipDataParameter()
    {
        if (defined('HHVM_VERSION')) {
            $this->markTestSkipped('This test fails with HHVM');
        }
        new OrangePaymentSlip(new \ArrayObject());
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
            'SwissPaymentSlip\SwissPaymentSlip\OrangePaymentSlipData',
            $this->paymentSlip->getPaymentSlipData()
        );
    }

    /**
     * Tests the default attributes of the left bank element for an orange slip
     *
     * @return void
     * @covers ::setDefaults
     */
    public function testBankLeftAttrDefaultValues()
    {
        $attributes = $this->paymentSlip->getBankLeftAttr();

        $expectedAttributes = $this->defaultAttributes;

        $expectedAttributes['PosX'] = 3;
        $expectedAttributes['PosY'] = 8;
        $expectedAttributes['Width'] = 50;
        $expectedAttributes['Height'] = 4;

        $this->assertEquals($expectedAttributes, $attributes);
    }

    /**
     * Tests the default attributes of the right bank element for an orange slip
     *
     * @return void
     * @covers ::setDefaults
     */
    public function testBankRightAttrDefaultValues()
    {
        $attributes = $this->paymentSlip->getBankRightAttr();

        $expectedAttributes = $this->defaultAttributes;

        $expectedAttributes['PosX'] = 66;
        $expectedAttributes['PosY'] = 8;
        $expectedAttributes['Width'] = 50;
        $expectedAttributes['Height'] = 4;

        $this->assertEquals($expectedAttributes, $attributes);
    }

    /**
     * Tests the default attributes of the left recipient element for an orange slip
     *
     * @return void
     * @covers ::setDefaults
     */
    public function testRecipientLeftAttrDefaultValues()
    {
        $attributes = $this->paymentSlip->getRecipientLeftAttr();

        $expectedAttributes = $this->defaultAttributes;

        $expectedAttributes['PosX'] = 3;
        $expectedAttributes['PosY'] = 23;
        $expectedAttributes['Width'] = 50;
        $expectedAttributes['Height'] = 4;

        $this->assertEquals($expectedAttributes, $attributes);
    }

    /**
     * Tests the default attributes of the right recipient element for an orange slip
     *
     * @return void
     * @covers ::setDefaults
     */
    public function testRecipientRightAttrDefaultValues()
    {
        $attributes = $this->paymentSlip->getRecipientRightAttr();

        $expectedAttributes = $this->defaultAttributes;

        $expectedAttributes['PosX'] = 66;
        $expectedAttributes['PosY'] = 23;
        $expectedAttributes['Width'] = 50;
        $expectedAttributes['Height'] = 4;

        $this->assertEquals($expectedAttributes, $attributes);
    }

    /**
     * Tests the default attributes of the left account element for an orange slip
     *
     * @return void
     * @covers ::setDefaults
     */
    public function testAccountLeftAttrDefaultValues()
    {
        $attributes = $this->paymentSlip->getAccountLeftAttr();

        $expectedAttributes = $this->defaultAttributes;

        $expectedAttributes['PosX'] = 27;
        $expectedAttributes['PosY'] = 43;
        $expectedAttributes['Width'] = 30;
        $expectedAttributes['Height'] = 4;

        $this->assertEquals($expectedAttributes, $attributes);
    }

    /**
     * Tests the default attributes of the right account element for an orange slip
     *
     * @return void
     * @covers ::setDefaults
     */
    public function testAccountRightAttrDefaultValues()
    {
        $attributes = $this->paymentSlip->getAccountRightAttr();

        $expectedAttributes = $this->defaultAttributes;

        $expectedAttributes['PosX'] = 90;
        $expectedAttributes['PosY'] = 43;
        $expectedAttributes['Width'] = 30;
        $expectedAttributes['Height'] = 4;

        $this->assertEquals($expectedAttributes, $attributes);
    }

    /**
     * Tests the default attributes of the left francs amount element for an orange slip
     *
     * @return void
     * @covers ::setDefaults
     */
    public function testAmountFrancsLeftAttrDefaultValues()
    {
        $attributes = $this->paymentSlip->getAmountFrancsLeftAttr();

        $expectedAttributes = $this->defaultAttributes;

        $expectedAttributes['PosX'] = 5;
        $expectedAttributes['PosY'] = 50.5;
        $expectedAttributes['Width'] = 35;
        $expectedAttributes['Height'] = 4;
        $expectedAttributes['TextAlign'] = 'R';

        $this->assertEquals($expectedAttributes, $attributes);
    }

    /**
     * Tests the default attributes of the right francs amount element for an orange slip
     *
     * @return void
     * @covers ::setDefaults
     */
    public function testAmountFrancsRightAttrDefaultValues()
    {
        $attributes = $this->paymentSlip->getAmountFrancsRightAttr();

        $expectedAttributes = $this->defaultAttributes;

        $expectedAttributes['PosX'] = 66;
        $expectedAttributes['PosY'] = 50.5;
        $expectedAttributes['Width'] = 35;
        $expectedAttributes['Height'] = 4;
        $expectedAttributes['TextAlign'] = 'R';

        $this->assertEquals($expectedAttributes, $attributes);
    }

    /**
     * Tests the default attributes of the left cents amount element for an orange slip
     *
     * @return void
     * @covers ::setDefaults
     */
    public function testAmountCentsLeftAttrDefaultValues()
    {
        $attributes = $this->paymentSlip->getAmountCentsLeftAttr();

        $expectedAttributes = $this->defaultAttributes;

        $expectedAttributes['PosX'] = 50;
        $expectedAttributes['PosY'] = 50.5;
        $expectedAttributes['Width'] = 6;
        $expectedAttributes['Height'] = 4;

        $this->assertEquals($expectedAttributes, $attributes);
    }

    /**
     * Tests the default attributes of the right cents amount element for an orange slip
     *
     * @return void
     * @covers ::setDefaults
     */
    public function testAmountCentsRightAttrDefaultValues()
    {
        $attributes = $this->paymentSlip->getAmountCentsRightAttr();

        $expectedAttributes = $this->defaultAttributes;

        $expectedAttributes['PosX'] = 111;
        $expectedAttributes['PosY'] = 50.5;
        $expectedAttributes['Width'] = 6;
        $expectedAttributes['Height'] = 4;

        $this->assertEquals($expectedAttributes, $attributes);
    }

    /**
     * Tests the default attributes of the left reference number element for an orange slip
     *
     * @return void
     * @covers ::setDefaults
     */
    public function testReferenceNumberLeftAttrDefaultValues()
    {
        $attributes = $this->paymentSlip->getReferenceNumberLeftAttr();

        $expectedAttributes = $this->defaultAttributes;

        $expectedAttributes['PosX'] = 3;
        $expectedAttributes['PosY'] = 60;
        $expectedAttributes['Width'] = 50;
        $expectedAttributes['Height'] = 4;
        $expectedAttributes['FontSize'] = 8;

        $this->assertEquals($expectedAttributes, $attributes);
    }

    /**
     * Tests the default attributes of the right reference number element for an orange slip
     *
     * @return void
     * @covers ::setDefaults
     */
    public function testReferenceNumberRightAttrDefaultValues()
    {
        $attributes = $this->paymentSlip->getReferenceNumberRightAttr();

        $expectedAttributes = $this->defaultAttributes;

        $expectedAttributes['PosX'] = 125;
        $expectedAttributes['PosY'] = 33.5;
        $expectedAttributes['Width'] = 80;
        $expectedAttributes['Height'] = 4;
        $expectedAttributes['TextAlign'] = 'R';

        $this->assertEquals($expectedAttributes, $attributes);
    }

    /**
     * Tests the default attributes of the left payer element for an orange slip
     *
     * @return void
     * @covers ::setDefaults
     */
    public function testPayerLeftAttrDefaultValues()
    {
        $attributes = $this->paymentSlip->getPayerLeftAttr();

        $expectedAttributes = $this->defaultAttributes;

        $expectedAttributes['PosX'] = 3;
        $expectedAttributes['PosY'] = 65;
        $expectedAttributes['Width'] = 50;
        $expectedAttributes['Height'] = 4;

        $this->assertEquals($expectedAttributes, $attributes);
    }

    /**
     * Tests the default attributes of the right payer element for an orange slip
     *
     * @return void
     * @covers ::setDefaults
     */
    public function testPayerRightAttrDefaultValues()
    {
        $attributes = $this->paymentSlip->getPayerRightAttr();

        $expectedAttributes = $this->defaultAttributes;

        $expectedAttributes['PosX'] = 125;
        $expectedAttributes['PosY'] = 48;
        $expectedAttributes['Width'] = 50;
        $expectedAttributes['Height'] = 4;

        $this->assertEquals($expectedAttributes, $attributes);
    }

    /**
     * Tests the default attributes of the code line element for an orange slip
     *
     * @return void
     * @covers ::setDefaults
     */
    public function testCodeLineAttrDefaultValues()
    {
        $attributes = $this->paymentSlip->getCodeLineAttr();

        $expectedAttributes = $this->defaultAttributes;

        $expectedAttributes['PosX'] = 64;
        $expectedAttributes['PosY'] = 85;
        $expectedAttributes['Width'] = 140;
        $expectedAttributes['Height'] = 4;
        $expectedAttributes['FontFamily'] = 'OCRB10';
        $expectedAttributes['TextAlign'] = 'R';

        $this->assertEquals($expectedAttributes, $attributes);
    }

    /**
     * Tests the default background for an orange slip
     *
     * @return void
     * @covers ::setDefaults
     */
    public function testSlipBackgroundDefaultValues()
    {
        $this->assertEquals('ezs_orange.gif', basename($this->paymentSlip->getSlipBackground()));
    }

    /**
     * Tests the setReferenceNumberLeftAttr method
     *
     * @return void
     * @covers ::setReferenceNumberLeftAttr
     * @covers ::setAttributes
     * @covers ::getReferenceNumberLeftAttr
     */
    public function testSetReferenceNumberLeftAttr()
    {
        $this->paymentSlip->setReferenceNumberLeftAttr(123, 456, 987, 654, '#123456', 'Courier', '1', '#654321', '15', 'C');
        $this->assertEquals($this->setAttributes, $this->paymentSlip->getReferenceNumberLeftAttr());
    }

    /**
     * Tests the setReferenceNumberRightAttr method
     *
     * @return void
     * @covers ::setReferenceNumberRightAttr
     * @covers ::setAttributes
     * @covers ::getReferenceNumberRightAttr
     */
    public function testSetReferenceNumberRightAttr()
    {
        $this->paymentSlip->setReferenceNumberRightAttr(123, 456, 987, 654, '#123456', 'Courier', '1', '#654321', '15', 'C');
        $this->assertEquals($this->setAttributes, $this->paymentSlip->getReferenceNumberRightAttr());
    }

    /**
     * Tests the setDisplayReferenceNr method
     *
     * @return void
     * @covers ::setDisplayReferenceNr
     * @covers ::getDisplayReferenceNr
     */
    public function testSetDisplayReferenceNr()
    {
        $this->paymentSlip->setDisplayReferenceNr();
        $this->assertEquals(true, $this->paymentSlip->getDisplayReferenceNr());

        $this->paymentSlip->setDisplayReferenceNr(true);
        $this->assertEquals(true, $this->paymentSlip->getDisplayReferenceNr());

        $this->paymentSlip->setDisplayReferenceNr(false);
        $this->assertEquals(false, $this->paymentSlip->getDisplayReferenceNr());

        $this->paymentSlip->setDisplayReferenceNr('XXX');
    }

    /**
     * Tests the getAllElements method
     *
     * @return void
     * @covers ::getAllElements
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
            'referenceNumberLeft',
            'referenceNumberRight',
            'payerLeft',
            'payerRight',
            'codeLine'
        );

        $this->assertElementsArray($expectedElements, $elements);
    }

}
