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

use SwissPaymentSlip\SwissPaymentSlip\OrangePaymentSlipData;

/**
 * Tests for the OrangePaymentSlipData class
 *
 * @coversDefaultClass SwissPaymentSlip\SwissPaymentSlip\OrangePaymentSlipData
 */
class OrangePaymentSlipDataTest extends \PHPUnit_Framework_TestCase
{
    /**
     * The object under test
     *
     * @var OrangePaymentSlipData
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
        $this->slipData = new OrangePaymentSlipData;
    }

    /**
     * Tests the setWithBank method with an orange slip
     *
     * @return void
     * @covers ::setWithBank
     * @covers ::getWithBank
     */
    public function testSetWithBankOrangeType()
    {
        $this->slipData = new OrangePaymentSlipData('orange');
        $this->slipData->setBankData('Seldwyla Bank', '8001 Zürich');

        $this->slipData->setWithBank();
        $this->assertTrue($this->slipData->getWithBank());
        $this->assertEquals('Seldwyla Bank', $this->slipData->getBankName());
        $this->assertEquals('8001 Zürich', $this->slipData->getBankCity());

        $this->slipData->setWithBank(true);
        $this->assertTrue($this->slipData->getWithBank());
        $this->assertEquals('Seldwyla Bank', $this->slipData->getBankName());
        $this->assertEquals('8001 Zürich', $this->slipData->getBankCity());

        $this->slipData->setWithBank(false);
        $this->assertFalse($this->slipData->getWithBank());
        $this->assertEquals(false, $this->slipData->getBankName());
        $this->assertEquals(false, $this->slipData->getBankCity());
    }

    /**
     * Tests the setWithBank method with various parameters
     *
     * @return void
     * @covers ::setWithBank
     * @covers ::getWithBank
     */
    public function testSetWithBankParameters()
    {
        $this->slipData->setBankData('Seldwyla Bank', '8001 Zürich');

        $this->slipData->setWithBank(1);
        $this->assertTrue($this->slipData->getWithBank());
        $this->assertEquals('Seldwyla Bank', $this->slipData->getBankName());
        $this->assertEquals('8001 Zürich', $this->slipData->getBankCity());

        $this->slipData->setWithBank(0);
        $this->assertTrue($this->slipData->getWithBank());
        $this->assertEquals('Seldwyla Bank', $this->slipData->getBankName());
        $this->assertEquals('8001 Zürich', $this->slipData->getBankCity());

        $this->slipData->setWithBank('foo');
        $this->assertTrue($this->slipData->getWithBank());

        $this->slipData->setWithBank(123);
        $this->assertTrue($this->slipData->getWithBank());

        $this->slipData->setWithBank(123.456);
        $this->assertTrue($this->slipData->getWithBank());

        $this->slipData->setWithBank(array(true));
        $this->assertTrue($this->slipData->getWithBank());
    }

    /**
     * Tests the setWithAccountNumber method with an orange slip
     *
     * @return void
     * @covers ::setWithAccountNumber
     * @covers ::getWithAccountNumber
     */
    public function testSetWithAccountNumberOrangeType()
    {
        $this->slipData = new OrangePaymentSlipData('orange');
        $this->slipData->setAccountNumber('01-2345-6');

        $this->slipData->setWithAccountNumber();
        $this->assertTrue($this->slipData->getWithAccountNumber());
        $this->assertEquals('01-2345-6', $this->slipData->getAccountNumber());

        $this->slipData->setWithAccountNumber(true);
        $this->assertTrue($this->slipData->getWithAccountNumber());
        $this->assertEquals('01-2345-6', $this->slipData->getAccountNumber());

        $this->slipData->setWithAccountNumber(false);
        $this->assertFalse($this->slipData->getWithAccountNumber());
        $this->assertEquals(false, $this->slipData->getAccountNumber());
    }

