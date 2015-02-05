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

namespace SwissPaymentSlip\SwissPaymentSlip\Tests\SwissPaymentSlip;

use SwissPaymentSlip\SwissPaymentSlip\SwissPaymentSlipData;

require __DIR__.'/../../../vendor/autoload.php';

/**
 * Tests for the SwissPaymentSlipData class
 *
 * @coversDefaultClass SwissPaymentSlip\SwissPaymentSlip\SwissPaymentSlipData
 */
class SwissPaymentSlipDataTest extends \PHPUnit_Framework_TestCase
{
    /**
     * The object under test
     *
     * @var SwissPaymentSlipData
     */
    protected $slipData;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     *
     * @return void
     */
    protected function setUp()
    {
        $this->slipData = new SwissPaymentSlipData;
    }

    /**
     *
     * @return void
     * @covers ::__construct
     * @covers ::setType
     * @expectedException \InvalidArgumentException
     */
    public function testConstructorFirstParameterIsEmptyString()
    {
        new SwissPaymentSlipData('');
    }

    /**
     *
     * @return void
     * @covers ::__construct
     * @covers ::setType
     * @expectedException \InvalidArgumentException
     */
    public function testConstructorFirstParameterIsInvalidString()
    {
        new SwissPaymentSlipData('123');
    }

    /**
     *
     * @return void
     * @covers ::__construct
     * @covers ::setType
     * @expectedException \InvalidArgumentException
     */
    public function testConstructorFirstParameterIsArray()
    {
        new SwissPaymentSlipData(array('red'));
    }

    /**
     * Tests the isOrangeSlip method
     *
     * @return void
     * @covers ::isOrangeSlip
     */
    public function testIsOrangeSlip()
    {
        $slipData = new SwissPaymentSlipData('red');
        $this->assertFalse($slipData->isOrangeSlip());

        $slipData = new SwissPaymentSlipData('orange');
        $this->assertTrue($slipData->isOrangeSlip());
    }

    /**
     * Tests the isRedSlip method
     *
     * @return void
     * @covers ::isRedSlip
     */
    public function testIsRedSlip()
    {
        $slipData = new SwissPaymentSlipData('orange');
        $this->assertFalse($slipData->isRedSlip());

        $slipData = new SwissPaymentSlipData('red');
        $this->assertTrue($slipData->isRedSlip());
    }

    /**
     * Tests the setRedDefaults method when setting up an unspecified slip (defaults to orange)
     *
     * @return void
     * @covers ::setRedDefaults
     * @covers ::setType
     * @covers ::getType
     */
    public function testSetTypeNoTypeSpecified()
    {
        $this->assertTrue($this->slipData->setType());
        $this->assertEquals('orange', $this->slipData->getType());

        $this->assertTrue($this->slipData->getWithBank());
        $this->assertTrue($this->slipData->getWithAccountNumber());
        $this->assertTrue($this->slipData->getWithRecipient());
        $this->assertTrue($this->slipData->getWithAmount());
        $this->assertTrue($this->slipData->getWithReferenceNumber());
        $this->assertTrue($this->slipData->getWithBankingCustomerId());
        $this->assertTrue($this->slipData->getWithPayer());
        $this->assertFalse($this->slipData->getWithIban());
        $this->assertFalse($this->slipData->getWithPaymentReason());
    }

    /**
     * Tests the setRedDefaults method when setting up an orange slip
     *
     * @return void
     * @covers ::setRedDefaults
     * @covers ::setType
     * @covers ::getType
     */
    public function testSetTypeOrangeType()
    {
        $this->assertTrue($this->slipData->setType('orange'));
        $this->assertEquals('orange', $this->slipData->getType());

        $this->assertTrue($this->slipData->getWithBank());
        $this->assertTrue($this->slipData->getWithAccountNumber());
        $this->assertTrue($this->slipData->getWithRecipient());
        $this->assertTrue($this->slipData->getWithAmount());
        $this->assertTrue($this->slipData->getWithReferenceNumber());
        $this->assertTrue($this->slipData->getWithBankingCustomerId());
        $this->assertTrue($this->slipData->getWithPayer());
        $this->assertFalse($this->slipData->getWithIban());
        $this->assertFalse($this->slipData->getWithPaymentReason());
    }

    /**
     * Tests the setRedDefaults method when setting up a red slip
     *
     * @return void
     * @covers ::setRedDefaults
     * @covers ::setType
     * @covers ::getType
     */
    public function testSetTypeRedType()
    {
        $this->assertTrue($this->slipData->setType('red'));
        $this->assertEquals('red', $this->slipData->getType());

        $this->assertTrue($this->slipData->getWithBank());
        $this->assertTrue($this->slipData->getWithAccountNumber());
        $this->assertTrue($this->slipData->getWithRecipient());
        $this->assertTrue($this->slipData->getWithAmount());
        $this->assertFalse($this->slipData->getWithReferenceNumber());
        $this->assertFalse($this->slipData->getWithBankingCustomerId());
        $this->assertTrue($this->slipData->getWithPayer());
        $this->assertTrue($this->slipData->getWithIban());
        $this->assertTrue($this->slipData->getWithPaymentReason());
    }

    /**
     *
     * @return void
     * @covers ::setType
     */
    public function testSetTypeOrangeTypeWithoutReset()
    {
        $this->slipData->setWithBank(false);
        $this->slipData->setWithAccountNumber(false);
        $this->slipData->setWithRecipient(false);
        $this->slipData->setWithAmount(false);
        $this->slipData->setWithReferenceNumber(false);
        $this->slipData->setWithBankingCustomerId(false);
        $this->slipData->setWithPayer(false);
        $this->slipData->setWithIban(true); // Shouldn't set to true
        $this->slipData->setWithPaymentReason(true); // Shouldn't set to true

        $this->assertTrue($this->slipData->setType('orange'));

        $this->assertFalse($this->slipData->getWithBank());
        $this->assertFalse($this->slipData->getWithAccountNumber());
        $this->assertFalse($this->slipData->getWithRecipient());
        $this->assertFalse($this->slipData->getWithAmount());
        $this->assertFalse($this->slipData->getWithReferenceNumber());
        $this->assertFalse($this->slipData->getWithBankingCustomerId());
        $this->assertFalse($this->slipData->getWithPayer());
        $this->assertFalse($this->slipData->getWithIban());
        $this->assertFalse($this->slipData->getWithPaymentReason());
    }

    /**
     *
     * @return void
     * @covers ::setType
     */
    public function testSetTypeRedTypeWithoutReset()
    {
        $this->slipData = new SwissPaymentSlipData('red');

        $this->slipData->setWithBank(false);
        $this->slipData->setWithAccountNumber(false);
        $this->slipData->setWithRecipient(false);
        $this->slipData->setWithAmount(false);
        $this->slipData->setWithReferenceNumber(true); // Shouldn't set to true
        $this->slipData->setWithBankingCustomerId(true); // Shouldn't set to true
        $this->slipData->setWithPayer(false);
        $this->slipData->setWithIban(false);
        $this->slipData->setWithPaymentReason(false);

        $this->assertTrue($this->slipData->setType('red'));

        $this->assertFalse($this->slipData->getWithBank());
        $this->assertFalse($this->slipData->getWithAccountNumber());
        $this->assertFalse($this->slipData->getWithRecipient());
        $this->assertFalse($this->slipData->getWithAmount());
        $this->assertFalse($this->slipData->getWithReferenceNumber());
        $this->assertFalse($this->slipData->getWithBankingCustomerId());
        $this->assertFalse($this->slipData->getWithPayer());
        $this->assertFalse($this->slipData->getWithIban());
        $this->assertFalse($this->slipData->getWithPaymentReason());
    }

    /**
     *
     * @return void
     * @covers ::setType
     * @covers ::setOrangeDefaults
     */
    public function testSetTypeOrangeTypeWithReset()
    {
        $this->slipData->setWithBank(false);
        $this->slipData->setWithAccountNumber(false);
        $this->slipData->setWithRecipient(false);
        $this->slipData->setWithAmount(false);
        $this->slipData->setWithReferenceNumber(false);
        $this->slipData->setWithBankingCustomerId(false);
        $this->slipData->setWithPayer(false);
        $this->slipData->setWithIban(true);
        $this->slipData->setWithPaymentReason(true);

        $this->assertTrue($this->slipData->setType('orange', true));

        $this->assertTrue($this->slipData->getWithBank());
        $this->assertTrue($this->slipData->getWithAccountNumber());
        $this->assertTrue($this->slipData->getWithRecipient());
        $this->assertTrue($this->slipData->getWithAmount());
        $this->assertTrue($this->slipData->getWithReferenceNumber());
        $this->assertTrue($this->slipData->getWithBankingCustomerId());
        $this->assertTrue($this->slipData->getWithPayer());
        $this->assertFalse($this->slipData->getWithIban());
        $this->assertFalse($this->slipData->getWithPaymentReason());
    }

    /**
     *
     * @return void
     * @covers ::setType
     * @covers ::setRedDefaults
     */
    public function testSetTypeRedTypeWithReset()
    {
        $this->slipData->setWithBank(false);
        $this->slipData->setWithAccountNumber(false);
        $this->slipData->setWithRecipient(false);
        $this->slipData->setWithAmount(false);
        $this->slipData->setWithReferenceNumber(true);
        $this->slipData->setWithBankingCustomerId(true);
        $this->slipData->setWithPayer(false);
        $this->slipData->setWithIban(false);
        $this->slipData->setWithPaymentReason(false);

        $this->assertTrue($this->slipData->setType('red', true));

        $this->assertTrue($this->slipData->getWithBank());
        $this->assertTrue($this->slipData->getWithAccountNumber());
        $this->assertTrue($this->slipData->getWithRecipient());
        $this->assertTrue($this->slipData->getWithAmount());
        $this->assertFalse($this->slipData->getWithReferenceNumber());
        $this->assertFalse($this->slipData->getWithBankingCustomerId());
        $this->assertTrue($this->slipData->getWithPayer());
        $this->assertTrue($this->slipData->getWithIban());
        $this->assertTrue($this->slipData->getWithPaymentReason());
    }

