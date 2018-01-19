<?php
/**
 * Swiss Payment Slip
 *
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 * @copyright 2012-2016 Some nice Swiss guys
 * @author Marc Würth ravage@bluewin.ch
 * @author Manuel Reinhard <manu@sprain.ch>
 * @author Peter Siska <pesche@gridonic.ch>
 * @link https://github.com/ravage84/SwissPaymentSlip/
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
     * @expectedException \TypeError
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
     * @expectedException \TypeError
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
     * Tests the default background
     *
     * @return void
     * @covers ::setDefaults
     */
    public function testSlipBackgroundDefaultValues()
    {
        $this->assertEquals('ezs_orange.gif', basename($this->paymentSlip->getSlipBackground()));
    }

    /**
     * Tests the default attributes of the left reference number element
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
     * Tests the default attributes of the right reference number element
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
     * Tests the default attributes of the code line element
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
     * Tests the setReferenceNumberLeftAttr method
     *
     * @return void
     * @covers ::setReferenceNumberLeftAttr
     * @covers ::setAttributes
     * @covers ::getReferenceNumberLeftAttr
     */
    public function testSetReferenceNumberLeftAttr()
    {
        $returned = $this->paymentSlip->setReferenceNumberLeftAttr(123, 456, 987, 654, '#123456', 'Courier', '1', '#654321', '15', 'C');
        $this->assertInstanceOf('SwissPaymentSlip\SwissPaymentSlip\OrangePaymentSlip', $returned);
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
        $returned = $this->paymentSlip->setReferenceNumberRightAttr(123, 456, 987, 654, '#123456', 'Courier', '1', '#654321', '15', 'C');
        $this->assertInstanceOf('SwissPaymentSlip\SwissPaymentSlip\OrangePaymentSlip', $returned);
        $this->assertEquals($this->setAttributes, $this->paymentSlip->getReferenceNumberRightAttr());
    }

    /**
     * Tests the setCodeLineAttr method
     *
     * @return void
     * @covers ::setCodeLineAttr
     * @covers ::setAttributes
     * @covers ::getCodeLineAttr
     */
    public function testSetCodeLineAttr()
    {
        $returned = $this->paymentSlip->setCodeLineAttr(123, 456, 987, 654, '#123456', 'Courier', '1', '#654321', '15', 'C');
        $this->assertInstanceOf('SwissPaymentSlip\SwissPaymentSlip\OrangePaymentSlip', $returned);
        $this->assertEquals($this->setAttributes, $this->paymentSlip->getCodeLineAttr());
    }

    /**
     * Tests the setDisplayReferenceNr method
     *
     * @return void
     * @covers ::setDisplayReferenceNr
     * @covers ::getDisplayReferenceNr
     * @covers ::isBool
     */
    public function testSetDisplayReferenceNr()
    {
        // Test the default value
        $this->assertTrue($this->paymentSlip->getDisplayReferenceNr());

        // Disable the feature, also assert returned instance
        $returned = $this->paymentSlip->setDisplayReferenceNr(false);
        $this->assertInstanceOf('SwissPaymentSlip\SwissPaymentSlip\OrangePaymentSlip', $returned);
        $this->assertFalse($this->paymentSlip->getDisplayReferenceNr());

        // Re-enable the feature
        $this->paymentSlip->setDisplayReferenceNr();
        $this->assertTrue($this->paymentSlip->getDisplayReferenceNr());

        // Check if the data is disabled
        $this->paymentSlip->getPaymentSlipData()->setWithReferenceNumber(false);
        $this->assertFalse($this->paymentSlip->getDisplayReferenceNr());
    }

    /**
     * Tests the setDisplayReferenceNr method with an invalid parameter
     *
     * @return void
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $displayReferenceNr is not a boolean.
     * @covers ::setDisplayReferenceNr
     * @covers ::isBool
     */
    public function testSetDisplayReferenceNrInvalidParameter()
    {
        $this->paymentSlip->setDisplayReferenceNr('true');
    }

    /**
     * Tests the setDisplayCodeLine method
     *
     * @return void
     * @covers ::setDisplayCodeLine
     * @covers ::getDisplayCodeLine
     * @covers ::isBool
     */
    public function testSetDisplayCodeLine()
    {
        // Test the default value
        $this->assertTrue($this->paymentSlip->getDisplayCodeLine());

        // Disable feature, also check for returned instance
        $returned = $this->paymentSlip->setDisplayCodeLine(false);
        $this->assertInstanceOf('SwissPaymentSlip\SwissPaymentSlip\OrangePaymentSlip', $returned);
        $this->assertFalse($this->paymentSlip->getDisplayCodeLine());

        // Re-enable the feature
        $this->paymentSlip->setDisplayCodeLine();
        $this->assertTrue($this->paymentSlip->getDisplayCodeLine());

        // Check if the data is disabled
        $this->paymentSlip->getPaymentSlipData()->setWithAccountNumber(true);
        $this->paymentSlip->getPaymentSlipData()->setWithReferenceNumber(false);
        $this->assertFalse($this->paymentSlip->getDisplayCodeLine());

        // Check if the data is disabled
        $this->paymentSlip->getPaymentSlipData()->setWithAccountNumber(false);
        $this->paymentSlip->getPaymentSlipData()->setWithReferenceNumber(true);
        $this->assertFalse($this->paymentSlip->getDisplayCodeLine());
    }

    /**
     * Tests the setDisplayCodeLine method with an invalid parameter
     *
     * @return void
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $displayCodeLine is not a boolean.
     * @covers ::setDisplayCodeLine
     * @covers ::isBool
     */
    public function testSetDisplayCodeLineInvalidParameter()
    {
        $this->paymentSlip->setDisplayCodeLine('true');
    }

    /**
     * Tests the setReferenceNrFormatted method
     *
     * @return void
     * @covers ::setReferenceNrFormatted
     * @covers ::getReferenceNrFormatted
     * @covers ::isBool
     */
    public function testSetReferenceNrFormatted()
    {
        // Test the default value
        $this->assertTrue($this->paymentSlip->getReferenceNrFormatted());

        // Disable feature, also check for returned instance
        $returned = $this->paymentSlip->setReferenceNrFormatted(false);
        $this->assertInstanceOf('SwissPaymentSlip\SwissPaymentSlip\OrangePaymentSlip', $returned);
        $this->assertFalse($this->paymentSlip->getReferenceNrFormatted());

        // Re-enable the feature
        $this->paymentSlip->setReferenceNrFormatted(true);
        $this->assertTrue($this->paymentSlip->getReferenceNrFormatted());
    }

    /**
     * Tests the setReferenceNrFormatted method with an invalid parameter
     *
     * @return void
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $referenceNrFormatted is not a boolean.
     * @covers ::setReferenceNrFormatted
     * @covers ::isBool
     */
    public function testSetReferenceNrFormattedInvalidParameter()
    {
        $this->paymentSlip->setReferenceNrFormatted('true');
    }

    /**
     * Tests the setReferenceNrFillZeros method
     *
     * @return void
     * @covers ::setReferenceNrFillZeros
     * @covers ::getReferenceNrFillZeros
     * @covers ::isBool
     */
    public function testSetReferenceNrFillZeros()
    {
        // Test the default value
        $this->assertTrue($this->paymentSlip->getReferenceNrFillZeros());

        // Disable feature, also check for returned instance
        $returned = $this->paymentSlip->setReferenceNrFillZeros(false);
        $this->assertInstanceOf('SwissPaymentSlip\SwissPaymentSlip\OrangePaymentSlip', $returned);
        $this->assertFalse($this->paymentSlip->getReferenceNrFillZeros());

        // Re-enable the feature
        $this->paymentSlip->setReferenceNrFillZeros(true);
        $this->assertTrue($this->paymentSlip->getReferenceNrFillZeros());
    }

    /**
     * Tests the setReferenceNrFillZeros method with an invalid parameter
     *
     * @return void
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $referenceNrFillZeros is not a boolean.
     * @covers ::setReferenceNrFillZeros
     * @covers ::isBool
     */
    public function testSetReferenceNrFillZerosInvalidParameter()
    {
        $this->paymentSlip->setReferenceNrFillZeros('true');
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

    /**
     * Tests the getAllElements method when no elements are shown
     *
     * @return void
     * @covers ::getAllElements
     */
    public function testGetAllElementsNoElementsShown()
    {
        $this->paymentSlip->setDisplayAccount(false);
        $this->paymentSlip->setDisplayAmount(false);
        $this->paymentSlip->setDisplayBank(false);
        $this->paymentSlip->setDisplayPayer(false);
        $this->paymentSlip->setDisplayRecipient(false);
        $this->paymentSlip->setDisplayCodeLine(false);
        $this->paymentSlip->setDisplayReferenceNr(false);

        $elements = $this->paymentSlip->getAllElements();

        $expectedElements = array();

        $this->assertElementsArray($expectedElements, $elements);
    }

    /**
     * Tests the getAllElements method when all data is disabled
     *
     * @return void
     * @covers ::getAllElements
     */
    public function testGetAllElementsDisabledData()
    {
        $paymentSlipData = $this->paymentSlip->getPaymentSlipData();
        $paymentSlipData->setWithAccountNumber(false);
        $paymentSlipData->setWithAmount(false);
        $paymentSlipData->setWithBank(false);
        $paymentSlipData->setWithPayer(false);
        $paymentSlipData->setWithRecipient(false);
        $paymentSlipData->setWithReferenceNumber(false);
        $paymentSlipData->setWithBankingCustomerId(false);

        $elements = $this->paymentSlip->getAllElements();

        $expectedElements = array();

        $this->assertElementsArray($expectedElements, $elements);
    }
}
