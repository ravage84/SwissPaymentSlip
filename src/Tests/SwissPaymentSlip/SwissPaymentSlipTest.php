<?php
namespace SwissPaymentSlip\SwissPaymentSlip\Tests\SwissPaymentSlip;

use SwissPaymentSlip\SwissPaymentSlip\SwissPaymentSlip;
use SwissPaymentSlip\SwissPaymentSlip\SwissPaymentSlipData;

require __DIR__.'/../../../vendor/autoload.php';

/**
 * Tests for the SwissPaymentSlip class
 *
 * @coversDefaultClass SwissPaymentSlip\SwissPaymentSlip\SwissPaymentSlip
 */
class SwissPaymentSlipTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var SwissPaymentSlip
     */
    protected $object;

    /**
     * @var array
     */
    protected $defaultAttributes;

    /**
     * @var array
     */
    protected $setAttributes;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     *
     * @return void
     */
    protected function setUp()
    {
        $slipData = new SwissPaymentSlipData();
        $this->object = new SwissPaymentSlip($slipData);

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
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     *
     * @return void
     */
    protected function tearDown()
    {
    }

    /**
     *
     * @return void
     * @covers ::__construct
     */
    public function testIsInstanceOf()
    {
        $this->assertInstanceOf(
            'SwissPaymentSlip\SwissPaymentSlip\SwissPaymentSlip',
            new SwissPaymentSlip(new SwissPaymentSlipData())
        );
        $this->assertInstanceOf(
            'SwissPaymentSlip\SwissPaymentSlip\SwissPaymentSlip',
            new SwissPaymentSlip(new SwissPaymentSlipData(), 100)
        );
        $this->assertInstanceOf(
            'SwissPaymentSlip\SwissPaymentSlip\SwissPaymentSlip',
            new SwissPaymentSlip(new SwissPaymentSlipData(), 100, 100)
        );
    }

    /**
     *
     * @return void
     * @covers ::__construct
     * @expectedException \PHPUnit_Framework_Error
     * @expectedExceptionMessage Argument 1 passed to SwissPaymentSlip\SwissPaymentSlip\SwissPaymentSlip::__construct() must be an instance of SwissPaymentSlip\SwissPaymentSlip\SwissPaymentSlipData, null given
     */
    public function testNullSlipDataParameter()
    {
        new SwissPaymentSlip(null);
    }

    /**
     *
     * @return void
     * @covers ::__construct
     * @expectedException \PHPUnit_Framework_Error
     * @expectedExceptionMessage Argument 1 passed to SwissPaymentSlip\SwissPaymentSlip\SwissPaymentSlip::__construct() must be an instance of SwissPaymentSlip\SwissPaymentSlip\SwissPaymentSlipData, instance of ArrayObject given
     */
    public function testInvalidSlipDataParameter()
    {
        new SwissPaymentSlip(new \ArrayObject());
    }

    /**
     *
     * @return void
     * @covers ::getPaymentSlipData
     */
    public function testGetPaymentSlipDataIsInstanceOf()
    {
        $this->assertInstanceOf(
            'SwissPaymentSlip\SwissPaymentSlip\SwissPaymentSlipData',
            $this->object->getPaymentSlipData()
        );
    }

    /**
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
        $this->assertTrue($this->object->setSlipPosition(200, 100));
        $this->assertEquals(200, $this->object->getSlipPosX());
        $this->assertEquals(100, $this->object->getSlipPosY());

        $this->assertFalse($this->object->setSlipPosition('A', 100));
        $this->assertEquals(200, $this->object->getSlipPosX());
        $this->assertEquals(100, $this->object->getSlipPosY());

        $this->assertFalse($this->object->setSlipPosition(200, 'B'));
        $this->assertEquals(200, $this->object->getSlipPosX());
        $this->assertEquals(100, $this->object->getSlipPosY());
    }

    /**
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
        $this->assertTrue($this->object->setSlipSize(200, 100));
        $this->assertEquals(200, $this->object->getSlipWidth());
        $this->assertEquals(100, $this->object->getSlipHeight());

        $this->assertFalse($this->object->setSlipSize('A', 100));
        $this->assertEquals(200, $this->object->getSlipWidth());
        $this->assertEquals(100, $this->object->getSlipHeight());

        $this->assertFalse($this->object->setSlipSize(200, 'B'));
        $this->assertEquals(200, $this->object->getSlipWidth());
        $this->assertEquals(100, $this->object->getSlipHeight());
    }

    /**
     *
     * @return void
     * @covers ::setSlipBackground
     * @covers ::getSlipBackground
     */
    public function testSetSlipBackground()
    {
        $this->assertTrue($this->object->setSlipBackground('#123456'));
        $this->assertEquals('#123456', $this->object->getSlipBackground());

        $this->assertTrue($this->object->setSlipBackground(__DIR__.'/Resources/img/ezs_orange.gif'));
        $this->assertEquals(__DIR__.'/Resources/img/ezs_orange.gif', $this->object->getSlipBackground());
    }

    /**
     *
     * @return void
     * @covers ::setDefaults
     */
    public function testBankLeftAttrDefaultValuesOrangeType()
    {
        $attributes = $this->object->getBankLeftAttr();

        $expectedAttributes = $this->defaultAttributes;

        $expectedAttributes['PosX'] = 3;
        $expectedAttributes['PosY'] = 8;
        $expectedAttributes['Width'] = 50;
        $expectedAttributes['Height'] = 4;

        $this->assertEquals($expectedAttributes, $attributes);
    }

    /**
     *
     * @return void
     * @covers ::setDefaults
     */
    public function testBankRightAttrDefaultValuesOrangeType()
    {
        $attributes = $this->object->getBankRightAttr();

        $expectedAttributes = $this->defaultAttributes;

        $expectedAttributes['PosX'] = 66;
        $expectedAttributes['PosY'] = 8;
        $expectedAttributes['Width'] = 50;
        $expectedAttributes['Height'] = 4;

        $this->assertEquals($expectedAttributes, $attributes);
    }

    /**
     *
     * @return void
     * @covers ::setDefaults
     */
    public function testRecipientLeftAttrDefaultValuesOrangeType()
    {
        $attributes = $this->object->getRecipientLeftAttr();

        $expectedAttributes = $this->defaultAttributes;

        $expectedAttributes['PosX'] = 3;
        $expectedAttributes['PosY'] = 23;
        $expectedAttributes['Width'] = 50;
        $expectedAttributes['Height'] = 4;

        $this->assertEquals($expectedAttributes, $attributes);
    }

    /**
     *
     * @return void
     * @covers ::setDefaults
     */
    public function testRecipientRightAttrDefaultValuesOrangeType()
    {
        $attributes = $this->object->getRecipientRightAttr();

        $expectedAttributes = $this->defaultAttributes;

        $expectedAttributes['PosX'] = 66;
        $expectedAttributes['PosY'] = 23;
        $expectedAttributes['Width'] = 50;
        $expectedAttributes['Height'] = 4;

        $this->assertEquals($expectedAttributes, $attributes);
    }

    /**
     *
     * @return void
     * @covers ::setDefaults
     */
    public function testAccountLeftAttrDefaultValuesOrangeType()
    {
        $attributes = $this->object->getAccountLeftAttr();

        $expectedAttributes = $this->defaultAttributes;

        $expectedAttributes['PosX'] = 27;
        $expectedAttributes['PosY'] = 43;
        $expectedAttributes['Width'] = 30;
        $expectedAttributes['Height'] = 4;

        $this->assertEquals($expectedAttributes, $attributes);
    }

    /**
     *
     * @return void
     * @covers ::setDefaults
     */
    public function testAccountRightAttrDefaultValuesOrangeType()
    {
        $attributes = $this->object->getAccountRightAttr();

        $expectedAttributes = $this->defaultAttributes;

        $expectedAttributes['PosX'] = 90;
        $expectedAttributes['PosY'] = 43;
        $expectedAttributes['Width'] = 30;
        $expectedAttributes['Height'] = 4;

        $this->assertEquals($expectedAttributes, $attributes);
    }

    /**
     *
     * @return void
     * @covers ::setDefaults
     */
    public function testAmountFrancsLeftAttrDefaultValuesOrangeType()
    {
        $attributes = $this->object->getAmountFrancsLeftAttr();

        $expectedAttributes = $this->defaultAttributes;

        $expectedAttributes['PosX'] = 5;
        $expectedAttributes['PosY'] = 50.5;
        $expectedAttributes['Width'] = 35;
        $expectedAttributes['Height'] = 4;
        $expectedAttributes['TextAlign'] = 'R';

        $this->assertEquals($expectedAttributes, $attributes);
    }

    /**
     *
     * @return void
     * @covers ::setDefaults
     */
    public function testAmountFrancsRightAttrDefaultValuesOrangeType()
    {
        $attributes = $this->object->getAmountFrancsRightAttr();

        $expectedAttributes = $this->defaultAttributes;

        $expectedAttributes['PosX'] = 66;
        $expectedAttributes['PosY'] = 50.5;
        $expectedAttributes['Width'] = 35;
        $expectedAttributes['Height'] = 4;
        $expectedAttributes['TextAlign'] = 'R';

        $this->assertEquals($expectedAttributes, $attributes);
    }

    /**
     *
     * @return void
     * @covers ::setDefaults
     */
    public function testAmountCentsLeftAttrDefaultValuesOrangeType()
    {
        $attributes = $this->object->getAmountCentsLeftAttr();

        $expectedAttributes = $this->defaultAttributes;

        $expectedAttributes['PosX'] = 50;
        $expectedAttributes['PosY'] = 50.5;
        $expectedAttributes['Width'] = 6;
        $expectedAttributes['Height'] = 4;

        $this->assertEquals($expectedAttributes, $attributes);
    }

    /**
     *
     * @return void
     * @covers ::setDefaults
     */
    public function testAmountCentsRightAttrDefaultValuesOrangeType()
    {
        $attributes = $this->object->getAmountCentsRightAttr();

        $expectedAttributes = $this->defaultAttributes;

        $expectedAttributes['PosX'] = 111;
        $expectedAttributes['PosY'] = 50.5;
        $expectedAttributes['Width'] = 6;
        $expectedAttributes['Height'] = 4;

        $this->assertEquals($expectedAttributes, $attributes);
    }

    /**
     *
     * @return void
     * @covers ::setDefaults
     */
    public function testReferenceNumberLeftAttrDefaultValuesOrangeType()
    {
        $attributes = $this->object->getReferenceNumberLeftAttr();

        $expectedAttributes = $this->defaultAttributes;

        $expectedAttributes['PosX'] = 3;
        $expectedAttributes['PosY'] = 60;
        $expectedAttributes['Width'] = 50;
        $expectedAttributes['Height'] = 4;
        $expectedAttributes['FontSize'] = 8;

        $this->assertEquals($expectedAttributes, $attributes);
    }

    /**
     *
     * @return void
     * @covers ::setDefaults
     */
    public function testReferenceNumberRightAttrDefaultValuesOrangeType()
    {
        $attributes = $this->object->getReferenceNumberRightAttr();

        $expectedAttributes = $this->defaultAttributes;

        $expectedAttributes['PosX'] = 125;
        $expectedAttributes['PosY'] = 33.5;
        $expectedAttributes['Width'] = 80;
        $expectedAttributes['Height'] = 4;
        $expectedAttributes['TextAlign'] = 'R';

        $this->assertEquals($expectedAttributes, $attributes);
    }

    /**
     *
     * @return void
     * @covers ::setDefaults
     */
    public function testPayerLeftAttrDefaultValuesOrangeType()
    {
        $attributes = $this->object->getPayerLeftAttr();

        $expectedAttributes = $this->defaultAttributes;

        $expectedAttributes['PosX'] = 3;
        $expectedAttributes['PosY'] = 65;
        $expectedAttributes['Width'] = 50;
        $expectedAttributes['Height'] = 4;

        $this->assertEquals($expectedAttributes, $attributes);
    }

    /**
     *
     * @return void
     * @covers ::setDefaults
     */
    public function testPayerRightAttrDefaultValuesOrangeType()
    {
        $attributes = $this->object->getPayerRightAttr();

        $expectedAttributes = $this->defaultAttributes;

        $expectedAttributes['PosX'] = 125;
        $expectedAttributes['PosY'] = 48;
        $expectedAttributes['Width'] = 50;
        $expectedAttributes['Height'] = 4;

        $this->assertEquals($expectedAttributes, $attributes);
    }

    /**
     *
     * @return void
     * @covers ::setDefaults
     */
    public function testCodeLineAttrDefaultValuesOrangeType()
    {
        $attributes = $this->object->getCodeLineAttr();

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
     *
     * @return void
     * @covers ::setDefaults
     */
    public function testSlipBackgroundDefaultValuesOrangeType()
    {
        $this->assertEquals('ezs_orange.gif', basename($this->object->getSlipBackground()));
    }

    /**
     *
     * @return void
     * @covers ::setDefaults
     * @todo Implement testBankLeftAttrDefaultValuesRedType
     */
    public function testBankLeftAttrDefaultValuesRedType()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     *
     * @return void
     * @covers ::setDefaults
     * @todo Implement testBankRightAttrDefaultValuesRedType
     */
    public function testBankRightAttrDefaultValuesRedType()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     *
     * @return void
     * @covers ::setDefaults
     * @todo Implement testRecipientLeftAttrDefaultValuesRedType
     */
    public function testRecipientLeftAttrDefaultValuesRedType()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     *
     * @return void
     * @covers ::setDefaults
     * @todo Implement testRecipientRightAttrDefaultValuesRedType
     */
    public function testRecipientRightAttrDefaultValuesRedType()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     *
     * @return void
     * @covers ::setDefaults
     * @todo Implement testAccountLeftAttrDefaultValuesRedType
     */
    public function testAccountLeftAttrDefaultValuesRedType()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     *
     * @return void
     * @covers ::setDefaults
     * @todo Implement testAccountRightAttrDefaultValuesRedType
     */
    public function testAccountRightAttrDefaultValuesRedType()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     *
     * @return void
     * @covers ::setDefaults
     * @todo Implement testAmountFrancsLeftAttrDefaultValuesRedType
     */
    public function testAmountFrancsLeftAttrDefaultValuesRedType()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     *
     * @return void
     * @covers ::setDefaults
     * @todo Implement testAmountFrancsRightAttrDefaultValuesRedType
     */
    public function testAmountFrancsRightAttrDefaultValuesRedType()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     *
     * @return void
     * @covers ::setDefaults
     * @todo Implement testAmountCentsLeftAttrDefaultValuesRedType
     */
    public function testAmountCentsLeftAttrDefaultValuesRedType()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     *
     * @return void
     * @covers ::setDefaults
     * @todo Implement testAmountCentsRightAttrDefaultValuesRedType
     */
    public function testAmountCentsRightAttrDefaultValuesRedType()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     *
     * @return void
     * @covers ::setDefaults
     * @todo Implement testReferenceNumberLeftAttrDefaultValuesRedType
     */
    public function testReferenceNumberLeftAttrDefaultValuesRedType()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     *
     * @return void
     * @covers ::setDefaults
     * @todo Implement testReferenceNumberRightAttrDefaultValuesRedType
     */
    public function testReferenceNumberRightAttrDefaultValuesRedType()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     *
     * @return void
     * @covers ::setDefaults
     * @todo Implement testPayerLeftAttrDefaultValuesRedType
     */
    public function testPayerLeftAttrDefaultValuesRedType()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     *
     * @return void
     * @covers ::setDefaults
     * @todo Implement testPayerRightAttrDefaultValuesRedType
     */
    public function testPayerRightAttrDefaultValuesRedType()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     *
     * @return void
     * @covers ::setDefaults
     * @todo Implement testCodeLineAttrDefaultValuesRedType
     */
    public function testCodeLineAttrDefaultValuesRedType()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     *
     * @return void
     * @covers ::setDefaults
     */
    public function testSlipBackgroundDefaultValuesRedType()
    {
        $slipData = new SwissPaymentSlipData('red');
        $this->object = new SwissPaymentSlip($slipData);

        $this->assertEquals('ezs_red.gif', basename($this->object->getSlipBackground()));
    }

    /**
     *
     * @return void
     * @covers ::setBankLeftAttr
     * @covers ::setAttributes
     * @covers ::getBankLeftAttr
     */
    public function testSetBankLeftAttr()
    {
        $this->assertTrue($this->object->setBankLeftAttr(123, 456, 987, 654, '#123456', 'Courier', '1', '#654321', '15', 'C'));
        $this->assertEquals($this->setAttributes, $this->object->getBankLeftAttr());
    }

    /**
     *
     * @return void
     * @covers ::setBankRightAttr
     * @covers ::setAttributes
     * @covers ::getBankRightAttr
     */
    public function testSetBankRightAttr()
    {
        $this->assertTrue($this->object->setBankRightAttr(123, 456, 987, 654, '#123456', 'Courier', '1', '#654321', '15', 'C'));
        $this->assertEquals($this->setAttributes, $this->object->getBankRightAttr());
    }

    /**
     *
     * @return void
     * @covers ::setRecipientLeftAttr
     * @covers ::setAttributes
     * @covers ::getRecipientLeftAttr
     */
    public function testSetRecipientLeftAttr()
    {
        $this->assertTrue($this->object->setRecipientLeftAttr(123, 456, 987, 654, '#123456', 'Courier', '1', '#654321', '15', 'C'));
        $this->assertEquals($this->setAttributes, $this->object->getRecipientLeftAttr());
    }

    /**
     *
     * @return void
     * @covers ::setRecipientRightAttr
     * @covers ::setAttributes
     * @covers ::getRecipientRightAttr
     */
    public function testSetRecipientRightAttr()
    {
        $this->assertTrue($this->object->setRecipientRightAttr(123, 456, 987, 654, '#123456', 'Courier', '1', '#654321', '15', 'C'));
        $this->assertEquals($this->setAttributes, $this->object->getRecipientRightAttr());
    }

    /**
     *
     * @return void
     * @covers ::setAccountLeftAttr
     * @covers ::setAttributes
     * @covers ::getAccountLeftAttr
     */
    public function testSetAccountLeftAttr()
    {
        $this->assertTrue($this->object->setAccountLeftAttr(123, 456, 987, 654, '#123456', 'Courier', '1', '#654321', '15', 'C'));
        $this->assertEquals($this->setAttributes, $this->object->getAccountLeftAttr());
    }

    /**
     *
     * @return void
     * @covers ::setAccountRightAttr
     * @covers ::setAttributes
     * @covers ::getAccountRightAttr
     */
    public function testSetAccountRightAttr()
    {
        $this->assertTrue($this->object->setAccountRightAttr(123, 456, 987, 654, '#123456', 'Courier', '1', '#654321', '15', 'C'));
        $this->assertEquals($this->setAttributes, $this->object->getAccountRightAttr());
    }

    /**
     *
     * @return void
     * @covers ::setAmountFrancsLeftAttr
     * @covers ::setAttributes
     * @covers ::getAmountFrancsLeftAttr
     */
    public function testSetAmountFrancsLeftAttr()
    {
        $this->assertTrue($this->object->setAmountFrancsLeftAttr(123, 456, 987, 654, '#123456', 'Courier', '1', '#654321', '15', 'C'));
        $this->assertEquals($this->setAttributes, $this->object->getAmountFrancsLeftAttr());
    }

    /**
     *
     * @return void
     * @covers ::setAmountCentsLeftAttr
     * @covers ::setAttributes
     * @covers ::getAmountCentsLeftAttr
     */
    public function testSetAmountCentsLeftAttr()
    {
        $this->assertTrue($this->object->setAmountCentsLeftAttr(123, 456, 987, 654, '#123456', 'Courier', '1', '#654321', '15', 'C'));
        $this->assertEquals($this->setAttributes, $this->object->getAmountCentsLeftAttr());
    }

    /**
     *
     * @return void
     * @covers ::setAmountCentsRightAttr
     * @covers ::setAttributes
     * @covers ::getAmountCentsRightAttr
     */
    public function testSetAmountCentsRightAttr()
    {
        $this->assertTrue($this->object->setAmountCentsRightAttr(123, 456, 987, 654, '#123456', 'Courier', '1', '#654321', '15', 'C'));
        $this->assertEquals($this->setAttributes, $this->object->getAmountCentsRightAttr());
    }

    /**
     *
     * @return void
     * @covers ::setAmountFrancsRightAttr
     * @covers ::setAttributes
     * @covers ::getAmountFrancsRightAttr
     */
    public function testSetAmountFrancsRightAttr()
    {
        $this->assertTrue($this->object->setAmountFrancsRightAttr(123, 456, 987, 654, '#123456', 'Courier', '1', '#654321', '15', 'C'));
        $this->assertEquals($this->setAttributes, $this->object->getAmountFrancsRightAttr());
    }

    /**
     *
     * @return void
     * @covers ::setReferenceNumberLeftAttr
     * @covers ::setAttributes
     * @covers ::getReferenceNumberLeftAttr
     */
    public function testSetReferenceNumberLeftAttr()
    {
        $this->assertTrue($this->object->setReferenceNumberLeftAttr(123, 456, 987, 654, '#123456', 'Courier', '1', '#654321', '15', 'C'));
        $this->assertEquals($this->setAttributes, $this->object->getReferenceNumberLeftAttr());
    }

    /**
     *
     * @return void
     * @covers ::setReferenceNumberRightAttr
     * @covers ::setAttributes
     * @covers ::getReferenceNumberRightAttr
     */
    public function testSetReferenceNumberRightAttr()
    {
        $this->assertTrue($this->object->setReferenceNumberRightAttr(123, 456, 987, 654, '#123456', 'Courier', '1', '#654321', '15', 'C'));
        $this->assertEquals($this->setAttributes, $this->object->getReferenceNumberRightAttr());
    }

    /**
     *
     * @return void
     * @covers ::setPayerLeftAttr
     * @covers ::setAttributes
     * @covers ::getPayerLeftAttr
     */
    public function testSetPayerLeftAttr()
    {
        $this->assertTrue($this->object->setPayerLeftAttr(123, 456, 987, 654, '#123456', 'Courier', '1', '#654321', '15', 'C'));
        $this->assertEquals($this->setAttributes, $this->object->getPayerLeftAttr());
    }

    /**
     *
     * @return void
     * @covers ::setPayerRightAttr
     * @covers ::setAttributes
     * @covers ::getPayerRightAttr
     */
    public function testSetPayerRightAttr()
    {
        $this->assertTrue($this->object->setPayerRightAttr(123, 456, 987, 654, '#123456', 'Courier', '1', '#654321', '15', 'C'));
        $this->assertEquals($this->setAttributes, $this->object->getPayerRightAttr());
    }

    /**
     *
     * @return void
     * @covers ::setCodeLineAttr
     * @covers ::setAttributes
     * @covers ::getCodeLineAttr
     */
    public function testSetCodeLineAttr()
    {
        $this->assertTrue($this->object->setCodeLineAttr(123, 456, 987, 654, '#123456', 'Courier', '1', '#654321', '15', 'C'));
        $this->assertEquals($this->setAttributes, $this->object->getCodeLineAttr());
    }

    /**
     *
     * @return void
     * @covers ::setDisplayBank
     * @covers ::getDisplayBank
     */
    public function testSetDisplayBank()
    {
        $this->assertTrue($this->object->setDisplayBank());
        $this->assertEquals(true, $this->object->getDisplayBank());

        $this->assertTrue($this->object->setDisplayBank(true));
        $this->assertEquals(true, $this->object->getDisplayBank());

        $this->assertTrue($this->object->setDisplayBank(false));
        $this->assertEquals(false, $this->object->getDisplayBank());

        $this->assertFalse($this->object->setDisplayBank('XXX'));
    }

    /**
     *
     * @return void
     * @covers ::setDisplayAccount
     * @covers ::getDisplayAccount
     */
    public function testSetDisplayAccount()
    {
        $this->assertTrue($this->object->setDisplayAccount());
        $this->assertEquals(true, $this->object->getDisplayAccount());

        $this->assertTrue($this->object->setDisplayAccount(true));
        $this->assertEquals(true, $this->object->getDisplayAccount());

        $this->assertTrue($this->object->setDisplayAccount(false));
        $this->assertEquals(false, $this->object->getDisplayAccount());

        $this->assertFalse($this->object->setDisplayAccount('XXX'));
    }

    /**
     *
     * @return void
     * @covers ::setDisplayRecipient
     * @covers ::getDisplayRecipient
     */
    public function testSetDisplayRecipient()
    {
        $this->assertTrue($this->object->setDisplayRecipient());
        $this->assertEquals(true, $this->object->getDisplayRecipient());

        $this->assertTrue($this->object->setDisplayRecipient(true));
        $this->assertEquals(true, $this->object->getDisplayRecipient());

        $this->assertTrue($this->object->setDisplayRecipient(false));
        $this->assertEquals(false, $this->object->getDisplayRecipient());

        $this->assertFalse($this->object->setDisplayRecipient('XXX'));
    }

    /**
     *
     * @return void
     * @covers ::setDisplayAmount
     * @covers ::getDisplayAmount
     */
    public function testSetDisplayAmount()
    {
        $this->assertTrue($this->object->setDisplayAmount());
        $this->assertEquals(true, $this->object->getDisplayAmount());

        $this->assertTrue($this->object->setDisplayAmount(true));
        $this->assertEquals(true, $this->object->getDisplayAmount());

        $this->assertTrue($this->object->setDisplayAmount(false));
        $this->assertEquals(false, $this->object->getDisplayAmount());

        $this->assertFalse($this->object->setDisplayAmount('XXX'));
    }

    /**
     *
     * @return void
     * @covers ::setDisplayReferenceNr
     * @covers ::getDisplayReferenceNr
     */
    public function testSetDisplayReferenceNr()
    {
        $this->assertTrue($this->object->setDisplayReferenceNr());
        $this->assertEquals(true, $this->object->getDisplayReferenceNr());

        $this->assertTrue($this->object->setDisplayReferenceNr(true));
        $this->assertEquals(true, $this->object->getDisplayReferenceNr());

        $this->assertTrue($this->object->setDisplayReferenceNr(false));
        $this->assertEquals(false, $this->object->getDisplayReferenceNr());

        $this->assertFalse($this->object->setDisplayReferenceNr('XXX'));
    }

    /**
     *
     * @return void
     * @covers ::setDisplayPayer
     * @covers ::getDisplayPayer
     */
    public function testSetDisplayPayer()
    {
        $this->assertTrue($this->object->setDisplayPayer());
        $this->assertEquals(true, $this->object->getDisplayPayer());

        $this->assertTrue($this->object->setDisplayPayer(true));
        $this->assertEquals(true, $this->object->getDisplayPayer());

        $this->assertTrue($this->object->setDisplayPayer(false));
        $this->assertEquals(false, $this->object->getDisplayPayer());

        $this->assertFalse($this->object->setDisplayPayer('XXX'));
    }

    /**
     *
     * @return void
     * @covers ::setDisplayCodeLine
     * @covers ::getDisplayCodeLine
     */
    public function testSetDisplayCodeLine()
    {
        $this->assertTrue($this->object->setDisplayCodeLine());
        $this->assertEquals(true, $this->object->getDisplayCodeLine());

        $this->assertTrue($this->object->setDisplayCodeLine(true));
        $this->assertEquals(true, $this->object->getDisplayCodeLine());

        $this->assertTrue($this->object->setDisplayCodeLine(false));
        $this->assertEquals(false, $this->object->getDisplayCodeLine());

        $this->assertFalse($this->object->setDisplayCodeLine('XXX'));
    }

    /**
     *
     * @return void
     * @covers ::setDisplayIban
     * @covers ::getDisplayIban
     */
    public function testSetDisplayIban()
    {
        $this->assertTrue($this->object->setDisplayIban());
        $this->assertEquals(true, $this->object->getDisplayIban());

        $this->assertTrue($this->object->setDisplayIban(true));
        $this->assertEquals(true, $this->object->getDisplayIban());

        $this->assertTrue($this->object->setDisplayIban(false));
        $this->assertEquals(false, $this->object->getDisplayIban());

        $this->assertFalse($this->object->setDisplayIban('XXX'));
    }

    /**
     *
     * @return void
     * @covers ::setDisplayPaymentReason
     * @covers ::getDisplayPaymentReason
     */
    public function testSetDisplayPaymentReason()
    {
        $this->assertTrue($this->object->setDisplayPaymentReason());
        $this->assertEquals(true, $this->object->getDisplayPaymentReason());

        $this->assertTrue($this->object->setDisplayPaymentReason(true));
        $this->assertEquals(true, $this->object->getDisplayPaymentReason());

        $this->assertTrue($this->object->setDisplayPaymentReason(false));
        $this->assertEquals(false, $this->object->getDisplayPaymentReason());

        $this->assertFalse($this->object->setDisplayPaymentReason('XXX'));
    }

    /**
     *
     * @return void
     * @covers ::getAllElements
     */
    public function testGetAllElementsOrangeType()
    {
        $elements = $this->object->getAllElements();

        $expectedElementsArray = array(
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

        foreach ($expectedElementsArray as $elementNr => $element) {
            $this->assertArrayHasKey($element, $elements);

            $this->assertArrayHasKey('lines', $elements[$element]);
            $this->assertArrayHasKey('attributes', $elements[$element]);
        }
    }

    /**
     *
     * @return void
     * @covers ::getAllElements
     * @todo Implement testGetAllElementsRedType
     */
    public function testGetAllElementsRedType()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }
}