    /**
     * Tests the setWithAccountNumber method with various parameters
     *
     * @return void
     * @covers ::setWithAccountNumber
     * @covers ::getWithAccountNumber
     */
    public function testSetWithAccountNumberParameters()
    {
        $this->slipData->setAccountNumber('01-2345-6');

        $this->slipData->setWithAccountNumber(1);
        $this->assertTrue($this->slipData->getWithAccountNumber());
        $this->assertEquals('01-2345-6', $this->slipData->getAccountNumber());

        $this->slipData->setWithAccountNumber(0);
        $this->assertTrue($this->slipData->getWithAccountNumber());
        $this->assertEquals('01-2345-6', $this->slipData->getAccountNumber());

        $this->slipData->setWithAccountNumber('foo');
        $this->assertTrue($this->slipData->getWithAccountNumber());

        $this->slipData->setWithAccountNumber(123);
        $this->assertTrue($this->slipData->getWithAccountNumber());

        $this->slipData->setWithAccountNumber(123.456);
        $this->assertTrue($this->slipData->getWithAccountNumber());

        $this->slipData->setWithAccountNumber(array(true));
        $this->assertTrue($this->slipData->getWithAccountNumber());
    }

    /**
     * Tests the setWithRecipient method with an orange slip
     *
     * @return void
     * @covers ::setWithRecipient
     * @covers ::getWithRecipient
     */
    public function testSetWithRecipientOrangeType()
    {
        $this->slipData = new OrangePaymentSlipData('orange');
        $this->slipData->setRecipientData('AAAAAAAAAA', 'BBBBBBBBBB', 'CCCCCCCCCC', 'DDDDDDDDDD');

        $this->slipData->setWithRecipient();
        $this->assertTrue($this->slipData->getWithRecipient());
        $this->assertEquals('AAAAAAAAAA', $this->slipData->getRecipientLine1());
        $this->assertEquals('BBBBBBBBBB', $this->slipData->getRecipientLine2());
        $this->assertEquals('CCCCCCCCCC', $this->slipData->getRecipientLine3());
        $this->assertEquals('DDDDDDDDDD', $this->slipData->getRecipientLine4());

        $this->slipData->setWithRecipient(true);
        $this->assertTrue($this->slipData->getWithRecipient());
        $this->assertEquals('AAAAAAAAAA', $this->slipData->getRecipientLine1());
        $this->assertEquals('BBBBBBBBBB', $this->slipData->getRecipientLine2());
        $this->assertEquals('CCCCCCCCCC', $this->slipData->getRecipientLine3());
        $this->assertEquals('DDDDDDDDDD', $this->slipData->getRecipientLine4());

        $this->slipData->setWithRecipient(false);
        $this->assertFalse($this->slipData->getWithRecipient());
        $this->assertEquals(false, $this->slipData->getRecipientLine1());
        $this->assertEquals(false, $this->slipData->getRecipientLine2());
        $this->assertEquals(false, $this->slipData->getRecipientLine3());
        $this->assertEquals(false, $this->slipData->getRecipientLine4());
    }

    /**
     * Tests the setWithBank method with various parameters
     *
     * @return void
     * @covers ::setWithRecipient
     * @covers ::getWithRecipient
     */
    public function testSetWithRecipientParameters()
    {
        $this->slipData->setRecipientData('AAAAAAAAAA', 'BBBBBBBBBB', 'CCCCCCCCCC', 'DDDDDDDDDD');

        $this->slipData->setWithRecipient(1);
        $this->assertTrue($this->slipData->getWithRecipient());
        $this->assertEquals('AAAAAAAAAA', $this->slipData->getRecipientLine1());
        $this->assertEquals('BBBBBBBBBB', $this->slipData->getRecipientLine2());
        $this->assertEquals('CCCCCCCCCC', $this->slipData->getRecipientLine3());
        $this->assertEquals('DDDDDDDDDD', $this->slipData->getRecipientLine4());

        $this->slipData->setWithRecipient(0);
        $this->assertTrue($this->slipData->getWithRecipient());
        $this->assertEquals('AAAAAAAAAA', $this->slipData->getRecipientLine1());
        $this->assertEquals('BBBBBBBBBB', $this->slipData->getRecipientLine2());
        $this->assertEquals('CCCCCCCCCC', $this->slipData->getRecipientLine3());
        $this->assertEquals('DDDDDDDDDD', $this->slipData->getRecipientLine4());

        $this->slipData->setWithRecipient('foo');
        $this->assertTrue($this->slipData->getWithRecipient());

        $this->slipData->setWithRecipient(123);
        $this->assertTrue($this->slipData->getWithRecipient());

        $this->slipData->setWithRecipient(123.456);
        $this->assertTrue($this->slipData->getWithRecipient());

        $this->slipData->setWithRecipient(array(true));
        $this->assertTrue($this->slipData->getWithRecipient());
    }

