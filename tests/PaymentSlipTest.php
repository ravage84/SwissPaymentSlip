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

/**
 * Tests for the PaymentSlip class
 *
 * @coversDefaultClass SwissPaymentSlip\SwissPaymentSlip\PaymentSlip
 */
class PaymentSlipTest extends PaymentSlipTestCase
{
    /**
     * Setup a slip to test and some default and set attributes to test
     *
     * @return void
     */
    protected function setUp()
    {
        $this->slipData = new TestablePaymentSlipData();
        $this->paymentSlip = new TestablePaymentSlip($this->slipData);

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
     * Tests the constructor when setting the position
     *
     * @return void
     * @covers ::__construct
     */
    public function testConstructSetPosition()
    {
        // Do not set position explicitly
        $slip = new TestablePaymentSlip($this->slipData);
        $this->assertEquals(0, $slip->getSlipPosX());
        $this->assertEquals(191, $slip->getSlipPosY());

        // Set X and Y position
        $slip = new TestablePaymentSlip($this->slipData, 100, 200);
        $this->assertEquals(100, $slip->getSlipPosX());
        $this->assertEquals(200, $slip->getSlipPosY());

        // Set X position only
        $slip = new TestablePaymentSlip($this->slipData, 50);
        $this->assertEquals(50, $slip->getSlipPosX());
        $this->assertEquals(191, $slip->getSlipPosY());

        // Set X position only
        $slip = new TestablePaymentSlip($this->slipData, null, 150);
        $this->assertEquals(0, $slip->getSlipPosX());
        $this->assertEquals(150, $slip->getSlipPosY());
    }

    /**
     * Test the constructor method with a null parameter
     *
     * @return void
     * @covers ::__construct
     * @expectedException \PHPUnit_Framework_Error
     * @expectedExceptionMessage Argument 1 passed to SwissPaymentSlip\SwissPaymentSlip\PaymentSlip::__construct() must be an instance of SwissPaymentSlip\SwissPaymentSlip\PaymentSlipData, null given
     */
    public function testNullSlipDataParameter()
    {
        new TestablePaymentSlip(null);
    }

    /**
     * Test the constructor method with a invalid object parameter
     *
     * @return void
     * @covers ::__construct
     * @expectedException \PHPUnit_Framework_Error
     * @expectedExceptionMessage Argument 1 passed to SwissPaymentSlip\SwissPaymentSlip\PaymentSlip::__construct() must be an instance of SwissPaymentSlip\SwissPaymentSlip\PaymentSlipData, instance of ArrayObject given
     */
    public function testInvalidSlipDataParameter()
    {
        if (defined('HHVM_VERSION')) {
            $this->markTestSkipped('This test fails with HHVM');
        }
        new TestablePaymentSlip(new \ArrayObject());
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
            'SwissPaymentSlip\SwissPaymentSlip\PaymentSlipData',
            $this->paymentSlip->getPaymentSlipData()
        );
    }

    /**
     * Tests setting the slip position
     *
     * @return void
     * @covers ::setSlipPosition
     * @covers ::setSlipPosX
     * @covers ::setSlipPosY
     * @covers ::getSlipPosX
     * @covers ::getSlipPosY
     */
    public function testSetSlipPosition()
    {
        // Test the default values
        $this->assertEquals(0, $this->paymentSlip->getSlipPosX());
        $this->assertEquals(191, $this->paymentSlip->getSlipPosY());

        // Set both
        $returned = $this->paymentSlip->setSlipPosition(200, 100);
        $this->assertInstanceOf('SwissPaymentSlip\SwissPaymentSlip\Tests\TestablePaymentSlip', $returned);
        $this->assertEquals(200, $this->paymentSlip->getSlipPosX());
        $this->assertEquals(100, $this->paymentSlip->getSlipPosY());
    }

    /**
     * Tests the setSlipPosition method with an invalid first parameter
     *
     * @return void
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $slipPosX is neither an integer nor a float.
     * @covers ::setSlipPosition
     * @covers ::isIntOrFloat
     */
    public function testSetSlipPositionFirstParameterInvalid()
    {
        $this->paymentSlip->setSlipPosition('A', 150);
    }

    /**
     * Tests the setSlipPosition method with an invalid second parameter
     *
     * @return void
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $slipPosY is neither an integer nor a float.
     * @covers ::setSlipPosition
     * @covers ::isIntOrFloat
     */
    public function testSetSlipPositionSecondParameterInvalid()
    {
        $this->paymentSlip->setSlipPosition(150, 'B');
    }