    /**
     *
     * @return void
     * @covers ::setType
     * @expectedException \InvalidArgumentException
     */
    public function testSetTypeFirstParameterIsEmptyString()
    {
        $this->slipData->setType('');
    }

    /**
     *
     * @return void
     * @covers ::setType
     * @expectedException \InvalidArgumentException
     */
    public function testSetTypeFirstParameterIsInvalidString()
    {
        $this->slipData->setType('123');
    }

    /**
     *
     * @return void
     * @covers ::setType
     * @expectedException \InvalidArgumentException
     */
    public function testSetTypeFirstParameterIsArray()
    {
        $this->slipData->setType(array('red'));
    }

    /**
     *
     * @return void
     * @covers ::setType
     * @expectedException \InvalidArgumentException
     */
    public function testSetTypeSecondParameterIsEmptyString()
    {
        $this->slipData->setType('orange', '');
    }

    /**
     *
     * @return void
     * @covers ::setType
     * @expectedException \InvalidArgumentException
     */
    public function testSetTypeSecondParameterIsInvalidString()
    {
        $this->slipData->setType('red', '123');
    }

    /**
     *
     * @return void
     * @covers ::setType
     * @expectedException \InvalidArgumentException
     */
    public function testSetTypeSecondParameterIsArray()
    {
        $this->slipData->setType('red', array(true));
    }

    /**
     *
     * @return void
     * @covers ::setWithBank
     * @covers ::getWithBank
     */
    public function testSetWithBankNoTypeSpecified()
    {
        $this->slipData->setBankData('Seldwyla Bank', '8001 Zürich');

        $this->assertTrue($this->slipData->setWithBank());
        $this->assertTrue($this->slipData->getWithBank());
        $this->assertEquals('Seldwyla Bank', $this->slipData->getBankName());
        $this->assertEquals('8001 Zürich', $this->slipData->getBankCity());

        $this->assertTrue($this->slipData->setWithBank(true));
        $this->assertTrue($this->slipData->getWithBank());
        $this->assertEquals('Seldwyla Bank', $this->slipData->getBankName());
        $this->assertEquals('8001 Zürich', $this->slipData->getBankCity());

        $this->assertTrue($this->slipData->setWithBank(false));
        $this->assertFalse($this->slipData->getWithBank());
        $this->assertEquals(false, $this->slipData->getBankName());
        $this->assertEquals(false, $this->slipData->getBankCity());
    }

    /**
     *
     * @return void
     * @covers ::setWithBank
     * @covers ::getWithBank
     */
    public function testSetWithBankOrangeType()
    {
        $this->slipData = new SwissPaymentSlipData('orange');
        $this->slipData->setBankData('Seldwyla Bank', '8001 Zürich');

        $this->assertTrue($this->slipData->setWithBank());
        $this->assertTrue($this->slipData->getWithBank());
        $this->assertEquals('Seldwyla Bank', $this->slipData->getBankName());
        $this->assertEquals('8001 Zürich', $this->slipData->getBankCity());

        $this->assertTrue($this->slipData->setWithBank(true));
        $this->assertTrue($this->slipData->getWithBank());
        $this->assertEquals('Seldwyla Bank', $this->slipData->getBankName());
        $this->assertEquals('8001 Zürich', $this->slipData->getBankCity());

        $this->assertTrue($this->slipData->setWithBank(false));
        $this->assertFalse($this->slipData->getWithBank());
        $this->assertEquals(false, $this->slipData->getBankName());
        $this->assertEquals(false, $this->slipData->getBankCity());
    }

    /**
     *
     * @return void
     * @covers ::setWithBank
     * @covers ::getWithBank
     */
    public function testSetWithBankRedType()
    {
        $this->slipData = new SwissPaymentSlipData('red');
        $this->slipData->setBankData('Seldwyla Bank', '8001 Zürich');

        $this->assertTrue($this->slipData->setWithBank());
        $this->assertTrue($this->slipData->getWithBank());
        $this->assertEquals('Seldwyla Bank', $this->slipData->getBankName());
        $this->assertEquals('8001 Zürich', $this->slipData->getBankCity());

        $this->assertTrue($this->slipData->setWithBank(true));
        $this->assertTrue($this->slipData->getWithBank());
        $this->assertEquals('Seldwyla Bank', $this->slipData->getBankName());
        $this->assertEquals('8001 Zürich', $this->slipData->getBankCity());

        $this->assertTrue($this->slipData->setWithBank(false));
        $this->assertFalse($this->slipData->getWithBank());
        $this->assertEquals(false, $this->slipData->getBankName());
        $this->assertEquals(false, $this->slipData->getBankCity());
    }

    /**
     *
     * @return void
     * @covers ::setWithBank
     * @covers ::getWithBank
     */
    public function testSetWithBankParameters()
    {
        $this->slipData->setBankData('Seldwyla Bank', '8001 Zürich');

        $this->assertFalse($this->slipData->setWithBank(1));
        $this->assertTrue($this->slipData->getWithBank());
        $this->assertEquals('Seldwyla Bank', $this->slipData->getBankName());
        $this->assertEquals('8001 Zürich', $this->slipData->getBankCity());

        $this->assertFalse($this->slipData->setWithBank(0));
        $this->assertTrue($this->slipData->getWithBank());
        $this->assertEquals('Seldwyla Bank', $this->slipData->getBankName());
        $this->assertEquals('8001 Zürich', $this->slipData->getBankCity());

        $this->assertFalse($this->slipData->setWithBank('foo'));
        $this->assertTrue($this->slipData->getWithBank());

        $this->assertFalse($this->slipData->setWithBank(123));
        $this->assertTrue($this->slipData->getWithBank());

        $this->assertFalse($this->slipData->setWithBank(123.456));
        $this->assertTrue($this->slipData->getWithBank());

        $this->assertFalse($this->slipData->setWithBank(array(true)));
        $this->assertTrue($this->slipData->getWithBank());
    }

    /**
     *
     * @return void
     * @covers ::setWithAccountNumber
     * @covers ::getWithAccountNumber
     */
    public function testSetWithAccountNumberNoTypeSpecified()
    {
        $this->slipData->setAccountNumber('01-2345-6');

        $this->assertTrue($this->slipData->setWithAccountNumber());
        $this->assertTrue($this->slipData->getWithAccountNumber());
        $this->assertEquals('01-2345-6', $this->slipData->getAccountNumber());

        $this->assertTrue($this->slipData->setWithAccountNumber(true));
        $this->assertTrue($this->slipData->getWithAccountNumber());
        $this->assertEquals('01-2345-6', $this->slipData->getAccountNumber());

        $this->assertTrue($this->slipData->setWithAccountNumber(false));
        $this->assertFalse($this->slipData->getWithAccountNumber());
        $this->assertEquals(false, $this->slipData->getAccountNumber());
    }

    /**
     *
     * @return void
     * @covers ::setWithAccountNumber
     * @covers ::getWithAccountNumber
     */
    public function testSetWithAccountNumberOrangeType()
    {
        $this->slipData = new SwissPaymentSlipData('orange');
        $this->slipData->setAccountNumber('01-2345-6');

        $this->assertTrue($this->slipData->setWithAccountNumber());
        $this->assertTrue($this->slipData->getWithAccountNumber());
        $this->assertEquals('01-2345-6', $this->slipData->getAccountNumber());

        $this->assertTrue($this->slipData->setWithAccountNumber(true));
        $this->assertTrue($this->slipData->getWithAccountNumber());
        $this->assertEquals('01-2345-6', $this->slipData->getAccountNumber());

        $this->assertTrue($this->slipData->setWithAccountNumber(false));
        $this->assertFalse($this->slipData->getWithAccountNumber());
        $this->assertEquals(false, $this->slipData->getAccountNumber());
    }

    /**
     *
     * @return void
     * @covers ::setWithAccountNumber
     * @covers ::getWithAccountNumber
     */
    public function testSetWithAccountNumberRedType()
    {
        $this->slipData = new SwissPaymentSlipData('red');
        $this->slipData->setAccountNumber('01-2345-6');

        $this->assertTrue($this->slipData->setWithAccountNumber());
        $this->assertTrue($this->slipData->getWithAccountNumber());
        $this->assertEquals('01-2345-6', $this->slipData->getAccountNumber());

        $this->assertTrue($this->slipData->setWithAccountNumber(true));
        $this->assertTrue($this->slipData->getWithAccountNumber());
        $this->assertEquals('01-2345-6', $this->slipData->getAccountNumber());

        $this->assertTrue($this->slipData->setWithAccountNumber(false));
        $this->assertFalse($this->slipData->getWithAccountNumber());
        $this->assertEquals(false, $this->slipData->getAccountNumber());
    }