    /**
     * Tests the setWithAmount method with an orange slip
     *
     * @return void
     * @covers ::setWithAmount
     * @covers ::getWithAmount
     */
    public function testSetWithAmountNumberOrangeType()
    {
        $this->slipData = new OrangePaymentSlipData('orange');
        $this->slipData->setAmount(1234567.89);

        $this->slipData->setWithAmount();
        $this->assertTrue($this->slipData->getWithAmount());
        $this->assertEquals(1234567.89, $this->slipData->getAmount());

        $this->slipData->setWithAmount(true);
        $this->assertTrue($this->slipData->getWithAmount());
        $this->assertEquals(1234567.89, $this->slipData->getAmount());

        $this->slipData->setWithAmount(false);
        $this->assertFalse($this->slipData->getWithAmount());
        $this->assertEquals(false, $this->slipData->getAmount());
    }

    /**
     * Tests the setWithAmount method with various parameters
     *
     * @return void
     * @covers ::setWithAmount
     * @covers ::getWithAmount
     */
    public function testSetWithAmountNumberParameters()
    {
        $this->slipData->setAmount(1234567.89);

        $this->slipData->setWithAmount(1);
        $this->assertTrue($this->slipData->getWithAmount());
        $this->assertEquals(1234567.89, $this->slipData->getAmount());

        $this->slipData->setWithAmount(0);
        $this->assertTrue($this->slipData->getWithAmount());
        $this->assertEquals(1234567.89, $this->slipData->getAmount());

        $this->slipData->setWithAmount('foo');
        $this->assertTrue($this->slipData->getWithAmount());

        $this->slipData->setWithAmount(123);
        $this->assertTrue($this->slipData->getWithAmount());

        $this->slipData->setWithAmount(123.456);
        $this->assertTrue($this->slipData->getWithAmount());

        $this->slipData->setWithAmount(array(true));
        $this->assertTrue($this->slipData->getWithAmount());
    }

    /**
     * Tests the setWithReferenceNumber method with an orange slip
     *
     * @return void
     * @covers ::setWithReferenceNumber
     * @covers ::getWithReferenceNumber
     */
    public function testSetWithReferenceNumberNumberOrangeType()
    {
        $this->slipData = new OrangePaymentSlipData('orange');
        $this->slipData->setReferenceNumber('0123456789');

        $this->slipData->setWithReferenceNumber();
        $this->assertTrue($this->slipData->getWithReferenceNumber());
        $this->assertEquals('0123456789', $this->slipData->getReferenceNumber());

        $this->slipData->setWithReferenceNumber(true);
        $this->assertTrue($this->slipData->getWithReferenceNumber());
        $this->assertEquals('0123456789', $this->slipData->getReferenceNumber());

        $this->slipData->setWithReferenceNumber(false);
        $this->assertFalse($this->slipData->getWithReferenceNumber());
        $this->assertEquals(false, $this->slipData->getReferenceNumber());
    }

    /**
     * Tests the setWithReferenceNumber method with various parameters
     *
     * @return void
     * @covers ::setWithReferenceNumber
     * @covers ::getWithReferenceNumber
     */
    public function testSetWithReferenceNumberNumberParameters()
    {
        $this->slipData->setReferenceNumber('0123456789');

        $this->slipData->setWithReferenceNumber(1);
        $this->assertTrue($this->slipData->getWithReferenceNumber());
        $this->assertEquals('0123456789', $this->slipData->getReferenceNumber());

        $this->slipData->setWithReferenceNumber(0);
        $this->assertTrue($this->slipData->getWithReferenceNumber());
        $this->assertEquals('0123456789', $this->slipData->getReferenceNumber());

        $this->slipData->setWithReferenceNumber('foo');
        $this->assertTrue($this->slipData->getWithReferenceNumber());

        $this->slipData->setWithReferenceNumber(123);
        $this->assertTrue($this->slipData->getWithReferenceNumber());

        $this->slipData->setWithReferenceNumber(123.456);
        $this->assertTrue($this->slipData->getWithReferenceNumber());

        $this->slipData->setWithReferenceNumber(array(true));
        $this->assertTrue($this->slipData->getWithReferenceNumber());
    }