    /**
     * Tests setting the slip size
     *
     * @return void
     * @covers ::setSlipSize
     * @covers ::setSlipWidth
     * @covers ::setSlipHeight
     * @covers ::getSlipWidth
     * @covers ::getSlipHeight
     */
    public function testSetSlipSize()
    {
        // Test the default values
        $this->assertEquals(210, $this->paymentSlip->getSlipWidth());
        $this->assertEquals(106, $this->paymentSlip->getSlipHeight());

        $returned = $this->paymentSlip->setSlipSize(250, 150);
        $this->assertInstanceOf('SwissPaymentSlip\SwissPaymentSlip\Tests\TestablePaymentSlip', $returned);
        $this->assertEquals(250, $this->paymentSlip->getSlipWidth());
        $this->assertEquals(150, $this->paymentSlip->getSlipHeight());
    }

    /**
     * Tests the setSlipSize method with an invalid first parameter
     *
     * @return void
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $slipWidth is neither an integer nor a float.
     * @covers ::setSlipSize
     * @covers ::isIntOrFloat
     */
    public function testSetSlipSizeFirstParameterInvalid()
    {
        $this->paymentSlip->setSlipSize('A', 150);
    }

    /**
     * Tests the setSlipSize method with an invalid second parameter
     *
     * @return void
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $slipHeight is neither an integer nor a float.
     * @covers ::setSlipSize
     * @covers ::isIntOrFloat
     */
    public function testSetSlipSizeSecondParameterInvalid()
    {
        $this->paymentSlip->setSlipSize(150, 'B');
    }

    /**
     * Tests setting the slip background
     *
     * @return void
     * @covers ::setSlipBackground
     * @covers ::getSlipBackground
     */
    public function testSetSlipBackground()
    {
        // Test with a RGB code
        $returned = $this->paymentSlip->setSlipBackground('#123456');
        $this->assertInstanceOf('SwissPaymentSlip\SwissPaymentSlip\Tests\TestablePaymentSlip', $returned);
        $this->assertEquals('#123456', $this->paymentSlip->getSlipBackground());

        // Test with an image
        $this->paymentSlip->setSlipBackground(__DIR__.'/Resources/img/ezs_orange.gif');
        $this->assertEquals(__DIR__.'/Resources/img/ezs_orange.gif', $this->paymentSlip->getSlipBackground());
    }

    /**
     * Tests the default attributes of the left bank element
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
     * Tests the default attributes of the right bank element
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
     * Tests the default attributes of the left recipient element
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
     * Tests the default attributes of the right recipient element
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
     * Tests the default attributes of the left account element
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
     * Tests the default attributes of the right account element
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
     * Tests the default attributes of the left francs amount element
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
     * Tests the default attributes of the right francs amount element
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
     * Tests the default attributes of the left cents amount element
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
     * Tests the default attributes of the right cents amount element
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
     * Tests the default attributes of the left payer element
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
     * Tests the default attributes of the right payer element
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
     * Tests the default background
     *
     * @return void
     * @covers ::setDefaults
     */
    public function testSlipBackgroundDefaultValues()
    {
        $this->assertEquals(null, basename($this->paymentSlip->getSlipBackground()));
    }

    /**
     * Tests the setBankLeftAttr method
     *
     * @return void
     * @covers ::setBankLeftAttr
     * @covers ::setAttributes
     * @covers ::getBankLeftAttr
     */
    public function testSetBankLeftAttr()
    {
        $returned = $this->paymentSlip->setBankLeftAttr(123, 456, 987, 654, '#123456', 'Courier', '1', '#654321', '15', 'C');
        $this->assertInstanceOf('SwissPaymentSlip\SwissPaymentSlip\Tests\TestablePaymentSlip', $returned);
        $this->assertEquals($this->setAttributes, $this->paymentSlip->getBankLeftAttr());
    }

    /**
     * Tests the setBankRightAttr method
     *
     * @return void
     * @covers ::setBankRightAttr
     * @covers ::setAttributes
     * @covers ::getBankRightAttr
     */
    public function testSetBankRightAttr()
    {
        $returned = $this->paymentSlip->setBankRightAttr(123, 456, 987, 654, '#123456', 'Courier', '1', '#654321', '15', 'C');
        $this->assertInstanceOf('SwissPaymentSlip\SwissPaymentSlip\Tests\TestablePaymentSlip', $returned);
        $this->assertEquals($this->setAttributes, $this->paymentSlip->getBankRightAttr());
    }