    /**
     *
     * @return void
     * @covers ::setWithAccountNumber
     * @covers ::getWithAccountNumber
     */
    public function testSetWithAccountNumberParameters()
    {
        $this->slipData->setAccountNumber('01-2345-6');

        $this->assertFalse($this->slipData->setWithAccountNumber(1));
        $this->assertTrue($this->slipData->getWithAccountNumber());
        $this->assertEquals('01-2345-6', $this->slipData->getAccountNumber());

        $this->assertFalse($this->slipData->setWithAccountNumber(0));
        $this->assertTrue($this->slipData->getWithAccountNumber());
        $this->assertEquals('01-2345-6', $this->slipData->getAccountNumber());

        $this->assertFalse($this->slipData->setWithAccountNumber('foo'));
        $this->assertTrue($this->slipData->getWithAccountNumber());

        $this->assertFalse($this->slipData->setWithAccountNumber(123));
        $this->assertTrue($this->slipData->getWithAccountNumber());

        $this->assertFalse($this->slipData->setWithAccountNumber(123.456));
        $this->assertTrue($this->slipData->getWithAccountNumber());

        $this->assertFalse($this->slipData->setWithAccountNumber(array(true)));
        $this->assertTrue($this->slipData->getWithAccountNumber());
    }

    /**
     *
     * @return void
     * @covers ::setWithRecipient
     * @covers ::getWithRecipient
     */
    public function testSetWithRecipientNoTypeSpecified()
    {
        $this->slipData->setRecipientData('AAAAAAAAAA', 'BBBBBBBBBB', 'CCCCCCCCCC', 'DDDDDDDDDD');

        $this->assertTrue($this->slipData->setWithRecipient());
        $this->assertTrue($this->slipData->getWithRecipient());
        $this->assertEquals('AAAAAAAAAA', $this->slipData->getRecipientLine1());
        $this->assertEquals('BBBBBBBBBB', $this->slipData->getRecipientLine2());
        $this->assertEquals('CCCCCCCCCC', $this->slipData->getRecipientLine3());
        $this->assertEquals('DDDDDDDDDD', $this->slipData->getRecipientLine4());

        $this->assertTrue($this->slipData->setWithRecipient(true));
        $this->assertTrue($this->slipData->getWithRecipient());
        $this->assertEquals('AAAAAAAAAA', $this->slipData->getRecipientLine1());
        $this->assertEquals('BBBBBBBBBB', $this->slipData->getRecipientLine2());
        $this->assertEquals('CCCCCCCCCC', $this->slipData->getRecipientLine3());
        $this->assertEquals('DDDDDDDDDD', $this->slipData->getRecipientLine4());

        $this->assertTrue($this->slipData->setWithRecipient(false));
        $this->assertFalse($this->slipData->getWithRecipient());
        $this->assertEquals(false, $this->slipData->getRecipientLine1());
        $this->assertEquals(false, $this->slipData->getRecipientLine2());
        $this->assertEquals(false, $this->slipData->getRecipientLine3());
        $this->assertEquals(false, $this->slipData->getRecipientLine4());
    }

    /**
     *
     * @return void
     * @covers ::setWithRecipient
     * @covers ::getWithRecipient
     */
    public function testSetWithRecipientOrangeType()
    {
        $this->slipData = new SwissPaymentSlipData('orange');
        $this->slipData->setRecipientData('AAAAAAAAAA', 'BBBBBBBBBB', 'CCCCCCCCCC', 'DDDDDDDDDD');

        $this->assertTrue($this->slipData->setWithRecipient());
        $this->assertTrue($this->slipData->getWithRecipient());
        $this->assertEquals('AAAAAAAAAA', $this->slipData->getRecipientLine1());
        $this->assertEquals('BBBBBBBBBB', $this->slipData->getRecipientLine2());
        $this->assertEquals('CCCCCCCCCC', $this->slipData->getRecipientLine3());
        $this->assertEquals('DDDDDDDDDD', $this->slipData->getRecipientLine4());

        $this->assertTrue($this->slipData->setWithRecipient(true));
        $this->assertTrue($this->slipData->getWithRecipient());
        $this->assertEquals('AAAAAAAAAA', $this->slipData->getRecipientLine1());
        $this->assertEquals('BBBBBBBBBB', $this->slipData->getRecipientLine2());
        $this->assertEquals('CCCCCCCCCC', $this->slipData->getRecipientLine3());
        $this->assertEquals('DDDDDDDDDD', $this->slipData->getRecipientLine4());

        $this->assertTrue($this->slipData->setWithRecipient(false));
        $this->assertFalse($this->slipData->getWithRecipient());
        $this->assertEquals(false, $this->slipData->getRecipientLine1());
        $this->assertEquals(false, $this->slipData->getRecipientLine2());
        $this->assertEquals(false, $this->slipData->getRecipientLine3());
        $this->assertEquals(false, $this->slipData->getRecipientLine4());
    }

    /**
     *
     * @return void
     * @covers ::setWithRecipient
     * @covers ::getWithRecipient
     */
    public function testSetWithRecipientRedType()
    {
        $this->slipData = new SwissPaymentSlipData('red');
        $this->slipData->setRecipientData('AAAAAAAAAA', 'BBBBBBBBBB', 'CCCCCCCCCC', 'DDDDDDDDDD');

        $this->assertTrue($this->slipData->setWithRecipient());
        $this->assertTrue($this->slipData->getWithRecipient());
        $this->assertEquals('AAAAAAAAAA', $this->slipData->getRecipientLine1());
        $this->assertEquals('BBBBBBBBBB', $this->slipData->getRecipientLine2());
        $this->assertEquals('CCCCCCCCCC', $this->slipData->getRecipientLine3());
        $this->assertEquals('DDDDDDDDDD', $this->slipData->getRecipientLine4());

        $this->assertTrue($this->slipData->setWithRecipient(true));
        $this->assertTrue($this->slipData->getWithRecipient());
        $this->assertEquals('AAAAAAAAAA', $this->slipData->getRecipientLine1());
        $this->assertEquals('BBBBBBBBBB', $this->slipData->getRecipientLine2());
        $this->assertEquals('CCCCCCCCCC', $this->slipData->getRecipientLine3());
        $this->assertEquals('DDDDDDDDDD', $this->slipData->getRecipientLine4());

        $this->assertTrue($this->slipData->setWithRecipient(false));
        $this->assertFalse($this->slipData->getWithRecipient());
        $this->assertEquals(false, $this->slipData->getRecipientLine1());
        $this->assertEquals(false, $this->slipData->getRecipientLine2());
        $this->assertEquals(false, $this->slipData->getRecipientLine3());
        $this->assertEquals(false, $this->slipData->getRecipientLine4());
    }

    /**
     *
     * @return void
     * @covers ::setWithRecipient
     * @covers ::getWithRecipient
     */
    public function testSetWithRecipientParameters()
    {
        $this->slipData->setRecipientData('AAAAAAAAAA', 'BBBBBBBBBB', 'CCCCCCCCCC', 'DDDDDDDDDD');

        $this->assertFalse($this->slipData->setWithRecipient(1));
        $this->assertTrue($this->slipData->getWithRecipient());
        $this->assertEquals('AAAAAAAAAA', $this->slipData->getRecipientLine1());
        $this->assertEquals('BBBBBBBBBB', $this->slipData->getRecipientLine2());
        $this->assertEquals('CCCCCCCCCC', $this->slipData->getRecipientLine3());
        $this->assertEquals('DDDDDDDDDD', $this->slipData->getRecipientLine4());

        $this->assertFalse($this->slipData->setWithRecipient(0));
        $this->assertTrue($this->slipData->getWithRecipient());
        $this->assertEquals('AAAAAAAAAA', $this->slipData->getRecipientLine1());
        $this->assertEquals('BBBBBBBBBB', $this->slipData->getRecipientLine2());
        $this->assertEquals('CCCCCCCCCC', $this->slipData->getRecipientLine3());
        $this->assertEquals('DDDDDDDDDD', $this->slipData->getRecipientLine4());

        $this->assertFalse($this->slipData->setWithRecipient('foo'));
        $this->assertTrue($this->slipData->getWithRecipient());

        $this->assertFalse($this->slipData->setWithRecipient(123));
        $this->assertTrue($this->slipData->getWithRecipient());

        $this->assertFalse($this->slipData->setWithRecipient(123.456));
        $this->assertTrue($this->slipData->getWithRecipient());

        $this->assertFalse($this->slipData->setWithRecipient(array(true)));
        $this->assertTrue($this->slipData->getWithRecipient());
    }

    /**
     *
     * @return void
     * @covers ::setWithAmount
     * @covers ::getWithAmount
     */
    public function testSetWithAmountNoTypeSpecified()
    {
        $this->slipData->setAmount(1234567.89);

        $this->assertTrue($this->slipData->setWithAmount());
        $this->assertTrue($this->slipData->getWithAmount());
        $this->assertEquals(1234567.89, $this->slipData->getAmount());

        $this->assertTrue($this->slipData->setWithAmount(true));
        $this->assertTrue($this->slipData->getWithAmount());
        $this->assertEquals(1234567.89, $this->slipData->getAmount());

        $this->assertTrue($this->slipData->setWithAmount(false));
        $this->assertFalse($this->slipData->getWithAmount());
        $this->assertEquals(false, $this->slipData->getAmount());
    }

    /**
     *
     * @return void
     * @covers ::setWithAmount
     * @covers ::getWithAmount
     */
    public function testSetWithAmountNumberOrangeType()
    {
        $this->slipData = new SwissPaymentSlipData('orange');
        $this->slipData->setAmount(1234567.89);

        $this->assertTrue($this->slipData->setWithAmount());
        $this->assertTrue($this->slipData->getWithAmount());
        $this->assertEquals(1234567.89, $this->slipData->getAmount());

        $this->assertTrue($this->slipData->setWithAmount(true));
        $this->assertTrue($this->slipData->getWithAmount());
        $this->assertEquals(1234567.89, $this->slipData->getAmount());

        $this->assertTrue($this->slipData->setWithAmount(false));
        $this->assertFalse($this->slipData->getWithAmount());
        $this->assertEquals(false, $this->slipData->getAmount());
    }