    /**
     * Tests the setWithBankingCustomerId method with an orange slip
     *
     * @return void
     * @covers ::setWithBankingCustomerId
     * @covers ::getWithBankingCustomerId
     */
    public function testSetWithBankingCustomerIdNumberOrangeType()
    {
        $this->slipData = new OrangePaymentSlipData('orange');
        $this->slipData->setBankingCustomerId('012345');

        $this->slipData->setWithBankingCustomerId();
        $this->assertTrue($this->slipData->getWithBankingCustomerId());
        $this->assertEquals('012345', $this->slipData->getBankingCustomerId());

        $this->slipData->setWithBankingCustomerId(true);
        $this->assertTrue($this->slipData->getWithBankingCustomerId());
        $this->assertEquals('012345', $this->slipData->getBankingCustomerId());

        $this->slipData->setWithBankingCustomerId(false);
        $this->assertFalse($this->slipData->getWithBankingCustomerId());
        $this->assertEquals(false, $this->slipData->getBankingCustomerId());
    }

    /**
     * Tests the setWithBankingCustomerId method with various parameters
     *
     * @return void
     * @covers ::setWithBankingCustomerId
     * @covers ::getWithBankingCustomerId
     */
    public function testSetWithBankingCustomerIdNumberParameters()
    {
        $this->slipData->setBankingCustomerId('012345');

        $this->slipData->setWithBankingCustomerId(1);
        $this->assertTrue($this->slipData->getWithBankingCustomerId());
        $this->assertEquals('012345', $this->slipData->getBankingCustomerId());

        $this->slipData->setWithBankingCustomerId(0);
        $this->assertTrue($this->slipData->getWithBankingCustomerId());
        $this->assertEquals('012345', $this->slipData->getBankingCustomerId());

        $this->slipData->setWithBankingCustomerId('foo');
        $this->assertTrue($this->slipData->getWithBankingCustomerId());

        $this->slipData->setWithBankingCustomerId(123);
        $this->assertTrue($this->slipData->getWithBankingCustomerId());

        $this->slipData->setWithBankingCustomerId(123.456);
        $this->assertTrue($this->slipData->getWithBankingCustomerId());

        $this->slipData->setWithBankingCustomerId(array(true));
        $this->assertTrue($this->slipData->getWithBankingCustomerId());
    }

    /**
     * Tests the setWithPayer method with an orange slip
     *
     * @return void
     * @covers ::setWithPayer
     * @covers ::getWithPayer
     */
    public function testSetWithPayerOrangeType()
    {
        $this->slipData = new OrangePaymentSlipData('orange');
        $this->slipData->setPayerData('AAAAAAAAAA', 'BBBBBBBBBB', 'CCCCCCCCCC', 'DDDDDDDDDD');

        $this->slipData->setWithPayer();
        $this->assertTrue($this->slipData->getWithPayer());
        $this->assertEquals('AAAAAAAAAA', $this->slipData->getPayerLine1());
        $this->assertEquals('BBBBBBBBBB', $this->slipData->getPayerLine2());
        $this->assertEquals('CCCCCCCCCC', $this->slipData->getPayerLine3());
        $this->assertEquals('DDDDDDDDDD', $this->slipData->getPayerLine4());

        $this->slipData->setWithPayer(true);
        $this->assertTrue($this->slipData->getWithPayer());
        $this->assertEquals('AAAAAAAAAA', $this->slipData->getPayerLine1());
        $this->assertEquals('BBBBBBBBBB', $this->slipData->getPayerLine2());
        $this->assertEquals('CCCCCCCCCC', $this->slipData->getPayerLine3());
        $this->assertEquals('DDDDDDDDDD', $this->slipData->getPayerLine4());

        $this->slipData->setWithPayer(false);
        $this->assertFalse($this->slipData->getWithPayer());
        $this->assertEquals(false, $this->slipData->getPayerLine1());
        $this->assertEquals(false, $this->slipData->getPayerLine2());
        $this->assertEquals(false, $this->slipData->getPayerLine3());
        $this->assertEquals(false, $this->slipData->getPayerLine4());
    }