    /**
     * Tests the setRecipientLeftAttr method
     *
     * @return void
     * @covers ::setRecipientLeftAttr
     * @covers ::setAttributes
     * @covers ::getRecipientLeftAttr
     */
    public function testSetRecipientLeftAttr()
    {
        $returned = $this->paymentSlip->setRecipientLeftAttr(123, 456, 987, 654, '#123456', 'Courier', '1', '#654321', '15', 'C');
        $this->assertInstanceOf('SwissPaymentSlip\SwissPaymentSlip\Tests\TestablePaymentSlip', $returned);
        $this->assertEquals($this->setAttributes, $this->paymentSlip->getRecipientLeftAttr());
    }

    /**
     * Tests the setRecipientRightAttr method
     *
     * @return void
     * @covers ::setRecipientRightAttr
     * @covers ::setAttributes
     * @covers ::getRecipientRightAttr
     */
    public function testSetRecipientRightAttr()
    {
        $returned = $this->paymentSlip->setRecipientRightAttr(123, 456, 987, 654, '#123456', 'Courier', '1', '#654321', '15', 'C');
        $this->assertInstanceOf('SwissPaymentSlip\SwissPaymentSlip\Tests\TestablePaymentSlip', $returned);
        $this->assertEquals($this->setAttributes, $this->paymentSlip->getRecipientRightAttr());
    }

    /**
     * Tests the setAccountLeftAttr method
     *
     * @return void
     * @covers ::setAccountLeftAttr
     * @covers ::setAttributes
     * @covers ::getAccountLeftAttr
     */
    public function testSetAccountLeftAttr()
    {
        $returned = $this->paymentSlip->setAccountLeftAttr(123, 456, 987, 654, '#123456', 'Courier', '1', '#654321', '15', 'C');
        $this->assertInstanceOf('SwissPaymentSlip\SwissPaymentSlip\Tests\TestablePaymentSlip', $returned);
        $this->assertEquals($this->setAttributes, $this->paymentSlip->getAccountLeftAttr());
    }

    /**
     * Tests the setAccountRightAttr method
     *
     * @return void
     * @covers ::setAccountRightAttr
     * @covers ::setAttributes
     * @covers ::getAccountRightAttr
     */
    public function testSetAccountRightAttr()
    {
        $returned = $this->paymentSlip->setAccountRightAttr(123, 456, 987, 654, '#123456', 'Courier', '1', '#654321', '15', 'C');
        $this->assertInstanceOf('SwissPaymentSlip\SwissPaymentSlip\Tests\TestablePaymentSlip', $returned);
        $this->assertEquals($this->setAttributes, $this->paymentSlip->getAccountRightAttr());
    }

    /**
     * Tests the setAmountFrancsLeftAttr method
     *
     * @return void
     * @covers ::setAmountFrancsLeftAttr
     * @covers ::setAttributes
     * @covers ::getAmountFrancsLeftAttr
     */
    public function testSetAmountFrancsLeftAttr()
    {
        $returned = $this->paymentSlip->setAmountFrancsLeftAttr(123, 456, 987, 654, '#123456', 'Courier', '1', '#654321', '15', 'C');
        $this->assertInstanceOf('SwissPaymentSlip\SwissPaymentSlip\Tests\TestablePaymentSlip', $returned);
        $this->assertEquals($this->setAttributes, $this->paymentSlip->getAmountFrancsLeftAttr());
    }

    /**
     * Tests the setAmountCentsLeftAttr method
     *
     * @return void
     * @covers ::setAmountCentsLeftAttr
     * @covers ::setAttributes
     * @covers ::getAmountCentsLeftAttr
     */
    public function testSetAmountCentsLeftAttr()
    {
        $returned = $this->paymentSlip->setAmountCentsLeftAttr(123, 456, 987, 654, '#123456', 'Courier', '1', '#654321', '15', 'C');
        $this->assertInstanceOf('SwissPaymentSlip\SwissPaymentSlip\Tests\TestablePaymentSlip', $returned);
        $this->assertEquals($this->setAttributes, $this->paymentSlip->getAmountCentsLeftAttr());
    }