    /**
     *
     * @return void
     * @covers ::setWithAmount
     * @covers ::getWithAmount
     */
    public function testSetWithAmountNumberRedType()
    {
        $this->slipData = new SwissPaymentSlipData('red');
        $this->slipData->setAmount(1234567.89);

        $this->assertTrue($this->slipData->setWithAmount());
        $this->assertTrue($this->slipData->getWithAmount());
        $this->assertEquals(1234567.89, $this->slipData->getAmount());

        $this->assertTrue($this->slipData->setWithAmount(true));
        $this->assertTrue($this->slipData->getWithAmount());
        $this->assertEquals(1234567.89, $this->slipData->getAmount());

        $this->assertTrue($this->slipData->setWithAmount(false));
        $this->assertFalse($this->slipData->getWithAmount());
        $this->assertEquals(false, $this->slipData->getAmount());
    }

    /**
     *
     * @return void
     * @covers ::setWithAmount
     * @covers ::getWithAmount
     */
    public function testSetWithAmountNumberParameters()
    {
        $this->slipData->setAmount(1234567.89);

        $this->assertFalse($this->slipData->setWithAmount(1));
        $this->assertTrue($this->slipData->getWithAmount());
        $this->assertEquals(1234567.89, $this->slipData->getAmount());

        $this->assertFalse($this->slipData->setWithAmount(0));
        $this->assertTrue($this->slipData->getWithAmount());
        $this->assertEquals(1234567.89, $this->slipData->getAmount());

        $this->assertFalse($this->slipData->setWithAmount('foo'));
        $this->assertTrue($this->slipData->getWithAmount());

        $this->assertFalse($this->slipData->setWithAmount(123));
        $this->assertTrue($this->slipData->getWithAmount());

        $this->assertFalse($this->slipData->setWithAmount(123.456));
        $this->assertTrue($this->slipData->getWithAmount());

        $this->assertFalse($this->slipData->setWithAmount(array(true)));
        $this->assertTrue($this->slipData->getWithAmount());
    }

    /**
     *
     * @return void
     * @covers ::setWithReferenceNumber
     * @covers ::getWithReferenceNumber
     */
    public function testSetWithReferenceNumberNoTypeSpecified()
    {
        $this->slipData->setReferenceNumber('0123456789');

        $this->assertTrue($this->slipData->setWithReferenceNumber());
        $this->assertTrue($this->slipData->getWithReferenceNumber());
        $this->assertEquals('0123456789', $this->slipData->getReferenceNumber());

        $this->assertTrue($this->slipData->setWithReferenceNumber(true));
        $this->assertTrue($this->slipData->getWithReferenceNumber());
        $this->assertEquals('0123456789', $this->slipData->getReferenceNumber());

        $this->assertTrue($this->slipData->setWithReferenceNumber(false));
        $this->assertFalse($this->slipData->getWithReferenceNumber());
        $this->assertEquals(false, $this->slipData->getReferenceNumber());
    }

    /**
     *
     * @return void
     * @covers ::setWithReferenceNumber
     * @covers ::getWithReferenceNumber
     */
    public function testSetWithReferenceNumberNumberOrangeType()
    {
        $this->slipData = new SwissPaymentSlipData('orange');
        $this->slipData->setReferenceNumber('0123456789');

        $this->assertTrue($this->slipData->setWithReferenceNumber());
        $this->assertTrue($this->slipData->getWithReferenceNumber());
        $this->assertEquals('0123456789', $this->slipData->getReferenceNumber());

        $this->assertTrue($this->slipData->setWithReferenceNumber(true));
        $this->assertTrue($this->slipData->getWithReferenceNumber());
        $this->assertEquals('0123456789', $this->slipData->getReferenceNumber());

        $this->assertTrue($this->slipData->setWithReferenceNumber(false));
        $this->assertFalse($this->slipData->getWithReferenceNumber());
        $this->assertEquals(false, $this->slipData->getReferenceNumber());
    }

    /**
     *
     * @return void
     * @covers ::setWithReferenceNumber
     * @covers ::getWithReferenceNumber
     */
    public function testSetWithReferenceNumberNumberRedType()
    {
        $this->slipData = new SwissPaymentSlipData('red');
        $this->slipData->setReferenceNumber('0123456789');

        $this->assertFalse($this->slipData->setWithReferenceNumber());
        $this->assertFalse($this->slipData->getWithReferenceNumber());
        $this->assertEquals(false, $this->slipData->getReferenceNumber());

        $this->assertFalse($this->slipData->setWithReferenceNumber(true));
        $this->assertFalse($this->slipData->getWithReferenceNumber());
        $this->assertEquals(false, $this->slipData->getReferenceNumber());

        $this->assertFalse($this->slipData->setWithReferenceNumber(false));
        $this->assertFalse($this->slipData->getWithReferenceNumber());
        $this->assertEquals(false, $this->slipData->getReferenceNumber());
    }

    /**
     *
     * @return void
     * @covers ::setWithReferenceNumber
     * @covers ::getWithReferenceNumber
     */
    public function testSetWithReferenceNumberNumberParameters()
    {
        $this->slipData->setReferenceNumber('0123456789');

        $this->assertFalse($this->slipData->setWithReferenceNumber(1));
        $this->assertTrue($this->slipData->getWithReferenceNumber());
        $this->assertEquals('0123456789', $this->slipData->getReferenceNumber());

        $this->assertFalse($this->slipData->setWithReferenceNumber(0));
        $this->assertTrue($this->slipData->getWithReferenceNumber());
        $this->assertEquals('0123456789', $this->slipData->getReferenceNumber());

        $this->assertFalse($this->slipData->setWithReferenceNumber('foo'));
        $this->assertTrue($this->slipData->getWithReferenceNumber());

        $this->assertFalse($this->slipData->setWithReferenceNumber(123));
        $this->assertTrue($this->slipData->getWithReferenceNumber());

        $this->assertFalse($this->slipData->setWithReferenceNumber(123.456));
        $this->assertTrue($this->slipData->getWithReferenceNumber());

        $this->assertFalse($this->slipData->setWithReferenceNumber(array(true)));
        $this->assertTrue($this->slipData->getWithReferenceNumber());
    }

    /**
     *
     * @return void
     * @covers ::setWithBankingCustomerId
     * @covers ::getWithBankingCustomerId
     */
    public function testSetWithBankingCustomerIdNoTypeSpecified()
    {
        $this->slipData->setBankingCustomerId('012345');

        $this->assertTrue($this->slipData->setWithBankingCustomerId());
        $this->assertTrue($this->slipData->getWithBankingCustomerId());
        $this->assertEquals('012345', $this->slipData->getBankingCustomerId());

        $this->assertTrue($this->slipData->setWithBankingCustomerId(true));
        $this->assertTrue($this->slipData->getWithBankingCustomerId());
        $this->assertEquals('012345', $this->slipData->getBankingCustomerId());

        $this->assertTrue($this->slipData->setWithBankingCustomerId(false));
        $this->assertFalse($this->slipData->getWithBankingCustomerId());
        $this->assertEquals(false, $this->slipData->getBankingCustomerId());
    }

    /**
     *
     * @return void
     * @covers ::setWithBankingCustomerId
     * @covers ::getWithBankingCustomerId
     */
    public function testSetWithBankingCustomerIdNumberOrangeType()
    {
        $this->slipData = new SwissPaymentSlipData('orange');
        $this->slipData->setBankingCustomerId('012345');

        $this->assertTrue($this->slipData->setWithBankingCustomerId());
        $this->assertTrue($this->slipData->getWithBankingCustomerId());
        $this->assertEquals('012345', $this->slipData->getBankingCustomerId());

        $this->assertTrue($this->slipData->setWithBankingCustomerId(true));
        $this->assertTrue($this->slipData->getWithBankingCustomerId());
        $this->assertEquals('012345', $this->slipData->getBankingCustomerId());

        $this->assertTrue($this->slipData->setWithBankingCustomerId(false));
        $this->assertFalse($this->slipData->getWithBankingCustomerId());
        $this->assertEquals(false, $this->slipData->getBankingCustomerId());
    }

    /**
     *
     * @return void
     * @covers ::setWithBankingCustomerId
     * @covers ::getWithBankingCustomerId
     */
    public function testSetWithBankingCustomerIdNumberRedType()
    {
        $this->slipData = new SwissPaymentSlipData('red');
        $this->slipData->setBankingCustomerId('012345');

        $this->assertFalse($this->slipData->setWithBankingCustomerId());
        $this->assertFalse($this->slipData->getWithBankingCustomerId());
        $this->assertEquals(false, $this->slipData->getBankingCustomerId());

        $this->assertFalse($this->slipData->setWithBankingCustomerId(true));
        $this->assertFalse($this->slipData->getWithBankingCustomerId());
        $this->assertEquals(false, $this->slipData->getBankingCustomerId());

        $this->assertFalse($this->slipData->setWithBankingCustomerId(false));
        $this->assertFalse($this->slipData->getWithBankingCustomerId());
        $this->assertEquals(false, $this->slipData->getBankingCustomerId());
    }