    /**
     * Tests the setWithPayer method with various parameters
     *
     * @return void
     * @covers ::setWithPayer
     * @covers ::getWithPayer
     */
    public function testSetWithPayerParameters()
    {
        $this->slipData->setPayerData('AAAAAAAAAA', 'BBBBBBBBBB', 'CCCCCCCCCC', 'DDDDDDDDDD');

        $this->slipData->setWithPayer(1);
        $this->assertTrue($this->slipData->getWithPayer());
        $this->assertEquals('AAAAAAAAAA', $this->slipData->getPayerLine1());
        $this->assertEquals('BBBBBBBBBB', $this->slipData->getPayerLine2());
        $this->assertEquals('CCCCCCCCCC', $this->slipData->getPayerLine3());
        $this->assertEquals('DDDDDDDDDD', $this->slipData->getPayerLine4());

        $this->slipData->setWithPayer(0);
        $this->assertTrue($this->slipData->getWithPayer());
        $this->assertEquals('AAAAAAAAAA', $this->slipData->getPayerLine1());
        $this->assertEquals('BBBBBBBBBB', $this->slipData->getPayerLine2());
        $this->assertEquals('CCCCCCCCCC', $this->slipData->getPayerLine3());
        $this->assertEquals('DDDDDDDDDD', $this->slipData->getPayerLine4());

        $this->slipData->setWithPayer('foo');
        $this->assertTrue($this->slipData->getWithPayer());

        $this->slipData->setWithPayer(123);
        $this->assertTrue($this->slipData->getWithPayer());

        $this->slipData->setWithPayer(123.456);
        $this->assertTrue($this->slipData->getWithPayer());

        $this->slipData->setWithPayer(array(true));
        $this->assertTrue($this->slipData->getWithPayer());
    }

    /**
     * Tests the setBankData method
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
        $this->slipData = new OrangePaymentSlipData('orange');
        $this->slipData->setBankData('Seldwyla Bank', '8001 Zürich');

        $this->assertEquals('Seldwyla Bank', $this->slipData->getBankName());
        $this->assertEquals('8001 Zürich', $this->slipData->getBankCity());

        $this->slipData->setWithBank(false);
        $this->slipData->setBankData('Seldwyla Bank', '8001 Zürich');

        $this->assertEquals(false, $this->slipData->getBankName());
        $this->assertEquals(false, $this->slipData->getBankCity());
    }

    /**
     * Tests the setAccountNumber method
     *
     * @return void
     * @covers ::setAccountNumber
     * @covers ::getAccountNumber
     */
    public function testSetAccountNumber()
    {
        $this->slipData = new OrangePaymentSlipData('orange');
        $this->slipData->setAccountNumber('01-2345-6');

        $this->assertEquals('01-2345-6', $this->slipData->getAccountNumber());

        $this->slipData->setWithAccountNumber(false);
        $this->slipData->setAccountNumber('01-2345-6');

        $this->assertEquals(false, $this->slipData->getAccountNumber());
    }

    /**
     * Tests the setRecipientData method
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
        $this->slipData = new OrangePaymentSlipData('orange');
        $this->slipData->setRecipientData('AAAAAAAAAA', 'BBBBBBBBBB', 'CCCCCCCCCC', 'DDDDDDDDDD');

        $this->assertEquals('AAAAAAAAAA', $this->slipData->getRecipientLine1());
        $this->assertEquals('BBBBBBBBBB', $this->slipData->getRecipientLine2());
        $this->assertEquals('CCCCCCCCCC', $this->slipData->getRecipientLine3());
        $this->assertEquals('DDDDDDDDDD', $this->slipData->getRecipientLine4());

        $this->slipData->setWithRecipient(false);
        $this->slipData->setRecipientData('AAAAAAAAAA', 'BBBBBBBBBB', 'CCCCCCCCCC', 'DDDDDDDDDD');

        $this->assertEquals(false, $this->slipData->getRecipientLine1());
        $this->assertEquals(false, $this->slipData->getRecipientLine2());
        $this->assertEquals(false, $this->slipData->getRecipientLine3());
        $this->assertEquals(false, $this->slipData->getRecipientLine4());
    }

    /**
     * Tests the setAmount method
     *
     * @return void
     * @covers ::setAmount
     * @covers ::getAmount
     */
    public function testSetAmount()
    {
        $this->slipData = new OrangePaymentSlipData('orange');
        $this->slipData->setAmount(1234567.89);

        $this->assertEquals(1234567.89, $this->slipData->getAmount());

        $this->slipData->setWithAmount(false);
        $this->slipData->setAmount(1234567.89);

        $this->assertEquals(false, $this->slipData->getAmount());
    }

