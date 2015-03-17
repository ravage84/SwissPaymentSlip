<?php
/**
 * Swiss Payment Slip
 *
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 * @copyright 2012-2015 Some nice Swiss guys
 * @author Marc Würth ravage@bluewin.ch
 * @author Manuel Reinhard <manu@sprain.ch>
 * @author Peter Siska <pesche@gridonic.ch>
 * @link https://github.com/ravage84/SwissPaymentSlip/
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
     * Setup the object under test
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

        // Set data when enabled, also check for returned instance, also check for returned instance
        $returned = $this->slipData->setBankData('Seldwyla Bank', '8001 Zürich');
        $this->assertInstanceOf('SwissPaymentSlip\SwissPaymentSlip\Tests\TestablePaymentSlipData', $returned);
        $this->assertEquals('Seldwyla Bank', $this->slipData->getBankName());
        $this->assertEquals('8001 Zürich', $this->slipData->getBankCity());

        // Disable feature, also check for returned instance
        $returned = $this->slipData->setWithBank(false);
        $this->assertInstanceOf('SwissPaymentSlip\SwissPaymentSlip\Tests\TestablePaymentSlipData', $returned);
        $this->assertFalse($this->slipData->getWithBank());

        // Re-enable feature, using no parameter
        $this->slipData->setWithBank();
        $this->assertTrue($this->slipData->getWithBank());
        $this->assertEquals('', $this->slipData->getBankName());
        $this->assertEquals('', $this->slipData->getBankCity());
    }

    /**
     * Tests the setBankName method when disabled
     *
     * @return void
     * @expectedException \SwissPaymentSlip\SwissPaymentSlip\Exception\DisabledDataException
     * @expectedExceptionMessage You are accessing the disabled bank name. You need to re-enable it first.
     * @covers ::setBankName
     */
    public function testSetBankNameWhenDisabled()
    {
        $this->slipData->setWithBank(false);
        $this->slipData->setBankName('');
    }

    /**
     * Tests the getBankName method when disabled
     *
     * @return void
     * @expectedException \SwissPaymentSlip\SwissPaymentSlip\Exception\DisabledDataException
     * @expectedExceptionMessage You are accessing the disabled bank name. You need to re-enable it first.
     * @covers ::getBankName
     */
    public function testGetBankNameWhenDisabled()
    {
        $this->slipData->setWithBank(false);
        $this->slipData->getBankName();
    }

    /**
     * Tests the setBankCity method when disabled
     *
     * @return void
     * @expectedException \SwissPaymentSlip\SwissPaymentSlip\Exception\DisabledDataException
     * @expectedExceptionMessage You are accessing the disabled bank city. You need to re-enable it first.
     * @covers ::setBankCity
     */
    public function testSetBankCityWhenDisabled()
    {
        $this->slipData->setWithBank(false);
        $this->slipData->setBankCity('');
    }

    /**
     * Tests the getBankCity method when disabled
     *
     * @return void
     * @expectedException \SwissPaymentSlip\SwissPaymentSlip\Exception\DisabledDataException
     * @expectedExceptionMessage You are accessing the disabled bank city. You need to re-enable it first.
     * @covers ::getBankCity
     */
    public function testGetBankCityWhenDisabled()
    {
        $this->slipData->setWithBank(false);
        $this->slipData->getBankCity();
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

        // Set data when enabled, also check for returned instance
        $returned = $this->slipData->setAccountNumber('01-2345-6');
        $this->assertInstanceOf('SwissPaymentSlip\SwissPaymentSlip\Tests\TestablePaymentSlipData', $returned);
        $this->assertEquals('01-2345-6', $this->slipData->getAccountNumber());

        // Disable feature, also check for returned instance
        $returned = $this->slipData->setWithAccountNumber(false);
        $this->assertInstanceOf('SwissPaymentSlip\SwissPaymentSlip\Tests\TestablePaymentSlipData', $returned);

        // Re-enable feature, using no parameter
        $this->slipData->setWithAccountNumber();
        $this->assertTrue($this->slipData->getWithAccountNumber());
        $this->assertEquals('', $this->slipData->getAccountNumber());
    }

    /**
     * Tests the setAccountNumber method when disabled
     *
     * @return void
     * @expectedException \SwissPaymentSlip\SwissPaymentSlip\Exception\DisabledDataException
     * @expectedExceptionMessage You are accessing the disabled account number. You need to re-enable it first.
     * @covers ::setAccountNumber
     */
    public function testSetAccountNumberWhenDisabled()
    {
        $this->slipData->setWithAccountNumber(false);
        $this->slipData->setAccountNumber('');
    }

    /**
     * Tests the getAccountNumber method when disabled
     *
     * @return void
     * @expectedException \SwissPaymentSlip\SwissPaymentSlip\Exception\DisabledDataException
     * @expectedExceptionMessage You are accessing the disabled account number. You need to re-enable it first.
     * @covers ::getAccountNumber
     */
    public function testGetAccountNumberWhenDisabled()
    {
        $this->slipData->setWithAccountNumber(false);
        $this->slipData->getAccountNumber();
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

        // Set data when enabled, also check for returned instance
        $returned = $this->slipData->setRecipientData('AAAAAAAAAA', 'BBBBBBBBBB', 'CCCCCCCCCC', 'DDDDDDDDDD');
        $this->assertInstanceOf('SwissPaymentSlip\SwissPaymentSlip\Tests\TestablePaymentSlipData', $returned);
        $this->assertEquals('AAAAAAAAAA', $this->slipData->getRecipientLine1());
        $this->assertEquals('BBBBBBBBBB', $this->slipData->getRecipientLine2());
        $this->assertEquals('CCCCCCCCCC', $this->slipData->getRecipientLine3());
        $this->assertEquals('DDDDDDDDDD', $this->slipData->getRecipientLine4());

        // Disable feature, also check for returned instance
        $returned = $this->slipData->setWithRecipient(false);
        $this->assertInstanceOf('SwissPaymentSlip\SwissPaymentSlip\Tests\TestablePaymentSlipData', $returned);
        $this->assertFalse($this->slipData->getWithRecipient());

        // Re-enable feature, using no parameter
        $this->slipData->setWithRecipient();
        $this->assertTrue($this->slipData->getWithRecipient());
        $this->assertEquals('', $this->slipData->getRecipientLine1());
        $this->assertEquals('', $this->slipData->getRecipientLine2());
        $this->assertEquals('', $this->slipData->getRecipientLine3());
        $this->assertEquals('', $this->slipData->getRecipientLine4());
    }

    /**
     * Tests the setRecipientLine1 method when disabled
     *
     * @return void
     * @expectedException \SwissPaymentSlip\SwissPaymentSlip\Exception\DisabledDataException
     * @expectedExceptionMessage You are accessing the disabled recipient line 1. You need to re-enable it first.
     * @covers ::setRecipientLine1
     */
    public function testSetRecipientLine1WhenDisabled()
    {
        $this->slipData->setWithRecipient(false);
        $this->slipData->setRecipientLine1('');
    }

    /**
     * Tests the getRecipientLine1 method when disabled
     *
     * @return void
     * @expectedException \SwissPaymentSlip\SwissPaymentSlip\Exception\DisabledDataException
     * @expectedExceptionMessage You are accessing the disabled recipient line 1. You need to re-enable it first.
     * @covers ::getRecipientLine1
     */
    public function testGetRecipientLine1WhenDisabled()
    {
        $this->slipData->setWithRecipient(false);
        $this->slipData->getRecipientLine1();
    }

    /**
     * Tests the setRecipientLine2 method when disabled
     *
     * @return void
     * @expectedException \SwissPaymentSlip\SwissPaymentSlip\Exception\DisabledDataException
     * @expectedExceptionMessage You are accessing the disabled recipient line 2. You need to re-enable it first.
     * @covers ::setRecipientLine2
     */
    public function testSetRecipientLine2WhenDisabled()
    {
        $this->slipData->setWithRecipient(false);
        $this->slipData->setRecipientLine2('');
    }

    /**
     * Tests the getRecipientLine2 method when disabled
     *
     * @return void
     * @expectedException \SwissPaymentSlip\SwissPaymentSlip\Exception\DisabledDataException
     * @expectedExceptionMessage You are accessing the disabled recipient line 2. You need to re-enable it first.
     * @covers ::getRecipientLine2
     */
    public function testGetRecipientLine2WhenDisabled()
    {
        $this->slipData->setWithRecipient(false);
        $this->slipData->getRecipientLine2();
    }

    /**
     * Tests the setRecipientLine3 method when disabled
     *
     * @return void
     * @expectedException \SwissPaymentSlip\SwissPaymentSlip\Exception\DisabledDataException
     * @expectedExceptionMessage You are accessing the disabled recipient line 3. You need to re-enable it first.
     * @covers ::setRecipientLine3
     */
    public function testSetRecipientLine3WhenDisabled()
    {
        $this->slipData->setWithRecipient(false);
        $this->slipData->setRecipientLine3('');
    }

    /**
     * Tests the getRecipientLine3 method when disabled
     *
     * @return void
     * @expectedException \SwissPaymentSlip\SwissPaymentSlip\Exception\DisabledDataException
     * @expectedExceptionMessage You are accessing the disabled recipient line 3. You need to re-enable it first.
     * @covers ::getRecipientLine3
     */
    public function testGetRecipientLine3WhenDisabled()
    {
        $this->slipData->setWithRecipient(false);
        $this->slipData->getRecipientLine3();
    }

    /**
     * Tests the getRecipientLine4 method when disabled
     *
     * @return void
     * @expectedException \SwissPaymentSlip\SwissPaymentSlip\Exception\DisabledDataException
     * @expectedExceptionMessage You are accessing the disabled recipient line 4. You need to re-enable it first.
     * @covers ::getRecipientLine4
     */
    public function testGetRecipientLine4WhenDisabled()
    {
        $this->slipData->setWithRecipient(false);
        $this->slipData->getRecipientLine4();
    }

    /**
     * Tests the setRecipientLine4 method when disabled
     *
     * @return void
     * @expectedException \SwissPaymentSlip\SwissPaymentSlip\Exception\DisabledDataException
     * @expectedExceptionMessage You are accessing the disabled recipient line 4. You need to re-enable it first.
     * @covers ::setRecipientLine4
     */
    public function testSetRecipientLine4WhenDisabled()
    {
        $this->slipData->setWithRecipient(false);
        $this->slipData->setRecipientLine4('');
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

        // Set data when enabled, also check for returned instance
        $returned = $this->slipData->setAmount(1234567.89);
        $this->assertInstanceOf('SwissPaymentSlip\SwissPaymentSlip\Tests\TestablePaymentSlipData', $returned);
        $this->assertEquals(1234567.89, $this->slipData->getAmount());

        // Disable feature, also check for returned instance
        $returned = $this->slipData->setWithAmount(false);
        $this->assertInstanceOf('SwissPaymentSlip\SwissPaymentSlip\Tests\TestablePaymentSlipData', $returned);
        $this->assertFalse($this->slipData->getWithAmount());

        // Re-enable feature, using no parameter
        $this->slipData->setWithAmount();
        $this->assertTrue($this->slipData->getWithAmount());
        $this->assertEquals(0.0, $this->slipData->getAmount());
    }

    /**
     * Tests the setAmount method when disabled
     *
     * @return void
     * @expectedException \SwissPaymentSlip\SwissPaymentSlip\Exception\DisabledDataException
     * @expectedExceptionMessage You are accessing the disabled amount. You need to re-enable it first.
     * @covers ::setAmount
     */
    public function testSetAmountWhenDisabled()
    {
        $this->slipData->setWithAmount(false);
        $this->slipData->setAmount('');
    }

    /**
     * Tests the getAmount method when disabled
     *
     * @return void
     * @expectedException \SwissPaymentSlip\SwissPaymentSlip\Exception\DisabledDataException
     * @expectedExceptionMessage You are accessing the disabled amount. You need to re-enable it first.
     * @covers ::getAmount
     */
    public function testGetAmountWhenDisabled()
    {
        $this->slipData->setWithAmount(false);
        $this->slipData->getAmount();
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

        // Set data when enabled, also check for returned instance
        $returned = $this->slipData->setPayerData('AAAAAAAAAA', 'BBBBBBBBBB', 'CCCCCCCCCC', 'DDDDDDDDDD');
        $this->assertInstanceOf('SwissPaymentSlip\SwissPaymentSlip\Tests\TestablePaymentSlipData', $returned);
        $this->assertEquals('AAAAAAAAAA', $this->slipData->getPayerLine1());
        $this->assertEquals('BBBBBBBBBB', $this->slipData->getPayerLine2());
        $this->assertEquals('CCCCCCCCCC', $this->slipData->getPayerLine3());
        $this->assertEquals('DDDDDDDDDD', $this->slipData->getPayerLine4());

        // Disable feature, also check for returned instance
        $returned = $this->slipData->setWithPayer(false);
        $this->assertInstanceOf('SwissPaymentSlip\SwissPaymentSlip\Tests\TestablePaymentSlipData', $returned);
        $this->assertFalse($this->slipData->getWithPayer());

        // Re-enable feature, using no parameter
        $this->slipData->setWithPayer();
        $this->assertTrue($this->slipData->getWithPayer());
        $this->assertEquals('', $this->slipData->getPayerLine1());
        $this->assertEquals('', $this->slipData->getPayerLine2());
        $this->assertEquals('', $this->slipData->getPayerLine3());
        $this->assertEquals('', $this->slipData->getPayerLine4());
    }

    /**
     * Tests the setPayerLine1 method when disabled
     *
     * @return void
     * @expectedException \SwissPaymentSlip\SwissPaymentSlip\Exception\DisabledDataException
     * @expectedExceptionMessage You are accessing the disabled payer line 1. You need to re-enable it first.
     * @covers ::setPayerLine1
     */
    public function testSetPayerLine1WhenDisabled()
    {
        $this->slipData->setWithPayer(false);
        $this->slipData->setPayerLine1('');
    }

    /**
     * Tests the getPayerLine1 method when disabled
     *
     * @return void
     * @expectedException \SwissPaymentSlip\SwissPaymentSlip\Exception\DisabledDataException
     * @expectedExceptionMessage You are accessing the disabled payer line 1. You need to re-enable it first.
     * @covers ::getPayerLine1
     */
    public function testGetPayerLine1WhenDisabled()
    {
        $this->slipData->setWithPayer(false);
        $this->slipData->getPayerLine1();
    }

    /**
     * Tests the setPayerLine2 method when disabled
     *
     * @return void
     * @expectedException \SwissPaymentSlip\SwissPaymentSlip\Exception\DisabledDataException
     * @expectedExceptionMessage You are accessing the disabled payer line 2. You need to re-enable it first.
     * @covers ::setPayerLine2
     */
    public function testSetPayerLine2WhenDisabled()
    {
        $this->slipData->setWithPayer(false);
        $this->slipData->setPayerLine2('');
    }

    /**
     * Tests the getPayerLine2 method when disabled
     *
     * @return void
     * @expectedException \SwissPaymentSlip\SwissPaymentSlip\Exception\DisabledDataException
     * @expectedExceptionMessage You are accessing the disabled payer line 2. You need to re-enable it first.
     * @covers ::getPayerLine2
     */
    public function testGetPayerLine2WhenDisabled()
    {
        $this->slipData->setWithPayer(false);
        $this->slipData->getPayerLine2();
    }

    /**
     * Tests the setPayerLine3 method when disabled
     *
     * @return void
     * @expectedException \SwissPaymentSlip\SwissPaymentSlip\Exception\DisabledDataException
     * @expectedExceptionMessage You are accessing the disabled payer line 3. You need to re-enable it first.
     * @covers ::setPayerLine3
     */
    public function testSetPayerLine3WhenDisabled()
    {
        $this->slipData->setWithPayer(false);
        $this->slipData->setPayerLine3('');
    }

    /**
     * Tests the getPayerLine3 method when disabled
     *
     * @return void
     * @expectedException \SwissPaymentSlip\SwissPaymentSlip\Exception\DisabledDataException
     * @expectedExceptionMessage You are accessing the disabled payer line 3. You need to re-enable it first.
     * @covers ::getPayerLine3
     */
    public function testGetPayerLine3WhenDisabled()
    {
        $this->slipData->setWithPayer(false);
        $this->slipData->getPayerLine3();
    }

    /**
     * Tests the setPayerLine4 method when disabled
     *
     * @return void
     * @expectedException \SwissPaymentSlip\SwissPaymentSlip\Exception\DisabledDataException
     * @expectedExceptionMessage You are accessing the disabled payer line 4. You need to re-enable it first.
     * @covers ::setPayerLine4
     */
    public function testSetPayerLine4WhenDisabled()
    {
        $this->slipData->setWithPayer(false);
        $this->slipData->setPayerLine4('');
    }

    /**
     * Tests the getPayerLine4 method when disabled
     *
     * @return void
     * @expectedException \SwissPaymentSlip\SwissPaymentSlip\Exception\DisabledDataException
     * @expectedExceptionMessage You are accessing the disabled payer line 4. You need to re-enable it first.
     * @covers ::getPayerLine4
     */
    public function testGetPayerLine4WhenDisabled()
    {
        $this->slipData->setWithPayer(false);
        $this->slipData->getPayerLine4();
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

        $returned = $this->slipData->setNotForPayment(true);
        $this->assertInstanceOf('SwissPaymentSlip\SwissPaymentSlip\Tests\TestablePaymentSlipData', $returned);
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