    /**
     *
     * @return void
     * @covers ::setWithBankingCustomerId
     * @covers ::getWithBankingCustomerId
     */
    public function testSetWithBankingCustomerIdNumberParameters()
    {
        $this->slipData->setBankingCustomerId('012345');

        $this->assertFalse($this->slipData->setWithBankingCustomerId(1));
        $this->assertTrue($this->slipData->getWithBankingCustomerId());
        $this->assertEquals('012345', $this->slipData->getBankingCustomerId());

        $this->assertFalse($this->slipData->setWithBankingCustomerId(0));
        $this->assertTrue($this->slipData->getWithBankingCustomerId());
        $this->assertEquals('012345', $this->slipData->getBankingCustomerId());

        $this->assertFalse($this->slipData->setWithBankingCustomerId('foo'));
        $this->assertTrue($this->slipData->getWithBankingCustomerId());

        $this->assertFalse($this->slipData->setWithBankingCustomerId(123));
        $this->assertTrue($this->slipData->getWithBankingCustomerId());

        $this->assertFalse($this->slipData->setWithBankingCustomerId(123.456));
        $this->assertTrue($this->slipData->getWithBankingCustomerId());

        $this->assertFalse($this->slipData->setWithBankingCustomerId(array(true)));
        $this->assertTrue($this->slipData->getWithBankingCustomerId());
    }

    /**
     *
     * @return void
     * @covers ::setWithPayer
     * @covers ::getWithPayer
     */
    public function testSetWithPayerNoTypeSpecified()
    {
        $this->slipData->setPayerData('AAAAAAAAAA', 'BBBBBBBBBB', 'CCCCCCCCCC', 'DDDDDDDDDD');

        $this->assertTrue($this->slipData->setWithPayer());
        $this->assertTrue($this->slipData->getWithPayer());
        $this->assertEquals('AAAAAAAAAA', $this->slipData->getPayerLine1());
        $this->assertEquals('BBBBBBBBBB', $this->slipData->getPayerLine2());
        $this->assertEquals('CCCCCCCCCC', $this->slipData->getPayerLine3());
        $this->assertEquals('DDDDDDDDDD', $this->slipData->getPayerLine4());

        $this->assertTrue($this->slipData->setWithPayer(true));
        $this->assertTrue($this->slipData->getWithPayer());
        $this->assertEquals('AAAAAAAAAA', $this->slipData->getPayerLine1());
        $this->assertEquals('BBBBBBBBBB', $this->slipData->getPayerLine2());
        $this->assertEquals('CCCCCCCCCC', $this->slipData->getPayerLine3());
        $this->assertEquals('DDDDDDDDDD', $this->slipData->getPayerLine4());

        $this->assertTrue($this->slipData->setWithPayer(false));
        $this->assertFalse($this->slipData->getWithPayer());
        $this->assertEquals(false, $this->slipData->getPayerLine1());
        $this->assertEquals(false, $this->slipData->getPayerLine2());
        $this->assertEquals(false, $this->slipData->getPayerLine3());
        $this->assertEquals(false, $this->slipData->getPayerLine4());
    }

    /**
     *
     * @return void
     * @covers ::setWithPayer
     * @covers ::getWithPayer
     */
    public function testSetWithPayerOrangeType()
    {
        $this->slipData = new SwissPaymentSlipData('orange');
        $this->slipData->setPayerData('AAAAAAAAAA', 'BBBBBBBBBB', 'CCCCCCCCCC', 'DDDDDDDDDD');

        $this->assertTrue($this->slipData->setWithPayer());
        $this->assertTrue($this->slipData->getWithPayer());
        $this->assertEquals('AAAAAAAAAA', $this->slipData->getPayerLine1());
        $this->assertEquals('BBBBBBBBBB', $this->slipData->getPayerLine2());
        $this->assertEquals('CCCCCCCCCC', $this->slipData->getPayerLine3());
        $this->assertEquals('DDDDDDDDDD', $this->slipData->getPayerLine4());

        $this->assertTrue($this->slipData->setWithPayer(true));
        $this->assertTrue($this->slipData->getWithPayer());
        $this->assertEquals('AAAAAAAAAA', $this->slipData->getPayerLine1());
        $this->assertEquals('BBBBBBBBBB', $this->slipData->getPayerLine2());
        $this->assertEquals('CCCCCCCCCC', $this->slipData->getPayerLine3());
        $this->assertEquals('DDDDDDDDDD', $this->slipData->getPayerLine4());

        $this->assertTrue($this->slipData->setWithPayer(false));
        $this->assertFalse($this->slipData->getWithPayer());
        $this->assertEquals(false, $this->slipData->getPayerLine1());
        $this->assertEquals(false, $this->slipData->getPayerLine2());
        $this->assertEquals(false, $this->slipData->getPayerLine3());
        $this->assertEquals(false, $this->slipData->getPayerLine4());
    }

    /**
     *
     * @return void
     * @covers ::setWithPayer
     * @covers ::getWithPayer
     */
    public function testSetWithPayerRedType()
    {
        $this->slipData = new SwissPaymentSlipData('red');
        $this->slipData->setPayerData('AAAAAAAAAA', 'BBBBBBBBBB', 'CCCCCCCCCC', 'DDDDDDDDDD');

        $this->assertTrue($this->slipData->setWithPayer());
        $this->assertTrue($this->slipData->getWithPayer());
        $this->assertEquals('AAAAAAAAAA', $this->slipData->getPayerLine1());
        $this->assertEquals('BBBBBBBBBB', $this->slipData->getPayerLine2());
        $this->assertEquals('CCCCCCCCCC', $this->slipData->getPayerLine3());
        $this->assertEquals('DDDDDDDDDD', $this->slipData->getPayerLine4());

        $this->assertTrue($this->slipData->setWithPayer(true));
        $this->assertTrue($this->slipData->getWithPayer());
        $this->assertEquals('AAAAAAAAAA', $this->slipData->getPayerLine1());
        $this->assertEquals('BBBBBBBBBB', $this->slipData->getPayerLine2());
        $this->assertEquals('CCCCCCCCCC', $this->slipData->getPayerLine3());
        $this->assertEquals('DDDDDDDDDD', $this->slipData->getPayerLine4());

        $this->assertTrue($this->slipData->setWithPayer(false));
        $this->assertFalse($this->slipData->getWithPayer());
        $this->assertEquals(false, $this->slipData->getPayerLine1());
        $this->assertEquals(false, $this->slipData->getPayerLine2());
        $this->assertEquals(false, $this->slipData->getPayerLine3());
        $this->assertEquals(false, $this->slipData->getPayerLine4());
    }

    /**
     *
     * @return void
     * @covers ::setWithPayer
     * @covers ::getWithPayer
     */
    public function testSetWithPayerParameters()
    {
        $this->slipData->setPayerData('AAAAAAAAAA', 'BBBBBBBBBB', 'CCCCCCCCCC', 'DDDDDDDDDD');

        $this->assertFalse($this->slipData->setWithPayer(1));
        $this->assertTrue($this->slipData->getWithPayer());
        $this->assertEquals('AAAAAAAAAA', $this->slipData->getPayerLine1());
        $this->assertEquals('BBBBBBBBBB', $this->slipData->getPayerLine2());
        $this->assertEquals('CCCCCCCCCC', $this->slipData->getPayerLine3());
        $this->assertEquals('DDDDDDDDDD', $this->slipData->getPayerLine4());

        $this->assertFalse($this->slipData->setWithPayer(0));
        $this->assertTrue($this->slipData->getWithPayer());
        $this->assertEquals('AAAAAAAAAA', $this->slipData->getPayerLine1());
        $this->assertEquals('BBBBBBBBBB', $this->slipData->getPayerLine2());
        $this->assertEquals('CCCCCCCCCC', $this->slipData->getPayerLine3());
        $this->assertEquals('DDDDDDDDDD', $this->slipData->getPayerLine4());

        $this->assertFalse($this->slipData->setWithPayer('foo'));
        $this->assertTrue($this->slipData->getWithPayer());

        $this->assertFalse($this->slipData->setWithPayer(123));
        $this->assertTrue($this->slipData->getWithPayer());

        $this->assertFalse($this->slipData->setWithPayer(123.456));
        $this->assertTrue($this->slipData->getWithPayer());

        $this->assertFalse($this->slipData->setWithPayer(array(true)));
        $this->assertTrue($this->slipData->getWithPayer());
    }

    /**
     *
     * @return void
     * @covers ::setWithIban
     * @covers ::getWithIban
     */
    public function testSetWithIbanNoTypeSpecified()
    {
        $this->slipData->setIban('CH380123456789');

        $this->assertFalse($this->slipData->setWithIban());
        $this->assertFalse($this->slipData->getWithIban());
        $this->assertEquals(false, $this->slipData->getIban());

        $this->assertFalse($this->slipData->setWithIban(true));
        $this->assertFalse($this->slipData->getWithIban());
        $this->assertEquals(false, $this->slipData->getIban());

        $this->assertFalse($this->slipData->setWithIban(false));
        $this->assertFalse($this->slipData->getWithIban());
        $this->assertEquals(false, $this->slipData->getIban());
    }

    /**
     *
     * @return void
     * @covers ::setWithIban
     * @covers ::getWithIban
     */
    public function testSetWithIbanNumberOrangeType()
    {
        $this->slipData = new SwissPaymentSlipData('orange');
        $this->slipData->setIban('CH380123456789');

        $this->assertFalse($this->slipData->setWithIban());
        $this->assertFalse($this->slipData->getWithIban());
        $this->assertEquals(false, $this->slipData->getIban());

        $this->assertFalse($this->slipData->setWithIban(true));
        $this->assertFalse($this->slipData->getWithIban());
        $this->assertEquals(false, $this->slipData->getIban());

        $this->assertFalse($this->slipData->setWithIban(false));
        $this->assertFalse($this->slipData->getWithIban());
        $this->assertEquals(false, $this->slipData->getIban());
    }

