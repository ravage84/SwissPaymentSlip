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

use SwissPaymentSlip\SwissPaymentSlip\PaymentSlipData;

/**
 * Tests for the PaymentSlipData class
 *
 * @coversDefaultClass SwissPaymentSlip\SwissPaymentSlip\PaymentSlipData
 */
class PaymentSlipDataTest extends \PHPUnit_Framework_TestCase
{
    /**
     * The object under test
     *
     * @var PaymentSlipData
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
        $this->slipData = new TestablePaymentSlipData();
    }

    /**
     * Tests the setWithBank method with
     *
     * @return void
     * @covers ::setWithBank
     * @covers ::getWithBank
     */
    public function testSetWithBank()
    {
        $this->slipData = new TestablePaymentSlipData();
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
     * Tests the setWithAccountNumber method with
     *
     * @return void
     * @covers ::setWithAccountNumber
     * @covers ::getWithAccountNumber
     */
    public function testSetWithAccountNumber()
    {
        $this->slipData = new TestablePaymentSlipData();
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
     * Tests the setWithRecipient method with
     *
     * @return void
     * @covers ::setWithRecipient
     * @covers ::getWithRecipient
     */
    public function testSetWithRecipient()
    {
        $this->slipData = new TestablePaymentSlipData();
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
     * Tests the setWithAmount method with
     *
     * @return void
     * @covers ::setWithAmount
     * @covers ::getWithAmount
     */
    public function testSetWithAmountNumber()
    {
        $this->slipData = new TestablePaymentSlipData();
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
     * Tests the setWithPayer method with
     *
     * @return void
     * @covers ::setWithPayer
     * @covers ::getWithPayer
     */
    public function testSetWithPayer()
    {
        $this->slipData = new TestablePaymentSlipData();
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
        $this->slipData = new TestablePaymentSlipData();
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
        $this->slipData = new TestablePaymentSlipData();
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
        $this->slipData = new TestablePaymentSlipData();
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
        $this->slipData = new TestablePaymentSlipData();
        $this->slipData->setAmount(1234567.89);

        $this->assertEquals(1234567.89, $this->slipData->getAmount());

        $this->slipData->setWithAmount(false);
        $this->slipData->setAmount(1234567.89);

        $this->assertEquals(false, $this->slipData->getAmount());
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
        $this->slipData = new TestablePaymentSlipData();
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
    }
}