    /**
     * Tests the setAmountCentsRightAttr method
     *
     * @return void
     * @covers ::setAmountCentsRightAttr
     * @covers ::setAttributes
     * @covers ::getAmountCentsRightAttr
     */
    public function testSetAmountCentsRightAttr()
    {
        $returned = $this->paymentSlip->setAmountCentsRightAttr(123, 456, 987, 654, '#123456', 'Courier', '1', '#654321', '15', 'C');
        $this->assertInstanceOf('SwissPaymentSlip\SwissPaymentSlip\Tests\TestablePaymentSlip', $returned);
        $this->assertEquals($this->setAttributes, $this->paymentSlip->getAmountCentsRightAttr());
    }

    /**
     * Tests the setAmountFrancsRightAttr method
     *
     * @return void
     * @covers ::setAmountFrancsRightAttr
     * @covers ::setAttributes
     * @covers ::getAmountFrancsRightAttr
     */
    public function testSetAmountFrancsRightAttr()
    {
        $returned = $this->paymentSlip->setAmountFrancsRightAttr(123, 456, 987, 654, '#123456', 'Courier', '1', '#654321', '15', 'C');
        $this->assertInstanceOf('SwissPaymentSlip\SwissPaymentSlip\Tests\TestablePaymentSlip', $returned);
        $this->assertEquals($this->setAttributes, $this->paymentSlip->getAmountFrancsRightAttr());
    }

    /**
     * Tests the setPayerLeftAttr method
     *
     * @return void
     * @covers ::setPayerLeftAttr
     * @covers ::setAttributes
     * @covers ::getPayerLeftAttr
     */
    public function testSetPayerLeftAttr()
    {
        $returned = $this->paymentSlip->setPayerLeftAttr(123, 456, 987, 654, '#123456', 'Courier', '1', '#654321', '15', 'C');
        $this->assertInstanceOf('SwissPaymentSlip\SwissPaymentSlip\Tests\TestablePaymentSlip', $returned);
        $this->assertEquals($this->setAttributes, $this->paymentSlip->getPayerLeftAttr());
    }

    /**
     * Tests the setPayerRightAttr method
     *
     * @return void
     * @covers ::setPayerRightAttr
     * @covers ::setAttributes
     * @covers ::getPayerRightAttr
     */
    public function testSetPayerRightAttr()
    {
        $returned = $this->paymentSlip->setPayerRightAttr(123, 456, 987, 654, '#123456', 'Courier', '1', '#654321', '15', 'C');
        $this->assertInstanceOf('SwissPaymentSlip\SwissPaymentSlip\Tests\TestablePaymentSlip', $returned);
        $this->assertEquals($this->setAttributes, $this->paymentSlip->getPayerRightAttr());
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
        $this->assertInstanceOf('SwissPaymentSlip\SwissPaymentSlip\Tests\TestablePaymentSlip', $returned);
        $this->assertEquals($this->setAttributes, $this->paymentSlip->getCodeLineAttr());
    }

    /**
     * Tests the setDisplayBank method
     *
     * @return void
     * @covers ::setDisplayBank
     * @covers ::getDisplayBank
     * @covers ::isBool
     */
    public function testSetDisplayBank()
    {
        // Test the default value
        $this->assertTrue($this->paymentSlip->getDisplayBank());

        // Disable feature, also check for returned instance
        $returned = $this->paymentSlip->setDisplayBank(false);
        $this->assertInstanceOf('SwissPaymentSlip\SwissPaymentSlip\Tests\TestablePaymentSlip', $returned);
        $this->assertFalse($this->paymentSlip->getDisplayBank());

        // Re-enable the feature
        $this->paymentSlip->setDisplayBank();
        $this->assertTrue($this->paymentSlip->getDisplayBank());
    }

    /**
     * Tests the setDisplayBank method with an invalid parameter
     *
     * @return void
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $displayBank is not a boolean.
     * @covers ::setDisplayBank
     * @covers ::isBool
     */
    public function testSetDisplayBankInvalidParameter()
    {
        $this->paymentSlip->setDisplayBank('true');
    }

    /**
     * Tests the setDisplayAccount method
     *
     * @return void
     * @covers ::setDisplayAccount
     * @covers ::getDisplayAccount
     * @covers ::isBool
     */
    public function testSetDisplayAccount()
    {
        // Test the default value
        $this->assertTrue($this->paymentSlip->getDisplayAccount());

        // Disable feature, also check for returned instance
        $returned = $this->paymentSlip->setDisplayAccount(false);
        $this->assertInstanceOf('SwissPaymentSlip\SwissPaymentSlip\Tests\TestablePaymentSlip', $returned);
        $this->assertFalse($this->paymentSlip->getDisplayAccount());

        // Re-enable the feature
        $this->paymentSlip->setDisplayAccount();
        $this->assertTrue($this->paymentSlip->getDisplayAccount());
    }