    /**
     *
     * @return void
     * @covers ::setWithIban
     * @covers ::getWithIban
     */
    public function testSetWithIbanNumberRedType()
    {
        $this->slipData = new SwissPaymentSlipData('red');
        $this->slipData->setIban('CH380123456789');

        $this->assertTrue($this->slipData->setWithIban(true));
        $this->assertTrue($this->slipData->getWithIban());
        $this->assertEquals('CH380123456789', $this->slipData->getIban());

        $this->assertTrue($this->slipData->setWithIban());
        $this->assertFalse($this->slipData->getWithIban());
        $this->assertEquals(false, $this->slipData->getIban());

        $this->assertTrue($this->slipData->setWithIban(false));
        $this->assertFalse($this->slipData->getWithIban());
        $this->assertEquals(false, $this->slipData->getIban());
    }

    /**
     *
     * @return void
     * @covers ::setWithIban
     * @covers ::getWithIban
     */
    public function testSetWithIbanNumberParameters()
    {
        $this->slipData = new SwissPaymentSlipData('red');
        $this->slipData->setIban('CH380123456789');

        $this->assertFalse($this->slipData->setWithIban(1));
        $this->assertTrue($this->slipData->getWithIban());
        $this->assertEquals('CH380123456789', $this->slipData->getIban());

        $this->assertFalse($this->slipData->setWithIban(0));
        $this->assertTrue($this->slipData->getWithIban());
        $this->assertEquals('CH380123456789', $this->slipData->getIban());

        $this->assertFalse($this->slipData->setWithIban('foo'));
        $this->assertTrue($this->slipData->getWithIban());

        $this->assertFalse($this->slipData->setWithIban(123));
        $this->assertTrue($this->slipData->getWithIban());

        $this->assertFalse($this->slipData->setWithIban(123.456));
        $this->assertTrue($this->slipData->getWithIban());

        $this->assertFalse($this->slipData->setWithIban(array(true)));
        $this->assertTrue($this->slipData->getWithIban());
    }

    /**
     *
     * @return void
     * @covers ::setWithPaymentReason
     * @covers ::getWithPaymentReason
     */
    public function testSetWithPaymentReasonNoTypeSpecified()
    {
        $this->slipData->setPaymentReasonData('AAAAAAAAAA', 'BBBBBBBBBB', 'CCCCCCCCCC', 'DDDDDDDDDD');

        $this->assertFalse($this->slipData->setWithPaymentReason());
        $this->assertFalse($this->slipData->getWithPaymentReason());
        $this->assertEquals(false, $this->slipData->getPaymentReasonLine1());
        $this->assertEquals(false, $this->slipData->getPaymentReasonLine2());
        $this->assertEquals(false, $this->slipData->getPaymentReasonLine3());
        $this->assertEquals(false, $this->slipData->getPaymentReasonLine4());

        $this->assertFalse($this->slipData->setWithPaymentReason(true));
        $this->assertFalse($this->slipData->getWithPaymentReason());
        $this->assertEquals(false, $this->slipData->getPaymentReasonLine1());
        $this->assertEquals(false, $this->slipData->getPaymentReasonLine2());
        $this->assertEquals(false, $this->slipData->getPaymentReasonLine3());
        $this->assertEquals(false, $this->slipData->getPaymentReasonLine4());

        $this->assertFalse($this->slipData->setWithPaymentReason(false));
        $this->assertFalse($this->slipData->getWithPaymentReason());
        $this->assertEquals(false, $this->slipData->getPaymentReasonLine1());
        $this->assertEquals(false, $this->slipData->getPaymentReasonLine2());
        $this->assertEquals(false, $this->slipData->getPaymentReasonLine3());
        $this->assertEquals(false, $this->slipData->getPaymentReasonLine4());
    }

    /**
     *
     * @return void
     * @covers ::setWithPaymentReason
     * @covers ::getWithPaymentReason
     */
    public function testSetWithPaymentReasonOrangeType()
    {
        $this->slipData = new SwissPaymentSlipData('orange');
        $this->slipData->setPaymentReasonData('AAAAAAAAAA', 'BBBBBBBBBB', 'CCCCCCCCCC', 'DDDDDDDDDD');

        $this->assertFalse($this->slipData->setWithPaymentReason());
        $this->assertFalse($this->slipData->getWithPaymentReason());
        $this->assertEquals(false, $this->slipData->getPaymentReasonLine1());
        $this->assertEquals(false, $this->slipData->getPaymentReasonLine2());
        $this->assertEquals(false, $this->slipData->getPaymentReasonLine3());
        $this->assertEquals(false, $this->slipData->getPaymentReasonLine4());

        $this->assertFalse($this->slipData->setWithPaymentReason(true));
        $this->assertFalse($this->slipData->getWithPaymentReason());
        $this->assertEquals(false, $this->slipData->getPaymentReasonLine1());
        $this->assertEquals(false, $this->slipData->getPaymentReasonLine2());
        $this->assertEquals(false, $this->slipData->getPaymentReasonLine3());
        $this->assertEquals(false, $this->slipData->getPaymentReasonLine4());

        $this->assertFalse($this->slipData->setWithPaymentReason(false));
        $this->assertFalse($this->slipData->getWithPaymentReason());
        $this->assertEquals(false, $this->slipData->getPaymentReasonLine1());
        $this->assertEquals(false, $this->slipData->getPaymentReasonLine2());
        $this->assertEquals(false, $this->slipData->getPaymentReasonLine3());
        $this->assertEquals(false, $this->slipData->getPaymentReasonLine4());
    }

    /**
     *
     * @return void
     * @covers ::setWithPaymentReason
     * @covers ::getWithPaymentReason
     */
    public function testSetWithPaymentReasonRedType()
    {
        $this->slipData = new SwissPaymentSlipData('red');
        $this->slipData->setPaymentReasonData('AAAAAAAAAA', 'BBBBBBBBBB', 'CCCCCCCCCC', 'DDDDDDDDDD');

        $this->assertTrue($this->slipData->setWithPaymentReason(true));
        $this->assertTrue($this->slipData->getWithPaymentReason());
        $this->assertEquals('AAAAAAAAAA', $this->slipData->getPaymentReasonLine1());
        $this->assertEquals('BBBBBBBBBB', $this->slipData->getPaymentReasonLine2());
        $this->assertEquals('CCCCCCCCCC', $this->slipData->getPaymentReasonLine3());
        $this->assertEquals('DDDDDDDDDD', $this->slipData->getPaymentReasonLine4());

        $this->assertTrue($this->slipData->setWithPaymentReason());
        $this->assertFalse($this->slipData->getWithPaymentReason());
        $this->assertEquals(false, $this->slipData->getPaymentReasonLine1());
        $this->assertEquals(false, $this->slipData->getPaymentReasonLine2());
        $this->assertEquals(false, $this->slipData->getPaymentReasonLine3());
        $this->assertEquals(false, $this->slipData->getPaymentReasonLine4());

        $this->assertTrue($this->slipData->setWithPaymentReason(false));
        $this->assertFalse($this->slipData->getWithPaymentReason());
        $this->assertEquals(false, $this->slipData->getPaymentReasonLine1());
        $this->assertEquals(false, $this->slipData->getPaymentReasonLine2());
        $this->assertEquals(false, $this->slipData->getPaymentReasonLine3());
        $this->assertEquals(false, $this->slipData->getPaymentReasonLine4());
    }

    /**
     *
     * @return void
     * @covers ::setWithPaymentReason
     * @covers ::getWithPaymentReason
     */
    public function testSetWithPaymentReasonParameters()
    {
        $this->slipData = new SwissPaymentSlipData('red');
        $this->slipData->setPaymentReasonData('AAAAAAAAAA', 'BBBBBBBBBB', 'CCCCCCCCCC', 'DDDDDDDDDD');

        $this->assertFalse($this->slipData->setWithPaymentReason(1));
        $this->assertTrue($this->slipData->getWithPaymentReason());
        $this->assertEquals('AAAAAAAAAA', $this->slipData->getPaymentReasonLine1());
        $this->assertEquals('BBBBBBBBBB', $this->slipData->getPaymentReasonLine2());
        $this->assertEquals('CCCCCCCCCC', $this->slipData->getPaymentReasonLine3());
        $this->assertEquals('DDDDDDDDDD', $this->slipData->getPaymentReasonLine4());

        $this->assertFalse($this->slipData->setWithPaymentReason(0));
        $this->assertTrue($this->slipData->getWithPaymentReason());
        $this->assertEquals('AAAAAAAAAA', $this->slipData->getPaymentReasonLine1());
        $this->assertEquals('BBBBBBBBBB', $this->slipData->getPaymentReasonLine2());
        $this->assertEquals('CCCCCCCCCC', $this->slipData->getPaymentReasonLine3());
        $this->assertEquals('DDDDDDDDDD', $this->slipData->getPaymentReasonLine4());

        $this->assertFalse($this->slipData->setWithPaymentReason('foo'));
        $this->assertTrue($this->slipData->getWithPaymentReason());

        $this->assertFalse($this->slipData->setWithPaymentReason(123));
        $this->assertTrue($this->slipData->getWithPaymentReason());

        $this->assertFalse($this->slipData->setWithPaymentReason(123.456));
        $this->assertTrue($this->slipData->getWithPaymentReason());

        $this->assertFalse($this->slipData->setWithPaymentReason(array(true)));
        $this->assertTrue($this->slipData->getWithPaymentReason());
    }

