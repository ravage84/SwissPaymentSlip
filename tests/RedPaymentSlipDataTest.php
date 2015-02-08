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

use SwissPaymentSlip\SwissPaymentSlip\RedPaymentSlipData;

/**
 * Tests for the RedPaymentSlipData class
 *
 * @coversDefaultClass SwissPaymentSlip\SwissPaymentSlip\RedPaymentSlipData
 */
class RedPaymentSlipDataTest extends \PHPUnit_Framework_TestCase
{
    /**
     * The object under test
     *
     * @var RedPaymentSlipData
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
        $this->slipData = new RedPaymentSlipData();
    }

    /**
     * Tests the setWithBank method with a red slip
     *
     * @return void
     * @covers ::setWithBank
     * @covers ::getWithBank
     */
    public function testSetWithBankRedType()
    {
        $this->slipData = new RedPaymentSlipData();
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
     * Tests the setWithAccountNumber method with a red slip
     *
     * @return void
     * @covers ::setWithAccountNumber
     * @covers ::getWithAccountNumber
     */
    public function testSetWithAccountNumberRedType()
    {
        $this->slipData = new RedPaymentSlipData();
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
     * Tests the setWithRecipient method with a red slip
     *
     * @return void
     * @covers ::setWithRecipient
     * @covers ::getWithRecipient
     */
    public function testSetWithRecipientRedType()
    {
        $this->slipData = new RedPaymentSlipData();
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
     * Tests the setWithAmount method with a red slip
     *
     * @return void
     * @covers ::setWithAmount
     * @covers ::getWithAmount
     */
    public function testSetWithAmountNumberRedType()
    {
        $this->slipData = new RedPaymentSlipData();
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
     * Tests the setWithPayer method with a red slip
     *
     * @return void
     * @covers ::setWithPayer
     * @covers ::getWithPayer
     */
    public function testSetWithPayerRedType()
    {
        $this->slipData = new RedPaymentSlipData();
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
     * Tests the setWithIban method with a red slip
     *
     * @return void
     * @covers ::setWithIban
     * @covers ::getWithIban
     */
    public function testSetWithIbanNumberRedType()
    {
        $this->slipData = new RedPaymentSlipData();
        $this->slipData->setIban('CH380123456789');

        $this->slipData->setWithIban(true);
        $this->assertTrue($this->slipData->getWithIban());
        $this->assertEquals('CH380123456789', $this->slipData->getIban());

        $this->slipData->setWithIban();
        $this->assertFalse($this->slipData->getWithIban());
        $this->assertEquals(false, $this->slipData->getIban());

        $this->slipData->setWithIban(false);
        $this->assertFalse($this->slipData->getWithIban());
        $this->assertEquals(false, $this->slipData->getIban());
    }

    /**
     * Tests the setWithIban method with various parameters
     *
     * @return void
     * @covers ::setWithIban
     * @covers ::getWithIban
     */
    public function testSetWithIbanNumberParameters()
    {
        $this->slipData = new RedPaymentSlipData();
        $this->slipData->setIban('CH380123456789');

        $this->slipData->setWithIban(1);
        $this->assertTrue($this->slipData->getWithIban());
        $this->assertEquals('CH380123456789', $this->slipData->getIban());

        $this->slipData->setWithIban(0);
        $this->assertTrue($this->slipData->getWithIban());
        $this->assertEquals('CH380123456789', $this->slipData->getIban());

        $this->slipData->setWithIban('foo');
        $this->assertTrue($this->slipData->getWithIban());

        $this->slipData->setWithIban(123);
        $this->assertTrue($this->slipData->getWithIban());

        $this->slipData->setWithIban(123.456);
        $this->assertTrue($this->slipData->getWithIban());

        $this->slipData->setWithIban(array(true));
        $this->assertTrue($this->slipData->getWithIban());
    }

    /**
     * Tests the setWithPaymentReason method with a red slip
     *
     * @return void
     * @covers ::setWithPaymentReason
     * @covers ::getWithPaymentReason
     */
    public function testSetWithPaymentReasonRedType()
    {
        $this->slipData = new RedPaymentSlipData();
        $this->slipData->setPaymentReasonData('AAAAAAAAAA', 'BBBBBBBBBB', 'CCCCCCCCCC', 'DDDDDDDDDD');

        $this->slipData->setWithPaymentReason(true);
        $this->assertTrue($this->slipData->getWithPaymentReason());
        $this->assertEquals('AAAAAAAAAA', $this->slipData->getPaymentReasonLine1());
        $this->assertEquals('BBBBBBBBBB', $this->slipData->getPaymentReasonLine2());
        $this->assertEquals('CCCCCCCCCC', $this->slipData->getPaymentReasonLine3());
        $this->assertEquals('DDDDDDDDDD', $this->slipData->getPaymentReasonLine4());

        $this->slipData->setWithPaymentReason();
        $this->assertFalse($this->slipData->getWithPaymentReason());
        $this->assertEquals(false, $this->slipData->getPaymentReasonLine1());
        $this->assertEquals(false, $this->slipData->getPaymentReasonLine2());
        $this->assertEquals(false, $this->slipData->getPaymentReasonLine3());
        $this->assertEquals(false, $this->slipData->getPaymentReasonLine4());

        $this->slipData->setWithPaymentReason(false);
        $this->assertFalse($this->slipData->getWithPaymentReason());
        $this->assertEquals(false, $this->slipData->getPaymentReasonLine1());
        $this->assertEquals(false, $this->slipData->getPaymentReasonLine2());
        $this->assertEquals(false, $this->slipData->getPaymentReasonLine3());
        $this->assertEquals(false, $this->slipData->getPaymentReasonLine4());
    }

    /**
     * Tests the setWithPaymentReason method with various parameters
     *
     * @return void
     * @covers ::setWithPaymentReason
     * @covers ::getWithPaymentReason
     */
    public function testSetWithPaymentReasonParameters()
    {
        $this->slipData = new RedPaymentSlipData();
        $this->slipData->setPaymentReasonData('AAAAAAAAAA', 'BBBBBBBBBB', 'CCCCCCCCCC', 'DDDDDDDDDD');

        $this->slipData->setWithPaymentReason(1);
        $this->assertTrue($this->slipData->getWithPaymentReason());
        $this->assertEquals('AAAAAAAAAA', $this->slipData->getPaymentReasonLine1());
        $this->assertEquals('BBBBBBBBBB', $this->slipData->getPaymentReasonLine2());
        $this->assertEquals('CCCCCCCCCC', $this->slipData->getPaymentReasonLine3());
        $this->assertEquals('DDDDDDDDDD', $this->slipData->getPaymentReasonLine4());

        $this->slipData->setWithPaymentReason(0);
        $this->assertTrue($this->slipData->getWithPaymentReason());
        $this->assertEquals('AAAAAAAAAA', $this->slipData->getPaymentReasonLine1());
        $this->assertEquals('BBBBBBBBBB', $this->slipData->getPaymentReasonLine2());
        $this->assertEquals('CCCCCCCCCC', $this->slipData->getPaymentReasonLine3());
        $this->assertEquals('DDDDDDDDDD', $this->slipData->getPaymentReasonLine4());

        $this->slipData->setWithPaymentReason('foo');
        $this->assertTrue($this->slipData->getWithPaymentReason());

        $this->slipData->setWithPaymentReason(123);
        $this->assertTrue($this->slipData->getWithPaymentReason());

        $this->slipData->setWithPaymentReason(123.456);
        $this->assertTrue($this->slipData->getWithPaymentReason());

        $this->slipData->setWithPaymentReason(array(true));
        $this->assertTrue($this->slipData->getWithPaymentReason());
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
        $this->slipData = new RedPaymentSlipData();
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
        $this->slipData = new RedPaymentSlipData();
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
        $this->slipData = new RedPaymentSlipData();
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
        $this->slipData = new RedPaymentSlipData();
        $this->slipData->setAmount(1234567.89);

        $this->assertEquals(1234567.89, $this->slipData->getAmount());

        $this->slipData->setWithAmount(false);
        $this->slipData->setAmount(1234567.89);

        $this->assertEquals(false, $this->slipData->getAmount());
    }

    /**
     * Tests the setIban method
     *
     * @return void
     * @covers ::setIban
     * @covers ::getIban
     */
    public function testSetIban()
    {
        $this->slipData = new RedPaymentSlipData();
        $this->slipData->setIban('CH380123456789');

        $this->assertEquals('CH380123456789', $this->slipData->getIban());

        $this->slipData->setWithIban(false);
        $this->slipData->setIban('CH380123456789');

        $this->assertEquals(false, $this->slipData->getIban());
    }

    /**
     * Tests the setPaymentReasonData method
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
        $this->slipData = new RedPaymentSlipData();
        $this->slipData->setPaymentReasonData('AAAAAAAAAA', 'BBBBBBBBBB', 'CCCCCCCCCC', 'DDDDDDDDDD');

        $this->assertEquals('AAAAAAAAAA', $this->slipData->getPaymentReasonLine1());
        $this->assertEquals('BBBBBBBBBB', $this->slipData->getPaymentReasonLine2());
        $this->assertEquals('CCCCCCCCCC', $this->slipData->getPaymentReasonLine3());
        $this->assertEquals('DDDDDDDDDD', $this->slipData->getPaymentReasonLine4());

        $this->slipData->setWithPaymentReason(false);
        $this->slipData->setPaymentReasonData('AAAAAAAAAA', 'BBBBBBBBBB', 'CCCCCCCCCC', 'DDDDDDDDDD');

        $this->assertEquals(false, $this->slipData->getPaymentReasonLine1());
        $this->assertEquals(false, $this->slipData->getPaymentReasonLine2());
        $this->assertEquals(false, $this->slipData->getPaymentReasonLine3());
        $this->assertEquals(false, $this->slipData->getPaymentReasonLine4());
    }

    /**
     * Tsets the getFormattedIban method
     *
     * @return void
     * @covers ::getFormattedIban
     */
    public function testGetFormattedIban()
    {
        $this->slipData = new RedPaymentSlipData();
        $this->slipData->setIban('CH3808888123456789012');

        $this->assertEquals('CH3808888123456789012', $this->slipData->getIban());
        $this->assertEquals('CH38 0888 8123 4567 8901 2', $this->slipData->getFormattedIban());

        $this->slipData->setWithIban(false);
        $this->assertEquals(false, $this->slipData->getFormattedIban());
    }

    /**
     * Tests the getCodeLine method with a red slip
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

        $this->assertEquals('XXXXXX', $this->slipData->getPayerLine1());
        $this->assertEquals('XXXXXX', $this->slipData->getPayerLine2());
        $this->assertEquals('XXXXXX', $this->slipData->getPayerLine3());
        $this->assertEquals('XXXXXX', $this->slipData->getPayerLine4());

        //$this->assertEquals(
        //'XXXXXXXXXXXXX>XXXXXXXXXXXXXXXXXXXXXXXXXXX+ XXXXXXXXX>', $this->slipData->getCodeLine()
        //);
    }
}
