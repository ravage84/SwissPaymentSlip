<?php
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
     * @var SwissPaymentSlipData
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
	 *
	 * @return void
     */
    protected function setUp()
    {
        $this->object = new SwissPaymentSlipData;
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
	 * @covers ::__construct
	 * @covers :setType
	 *
	 * @return void
	 */
	public function testIsInstanceOf()
	{
		$this->assertInstanceOf('SwissPaymentSlip\SwissPaymentSlip\SwissPaymentSlipData', new SwissPaymentSlipData());
		$this->assertInstanceOf('SwissPaymentSlip\SwissPaymentSlip\SwissPaymentSlipData', new SwissPaymentSlipData('orange'));
		$this->assertInstanceOf('SwissPaymentSlip\SwissPaymentSlip\SwissPaymentSlipData', new SwissPaymentSlipData('red'));

		$this->assertInstanceOf('SwissPaymentSlip\SwissPaymentSlip\SwissPaymentSlipData', new SwissPaymentSlipData('orange', true));
		$this->assertInstanceOf('SwissPaymentSlip\SwissPaymentSlip\SwissPaymentSlipData', new SwissPaymentSlipData('orange', false));
		$this->assertInstanceOf('SwissPaymentSlip\SwissPaymentSlip\SwissPaymentSlipData', new SwissPaymentSlipData('red', true));
		$this->assertInstanceOf('SwissPaymentSlip\SwissPaymentSlip\SwissPaymentSlipData', new SwissPaymentSlipData('red', false));
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
	 *
	 * @return void
	 * @covers ::setType
	 * @covers ::getType
	 */
	public function testSetTypeNoTypeSpecified()
	{
		$this->assertTrue($this->object->setType());
		$this->assertEquals('orange', $this->object->getType());

		$this->assertTrue($this->object->getWithBank());
		$this->assertTrue($this->object->getWithAccountNumber());
		$this->assertTrue($this->object->getWithRecipient());
		$this->assertTrue($this->object->getWithAmount());
		$this->assertTrue($this->object->getWithReferenceNumber());
		$this->assertTrue($this->object->getWithBankingCustomerId());
		$this->assertTrue($this->object->getWithPayer());
		$this->assertFalse($this->object->getWithIban());
		$this->assertFalse($this->object->getWithPaymentReason());
	}

	/**
	 *
	 * @return void
	 * @covers ::setType
	 * @covers ::getType
	 */
	public function testSetTypeOrangeType()
	{
		$this->assertTrue($this->object->setType('orange'));
		$this->assertEquals('orange', $this->object->getType());

		$this->assertTrue($this->object->getWithBank());
		$this->assertTrue($this->object->getWithAccountNumber());
		$this->assertTrue($this->object->getWithRecipient());
		$this->assertTrue($this->object->getWithAmount());
		$this->assertTrue($this->object->getWithReferenceNumber());
		$this->assertTrue($this->object->getWithBankingCustomerId());
		$this->assertTrue($this->object->getWithPayer());
		$this->assertFalse($this->object->getWithIban());
		$this->assertFalse($this->object->getWithPaymentReason());
	}

	/**
	 *
	 * @return void
	 * @covers ::setType
	 * @covers ::getType
	 * @covers ::setRedDefaults
	 */
	public function testSetTypeRedType()
	{
		$this->assertTrue($this->object->setType('red'));
		$this->assertEquals('red', $this->object->getType());

		$this->assertTrue($this->object->getWithBank());
		$this->assertTrue($this->object->getWithAccountNumber());
		$this->assertTrue($this->object->getWithRecipient());
		$this->assertTrue($this->object->getWithAmount());
		$this->assertFalse($this->object->getWithReferenceNumber());
		$this->assertFalse($this->object->getWithBankingCustomerId());
		$this->assertTrue($this->object->getWithPayer());
		$this->assertTrue($this->object->getWithIban());
		$this->assertTrue($this->object->getWithPaymentReason());
	}

	/**
	 *
	 * @return void
	 * @covers ::setType
	 */
	public function testSetTypeOrangeTypeWithoutReset()
	{
		$this->object->setWithBank(false);
		$this->object->setWithAccountNumber(false);
		$this->object->setWithRecipient(false);
		$this->object->setWithAmount(false);
		$this->object->setWithReferenceNumber(false);
		$this->object->setWithBankingCustomerId(false);
		$this->object->setWithPayer(false);
		$this->object->setWithIban(true);; // Shouldn't set to true
		$this->object->setWithPaymentReason(true); // Shouldn't set to true

		$this->assertTrue($this->object->setType('orange'));

		$this->assertFalse($this->object->getWithBank());
		$this->assertFalse($this->object->getWithAccountNumber());
		$this->assertFalse($this->object->getWithRecipient());
		$this->assertFalse($this->object->getWithAmount());
		$this->assertFalse($this->object->getWithReferenceNumber());
		$this->assertFalse($this->object->getWithBankingCustomerId());
		$this->assertFalse($this->object->getWithPayer());
		$this->assertFalse($this->object->getWithIban());
		$this->assertFalse($this->object->getWithPaymentReason());
	}

	/**
	 *
	 * @return void
	 * @covers ::setType
	 */
	public function testSetTypeRedTypeWithoutReset()
	{
		$this->object = new SwissPaymentSlipData('red');

		$this->object->setWithBank(false);
		$this->object->setWithAccountNumber(false);
		$this->object->setWithRecipient(false);
		$this->object->setWithAmount(false);
		$this->object->setWithReferenceNumber(true); // Shouldn't set to true
		$this->object->setWithBankingCustomerId(true); // Shouldn't set to true
		$this->object->setWithPayer(false);
		$this->object->setWithIban(false);
		$this->object->setWithPaymentReason(false);

		$this->assertTrue($this->object->setType('red'));

		$this->assertFalse($this->object->getWithBank());
		$this->assertFalse($this->object->getWithAccountNumber());
		$this->assertFalse($this->object->getWithRecipient());
		$this->assertFalse($this->object->getWithAmount());
		$this->assertFalse($this->object->getWithReferenceNumber());
		$this->assertFalse($this->object->getWithBankingCustomerId());
		$this->assertFalse($this->object->getWithPayer());
		$this->assertFalse($this->object->getWithIban());
		$this->assertFalse($this->object->getWithPaymentReason());
	}

	/**
	 *
	 * @return void
	 * @covers ::setType
	 * @covers ::setOrangeDefaults
	 */
	public function testSetTypeOrangeTypeWithReset()
	{
		$this->object->setWithBank(false);
		$this->object->setWithAccountNumber(false);
		$this->object->setWithRecipient(false);
		$this->object->setWithAmount(false);
		$this->object->setWithReferenceNumber(false);
		$this->object->setWithBankingCustomerId(false);
		$this->object->setWithPayer(false);
		$this->object->setWithIban(true);;
		$this->object->setWithPaymentReason(true);

		$this->assertTrue($this->object->setType('orange', true));

		$this->assertTrue($this->object->getWithBank());
		$this->assertTrue($this->object->getWithAccountNumber());
		$this->assertTrue($this->object->getWithRecipient());
		$this->assertTrue($this->object->getWithAmount());
		$this->assertTrue($this->object->getWithReferenceNumber());
		$this->assertTrue($this->object->getWithBankingCustomerId());
		$this->assertTrue($this->object->getWithPayer());
		$this->assertFalse($this->object->getWithIban());
		$this->assertFalse($this->object->getWithPaymentReason());
	}

	/**
	 *
	 * @return void
	 * @covers ::setType
	 * @covers ::setRedDefaults
	 */
	public function testSetTypeRedTypeWithReset()
	{
		$this->object->setWithBank(false);
		$this->object->setWithAccountNumber(false);
		$this->object->setWithRecipient(false);
		$this->object->setWithAmount(false);
		$this->object->setWithReferenceNumber(true);
		$this->object->setWithBankingCustomerId(true);
		$this->object->setWithPayer(false);
		$this->object->setWithIban(false);
		$this->object->setWithPaymentReason(false);

		$this->assertTrue($this->object->setType('red', true));

		$this->assertTrue($this->object->getWithBank());
		$this->assertTrue($this->object->getWithAccountNumber());
		$this->assertTrue($this->object->getWithRecipient());
		$this->assertTrue($this->object->getWithAmount());
		$this->assertFalse($this->object->getWithReferenceNumber());
		$this->assertFalse($this->object->getWithBankingCustomerId());
		$this->assertTrue($this->object->getWithPayer());
		$this->assertTrue($this->object->getWithIban());
		$this->assertTrue($this->object->getWithPaymentReason());
	}

	/**
	 *
	 * @return void
	 * @covers ::setType
	 * @expectedException \InvalidArgumentException
	 */
	public function testSetTypeFirstParameterIsEmptyString()
	{
		$this->object->setType('');
	}

	/**
	 *
	 * @return void
	 * @covers ::setType
	 * @expectedException \InvalidArgumentException
	 */
	public function testSetTypeFirstParameterIsInvalidString()
	{
		$this->object->setType('123');
	}

	/**
	 *
	 * @return void
	 * @covers ::setType
	 * @expectedException \InvalidArgumentException
	 */
	public function testSetTypeFirstParameterIsArray()
	{
		$this->object->setType(array('red'));
	}

	/**
	 *
	 * @return void
	 * @covers ::setType
	 * @expectedException \InvalidArgumentException
	 */
	public function testSetTypeSecondParameterIsEmptyString()
	{
		$this->object->setType('orange', '');
	}

	/**
	 *
	 * @return void
	 * @covers ::setType
	 * @expectedException \InvalidArgumentException
	 */
	public function testSetTypeSecondParameterIsInvalidString()
	{
		$this->object->setType('red', '123');
	}

	/**
	 *
	 * @return void
	 * @covers ::setType
	 * @expectedException \InvalidArgumentException
	 */
	public function testSetTypeSecondParameterIsArray()
	{
		$this->object->setType('red', array(true));
	}

    /**
	 *
	 * @return void
     * @covers ::setWithBank
	 * @covers ::getWithBank
     */
    public function testSetWithBankNoTypeSpecified()
    {
		$this->object->setBankData('Seldwyla Bank', '8001 Zürich');

		$this->assertTrue($this->object->setWithBank());
		$this->assertTrue($this->object->getWithBank());
		$this->assertEquals('Seldwyla Bank', $this->object->getBankName());
		$this->assertEquals('8001 Zürich', $this->object->getBankCity());

		$this->assertTrue($this->object->setWithBank(true));
		$this->assertTrue($this->object->getWithBank());
		$this->assertEquals('Seldwyla Bank', $this->object->getBankName());
		$this->assertEquals('8001 Zürich', $this->object->getBankCity());

		$this->assertTrue($this->object->setWithBank(false));
		$this->assertFalse($this->object->getWithBank());
		$this->assertEquals(false, $this->object->getBankName());
		$this->assertEquals(false, $this->object->getBankCity());
    }

	/**
	 *
	 * @return void
	 * @covers ::setWithBank
	 * @covers ::getWithBank
	 */
	public function testSetWithBankOrangeType()
	{
		$this->object = new SwissPaymentSlipData('orange');
		$this->object->setBankData('Seldwyla Bank', '8001 Zürich');

		$this->assertTrue($this->object->setWithBank());
		$this->assertTrue($this->object->getWithBank());
		$this->assertEquals('Seldwyla Bank', $this->object->getBankName());
		$this->assertEquals('8001 Zürich', $this->object->getBankCity());

		$this->assertTrue($this->object->setWithBank(true));
		$this->assertTrue($this->object->getWithBank());
		$this->assertEquals('Seldwyla Bank', $this->object->getBankName());
		$this->assertEquals('8001 Zürich', $this->object->getBankCity());

		$this->assertTrue($this->object->setWithBank(false));
		$this->assertFalse($this->object->getWithBank());
		$this->assertEquals(false, $this->object->getBankName());
		$this->assertEquals(false, $this->object->getBankCity());
	}

	/**
	 *
	 * @return void
	 * @covers ::setWithBank
	 * @covers ::getWithBank
	 */
	public function testSetWithBankRedType()
	{
		$this->object = new SwissPaymentSlipData('red');
		$this->object->setBankData('Seldwyla Bank', '8001 Zürich');

		$this->assertTrue($this->object->setWithBank());
		$this->assertTrue($this->object->getWithBank());
		$this->assertEquals('Seldwyla Bank', $this->object->getBankName());
		$this->assertEquals('8001 Zürich', $this->object->getBankCity());

		$this->assertTrue($this->object->setWithBank(true));
		$this->assertTrue($this->object->getWithBank());
		$this->assertEquals('Seldwyla Bank', $this->object->getBankName());
		$this->assertEquals('8001 Zürich', $this->object->getBankCity());

		$this->assertTrue($this->object->setWithBank(false));
		$this->assertFalse($this->object->getWithBank());
		$this->assertEquals(false, $this->object->getBankName());
		$this->assertEquals(false, $this->object->getBankCity());
	}

	/**
	 *
	 * @return void
	 * @covers ::setWithBank
	 * @covers ::getWithBank
	 */
	public function testSetWithBankParameters()
	{
		$this->object->setBankData('Seldwyla Bank', '8001 Zürich');

		$this->assertFalse($this->object->setWithBank(1));
		$this->assertTrue($this->object->getWithBank());
		$this->assertEquals('Seldwyla Bank', $this->object->getBankName());
		$this->assertEquals('8001 Zürich', $this->object->getBankCity());

		$this->assertFalse($this->object->setWithBank(0));
		$this->assertTrue($this->object->getWithBank());
		$this->assertEquals('Seldwyla Bank', $this->object->getBankName());
		$this->assertEquals('8001 Zürich', $this->object->getBankCity());

		$this->assertFalse($this->object->setWithBank('foo'));
		$this->assertTrue($this->object->getWithBank());

		$this->assertFalse($this->object->setWithBank(123));
		$this->assertTrue($this->object->getWithBank());

		$this->assertFalse($this->object->setWithBank(123.456));
		$this->assertTrue($this->object->getWithBank());

		$this->assertFalse($this->object->setWithBank(array(true)));
		$this->assertTrue($this->object->getWithBank());
	}

	/**
	 *
	 * @return void
	 * @covers ::setWithAccountNumber
	 * @covers ::getWithAccountNumber
	 */
	public function testSetWithAccountNumberNoTypeSpecified()
	{
		$this->object->setAccountNumber('01-2345-6');

		$this->assertTrue($this->object->setWithAccountNumber());
		$this->assertTrue($this->object->getWithAccountNumber());
		$this->assertEquals('01-2345-6', $this->object->getAccountNumber());

		$this->assertTrue($this->object->setWithAccountNumber(true));
		$this->assertTrue($this->object->getWithAccountNumber());
		$this->assertEquals('01-2345-6', $this->object->getAccountNumber());

		$this->assertTrue($this->object->setWithAccountNumber(false));
		$this->assertFalse($this->object->getWithAccountNumber());
		$this->assertEquals(false, $this->object->getAccountNumber());
	}

	/**
	 *
	 * @return void
	 * @covers ::setWithAccountNumber
	 * @covers ::getWithAccountNumber
	 */
	public function testSetWithAccountNumberOrangeType()
	{
		$this->object = new SwissPaymentSlipData('orange');
		$this->object->setAccountNumber('01-2345-6');

		$this->assertTrue($this->object->setWithAccountNumber());
		$this->assertTrue($this->object->getWithAccountNumber());
		$this->assertEquals('01-2345-6', $this->object->getAccountNumber());

		$this->assertTrue($this->object->setWithAccountNumber(true));
		$this->assertTrue($this->object->getWithAccountNumber());
		$this->assertEquals('01-2345-6', $this->object->getAccountNumber());

		$this->assertTrue($this->object->setWithAccountNumber(false));
		$this->assertFalse($this->object->getWithAccountNumber());
		$this->assertEquals(false, $this->object->getAccountNumber());
	}

	/**
	 *
	 * @return void
	 * @covers ::setWithAccountNumber
	 * @covers ::getWithAccountNumber
	 */
	public function testSetWithAccountNumberRedType()
	{
		$this->object = new SwissPaymentSlipData('red');
		$this->object->setAccountNumber('01-2345-6');

		$this->assertTrue($this->object->setWithAccountNumber());
		$this->assertTrue($this->object->getWithAccountNumber());
		$this->assertEquals('01-2345-6', $this->object->getAccountNumber());

		$this->assertTrue($this->object->setWithAccountNumber(true));
		$this->assertTrue($this->object->getWithAccountNumber());
		$this->assertEquals('01-2345-6', $this->object->getAccountNumber());

		$this->assertTrue($this->object->setWithAccountNumber(false));
		$this->assertFalse($this->object->getWithAccountNumber());
		$this->assertEquals(false, $this->object->getAccountNumber());
	}

	/**
	 *
	 * @return void
	 * @covers ::setWithAccountNumber
	 * @covers ::getWithAccountNumber
	 */
	public function testSetWithAccountNumberParameters()
	{
		$this->object->setAccountNumber('01-2345-6');

		$this->assertFalse($this->object->setWithAccountNumber(1));
		$this->assertTrue($this->object->getWithAccountNumber());
		$this->assertEquals('01-2345-6', $this->object->getAccountNumber());

		$this->assertFalse($this->object->setWithAccountNumber(0));
		$this->assertTrue($this->object->getWithAccountNumber());
		$this->assertEquals('01-2345-6', $this->object->getAccountNumber());

		$this->assertFalse($this->object->setWithAccountNumber('foo'));
		$this->assertTrue($this->object->getWithAccountNumber());

		$this->assertFalse($this->object->setWithAccountNumber(123));
		$this->assertTrue($this->object->getWithAccountNumber());

		$this->assertFalse($this->object->setWithAccountNumber(123.456));
		$this->assertTrue($this->object->getWithAccountNumber());

		$this->assertFalse($this->object->setWithAccountNumber(array(true)));
		$this->assertTrue($this->object->getWithAccountNumber());
	}

	/**
	 *
	 * @return void
	 * @covers ::setWithRecipient
	 * @covers ::getWithRecipient
	 */
	public function testSetWithRecipientNoTypeSpecified()
	{
		$this->object->setRecipientData('AAAAAAAAAA', 'BBBBBBBBBB', 'CCCCCCCCCC', 'DDDDDDDDDD');

		$this->assertTrue($this->object->setWithRecipient());
		$this->assertTrue($this->object->getWithRecipient());
		$this->assertEquals('AAAAAAAAAA', $this->object->getRecipientLine1());
		$this->assertEquals('BBBBBBBBBB', $this->object->getRecipientLine2());
		$this->assertEquals('CCCCCCCCCC', $this->object->getRecipientLine3());
		$this->assertEquals('DDDDDDDDDD', $this->object->getRecipientLine4());

		$this->assertTrue($this->object->setWithRecipient(true));
		$this->assertTrue($this->object->getWithRecipient());
		$this->assertEquals('AAAAAAAAAA', $this->object->getRecipientLine1());
		$this->assertEquals('BBBBBBBBBB', $this->object->getRecipientLine2());
		$this->assertEquals('CCCCCCCCCC', $this->object->getRecipientLine3());
		$this->assertEquals('DDDDDDDDDD', $this->object->getRecipientLine4());

		$this->assertTrue($this->object->setWithRecipient(false));
		$this->assertFalse($this->object->getWithRecipient());
		$this->assertEquals(false, $this->object->getRecipientLine1());
		$this->assertEquals(false, $this->object->getRecipientLine2());
		$this->assertEquals(false, $this->object->getRecipientLine3());
		$this->assertEquals(false, $this->object->getRecipientLine4());
	}

	/**
	 *
	 * @return void
	 * @covers ::setWithRecipient
	 * @covers ::getWithRecipient
	 */
	public function testSetWithRecipientOrangeType()
	{
		$this->object = new SwissPaymentSlipData('orange');
		$this->object->setRecipientData('AAAAAAAAAA', 'BBBBBBBBBB', 'CCCCCCCCCC', 'DDDDDDDDDD');

		$this->assertTrue($this->object->setWithRecipient());
		$this->assertTrue($this->object->getWithRecipient());
		$this->assertEquals('AAAAAAAAAA', $this->object->getRecipientLine1());
		$this->assertEquals('BBBBBBBBBB', $this->object->getRecipientLine2());
		$this->assertEquals('CCCCCCCCCC', $this->object->getRecipientLine3());
		$this->assertEquals('DDDDDDDDDD', $this->object->getRecipientLine4());

		$this->assertTrue($this->object->setWithRecipient(true));
		$this->assertTrue($this->object->getWithRecipient());
		$this->assertEquals('AAAAAAAAAA', $this->object->getRecipientLine1());
		$this->assertEquals('BBBBBBBBBB', $this->object->getRecipientLine2());
		$this->assertEquals('CCCCCCCCCC', $this->object->getRecipientLine3());
		$this->assertEquals('DDDDDDDDDD', $this->object->getRecipientLine4());

		$this->assertTrue($this->object->setWithRecipient(false));
		$this->assertFalse($this->object->getWithRecipient());
		$this->assertEquals(false, $this->object->getRecipientLine1());
		$this->assertEquals(false, $this->object->getRecipientLine2());
		$this->assertEquals(false, $this->object->getRecipientLine3());
		$this->assertEquals(false, $this->object->getRecipientLine4());
	}

	/**
	 *
	 * @return void
	 * @covers ::setWithRecipient
	 * @covers ::getWithRecipient
	 */
	public function testSetWithRecipientRedType()
	{
		$this->object = new SwissPaymentSlipData('red');
		$this->object->setRecipientData('AAAAAAAAAA', 'BBBBBBBBBB', 'CCCCCCCCCC', 'DDDDDDDDDD');

		$this->assertTrue($this->object->setWithRecipient());
		$this->assertTrue($this->object->getWithRecipient());
		$this->assertEquals('AAAAAAAAAA', $this->object->getRecipientLine1());
		$this->assertEquals('BBBBBBBBBB', $this->object->getRecipientLine2());
		$this->assertEquals('CCCCCCCCCC', $this->object->getRecipientLine3());
		$this->assertEquals('DDDDDDDDDD', $this->object->getRecipientLine4());

		$this->assertTrue($this->object->setWithRecipient(true));
		$this->assertTrue($this->object->getWithRecipient());
		$this->assertEquals('AAAAAAAAAA', $this->object->getRecipientLine1());
		$this->assertEquals('BBBBBBBBBB', $this->object->getRecipientLine2());
		$this->assertEquals('CCCCCCCCCC', $this->object->getRecipientLine3());
		$this->assertEquals('DDDDDDDDDD', $this->object->getRecipientLine4());

		$this->assertTrue($this->object->setWithRecipient(false));
		$this->assertFalse($this->object->getWithRecipient());
		$this->assertEquals(false, $this->object->getRecipientLine1());
		$this->assertEquals(false, $this->object->getRecipientLine2());
		$this->assertEquals(false, $this->object->getRecipientLine3());
		$this->assertEquals(false, $this->object->getRecipientLine4());
	}

	/**
	 *
	 * @return void
	 * @covers ::setWithRecipient
	 * @covers ::getWithRecipient
	 */
	public function testSetWithRecipientParameters()
	{
		$this->object->setRecipientData('AAAAAAAAAA', 'BBBBBBBBBB', 'CCCCCCCCCC', 'DDDDDDDDDD');

		$this->assertFalse($this->object->setWithRecipient(1));
		$this->assertTrue($this->object->getWithRecipient());
		$this->assertEquals('AAAAAAAAAA', $this->object->getRecipientLine1());
		$this->assertEquals('BBBBBBBBBB', $this->object->getRecipientLine2());
		$this->assertEquals('CCCCCCCCCC', $this->object->getRecipientLine3());
		$this->assertEquals('DDDDDDDDDD', $this->object->getRecipientLine4());

		$this->assertFalse($this->object->setWithRecipient(0));
		$this->assertTrue($this->object->getWithRecipient());
		$this->assertEquals('AAAAAAAAAA', $this->object->getRecipientLine1());
		$this->assertEquals('BBBBBBBBBB', $this->object->getRecipientLine2());
		$this->assertEquals('CCCCCCCCCC', $this->object->getRecipientLine3());
		$this->assertEquals('DDDDDDDDDD', $this->object->getRecipientLine4());

		$this->assertFalse($this->object->setWithRecipient('foo'));
		$this->assertTrue($this->object->getWithRecipient());

		$this->assertFalse($this->object->setWithRecipient(123));
		$this->assertTrue($this->object->getWithRecipient());

		$this->assertFalse($this->object->setWithRecipient(123.456));
		$this->assertTrue($this->object->getWithRecipient());

		$this->assertFalse($this->object->setWithRecipient(array(true)));
		$this->assertTrue($this->object->getWithRecipient());
	}

	/**
	 *
	 * @return void
	 * @covers ::setWithAmount
	 * @covers ::getWithAmount
	 */
	public function testSetWithAmountNoTypeSpecified()
	{
		$this->object->setAmount(1234567.89);

		$this->assertTrue($this->object->setWithAmount());
		$this->assertTrue($this->object->getWithAmount());
		$this->assertEquals(1234567.89, $this->object->getAmount());

		$this->assertTrue($this->object->setWithAmount(true));
		$this->assertTrue($this->object->getWithAmount());
		$this->assertEquals(1234567.89, $this->object->getAmount());

		$this->assertTrue($this->object->setWithAmount(false));
		$this->assertFalse($this->object->getWithAmount());
		$this->assertEquals(false, $this->object->getAmount());
	}

	/**
	 *
	 * @return void
	 * @covers ::setWithAmount
	 * @covers ::getWithAmount
	 */
	public function testSetWithAmountNumberOrangeType()
	{
		$this->object = new SwissPaymentSlipData('orange');
		$this->object->setAmount(1234567.89);

		$this->assertTrue($this->object->setWithAmount());
		$this->assertTrue($this->object->getWithAmount());
		$this->assertEquals(1234567.89, $this->object->getAmount());

		$this->assertTrue($this->object->setWithAmount(true));
		$this->assertTrue($this->object->getWithAmount());
		$this->assertEquals(1234567.89, $this->object->getAmount());

		$this->assertTrue($this->object->setWithAmount(false));
		$this->assertFalse($this->object->getWithAmount());
		$this->assertEquals(false, $this->object->getAmount());
	}

	/**
	 *
	 * @return void
	 * @covers ::setWithAmount
	 * @covers ::getWithAmount
	 */
	public function testSetWithAmountNumberRedType()
	{
		$this->object = new SwissPaymentSlipData('red');
		$this->object->setAmount(1234567.89);

		$this->assertTrue($this->object->setWithAmount());
		$this->assertTrue($this->object->getWithAmount());
		$this->assertEquals(1234567.89, $this->object->getAmount());

		$this->assertTrue($this->object->setWithAmount(true));
		$this->assertTrue($this->object->getWithAmount());
		$this->assertEquals(1234567.89, $this->object->getAmount());

		$this->assertTrue($this->object->setWithAmount(false));
		$this->assertFalse($this->object->getWithAmount());
		$this->assertEquals(false, $this->object->getAmount());
	}

	/**
	 *
	 * @return void
	 * @covers ::setWithAmount
	 * @covers ::getWithAmount
	 */
	public function testSetWithAmountNumberParameters()
	{
		$this->object->setAmount(1234567.89);

		$this->assertFalse($this->object->setWithAmount(1));
		$this->assertTrue($this->object->getWithAmount());
		$this->assertEquals(1234567.89, $this->object->getAmount());

		$this->assertFalse($this->object->setWithAmount(0));
		$this->assertTrue($this->object->getWithAmount());
		$this->assertEquals(1234567.89, $this->object->getAmount());

		$this->assertFalse($this->object->setWithAmount('foo'));
		$this->assertTrue($this->object->getWithAmount());

		$this->assertFalse($this->object->setWithAmount(123));
		$this->assertTrue($this->object->getWithAmount());

		$this->assertFalse($this->object->setWithAmount(123.456));
		$this->assertTrue($this->object->getWithAmount());

		$this->assertFalse($this->object->setWithAmount(array(true)));
		$this->assertTrue($this->object->getWithAmount());
	}

	/**
	 *
	 * @return void
	 * @covers ::setWithReferenceNumber
	 * @covers ::getWithReferenceNumber
	 */
	public function testSetWithReferenceNumberNoTypeSpecified()
	{
		$this->object->setReferenceNumber('0123456789');

		$this->assertTrue($this->object->setWithReferenceNumber());
		$this->assertTrue($this->object->getWithReferenceNumber());
		$this->assertEquals('0123456789', $this->object->getReferenceNumber());

		$this->assertTrue($this->object->setWithReferenceNumber(true));
		$this->assertTrue($this->object->getWithReferenceNumber());
		$this->assertEquals('0123456789', $this->object->getReferenceNumber());

		$this->assertTrue($this->object->setWithReferenceNumber(false));
		$this->assertFalse($this->object->getWithReferenceNumber());
		$this->assertEquals(false, $this->object->getReferenceNumber());
	}

	/**
	 *
	 * @return void
	 * @covers ::setWithReferenceNumber
	 * @covers ::getWithReferenceNumber
	 */
	public function testSetWithReferenceNumberNumberOrangeType()
	{
		$this->object = new SwissPaymentSlipData('orange');
		$this->object->setReferenceNumber('0123456789');

		$this->assertTrue($this->object->setWithReferenceNumber());
		$this->assertTrue($this->object->getWithReferenceNumber());
		$this->assertEquals('0123456789', $this->object->getReferenceNumber());

		$this->assertTrue($this->object->setWithReferenceNumber(true));
		$this->assertTrue($this->object->getWithReferenceNumber());
		$this->assertEquals('0123456789', $this->object->getReferenceNumber());

		$this->assertTrue($this->object->setWithReferenceNumber(false));
		$this->assertFalse($this->object->getWithReferenceNumber());
		$this->assertEquals(false, $this->object->getReferenceNumber());
	}

	/**
	 *
	 * @return void
	 * @covers ::setWithReferenceNumber
	 * @covers ::getWithReferenceNumber
	 */
	public function testSetWithReferenceNumberNumberRedType()
	{
		$this->object = new SwissPaymentSlipData('red');
		$this->object->setReferenceNumber('0123456789');

		$this->assertFalse($this->object->setWithReferenceNumber());
		$this->assertFalse($this->object->getWithReferenceNumber());
		$this->assertEquals(false, $this->object->getReferenceNumber());

		$this->assertFalse($this->object->setWithReferenceNumber(true));
		$this->assertFalse($this->object->getWithReferenceNumber());
		$this->assertEquals(false, $this->object->getReferenceNumber());

		$this->assertFalse($this->object->setWithReferenceNumber(false));
		$this->assertFalse($this->object->getWithReferenceNumber());
		$this->assertEquals(false, $this->object->getReferenceNumber());
	}

	/**
	 *
	 * @return void
	 * @covers ::setWithReferenceNumber
	 * @covers ::getWithReferenceNumber
	 */
	public function testSetWithReferenceNumberNumberParameters()
	{
		$this->object->setReferenceNumber('0123456789');

		$this->assertFalse($this->object->setWithReferenceNumber(1));
		$this->assertTrue($this->object->getWithReferenceNumber());
		$this->assertEquals('0123456789', $this->object->getReferenceNumber());

		$this->assertFalse($this->object->setWithReferenceNumber(0));
		$this->assertTrue($this->object->getWithReferenceNumber());
		$this->assertEquals('0123456789', $this->object->getReferenceNumber());

		$this->assertFalse($this->object->setWithReferenceNumber('foo'));
		$this->assertTrue($this->object->getWithReferenceNumber());

		$this->assertFalse($this->object->setWithReferenceNumber(123));
		$this->assertTrue($this->object->getWithReferenceNumber());

		$this->assertFalse($this->object->setWithReferenceNumber(123.456));
		$this->assertTrue($this->object->getWithReferenceNumber());

		$this->assertFalse($this->object->setWithReferenceNumber(array(true)));
		$this->assertTrue($this->object->getWithReferenceNumber());
	}

	/**
	 *
	 * @return void
	 * @covers ::setWithBankingCustomerId
	 * @covers ::getWithBankingCustomerId
	 */
	public function testSetWithBankingCustomerIdNoTypeSpecified()
	{
		$this->object->setBankingCustomerId('012345');

		$this->assertTrue($this->object->setWithBankingCustomerId());
		$this->assertTrue($this->object->getWithBankingCustomerId());
		$this->assertEquals('012345', $this->object->getBankingCustomerId());

		$this->assertTrue($this->object->setWithBankingCustomerId(true));
		$this->assertTrue($this->object->getWithBankingCustomerId());
		$this->assertEquals('012345', $this->object->getBankingCustomerId());

		$this->assertTrue($this->object->setWithBankingCustomerId(false));
		$this->assertFalse($this->object->getWithBankingCustomerId());
		$this->assertEquals(false, $this->object->getBankingCustomerId());
	}

	/**
	 *
	 * @return void
	 * @covers ::setWithBankingCustomerId
	 * @covers ::getWithBankingCustomerId
	 */
	public function testSetWithBankingCustomerIdNumberOrangeType()
	{
		$this->object = new SwissPaymentSlipData('orange');
		$this->object->setBankingCustomerId('012345');

		$this->assertTrue($this->object->setWithBankingCustomerId());
		$this->assertTrue($this->object->getWithBankingCustomerId());
		$this->assertEquals('012345', $this->object->getBankingCustomerId());

		$this->assertTrue($this->object->setWithBankingCustomerId(true));
		$this->assertTrue($this->object->getWithBankingCustomerId());
		$this->assertEquals('012345', $this->object->getBankingCustomerId());

		$this->assertTrue($this->object->setWithBankingCustomerId(false));
		$this->assertFalse($this->object->getWithBankingCustomerId());
		$this->assertEquals(false, $this->object->getBankingCustomerId());
	}

	/**
	 *
	 * @return void
	 * @covers ::setWithBankingCustomerId
	 * @covers ::getWithBankingCustomerId
	 */
	public function testSetWithBankingCustomerIdNumberRedType()
	{
		$this->object = new SwissPaymentSlipData('red');
		$this->object->setBankingCustomerId('012345');

		$this->assertFalse($this->object->setWithBankingCustomerId());
		$this->assertFalse($this->object->getWithBankingCustomerId());
		$this->assertEquals(false, $this->object->getBankingCustomerId());

		$this->assertFalse($this->object->setWithBankingCustomerId(true));
		$this->assertFalse($this->object->getWithBankingCustomerId());
		$this->assertEquals(false, $this->object->getBankingCustomerId());

		$this->assertFalse($this->object->setWithBankingCustomerId(false));
		$this->assertFalse($this->object->getWithBankingCustomerId());
		$this->assertEquals(false, $this->object->getBankingCustomerId());
	}

	/**
	 *
	 * @return void
	 * @covers ::setWithBankingCustomerId
	 * @covers ::getWithBankingCustomerId
	 */
	public function testSetWithBankingCustomerIdNumberParameters()
	{
		$this->object->setBankingCustomerId('012345');

		$this->assertFalse($this->object->setWithBankingCustomerId(1));
		$this->assertTrue($this->object->getWithBankingCustomerId());
		$this->assertEquals('012345', $this->object->getBankingCustomerId());

		$this->assertFalse($this->object->setWithBankingCustomerId(0));
		$this->assertTrue($this->object->getWithBankingCustomerId());
		$this->assertEquals('012345', $this->object->getBankingCustomerId());

		$this->assertFalse($this->object->setWithBankingCustomerId('foo'));
		$this->assertTrue($this->object->getWithBankingCustomerId());

		$this->assertFalse($this->object->setWithBankingCustomerId(123));
		$this->assertTrue($this->object->getWithBankingCustomerId());

		$this->assertFalse($this->object->setWithBankingCustomerId(123.456));
		$this->assertTrue($this->object->getWithBankingCustomerId());

		$this->assertFalse($this->object->setWithBankingCustomerId(array(true)));
		$this->assertTrue($this->object->getWithBankingCustomerId());
	}

	/**
	 *
	 * @return void
	 * @covers ::setWithPayer
	 * @covers ::getWithPayer
	 */
	public function testSetWithPayerNoTypeSpecified()
	{
		$this->object->setPayerData('AAAAAAAAAA', 'BBBBBBBBBB', 'CCCCCCCCCC', 'DDDDDDDDDD');

		$this->assertTrue($this->object->setWithPayer());
		$this->assertTrue($this->object->getWithPayer());
		$this->assertEquals('AAAAAAAAAA', $this->object->getPayerLine1());
		$this->assertEquals('BBBBBBBBBB', $this->object->getPayerLine2());
		$this->assertEquals('CCCCCCCCCC', $this->object->getPayerLine3());
		$this->assertEquals('DDDDDDDDDD', $this->object->getPayerLine4());

		$this->assertTrue($this->object->setWithPayer(true));
		$this->assertTrue($this->object->getWithPayer());
		$this->assertEquals('AAAAAAAAAA', $this->object->getPayerLine1());
		$this->assertEquals('BBBBBBBBBB', $this->object->getPayerLine2());
		$this->assertEquals('CCCCCCCCCC', $this->object->getPayerLine3());
		$this->assertEquals('DDDDDDDDDD', $this->object->getPayerLine4());

		$this->assertTrue($this->object->setWithPayer(false));
		$this->assertFalse($this->object->getWithPayer());
		$this->assertEquals(false, $this->object->getPayerLine1());
		$this->assertEquals(false, $this->object->getPayerLine2());
		$this->assertEquals(false, $this->object->getPayerLine3());
		$this->assertEquals(false, $this->object->getPayerLine4());
	}

	/**
	 *
	 * @return void
	 * @covers ::setWithPayer
	 * @covers ::getWithPayer
	 */
	public function testSetWithPayerOrangeType()
	{
		$this->object = new SwissPaymentSlipData('orange');
		$this->object->setPayerData('AAAAAAAAAA', 'BBBBBBBBBB', 'CCCCCCCCCC', 'DDDDDDDDDD');

		$this->assertTrue($this->object->setWithPayer());
		$this->assertTrue($this->object->getWithPayer());
		$this->assertEquals('AAAAAAAAAA', $this->object->getPayerLine1());
		$this->assertEquals('BBBBBBBBBB', $this->object->getPayerLine2());
		$this->assertEquals('CCCCCCCCCC', $this->object->getPayerLine3());
		$this->assertEquals('DDDDDDDDDD', $this->object->getPayerLine4());

		$this->assertTrue($this->object->setWithPayer(true));
		$this->assertTrue($this->object->getWithPayer());
		$this->assertEquals('AAAAAAAAAA', $this->object->getPayerLine1());
		$this->assertEquals('BBBBBBBBBB', $this->object->getPayerLine2());
		$this->assertEquals('CCCCCCCCCC', $this->object->getPayerLine3());
		$this->assertEquals('DDDDDDDDDD', $this->object->getPayerLine4());

		$this->assertTrue($this->object->setWithPayer(false));
		$this->assertFalse($this->object->getWithPayer());
		$this->assertEquals(false, $this->object->getPayerLine1());
		$this->assertEquals(false, $this->object->getPayerLine2());
		$this->assertEquals(false, $this->object->getPayerLine3());
		$this->assertEquals(false, $this->object->getPayerLine4());
	}

	/**
	 *
	 * @return void
	 * @covers ::setWithPayer
	 * @covers ::getWithPayer
	 */
	public function testSetWithPayerRedType()
	{
		$this->object = new SwissPaymentSlipData('red');
		$this->object->setPayerData('AAAAAAAAAA', 'BBBBBBBBBB', 'CCCCCCCCCC', 'DDDDDDDDDD');

		$this->assertTrue($this->object->setWithPayer());
		$this->assertTrue($this->object->getWithPayer());
		$this->assertEquals('AAAAAAAAAA', $this->object->getPayerLine1());
		$this->assertEquals('BBBBBBBBBB', $this->object->getPayerLine2());
		$this->assertEquals('CCCCCCCCCC', $this->object->getPayerLine3());
		$this->assertEquals('DDDDDDDDDD', $this->object->getPayerLine4());

		$this->assertTrue($this->object->setWithPayer(true));
		$this->assertTrue($this->object->getWithPayer());
		$this->assertEquals('AAAAAAAAAA', $this->object->getPayerLine1());
		$this->assertEquals('BBBBBBBBBB', $this->object->getPayerLine2());
		$this->assertEquals('CCCCCCCCCC', $this->object->getPayerLine3());
		$this->assertEquals('DDDDDDDDDD', $this->object->getPayerLine4());

		$this->assertTrue($this->object->setWithPayer(false));
		$this->assertFalse($this->object->getWithPayer());
		$this->assertEquals(false, $this->object->getPayerLine1());
		$this->assertEquals(false, $this->object->getPayerLine2());
		$this->assertEquals(false, $this->object->getPayerLine3());
		$this->assertEquals(false, $this->object->getPayerLine4());
	}

	/**
	 *
	 * @return void
	 * @covers ::setWithPayer
	 * @covers ::getWithPayer
	 */
	public function testSetWithPayerParameters()
	{
		$this->object->setPayerData('AAAAAAAAAA', 'BBBBBBBBBB', 'CCCCCCCCCC', 'DDDDDDDDDD');

		$this->assertFalse($this->object->setWithPayer(1));
		$this->assertTrue($this->object->getWithPayer());
		$this->assertEquals('AAAAAAAAAA', $this->object->getPayerLine1());
		$this->assertEquals('BBBBBBBBBB', $this->object->getPayerLine2());
		$this->assertEquals('CCCCCCCCCC', $this->object->getPayerLine3());
		$this->assertEquals('DDDDDDDDDD', $this->object->getPayerLine4());

		$this->assertFalse($this->object->setWithPayer(0));
		$this->assertTrue($this->object->getWithPayer());
		$this->assertEquals('AAAAAAAAAA', $this->object->getPayerLine1());
		$this->assertEquals('BBBBBBBBBB', $this->object->getPayerLine2());
		$this->assertEquals('CCCCCCCCCC', $this->object->getPayerLine3());
		$this->assertEquals('DDDDDDDDDD', $this->object->getPayerLine4());

		$this->assertFalse($this->object->setWithPayer('foo'));
		$this->assertTrue($this->object->getWithPayer());

		$this->assertFalse($this->object->setWithPayer(123));
		$this->assertTrue($this->object->getWithPayer());

		$this->assertFalse($this->object->setWithPayer(123.456));
		$this->assertTrue($this->object->getWithPayer());

		$this->assertFalse($this->object->setWithPayer(array(true)));
		$this->assertTrue($this->object->getWithPayer());
	}

	/**
	 *
	 * @return void
	 * @covers ::setWithIban
	 * @covers ::getWithIban
	 */
	public function testSetWithIbanNoTypeSpecified()
	{
		$this->object->setIban('CH380123456789');

		$this->assertFalse($this->object->setWithIban());
		$this->assertFalse($this->object->getWithIban());
		$this->assertEquals(false, $this->object->getIban());

		$this->assertFalse($this->object->setWithIban(true));
		$this->assertFalse($this->object->getWithIban());
		$this->assertEquals(false, $this->object->getIban());

		$this->assertFalse($this->object->setWithIban(false));
		$this->assertFalse($this->object->getWithIban());
		$this->assertEquals(false, $this->object->getIban());
	}

	/**
	 *
	 * @return void
	 * @covers ::setWithIban
	 * @covers ::getWithIban
	 */
	public function testSetWithIbanNumberOrangeType()
	{
		$this->object = new SwissPaymentSlipData('orange');
		$this->object->setIban('CH380123456789');

		$this->assertFalse($this->object->setWithIban());
		$this->assertFalse($this->object->getWithIban());
		$this->assertEquals(false, $this->object->getIban());

		$this->assertFalse($this->object->setWithIban(true));
		$this->assertFalse($this->object->getWithIban());
		$this->assertEquals(false, $this->object->getIban());

		$this->assertFalse($this->object->setWithIban(false));
		$this->assertFalse($this->object->getWithIban());
		$this->assertEquals(false, $this->object->getIban());
	}

	/**
	 *
	 * @return void
	 * @covers ::setWithIban
	 * @covers ::getWithIban
	 */
	public function testSetWithIbanNumberRedType()
	{
		$this->object = new SwissPaymentSlipData('red');
		$this->object->setIban('CH380123456789');

		$this->assertTrue($this->object->setWithIban(true));
		$this->assertTrue($this->object->getWithIban());
		$this->assertEquals('CH380123456789', $this->object->getIban());

		$this->assertTrue($this->object->setWithIban());
		$this->assertFalse($this->object->getWithIban());
		$this->assertEquals(false, $this->object->getIban());

		$this->assertTrue($this->object->setWithIban(false));
		$this->assertFalse($this->object->getWithIban());
		$this->assertEquals(false, $this->object->getIban());
	}

	/**
	 *
	 * @return void
	 * @covers ::setWithIban
	 * @covers ::getWithIban
	 */
	public function testSetWithIbanNumberParameters()
	{
		$this->object = new SwissPaymentSlipData('red');
		$this->object->setIban('CH380123456789');

		$this->assertFalse($this->object->setWithIban(1));
		$this->assertTrue($this->object->getWithIban());
		$this->assertEquals('CH380123456789', $this->object->getIban());

		$this->assertFalse($this->object->setWithIban(0));
		$this->assertTrue($this->object->getWithIban());
		$this->assertEquals('CH380123456789', $this->object->getIban());

		$this->assertFalse($this->object->setWithIban('foo'));
		$this->assertTrue($this->object->getWithIban());

		$this->assertFalse($this->object->setWithIban(123));
		$this->assertTrue($this->object->getWithIban());

		$this->assertFalse($this->object->setWithIban(123.456));
		$this->assertTrue($this->object->getWithIban());

		$this->assertFalse($this->object->setWithIban(array(true)));
		$this->assertTrue($this->object->getWithIban());
	}

	/**
	 *
	 * @return void
	 * @covers ::setWithPaymentReason
	 * @covers ::getWithPaymentReason
	 */
	public function testSetWithPaymentReasonNoTypeSpecified()
	{
		$this->object->setPaymentReasonData('AAAAAAAAAA', 'BBBBBBBBBB', 'CCCCCCCCCC', 'DDDDDDDDDD');

		$this->assertFalse($this->object->setWithPaymentReason());
		$this->assertFalse($this->object->getWithPaymentReason());
		$this->assertEquals(false, $this->object->getPaymentReasonLine1());
		$this->assertEquals(false, $this->object->getPaymentReasonLine2());
		$this->assertEquals(false, $this->object->getPaymentReasonLine3());
		$this->assertEquals(false, $this->object->getPaymentReasonLine4());

		$this->assertFalse($this->object->setWithPaymentReason(true));
		$this->assertFalse($this->object->getWithPaymentReason());
		$this->assertEquals(false, $this->object->getPaymentReasonLine1());
		$this->assertEquals(false, $this->object->getPaymentReasonLine2());
		$this->assertEquals(false, $this->object->getPaymentReasonLine3());
		$this->assertEquals(false, $this->object->getPaymentReasonLine4());

		$this->assertFalse($this->object->setWithPaymentReason(false));
		$this->assertFalse($this->object->getWithPaymentReason());
		$this->assertEquals(false, $this->object->getPaymentReasonLine1());
		$this->assertEquals(false, $this->object->getPaymentReasonLine2());
		$this->assertEquals(false, $this->object->getPaymentReasonLine3());
		$this->assertEquals(false, $this->object->getPaymentReasonLine4());
	}

	/**
	 *
	 * @return void
	 * @covers ::setWithPaymentReason
	 * @covers ::getWithPaymentReason
	 */
	public function testSetWithPaymentReasonOrangeType()
	{
		$this->object = new SwissPaymentSlipData('orange');
		$this->object->setPaymentReasonData('AAAAAAAAAA', 'BBBBBBBBBB', 'CCCCCCCCCC', 'DDDDDDDDDD');

		$this->assertFalse($this->object->setWithPaymentReason());
		$this->assertFalse($this->object->getWithPaymentReason());
		$this->assertEquals(false, $this->object->getPaymentReasonLine1());
		$this->assertEquals(false, $this->object->getPaymentReasonLine2());
		$this->assertEquals(false, $this->object->getPaymentReasonLine3());
		$this->assertEquals(false, $this->object->getPaymentReasonLine4());

		$this->assertFalse($this->object->setWithPaymentReason(true));
		$this->assertFalse($this->object->getWithPaymentReason());
		$this->assertEquals(false, $this->object->getPaymentReasonLine1());
		$this->assertEquals(false, $this->object->getPaymentReasonLine2());
		$this->assertEquals(false, $this->object->getPaymentReasonLine3());
		$this->assertEquals(false, $this->object->getPaymentReasonLine4());

		$this->assertFalse($this->object->setWithPaymentReason(false));
		$this->assertFalse($this->object->getWithPaymentReason());
		$this->assertEquals(false, $this->object->getPaymentReasonLine1());
		$this->assertEquals(false, $this->object->getPaymentReasonLine2());
		$this->assertEquals(false, $this->object->getPaymentReasonLine3());
		$this->assertEquals(false, $this->object->getPaymentReasonLine4());
	}

	/**
	 *
	 * @return void
	 * @covers ::setWithPaymentReason
	 * @covers ::getWithPaymentReason
	 */
	public function testSetWithPaymentReasonRedType()
	{
		$this->object = new SwissPaymentSlipData('red');
		$this->object->setPaymentReasonData('AAAAAAAAAA', 'BBBBBBBBBB', 'CCCCCCCCCC', 'DDDDDDDDDD');

		$this->assertTrue($this->object->setWithPaymentReason(true));
		$this->assertTrue($this->object->getWithPaymentReason());
		$this->assertEquals('AAAAAAAAAA', $this->object->getPaymentReasonLine1());
		$this->assertEquals('BBBBBBBBBB', $this->object->getPaymentReasonLine2());
		$this->assertEquals('CCCCCCCCCC', $this->object->getPaymentReasonLine3());
		$this->assertEquals('DDDDDDDDDD', $this->object->getPaymentReasonLine4());

		$this->assertTrue($this->object->setWithPaymentReason());
		$this->assertFalse($this->object->getWithPaymentReason());
		$this->assertEquals(false, $this->object->getPaymentReasonLine1());
		$this->assertEquals(false, $this->object->getPaymentReasonLine2());
		$this->assertEquals(false, $this->object->getPaymentReasonLine3());
		$this->assertEquals(false, $this->object->getPaymentReasonLine4());

		$this->assertTrue($this->object->setWithPaymentReason(false));
		$this->assertFalse($this->object->getWithPaymentReason());
		$this->assertEquals(false, $this->object->getPaymentReasonLine1());
		$this->assertEquals(false, $this->object->getPaymentReasonLine2());
		$this->assertEquals(false, $this->object->getPaymentReasonLine3());
		$this->assertEquals(false, $this->object->getPaymentReasonLine4());
	}

	/**
	 *
	 * @return void
	 * @covers ::setWithPaymentReason
	 * @covers ::getWithPaymentReason
	 */
	public function testSetWithPaymentReasonParameters()
	{
		$this->object = new SwissPaymentSlipData('red');
		$this->object->setPaymentReasonData('AAAAAAAAAA', 'BBBBBBBBBB', 'CCCCCCCCCC', 'DDDDDDDDDD');

		$this->assertFalse($this->object->setWithPaymentReason(1));
		$this->assertTrue($this->object->getWithPaymentReason());
		$this->assertEquals('AAAAAAAAAA', $this->object->getPaymentReasonLine1());
		$this->assertEquals('BBBBBBBBBB', $this->object->getPaymentReasonLine2());
		$this->assertEquals('CCCCCCCCCC', $this->object->getPaymentReasonLine3());
		$this->assertEquals('DDDDDDDDDD', $this->object->getPaymentReasonLine4());

		$this->assertFalse($this->object->setWithPaymentReason(0));
		$this->assertTrue($this->object->getWithPaymentReason());
		$this->assertEquals('AAAAAAAAAA', $this->object->getPaymentReasonLine1());
		$this->assertEquals('BBBBBBBBBB', $this->object->getPaymentReasonLine2());
		$this->assertEquals('CCCCCCCCCC', $this->object->getPaymentReasonLine3());
		$this->assertEquals('DDDDDDDDDD', $this->object->getPaymentReasonLine4());

		$this->assertFalse($this->object->setWithPaymentReason('foo'));
		$this->assertTrue($this->object->getWithPaymentReason());

		$this->assertFalse($this->object->setWithPaymentReason(123));
		$this->assertTrue($this->object->getWithPaymentReason());

		$this->assertFalse($this->object->setWithPaymentReason(123.456));
		$this->assertTrue($this->object->getWithPaymentReason());

		$this->assertFalse($this->object->setWithPaymentReason(array(true)));
		$this->assertTrue($this->object->getWithPaymentReason());
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
		$this->object = new SwissPaymentSlipData('orange');
		$this->assertTrue($this->object->setBankData('Seldwyla Bank', '8001 Zürich'));

		$this->assertEquals('Seldwyla Bank', $this->object->getBankName());
		$this->assertEquals('8001 Zürich', $this->object->getBankCity());

		$this->object->setWithBank(false);
		$this->assertFalse($this->object->setBankData('Seldwyla Bank', '8001 Zürich'));

		$this->assertEquals(false, $this->object->getBankName());
		$this->assertEquals(false, $this->object->getBankCity());
    }

	/**
	 *
	 * @return void
	 * @covers ::setAccountNumber
	 * @covers ::getAccountNumber
	 */
	public function testSetAccountNumber()
	{
		$this->object = new SwissPaymentSlipData('orange');
		$this->assertTrue($this->object->setAccountNumber('01-2345-6'));

		$this->assertEquals('01-2345-6', $this->object->getAccountNumber());

		$this->object->setWithAccountNumber(false);
		$this->assertFalse($this->object->setAccountNumber('01-2345-6'));

		$this->assertEquals(false, $this->object->getAccountNumber());
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
		$this->object = new SwissPaymentSlipData('orange');
		$this->assertTrue($this->object->setRecipientData('AAAAAAAAAA', 'BBBBBBBBBB', 'CCCCCCCCCC', 'DDDDDDDDDD'));

		$this->assertEquals('AAAAAAAAAA', $this->object->getRecipientLine1());
		$this->assertEquals('BBBBBBBBBB', $this->object->getRecipientLine2());
		$this->assertEquals('CCCCCCCCCC', $this->object->getRecipientLine3());
		$this->assertEquals('DDDDDDDDDD', $this->object->getRecipientLine4());

		$this->object->setWithRecipient(false);
		$this->assertFalse($this->object->setRecipientData('AAAAAAAAAA', 'BBBBBBBBBB', 'CCCCCCCCCC', 'DDDDDDDDDD'));

		$this->assertEquals(false, $this->object->getRecipientLine1());
		$this->assertEquals(false, $this->object->getRecipientLine2());
		$this->assertEquals(false, $this->object->getRecipientLine3());
		$this->assertEquals(false, $this->object->getRecipientLine4());
	}

	/**
	 *
	 * @return void
	 * @covers ::setAmount
	 * @covers ::getAmount
	 */
	public function testSetAmount()
	{
		$this->object = new SwissPaymentSlipData('orange');
		$this->assertTrue($this->object->setAmount(1234567.89));

		$this->assertEquals(1234567.89, $this->object->getAmount());

		$this->object->setWithAmount(false);
		$this->assertFalse($this->object->setAmount(1234567.89));

		$this->assertEquals(false, $this->object->getAmount());
	}

	/**
	 *
	 * @return void
	 * @covers ::setReferenceNumber
	 * @covers ::getReferenceNumber
	 */
	public function testSetReferenceNumber()
	{
		$this->object = new SwissPaymentSlipData('orange');
		$this->assertTrue($this->object->setReferenceNumber('0123456789'));

		$this->assertEquals('0123456789', $this->object->getReferenceNumber());

		$this->object->setWithReferenceNumber(false);
		$this->assertFalse($this->object->setReferenceNumber('0123456789'));

		$this->assertEquals(false, $this->object->getReferenceNumber());
	}

	/**
	 *
	 * @return void
	 * @covers ::setBankingCustomerId
	 * @covers ::getBankingCustomerId
	 */
	public function testSetBankingCustomerId()
	{
		$this->object = new SwissPaymentSlipData('orange');
		$this->assertTrue($this->object->setBankingCustomerId('123456'));

		$this->assertEquals('123456', $this->object->getBankingCustomerId());

		$this->object->setWithBankingCustomerId(false);
		$this->assertFalse($this->object->setBankingCustomerId('123456'));

		$this->assertEquals(false, $this->object->getBankingCustomerId());
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
		$this->object = new SwissPaymentSlipData('orange');
		$this->assertTrue($this->object->setPayerData('AAAAAAAAAA', 'BBBBBBBBBB', 'CCCCCCCCCC', 'DDDDDDDDDD'));

		$this->assertEquals('AAAAAAAAAA', $this->object->getPayerLine1());
		$this->assertEquals('BBBBBBBBBB', $this->object->getPayerLine2());
		$this->assertEquals('CCCCCCCCCC', $this->object->getPayerLine3());
		$this->assertEquals('DDDDDDDDDD', $this->object->getPayerLine4());

		$this->object->setWithPayer(false);
		$this->assertFalse($this->object->setPayerData('AAAAAAAAAA', 'BBBBBBBBBB', 'CCCCCCCCCC', 'DDDDDDDDDD'));

		$this->assertEquals(false, $this->object->getPayerLine1());
		$this->assertEquals(false, $this->object->getPayerLine2());
		$this->assertEquals(false, $this->object->getPayerLine3());
		$this->assertEquals(false, $this->object->getPayerLine4());
	}

	/**
	 *
	 * @return void
	 * @covers ::setIban
	 * @covers ::getIban
	 */
	public function testSetIban()
	{
		$this->object = new SwissPaymentSlipData('red');
		$this->assertTrue($this->object->setIban('CH380123456789'));

		$this->assertEquals('CH380123456789', $this->object->getIban());

		$this->object->setWithIban(false);
		$this->assertFalse($this->object->setIban('CH380123456789'));

		$this->assertEquals(false, $this->object->getIban());
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
		$this->object = new SwissPaymentSlipData('red');
		$this->assertTrue($this->object->setPaymentReasonData('AAAAAAAAAA', 'BBBBBBBBBB', 'CCCCCCCCCC', 'DDDDDDDDDD'));

		$this->assertEquals('AAAAAAAAAA', $this->object->getPaymentReasonLine1());
		$this->assertEquals('BBBBBBBBBB', $this->object->getPaymentReasonLine2());
		$this->assertEquals('CCCCCCCCCC', $this->object->getPaymentReasonLine3());
		$this->assertEquals('DDDDDDDDDD', $this->object->getPaymentReasonLine4());

		$this->object->setWithPaymentReason(false);
		$this->assertFalse($this->object->setPaymentReasonData('AAAAAAAAAA', 'BBBBBBBBBB', 'CCCCCCCCCC', 'DDDDDDDDDD'));

		$this->assertEquals(false, $this->object->getPaymentReasonLine1());
		$this->assertEquals(false, $this->object->getPaymentReasonLine2());
		$this->assertEquals(false, $this->object->getPaymentReasonLine3());
		$this->assertEquals(false, $this->object->getPaymentReasonLine4());
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
		$this->object->setReferenceNumber('7520033455900012');
		$this->object->setBankingCustomerId('215703');

		$this->assertEquals('21 57030 00075 20033 45590 00126', $this->object->getCompleteReferenceNumber());
		$this->assertEquals('215703000075200334559000126', $this->object->getCompleteReferenceNumber(false));
		$this->assertEquals('21 57030 00075 20033 45590 00126', $this->object->getCompleteReferenceNumber(true, false));

		$this->object->setWithBankingCustomerId(false);

		$this->assertEquals('00 00000 00075 20033 45590 00129', $this->object->getCompleteReferenceNumber());
		$this->assertEquals('000000000075200334559000129', $this->object->getCompleteReferenceNumber(false));
		$this->assertEquals('75 20033 45590 00129', $this->object->getCompleteReferenceNumber(true, false));

		$this->object->setWithReferenceNumber(false);

		$this->assertEquals(false, $this->object->getCompleteReferenceNumber());
		$this->assertEquals(false, $this->object->getCompleteReferenceNumber(false));
		$this->assertEquals(false, $this->object->getCompleteReferenceNumber(true, false));
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
		$this->object = new SwissPaymentSlipData('red');
		$this->object->setIban('CH3808888123456789012');

		$this->assertEquals('CH3808888123456789012', $this->object->getIban());
		$this->assertEquals('CH38 0888 8123 4567 8901 2', $this->object->getFormattedIban());

		$this->object->setWithIban(false);
		$this->assertEquals(false, $this->object->getFormattedIban());
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
		$this->object->setAccountNumber('01-145-6');
		$this->object->setAmount(2830.50);
		$this->object->setReferenceNumber('7520033455900012');
		$this->object->setBankingCustomerId('215703');

		$this->assertEquals('0100002830509>215703000075200334559000126+ 010001456>',
			$this->object->getCodeLine());
		$this->assertEquals('0100002830509>215703000075200334559000126+ 010001456>',
			$this->object->getCodeLine(false));

		$this->object->setReferenceNumber('123456789');
		$this->object->setBankingCustomerId('1234');

		$this->assertEquals('0100002830509>001234000000000001234567892+ 010001456>',
			$this->object->getCodeLine());
		$this->assertEquals('0100002830509>1234000000000001234567892+ 010001456>',
			$this->object->getCodeLine(false));

		$this->object->setWithBankingCustomerId(false);

		$this->assertEquals('0100002830509>000000000000000001234567894+ 010001456>',
			$this->object->getCodeLine());
		$this->assertEquals('0100002830509>1234567894+ 010001456>',
			$this->object->getCodeLine(false));

		$this->object->setAmount(0.0);

		$this->assertEquals('0100000000005>000000000000000001234567894+ 010001456>',
			$this->object->getCodeLine());
		$this->assertEquals('0100000000005>1234567894+ 010001456>',
			$this->object->getCodeLine(false));

		$this->object->setWithAmount(false);

		$this->assertEquals('042>000000000000000001234567894+ 010001456>',
			$this->object->getCodeLine());
		$this->assertEquals('042>1234567894+ 010001456>',
			$this->object->getCodeLine(false));
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
		$this->object = new SwissPaymentSlipData('orange');
		$this->object->setAccountNumber('01-145-6');
		$this->object->setAmount(2830.50);
		$this->object->setReferenceNumber('7520033455900012');
		$this->object->setBankingCustomerId('215703');

		$this->assertEquals('0100002830509>215703000075200334559000126+ 010001456>',
			$this->object->getCodeLine());
		$this->assertEquals('0100002830509>215703000075200334559000126+ 010001456>',
			$this->object->getCodeLine(false));

		$this->object->setReferenceNumber('123456789');
		$this->object->setBankingCustomerId('1234');

		$this->assertEquals('0100002830509>001234000000000001234567892+ 010001456>',
			$this->object->getCodeLine());
		$this->assertEquals('0100002830509>1234000000000001234567892+ 010001456>',
			$this->object->getCodeLine(false));

		$this->object->setWithBankingCustomerId(false);

		$this->assertEquals('0100002830509>000000000000000001234567894+ 010001456>',
			$this->object->getCodeLine());
		$this->assertEquals('0100002830509>1234567894+ 010001456>',
			$this->object->getCodeLine(false));

		$this->object->setAmount(0.0);

		$this->assertEquals('0100000000005>000000000000000001234567894+ 010001456>',
			$this->object->getCodeLine());
		$this->assertEquals('0100000000005>1234567894+ 010001456>',
			$this->object->getCodeLine(false));

		$this->object->setWithAmount(false);

		$this->assertEquals('042>000000000000000001234567894+ 010001456>',
			$this->object->getCodeLine());
		$this->assertEquals('042>1234567894+ 010001456>',
			$this->object->getCodeLine(false));
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
		$this->object->setAmount(2830.50);
		$this->object->setReferenceNumber('7520033455900012');
		$this->object->setBankingCustomerId('215703');

		$this->object->setAccountNumber('123456789');

		$this->assertEquals(false, $this->object->getCodeLine());
		$this->assertEquals(false, $this->object->getCodeLine(false));

		$this->object->setAccountNumber('01-145-6');
		$this->object->setWithAccountNumber(false);

		$this->assertEquals(false, $this->object->getCodeLine());
		$this->assertEquals(false, $this->object->getCodeLine(false));

		$this->object->setWithAccountNumber(true);
		$this->object->setAccountNumber('01-145-6');
		$this->object->setWithReferenceNumber(false);

		$this->assertEquals(false, $this->object->getCodeLine());
		$this->assertEquals(false, $this->object->getCodeLine(false));
    }

    /**
	 *
	 * @return void
     * @covers ::getAmountFrancs
     */
    public function testGetAmountFrancs()
    {
		$this->assertTrue($this->object->setAmount(1234567.89));
		$this->assertEquals(1234567, $this->object->getAmountFrancs());

		$this->assertTrue($this->object->setAmount(0.0));
		$this->assertEquals(0, $this->object->getAmountFrancs());

		$this->object->setWithAmount(false);
		$this->assertFalse($this->object->getAmountFrancs());
    }

    /**
	 *
	 * @return void
     * @covers ::getAmountCents
     */
    public function testGetAmountCents()
    {
		$this->assertTrue($this->object->setAmount(1234567.89));
		$this->assertEquals(89, $this->object->getAmountCents());

		$this->assertTrue($this->object->setAmount(0.0));
		$this->assertEquals(0, $this->object->getAmountCents());

		$this->object->setWithAmount(false);
		$this->assertFalse($this->object->getAmountCents());
    }

	/**
	 *
	 * @return void
	 * @covers ::getNotForPayment
	 */
	public function testSetNotForPayment() {
		$this->object->setNotForPayment(true);
		$this->assertTrue($this->object->getNotForPayment());

		$this->assertEquals('XXXXXX', $this->object->getBankName());
		$this->assertEquals('XXXXXX', $this->object->getBankCity());

		$this->assertEquals('XXXXXX', $this->object->getRecipientLine1());
		$this->assertEquals('XXXXXX', $this->object->getRecipientLine2());
		$this->assertEquals('XXXXXX', $this->object->getRecipientLine3());
		$this->assertEquals('XXXXXX', $this->object->getRecipientLine4());

		$this->assertEquals('XXXXXX', $this->object->getAccountNumber());

		$this->assertEquals('XXXXXXXX.XX', $this->object->getAmount());
		$this->assertEquals('XXXXXXXX', $this->object->getAmountFrancs());
		$this->assertEquals('XX', $this->object->getAmountCents());

		$this->assertEquals('XXXXXXXXXXXXXXXXXXXX', $this->object->getReferenceNumber());
		$this->assertEquals('XXXXXXXXXXXXXXXXXXXXXXXXXXX', $this->object->getCompleteReferenceNumber(false));
		$this->assertEquals('XX XXXXX XXXXX XXXXX XXXXX XXXXX', $this->object->getCompleteReferenceNumber());

		$this->assertEquals('XXXXXX', $this->object->getPayerLine1());
		$this->assertEquals('XXXXXX', $this->object->getPayerLine2());
		$this->assertEquals('XXXXXX', $this->object->getPayerLine3());
		$this->assertEquals('XXXXXX', $this->object->getPayerLine4());

		$this->assertEquals('XXXXXXXXXXXXX>XXXXXXXXXXXXXXXXXXXXXXXXXXX+ XXXXXXXXX>', $this->object->getCodeLine());
	}
}