    /**
     *
     * @return void
     * @covers ::setBankData
     * @covers ::setBankName
     * @covers ::setBankCity
     * @covers ::getBankName
     * @covers ::getBankCity
     */
    public function testSetBankData()
    {
        $this->slipData = new SwissPaymentSlipData('orange');
        $this->assertTrue($this->slipData->setBankData('Seldwyla Bank', '8001 Zürich'));

        $this->assertEquals('Seldwyla Bank', $this->slipData->getBankName());
        $this->assertEquals('8001 Zürich', $this->slipData->getBankCity());

        $this->slipData->setWithBank(false);
        $this->assertFalse($this->slipData->setBankData('Seldwyla Bank', '8001 Zürich'));

        $this->assertEquals(false, $this->slipData->getBankName());
        $this->assertEquals(false, $this->slipData->getBankCity());
    }

    /**
     *
     * @return void
     * @covers ::setAccountNumber
     * @covers ::getAccountNumber
     */
    public function testSetAccountNumber()
    {
        $this->slipData = new SwissPaymentSlipData('orange');
        $this->assertTrue($this->slipData->setAccountNumber('01-2345-6'));

        $this->assertEquals('01-2345-6', $this->slipData->getAccountNumber());

        $this->slipData->setWithAccountNumber(false);
        $this->assertFalse($this->slipData->setAccountNumber('01-2345-6'));

        $this->assertEquals(false, $this->slipData->getAccountNumber());
    }

    /**
     *
     * @return void
     * @covers ::setRecipientData
     * @covers ::setRecipientLine1
     * @covers ::setRecipientLine2
     * @covers ::setRecipientLine3
     * @covers ::setRecipientLine4
     * @covers ::getRecipientLine1
     * @covers ::getRecipientLine2
     * @covers ::getRecipientLine3
     * @covers ::getRecipientLine4
     */
    public function testSetRecipientData()
    {
        $this->slipData = new SwissPaymentSlipData('orange');
        $this->assertTrue($this->slipData->setRecipientData('AAAAAAAAAA', 'BBBBBBBBBB', 'CCCCCCCCCC', 'DDDDDDDDDD'));

        $this->assertEquals('AAAAAAAAAA', $this->slipData->getRecipientLine1());
        $this->assertEquals('BBBBBBBBBB', $this->slipData->getRecipientLine2());
        $this->assertEquals('CCCCCCCCCC', $this->slipData->getRecipientLine3());
        $this->assertEquals('DDDDDDDDDD', $this->slipData->getRecipientLine4());

        $this->slipData->setWithRecipient(false);
        $this->assertFalse($this->slipData->setRecipientData('AAAAAAAAAA', 'BBBBBBBBBB', 'CCCCCCCCCC', 'DDDDDDDDDD'));

        $this->assertEquals(false, $this->slipData->getRecipientLine1());
        $this->assertEquals(false, $this->slipData->getRecipientLine2());
        $this->assertEquals(false, $this->slipData->getRecipientLine3());
        $this->assertEquals(false, $this->slipData->getRecipientLine4());
    }

    /**
     *
     * @return void
     * @covers ::setAmount
     * @covers ::getAmount
     */
    public function testSetAmount()
    {
        $this->slipData = new SwissPaymentSlipData('orange');
        $this->assertTrue($this->slipData->setAmount(1234567.89));

        $this->assertEquals(1234567.89, $this->slipData->getAmount());

        $this->slipData->setWithAmount(false);
        $this->assertFalse($this->slipData->setAmount(1234567.89));

        $this->assertEquals(false, $this->slipData->getAmount());
    }

    /**
     *
     * @return void
     * @covers ::setReferenceNumber
     * @covers ::getReferenceNumber
     */
    public function testSetReferenceNumber()
    {
        $this->slipData = new SwissPaymentSlipData('orange');
        $this->assertTrue($this->slipData->setReferenceNumber('0123456789'));

        $this->assertEquals('0123456789', $this->slipData->getReferenceNumber());

        $this->slipData->setWithReferenceNumber(false);
        $this->assertFalse($this->slipData->setReferenceNumber('0123456789'));

        $this->assertEquals(false, $this->slipData->getReferenceNumber());
    }

    /**
     *
     * @return void
     * @covers ::setBankingCustomerId
     * @covers ::getBankingCustomerId
     */
    public function testSetBankingCustomerId()
    {
        $this->slipData = new SwissPaymentSlipData('orange');
        $this->assertTrue($this->slipData->setBankingCustomerId('123456'));

        $this->assertEquals('123456', $this->slipData->getBankingCustomerId());

        $this->slipData->setWithBankingCustomerId(false);
        $this->assertFalse($this->slipData->setBankingCustomerId('123456'));

        $this->assertEquals(false, $this->slipData->getBankingCustomerId());
    }

    /**
     *
     * @return void
     * @covers ::setPayerData
     * @covers ::setPayerLine1
     * @covers ::setPayerLine2
     * @covers ::setPayerLine3
     * @covers ::setPayerLine4
     * @covers ::getPayerLine1
     * @covers ::getPayerLine2
     * @covers ::getPayerLine3
     * @covers ::getPayerLine4
     */
    public function testSetPayerData()
    {
        $this->slipData = new SwissPaymentSlipData('orange');
        $this->assertTrue($this->slipData->setPayerData('AAAAAAAAAA', 'BBBBBBBBBB', 'CCCCCCCCCC', 'DDDDDDDDDD'));

        $this->assertEquals('AAAAAAAAAA', $this->slipData->getPayerLine1());
        $this->assertEquals('BBBBBBBBBB', $this->slipData->getPayerLine2());
        $this->assertEquals('CCCCCCCCCC', $this->slipData->getPayerLine3());
        $this->assertEquals('DDDDDDDDDD', $this->slipData->getPayerLine4());

        $this->slipData->setWithPayer(false);
        $this->assertFalse($this->slipData->setPayerData('AAAAAAAAAA', 'BBBBBBBBBB', 'CCCCCCCCCC', 'DDDDDDDDDD'));

        $this->assertEquals(false, $this->slipData->getPayerLine1());
        $this->assertEquals(false, $this->slipData->getPayerLine2());
        $this->assertEquals(false, $this->slipData->getPayerLine3());
        $this->assertEquals(false, $this->slipData->getPayerLine4());
    }

    /**
     *
     * @return void
     * @covers ::setIban
     * @covers ::getIban
     */
    public function testSetIban()
    {
        $this->slipData = new SwissPaymentSlipData('red');
        $this->assertTrue($this->slipData->setIban('CH380123456789'));

        $this->assertEquals('CH380123456789', $this->slipData->getIban());

        $this->slipData->setWithIban(false);
        $this->assertFalse($this->slipData->setIban('CH380123456789'));

        $this->assertEquals(false, $this->slipData->getIban());
    }

    /**
     *
     * @return void
     * @covers ::setPaymentReasonData
     * @covers ::setPaymentReasonLine1
     * @covers ::setPaymentReasonLine2
     * @covers ::setPaymentReasonLine3
     * @covers ::setPaymentReasonLine4
     * @covers ::getPaymentReasonLine1
     * @covers ::getPaymentReasonLine2
     * @covers ::getPaymentReasonLine3
     * @covers ::getPaymentReasonLine4
     */
    public function testSetPaymentReasonData()
    {
        $this->slipData = new SwissPaymentSlipData('red');
        $this->assertTrue(
            $this->slipData->setPaymentReasonData('AAAAAAAAAA', 'BBBBBBBBBB', 'CCCCCCCCCC', 'DDDDDDDDDD')
        );

        $this->assertEquals('AAAAAAAAAA', $this->slipData->getPaymentReasonLine1());
        $this->assertEquals('BBBBBBBBBB', $this->slipData->getPaymentReasonLine2());
        $this->assertEquals('CCCCCCCCCC', $this->slipData->getPaymentReasonLine3());
        $this->assertEquals('DDDDDDDDDD', $this->slipData->getPaymentReasonLine4());

        $this->slipData->setWithPaymentReason(false);
        $this->assertFalse(
            $this->slipData->setPaymentReasonData('AAAAAAAAAA', 'BBBBBBBBBB', 'CCCCCCCCCC', 'DDDDDDDDDD')
        );

        $this->assertEquals(false, $this->slipData->getPaymentReasonLine1());
        $this->assertEquals(false, $this->slipData->getPaymentReasonLine2());
        $this->assertEquals(false, $this->slipData->getPaymentReasonLine3());
        $this->assertEquals(false, $this->slipData->getPaymentReasonLine4());
    }

    /**
     *
     * @return void
     * @covers ::getCompleteReferenceNumber
     * @covers ::breakStringIntoBlocks
     * @covers ::modulo10
     */
    public function testGetCompleteReferenceNumberOrangeType()
    {
        $this->slipData->setReferenceNumber('7520033455900012');
        $this->slipData->setBankingCustomerId('215703');

        $this->assertEquals('21 57030 00075 20033 45590 00126', $this->slipData->getCompleteReferenceNumber());
        $this->assertEquals('215703000075200334559000126', $this->slipData->getCompleteReferenceNumber(false));
        $this->assertEquals('21 57030 00075 20033 45590 00126', $this->slipData->getCompleteReferenceNumber(true, false));

        $this->slipData->setWithBankingCustomerId(false);

        $this->assertEquals('00 00000 00075 20033 45590 00129', $this->slipData->getCompleteReferenceNumber());
        $this->assertEquals('000000000075200334559000129', $this->slipData->getCompleteReferenceNumber(false));
        $this->assertEquals('75 20033 45590 00129', $this->slipData->getCompleteReferenceNumber(true, false));

        $this->slipData->setWithReferenceNumber(false);

        $this->assertEquals(false, $this->slipData->getCompleteReferenceNumber());
        $this->assertEquals(false, $this->slipData->getCompleteReferenceNumber(false));
        $this->assertEquals(false, $this->slipData->getCompleteReferenceNumber(true, false));
    }