    /**
     * Tests the setDisplayAccount method with an invalid parameter
     *
     * @return void
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $displayAccount is not a boolean.
     * @covers ::setDisplayAccount
     * @covers ::isBool
     */
    public function testSetDisplayAccountInvalidParameter()
    {
        $this->paymentSlip->setDisplayAccount('true');
    }

    /**
     * Tests the setDisplayRecipient method
     *
     * @return void
     * @covers ::setDisplayRecipient
     * @covers ::getDisplayRecipient
     * @covers ::isBool
     */
    public function testSetDisplayRecipient()
    {
        // Test the default value
        $this->assertTrue($this->paymentSlip->getDisplayRecipient());

        // Disable feature, also check for returned instance
        $returned = $this->paymentSlip->setDisplayRecipient(false);
        $this->assertInstanceOf('SwissPaymentSlip\SwissPaymentSlip\Tests\TestablePaymentSlip', $returned);
        $this->assertFalse($this->paymentSlip->getDisplayRecipient());

        // Re-enable the feature
        $this->paymentSlip->setDisplayRecipient();
        $this->assertTrue($this->paymentSlip->getDisplayRecipient());
    }

    /**
     * Tests the setDisplayRecipient method with an invalid parameter
     *
     * @return void
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $displayRecipient is not a boolean.
     * @covers ::setDisplayRecipient
     * @covers ::isBool
     */
    public function testSetDisplayRecipientInvalidParameter()
    {
        $this->paymentSlip->setDisplayRecipient('true');
    }

    /**
     * Tests the setDisplayAmount method
     *
     * @return void
     * @covers ::setDisplayAmount
     * @covers ::getDisplayAmount
     * @covers ::isBool
     */
    public function testSetDisplayAmount()
    {
        // Test the default value
        $this->assertTrue($this->paymentSlip->getDisplayAmount());

        // Disable feature, also check for returned instance
        $returned = $this->paymentSlip->setDisplayAmount(false);
        $this->assertInstanceOf('SwissPaymentSlip\SwissPaymentSlip\Tests\TestablePaymentSlip', $returned);
        $this->assertFalse($this->paymentSlip->getDisplayAmount());

        // Re-enable the feature
        $this->paymentSlip->setDisplayAmount();
        $this->assertTrue($this->paymentSlip->getDisplayAmount());
    }

    /**
     * Tests the setDisplayAmount method with an invalid parameter
     *
     * @return void
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $displayAmount is not a boolean.
     * @covers ::setDisplayAmount
     * @covers ::isBool
     */
    public function testSetDisplayAmountInvalidParameter()
    {
        $this->paymentSlip->setDisplayAmount('true');
    }

    /**
     * Tests the setDisplayPayer method
     *
     * @return void
     * @covers ::setDisplayPayer
     * @covers ::getDisplayPayer
     * @covers ::isBool
     */
    public function testSetDisplayPayer()
    {
        // Test the default value
        $this->assertTrue($this->paymentSlip->getDisplayPayer());

        // Disable feature, also check for returned instance
        $returned = $this->paymentSlip->setDisplayPayer(false);
        $this->assertInstanceOf('SwissPaymentSlip\SwissPaymentSlip\Tests\TestablePaymentSlip', $returned);
        $this->assertFalse($this->paymentSlip->getDisplayPayer());

        // Re-enable the feature
        $this->paymentSlip->setDisplayPayer();
        $this->assertTrue($this->paymentSlip->getDisplayPayer());
    }

    /**
     * Tests the setDisplayPayer method with an invalid parameter
     *
     * @return void
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $displayPayer is not a boolean.
     * @covers ::setDisplayPayer
     * @covers ::isBool
     */
    public function testSetDisplayPayerInvalidParameter()
    {
        $this->paymentSlip->setDisplayPayer('true');
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
        $this->assertInstanceOf('SwissPaymentSlip\SwissPaymentSlip\Tests\TestablePaymentSlip', $returned);
        $this->assertFalse($this->paymentSlip->getDisplayCodeLine());

        // Re-enable the feature
        $this->paymentSlip->setDisplayCodeLine();
        $this->assertTrue($this->paymentSlip->getDisplayCodeLine());
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
            'payerLeft',
            'payerRight',
            'codeLine'
        );

        $this->assertElementsArray($expectedElements, $elements);
    }
}
