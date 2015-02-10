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
     * Tests the getWithBank and setWithBank methods
     *
     * @return void
     * @covers ::setWithBank
     * @covers ::getWithBank
     * @covers ::isBool
     * @covers ::setBankData
     * @covers ::setBankName
     * @covers ::setBankCity
     * @covers ::getBankName
     * @covers ::getBankCity
     */
    public function testSetWithBank()
    {
        // Test default values
        $this->assertEquals('', $this->slipData->getBankName());
        $this->assertEquals('', $this->slipData->getBankCity());
        $this->assertTrue($this->slipData->getWithBank());

        // Set data when enabled
        $this->slipData->setBankData('Seldwyla Bank', '8001 Zürich');
        $this->assertEquals('Seldwyla Bank', $this->slipData->getBankName());
        $this->assertEquals('8001 Zürich', $this->slipData->getBankCity());

        // Disable feature, also check for returned instance
        $returned = $this->slipData->setWithBank(false);
        $this->assertInstanceOf('SwissPaymentSlip\SwissPaymentSlip\Tests\TestablePaymentSlipData', $returned);
        $this->assertFalse($this->slipData->getWithBank());
        $this->assertEquals('', $this->slipData->getBankName());
        $this->assertEquals('', $this->slipData->getBankCity());

        // Re-enable feature, using no parameter
        $this->slipData->setWithBank();
        $this->assertTrue($this->slipData->getWithBank());
        $this->assertEquals('', $this->slipData->getBankName());
        $this->assertEquals('', $this->slipData->getBankCity());
    }

    /**
     * Tests the setWithBank method with an invalid parameter
     *
     * @return void
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $withBank is not a boolean.
     * @covers ::setWithBank
     * @covers ::isBool
     */
    public function testSetWithBankInvalidParameter()
    {
        $this->slipData->setWithBank(1);
    }

    /**
     * Tests the getWithAccountNumber and setWithAccountNumber methods
     *
     * @return void
     * @covers ::setWithAccountNumber
     * @covers ::getWithAccountNumber
     * @covers ::isBool
     * @covers ::setAccountNumber
     * @covers ::getAccountNumber
     */
    public function testSetWithAccountNumber()
    {
        // Test default values
        $this->assertEquals('', $this->slipData->getAccountNumber());
        $this->assertTrue($this->slipData->getWithAccountNumber());

        // Set data when enabled
        $this->slipData->setAccountNumber('01-2345-6');
        $this->assertEquals('01-2345-6', $this->slipData->getAccountNumber());

        // Disable feature, also check for returned instance
        $returned = $this->slipData->setWithAccountNumber(false);
        $this->assertInstanceOf('SwissPaymentSlip\SwissPaymentSlip\Tests\TestablePaymentSlipData', $returned);
        $this->assertFalse($this->slipData->getWithAccountNumber());
        $this->assertEquals('', $this->slipData->getAccountNumber());

        // Re-enable feature, using no parameter
        $this->slipData->setWithAccountNumber();
        $this->assertTrue($this->slipData->getWithAccountNumber());
        $this->assertEquals('', $this->slipData->getAccountNumber());
    }

    /**
     * Tests the setAccountNumber method with an invalid parameter
     *
     * @return void
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $withAccountNumber is not a boolean.
     * @covers ::setWithAccountNumber
     * @covers ::isBool
     */
    public function testSetWithAccountNumberInvalidParameter()
    {
        $this->slipData->setWithAccountNumber(1);
    }

    /**
     * Tests the getWithRecipient and setWithRecipient methods
     *
     * @return void
     * @covers ::setWithRecipient
     * @covers ::getWithRecipient
     * @covers ::isBool
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
    public function testSetWithRecipient()
    {
        // Test default values
        $this->assertEquals('', $this->slipData->getRecipientLine1());
        $this->assertEquals('', $this->slipData->getRecipientLine2());
        $this->assertEquals('', $this->slipData->getRecipientLine3());
        $this->assertEquals('', $this->slipData->getRecipientLine4());
        $this->assertTrue($this->slipData->getWithRecipient());

        // Set data when enabled
        $this->slipData->setRecipientData('AAAAAAAAAA', 'BBBBBBBBBB', 'CCCCCCCCCC', 'DDDDDDDDDD');
        $this->assertEquals('AAAAAAAAAA', $this->slipData->getRecipientLine1());
        $this->assertEquals('BBBBBBBBBB', $this->slipData->getRecipientLine2());
        $this->assertEquals('CCCCCCCCCC', $this->slipData->getRecipientLine3());
        $this->assertEquals('DDDDDDDDDD', $this->slipData->getRecipientLine4());

        // Disable feature, also check for returned instance
        $returned = $this->slipData->setWithRecipient(false);
        $this->assertInstanceOf('SwissPaymentSlip\SwissPaymentSlip\Tests\TestablePaymentSlipData', $returned);
        $this->assertFalse($this->slipData->getWithRecipient());
        $this->assertEquals('', $this->slipData->getRecipientLine1());
        $this->assertEquals('', $this->slipData->getRecipientLine2());
        $this->assertEquals('', $this->slipData->getRecipientLine3());
        $this->assertEquals('', $this->slipData->getRecipientLine4());

        // Re-enable feature, using no parameter
        $this->slipData->setWithRecipient();
        $this->assertTrue($this->slipData->getWithRecipient());
        $this->assertEquals('', $this->slipData->getRecipientLine1());
        $this->assertEquals('', $this->slipData->getRecipientLine2());
        $this->assertEquals('', $this->slipData->getRecipientLine3());
        $this->assertEquals('', $this->slipData->getRecipientLine4());
    }

    /**
     * Tests the setWithRecipient method with an invalid parameter
     *
     * @return void
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $withRecipient is not a boolean.
     * @covers ::setWithRecipient
     * @covers ::isBool
     */
    public function testSetWithRecipientInvalidParameter()
    {
        $this->slipData->setWithRecipient(1);
    }

    /**
     * Tests the getWithAmount and setWithAmount methods
     *
     * @return void
     * @covers ::setWithAmount
     * @covers ::getWithAmount
     * @covers ::isBool
     * @covers ::setAmount
     * @covers ::getAmount
     */
    public function testSetWithAmount()
    {
        // Test default values
        $this->assertEquals(0.0, $this->slipData->getAmount());
        $this->assertTrue($this->slipData->getWithAmount());

        // Set data when enabled
        $this->slipData->setAmount(1234567.89);
        $this->assertEquals(1234567.89, $this->slipData->getAmount());

        // Disable feature, also check for returned instance
        $returned = $this->slipData->setWithAmount(false);
        $this->assertInstanceOf('SwissPaymentSlip\SwissPaymentSlip\Tests\TestablePaymentSlipData', $returned);
        $this->assertFalse($this->slipData->getWithAmount());
        $this->assertEquals(0.0, $this->slipData->getAmount());

        // Re-enable feature, using no parameter
        $this->slipData->setWithAmount();
        $this->assertTrue($this->slipData->getWithAmount());
        $this->assertEquals(0.0, $this->slipData->getAmount());
    }

    /**
     * Tests the setWithAmount method with an invalid parameter
     *
     * @return void
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $withAmount is not a boolean.
     * @covers ::setWithAmount
     * @covers ::isBool
     */
    public function testSetWithAmountInvalidParameter()
    {
        $this->slipData->setWithAmount(1);
    }

    /**
     * Tests the getWithPayer and setWithPayer methods
     *
     * @return void
     * @covers ::setWithPayer
     * @covers ::getWithPayer
     * @covers ::isBool
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
    public function testSetWithPayer()
    {
        // Test default values
        $this->assertEquals('', $this->slipData->getPayerLine1());
        $this->assertEquals('', $this->slipData->getPayerLine2());
        $this->assertEquals('', $this->slipData->getPayerLine3());
        $this->assertEquals('', $this->slipData->getPayerLine4());
        $this->assertTrue($this->slipData->getWithPayer());

        // Set data when enabled
        $this->slipData->setPayerData('AAAAAAAAAA', 'BBBBBBBBBB', 'CCCCCCCCCC', 'DDDDDDDDDD');
        $this->assertEquals('AAAAAAAAAA', $this->slipData->getPayerLine1());
        $this->assertEquals('BBBBBBBBBB', $this->slipData->getPayerLine2());
        $this->assertEquals('CCCCCCCCCC', $this->slipData->getPayerLine3());
        $this->assertEquals('DDDDDDDDDD', $this->slipData->getPayerLine4());

        // Disable feature, also check for returned instance
        $returned = $this->slipData->setWithPayer(false);
        $this->assertInstanceOf('SwissPaymentSlip\SwissPaymentSlip\Tests\TestablePaymentSlipData', $returned);
        $this->assertFalse($this->slipData->getWithPayer());
        $this->assertEquals('', $this->slipData->getPayerLine1());
        $this->assertEquals('', $this->slipData->getPayerLine2());
        $this->assertEquals('', $this->slipData->getPayerLine3());
        $this->assertEquals('', $this->slipData->getPayerLine4());

        // Re-enable feature, using no parameter
        $this->slipData->setWithPayer();
        $this->assertTrue($this->slipData->getWithPayer());
        $this->assertEquals('', $this->slipData->getPayerLine1());
        $this->assertEquals('', $this->slipData->getPayerLine2());
        $this->assertEquals('', $this->slipData->getPayerLine3());
        $this->assertEquals('', $this->slipData->getPayerLine4());
    }

    /**
     * Tests the setWithPayer method with an invalid parameter
     *
     * @return void
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $withPayer is not a boolean.
     * @covers ::setWithPayer
     * @covers ::isBool
     */
    public function testSetWithPayerInvalidParameter()
    {
        $this->slipData->setWithPayer(1);
    }

    /**
     * Tests the getAmountFrancs method
     *
     * @return void
     * @covers ::getAmountFrancs
     */
    public function testGetAmountFrancs()
    {
        // Test default value
        $this->assertEquals(0, $this->slipData->getAmountFrancs());

        // Test with set value
        $this->slipData->setAmount(1234567.89);
        $this->assertEquals(1234567, $this->slipData->getAmountFrancs());

        // Test when disabled
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
        // Test default value
        $this->assertEquals(0, $this->slipData->getAmountFrancs());

        // Test with set value
        $this->slipData->setAmount(1234567.89);
        $this->assertEquals(89, $this->slipData->getAmountCents());

        // Test when disabled
        $this->slipData->setWithAmount(false);
        $this->assertFalse($this->slipData->getAmountCents());
    }

    /**
     * Tests the setNotForPayment method
     *
     * @return void
     * @covers ::setNotForPayment
     * @covers ::getNotForPayment
     * @covers ::getAmountFrancs
     * @covers ::getAmountCents
     */
    public function testSetNotForPayment()
    {
        // Test default values
        $this->assertFalse($this->slipData->getNotForPayment());

        $this->assertEquals('', $this->slipData->getBankName());
        $this->assertEquals('', $this->slipData->getBankCity());

        $this->assertEquals('', $this->slipData->getRecipientLine1());
        $this->assertEquals('', $this->slipData->getRecipientLine2());
        $this->assertEquals('', $this->slipData->getRecipientLine3());
        $this->assertEquals('', $this->slipData->getRecipientLine4());

        $this->assertEquals('', $this->slipData->getAccountNumber());

        $this->assertEquals(0.0, $this->slipData->getAmount());
        $this->assertEquals(0, $this->slipData->getAmountFrancs());
        $this->assertEquals(0, $this->slipData->getAmountCents());

        $this->assertEquals('', $this->slipData->getPayerLine1());
        $this->assertEquals('', $this->slipData->getPayerLine2());
        $this->assertEquals('', $this->slipData->getPayerLine3());
        $this->assertEquals('', $this->slipData->getPayerLine4());

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