    /**
     *
     * @return void
     * @covers ::getCompleteReferenceNumber
     * @covers ::breakStringIntoBlocks
     * @covers ::modulo10
     * @todo Implement testGetCompleteReferenceNumberOrangeType
     */
    public function testGetCompleteReferenceNumberRedType()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     *
     * @return void
     * @covers ::getFormattedIban
     */
    public function testGetFormattedIban()
    {
        $this->slipData = new SwissPaymentSlipData('red');
        $this->slipData->setIban('CH3808888123456789012');

        $this->assertEquals('CH3808888123456789012', $this->slipData->getIban());
        $this->assertEquals('CH38 0888 8123 4567 8901 2', $this->slipData->getFormattedIban());

        $this->slipData->setWithIban(false);
        $this->assertEquals(false, $this->slipData->getFormattedIban());
    }

    /**
     *
     * @return void
     * @covers ::getCodeLine
     * @covers ::modulo10
     * @covers ::getAccountDigits
     */
    public function testGetCodeLineNoTypeSpecified()
    {
        $this->slipData->setAccountNumber('01-145-6');
        $this->slipData->setAmount(2830.50);
        $this->slipData->setReferenceNumber('7520033455900012');
        $this->slipData->setBankingCustomerId('215703');

        $this->assertEquals(
            '0100002830509>215703000075200334559000126+ 010001456>',
            $this->slipData->getCodeLine()
        );
        $this->assertEquals(
            '0100002830509>215703000075200334559000126+ 010001456>',
            $this->slipData->getCodeLine(false)
        );

        $this->slipData->setReferenceNumber('123456789');
        $this->slipData->setBankingCustomerId('1234');

        $this->assertEquals(
            '0100002830509>001234000000000001234567892+ 010001456>',
            $this->slipData->getCodeLine()
        );
        $this->assertEquals(
            '0100002830509>1234000000000001234567892+ 010001456>',
            $this->slipData->getCodeLine(false)
        );

        $this->slipData->setWithBankingCustomerId(false);

        $this->assertEquals(
            '0100002830509>000000000000000001234567894+ 010001456>',
            $this->slipData->getCodeLine()
        );
        $this->assertEquals(
            '0100002830509>1234567894+ 010001456>',
            $this->slipData->getCodeLine(false)
        );

        $this->slipData->setAmount(0.0);

        $this->assertEquals(
            '0100000000005>000000000000000001234567894+ 010001456>',
            $this->slipData->getCodeLine()
        );
        $this->assertEquals(
            '0100000000005>1234567894+ 010001456>',
            $this->slipData->getCodeLine(false)
        );

        $this->slipData->setWithAmount(false);

        $this->assertEquals(
            '042>000000000000000001234567894+ 010001456>',
            $this->slipData->getCodeLine()
        );
        $this->assertEquals(
            '042>1234567894+ 010001456>',
            $this->slipData->getCodeLine(false)
        );
    }

    /**
     *
     * @return void
     * @covers ::getCodeLine
     * @covers ::modulo10
     * @covers ::getAccountDigits
     */
    public function testGetCodeLineOrangeType()
    {
        $this->slipData = new SwissPaymentSlipData('orange');
        $this->slipData->setAccountNumber('01-145-6');
        $this->slipData->setAmount(2830.50);
        $this->slipData->setReferenceNumber('7520033455900012');
        $this->slipData->setBankingCustomerId('215703');

        $this->assertEquals(
            '0100002830509>215703000075200334559000126+ 010001456>',
            $this->slipData->getCodeLine()
        );
        $this->assertEquals(
            '0100002830509>215703000075200334559000126+ 010001456>',
            $this->slipData->getCodeLine(false)
        );

        $this->slipData->setReferenceNumber('123456789');
        $this->slipData->setBankingCustomerId('1234');

        $this->assertEquals(
            '0100002830509>001234000000000001234567892+ 010001456>',
            $this->slipData->getCodeLine()
        );
        $this->assertEquals(
            '0100002830509>1234000000000001234567892+ 010001456>',
            $this->slipData->getCodeLine(false)
        );

        $this->slipData->setWithBankingCustomerId(false);

        $this->assertEquals(
            '0100002830509>000000000000000001234567894+ 010001456>',
            $this->slipData->getCodeLine()
        );
        $this->assertEquals(
            '0100002830509>1234567894+ 010001456>',
            $this->slipData->getCodeLine(false)
        );

        $this->slipData->setAmount(0.0);

        $this->assertEquals(
            '0100000000005>000000000000000001234567894+ 010001456>',
            $this->slipData->getCodeLine()
        );
        $this->assertEquals(
            '0100000000005>1234567894+ 010001456>',
            $this->slipData->getCodeLine(false)
        );

        $this->slipData->setWithAmount(false);

        $this->assertEquals(
            '042>000000000000000001234567894+ 010001456>',
            $this->slipData->getCodeLine()
        );
        $this->assertEquals(
            '042>1234567894+ 010001456>',
            $this->slipData->getCodeLine(false)
        );
    }

    /**
     *
     * @return void
     * @covers ::getCodeLine
     * @covers ::modulo10
     * @covers ::getAccountDigits
     * @todo Implement testGetCodeLineRedType
     */
    public function testGetCodeLineRedType()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     *
     * @return void
     * @covers ::getCodeLine
     * @covers ::modulo10
     * @covers ::getAccountDigits
     */
    public function testGetCodeLineWithInvalidPreconditions()
    {
        $this->slipData->setAmount(2830.50);
        $this->slipData->setReferenceNumber('7520033455900012');
        $this->slipData->setBankingCustomerId('215703');

        $this->slipData->setAccountNumber('123456789');

        $this->assertEquals(false, $this->slipData->getCodeLine());
        $this->assertEquals(false, $this->slipData->getCodeLine(false));

        $this->slipData->setAccountNumber('01-145-6');
        $this->slipData->setWithAccountNumber(false);

        $this->assertEquals(false, $this->slipData->getCodeLine());
        $this->assertEquals(false, $this->slipData->getCodeLine(false));

        $this->slipData->setWithAccountNumber(true);
        $this->slipData->setAccountNumber('01-145-6');
        $this->slipData->setWithReferenceNumber(false);

        $this->assertEquals(false, $this->slipData->getCodeLine());
        $this->assertEquals(false, $this->slipData->getCodeLine(false));
    }

    /**
     *
     * @return void
     * @covers ::getAmountFrancs
     */
    public function testGetAmountFrancs()
    {
        $this->assertTrue($this->slipData->setAmount(1234567.89));
        $this->assertEquals(1234567, $this->slipData->getAmountFrancs());

        $this->assertTrue($this->slipData->setAmount(0.0));
        $this->assertEquals(0, $this->slipData->getAmountFrancs());

        $this->slipData->setWithAmount(false);
        $this->assertFalse($this->slipData->getAmountFrancs());
    }

    /**
     *
     * @return void
     * @covers ::getAmountCents
     */
    public function testGetAmountCents()
    {
        $this->assertTrue($this->slipData->setAmount(1234567.89));
        $this->assertEquals(89, $this->slipData->getAmountCents());

        $this->assertTrue($this->slipData->setAmount(0.0));
        $this->assertEquals(0, $this->slipData->getAmountCents());

        $this->slipData->setWithAmount(false);
        $this->assertFalse($this->slipData->getAmountCents());
    }

    /**
     *
     * @return void
     * @covers ::setNotForPayment
     * @covers ::getNotForPayment
     */
    public function testSetNotForPayment()
    {
        $this->slipData->setNotForPayment(true);
        $this->assertTrue($this->slipData->getNotForPayment());

        $this->assertEquals('XXXXXX', $this->slipData->getBankName());
        $this->assertEquals('XXXXXX', $this->slipData->getBankCity());

        $this->assertEquals('XXXXXX', $this->slipData->getRecipientLine1());
        $this->assertEquals('XXXXXX', $this->slipData->getRecipientLine2());
        $this->assertEquals('XXXXXX', $this->slipData->getRecipientLine3());
        $this->assertEquals('XXXXXX', $this->slipData->getRecipientLine4());

        $this->assertEquals('XXXXXX', $this->slipData->getAccountNumber());

        $this->assertEquals('XXXXXXXX.XX', $this->slipData->getAmount());
        $this->assertEquals('XXXXXXXX', $this->slipData->getAmountFrancs());
        $this->assertEquals('XX', $this->slipData->getAmountCents());

        $this->assertEquals('XXXXXXXXXXXXXXXXXXXX', $this->slipData->getReferenceNumber());
        $this->assertEquals('XXXXXXXXXXXXXXXXXXXXXXXXXXX', $this->slipData->getCompleteReferenceNumber(false));
        $this->assertEquals('XX XXXXX XXXXX XXXXX XXXXX XXXXX', $this->slipData->getCompleteReferenceNumber());

        $this->assertEquals('XXXXXX', $this->slipData->getPayerLine1());
        $this->assertEquals('XXXXXX', $this->slipData->getPayerLine2());
        $this->assertEquals('XXXXXX', $this->slipData->getPayerLine3());
        $this->assertEquals('XXXXXX', $this->slipData->getPayerLine4());

        $this->assertEquals('XXXXXXXXXXXXX>XXXXXXXXXXXXXXXXXXXXXXXXXXX+ XXXXXXXXX>', $this->slipData->getCodeLine());
    }
}