    /**
     * Tests the setReferenceNumber method
     *
     * @return void
     * @covers ::setReferenceNumber
     * @covers ::getReferenceNumber
     */
    public function testSetReferenceNumber()
    {
        $this->slipData = new OrangePaymentSlipData('orange');
        $this->slipData->setReferenceNumber('0123456789');

        $this->assertEquals('0123456789', $this->slipData->getReferenceNumber());

        $this->slipData->setWithReferenceNumber(false);
        $this->slipData->setReferenceNumber('0123456789');

        $this->assertEquals(false, $this->slipData->getReferenceNumber());
    }

    /**
     * Tests the setBankingCustomerId method
     *
     * @return void
     * @covers ::setBankingCustomerId
     * @covers ::getBankingCustomerId
     */
    public function testSetBankingCustomerId()
    {
        $this->slipData = new OrangePaymentSlipData('orange');
        $this->slipData->setBankingCustomerId('123456');

        $this->assertEquals('123456', $this->slipData->getBankingCustomerId());

        $this->slipData->setWithBankingCustomerId(false);
        $this->slipData->setBankingCustomerId('123456');

        $this->assertEquals(false, $this->slipData->getBankingCustomerId());
    }

    /**
     * Tests the setPayerData method
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
        $this->slipData = new OrangePaymentSlipData('orange');
        $this->slipData->setPayerData('AAAAAAAAAA', 'BBBBBBBBBB', 'CCCCCCCCCC', 'DDDDDDDDDD');

        $this->assertEquals('AAAAAAAAAA', $this->slipData->getPayerLine1());
        $this->assertEquals('BBBBBBBBBB', $this->slipData->getPayerLine2());
        $this->assertEquals('CCCCCCCCCC', $this->slipData->getPayerLine3());
        $this->assertEquals('DDDDDDDDDD', $this->slipData->getPayerLine4());

        $this->slipData->setWithPayer(false);
        $this->slipData->setPayerData('AAAAAAAAAA', 'BBBBBBBBBB', 'CCCCCCCCCC', 'DDDDDDDDDD');

        $this->assertEquals(false, $this->slipData->getPayerLine1());
        $this->assertEquals(false, $this->slipData->getPayerLine2());
        $this->assertEquals(false, $this->slipData->getPayerLine3());
        $this->assertEquals(false, $this->slipData->getPayerLine4());
    }

    /**
     * Tests the getCompleteReferenceNumber method for an orange slip
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
     * Tests the getCodeLine method with an orange slip
     *
     * @return void
     * @covers ::getCodeLine
     * @covers ::modulo10
     * @covers ::getAccountDigits
     */
    public function testGetCodeLineOrangeType()
    {
        $this->slipData = new OrangePaymentSlipData('orange');
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
     * Tests the getCodeLine method with invalid preconditions
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
     * Tests the getAmountFrancs method
     *
     * @return void
     * @covers ::getAmountFrancs
     */
    public function testGetAmountFrancs()
    {
        $this->slipData->setAmount(1234567.89);
        $this->assertEquals(1234567, $this->slipData->getAmountFrancs());

        $this->slipData->setAmount(0.0);
        $this->assertEquals(0, $this->slipData->getAmountFrancs());

        $this->slipData->setWithAmount(false);
        $this->assertFalse($this->slipData->getAmountFrancs());
    }

    /**
     * Tests the getAmountCents method
     *
     * @return void
     * @covers ::getAmountCents
     */
    public function testGetAmountCents()
    {
        $this->slipData->setAmount(1234567.89);
        $this->assertEquals(89, $this->slipData->getAmountCents());

        $this->slipData->setAmount(0.0);
        $this->assertEquals(0, $this->slipData->getAmountCents());

        $this->slipData->setWithAmount(false);
        $this->assertFalse($this->slipData->getAmountCents());
    }

    /**
     * Tests the setNotForPayment method
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
