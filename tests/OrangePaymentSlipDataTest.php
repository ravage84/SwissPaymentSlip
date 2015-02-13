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
     * Setup the object under test
     *
     * @return void
     */
    protected function setUp()
    {
        $this->slipData = new OrangePaymentSlipData();
    }

    /**
     * Tests the getWithReferenceNumber and setWithReferenceNumber methods
     *
     * @return void
     * @covers ::setWithReferenceNumber
     * @covers ::getWithReferenceNumber
     * @covers ::isBool
     * @covers ::setReferenceNumber
     * @covers ::getReferenceNumber
     */
    public function testSetWithReferenceNumber()
    {
        // Test default values
        $this->assertEquals('', $this->slipData->getReferenceNumber());
        $this->assertTrue($this->slipData->getWithReferenceNumber());

        // Set data when enabled, also check for returned instance
        $returned = $this->slipData->setReferenceNumber('0123456789');
        $this->assertInstanceOf('SwissPaymentSlip\SwissPaymentSlip\OrangePaymentSlipData', $returned);
        $this->assertEquals('0123456789', $this->slipData->getReferenceNumber());

        // Disable feature, also check for returned instance
        $returned = $this->slipData->setWithReferenceNumber(false);
        $this->assertInstanceOf('SwissPaymentSlip\SwissPaymentSlip\OrangePaymentSlipData', $returned);
        $this->assertFalse($this->slipData->getWithReferenceNumber());

        // Re-enable feature, using no parameter
        $this->slipData->setWithReferenceNumber();
        $this->assertTrue($this->slipData->getWithReferenceNumber());
        $this->assertEquals('', $this->slipData->getReferenceNumber());
    }

    /**
     * Tests the getReferenceNumber method when disabled
     *
     * @return void
     * @expectedException \SwissPaymentSlip\SwissPaymentSlip\Exception\DisabledDataException
     * @expectedExceptionMessage You are accessing the disabled reference number. You need to re-enable it first.
     * @covers ::getReferenceNumber
     */
    public function testGetReferenceNumberWhenDisabled()
    {
        $this->slipData->setWithReferenceNumber(false);
        $this->slipData->getReferenceNumber();
    }

    /**
     * Tests the setWithReferenceNumber method with an invalid parameter
     *
     * @return void
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $withReferenceNumber is not a boolean.
     * @covers ::setWithReferenceNumber
     * @covers ::isBool
     */
    public function testSetWithReferenceNumberInvalidParameter()
    {
        $this->slipData->setWithReferenceNumber(1);
    }

    /**
     * Tests the getWithBankingCustomerId and setWithBankingCustomerId methods
     *
     * @return void
     * @covers ::setWithBankingCustomerId
     * @covers ::getWithBankingCustomerId
     * @covers ::isBool
     * @covers ::setBankingCustomerId
     * @covers ::getBankingCustomerId
     */
    public function testSetWithBankingCustomerId()
    {
        // Test default values
        $this->assertEquals('', $this->slipData->getBankingCustomerId());
        $this->assertTrue($this->slipData->getWithBankingCustomerId());

        // Set data when enabled, also check for returned instance
        $returned = $this->slipData->setBankingCustomerId('0123456789');
        $this->assertInstanceOf('SwissPaymentSlip\SwissPaymentSlip\OrangePaymentSlipData', $returned);
        $this->assertEquals('0123456789', $this->slipData->getBankingCustomerId());

        // Disable feature, also check for returned instance
        $returned = $this->slipData->setWithBankingCustomerId(false);
        $this->assertInstanceOf('SwissPaymentSlip\SwissPaymentSlip\OrangePaymentSlipData', $returned);
        $this->assertFalse($this->slipData->getWithBankingCustomerId());

        // Re-enable feature, using no parameter
        $this->slipData->setWithBankingCustomerId();
        $this->assertTrue($this->slipData->getWithBankingCustomerId());
        $this->assertEquals('', $this->slipData->getBankingCustomerId());
    }

    /**
     * Tests the getWithBankingCustomerId method when disabled
     *
     * @return void
     * @expectedException \SwissPaymentSlip\SwissPaymentSlip\Exception\DisabledDataException
     * @expectedExceptionMessage You are accessing the disabled banking customer ID. You need to re-enable it first.
     * @covers ::getBankingCustomerId
     */
    public function testGetBankingCustomerIdNumberWhenDisabled()
    {
        $this->slipData->setWithBankingCustomerId(false);
        $this->slipData->getBankingCustomerId();
    }

    /**
     * Tests the setWithBankingCustomerId method with an invalid parameter
     *
     * @return void
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $withBankingCustomerId is not a boolean.
     * @covers ::setWithBankingCustomerId
     * @covers ::isBool
     */
    public function testSetWithBankingCustomerIdInvalidParameter()
    {
        $this->slipData->setWithBankingCustomerId(1);
    }

    /**
     * Tests the getCompleteReferenceNumber method
     *
     * @return void
     * @covers ::getCompleteReferenceNumber
     * @covers ::appendCheckDigit
     * @covers ::breakStringIntoBlocks
     * @covers ::modulo10
     */
    public function testGetCompleteReferenceNumber()
    {
        // Test with reference number & banking customer ID
        $this->slipData->setReferenceNumber('7520033455900012');
        $this->slipData->setBankingCustomerId('215703');

        // Formatted and filled with zeros
        $this->assertEquals(
            '21 57030 00075 20033 45590 00126',
            $this->slipData->getCompleteReferenceNumber()
        );
        // Not formatted but filled with zeros
        $this->assertEquals(
            '215703000075200334559000126',
            $this->slipData->getCompleteReferenceNumber(false)
        );
        // Formatted but not filled with zeros
        $this->assertEquals(
            '21 57030 00075 20033 45590 00126',
            $this->slipData->getCompleteReferenceNumber(true, false)
        );

        // Test with reference number but without banking customer ID
        $this->slipData->setWithBankingCustomerId(false);

        // Formatted and filled with zeros
        $this->assertEquals(
            '00 00000 00075 20033 45590 00129',
            $this->slipData->getCompleteReferenceNumber()
        );
        // Not formatted but filled with zeros
        $this->assertEquals(
            '000000000075200334559000129',
            $this->slipData->getCompleteReferenceNumber(false)
        );
        // Formatted but not filled with zeros
        $this->assertEquals(
            '75 20033 45590 00129',
            $this->slipData->getCompleteReferenceNumber(true, false)
        );
    }

    /**
     * Tests the getCompleteReferenceNumber method with the reference number disabled
     *
     * @return void
     * @expectedException \SwissPaymentSlip\SwissPaymentSlip\Exception\DisabledDataException
     * @expectedExceptionMessage You are accessing the disabled reference number. You need to re-enable it first.
     * @covers ::getCompleteReferenceNumber
     * @covers ::getReferenceNumber
     */
    public function testGetCompleteReferenceNumberWithReferenceNrDisabled()
    {
        $this->slipData->setWithReferenceNumber(false);
        $this->slipData->getCompleteReferenceNumber();
    }

    /**
     * Tests the getCodeLine method
     *
     * @return void
     * @covers ::getCodeLine
     * @covers ::modulo10
     * @covers ::getAccountDigits
     */
    public function testGetCodeLine()
    {
        $this->slipData->setAccountNumber('01-145-6');
        $this->slipData->setAmount(2830.50);
        $this->slipData->setReferenceNumber('7520033455900012');
        $this->slipData->setBankingCustomerId('215703');

        // Filled with zeros
        $this->assertEquals(
            '0100002830509>215703000075200334559000126+ 010001456>',
            $this->slipData->getCodeLine()
        );
        // Not filled with zeros
        $this->assertEquals(
            '0100002830509>215703000075200334559000126+ 010001456>',
            $this->slipData->getCodeLine(false)
        );

        $this->slipData->setReferenceNumber('123456789');
        $this->slipData->setBankingCustomerId('1234');

        // Filled with zeros
        $this->assertEquals(
            '0100002830509>001234000000000001234567892+ 010001456>',
            $this->slipData->getCodeLine()
        );
        // Not filled with zeros
        $this->assertEquals(
            '0100002830509>1234000000000001234567892+ 010001456>',
            $this->slipData->getCodeLine(false)
        );

        $this->slipData->setWithBankingCustomerId(false);

        // Filled with zeros
        $this->assertEquals(
            '0100002830509>000000000000000001234567894+ 010001456>',
            $this->slipData->getCodeLine()
        );
        // Not filled with zeros
        $this->assertEquals(
            '0100002830509>1234567894+ 010001456>',
            $this->slipData->getCodeLine(false)
        );

        $this->slipData->setAmount(0.0);

        // Filled with zeros
        $this->assertEquals(
            '0100000000005>000000000000000001234567894+ 010001456>',
            $this->slipData->getCodeLine()
        );
        // Not filled with zeros
        $this->assertEquals(
            '0100000000005>1234567894+ 010001456>',
            $this->slipData->getCodeLine(false)
        );

        $this->slipData->setWithAmount(false);

        // Filled with zeros
        $this->assertEquals(
            '042>000000000000000001234567894+ 010001456>',
            $this->slipData->getCodeLine()
        );
        // Not filled with zeros
        $this->assertEquals(
            '042>1234567894+ 010001456>',
            $this->slipData->getCodeLine(false)
        );
    }

    /**
     * Tests the setNotForPayment method
     *
     * @return void
     * @covers ::setNotForPayment
     * @covers ::appendCheckDigit
     * @covers ::getCompleteReferenceNumber
     * @covers ::getCodeLine
     * @covers ::getAccountDigits
     */
    public function testSetNotForPayment()
    {
        $returned = $this->slipData->setNotForPayment(true);
        $this->assertInstanceOf('SwissPaymentSlip\SwissPaymentSlip\OrangePaymentSlipData', $returned);
        $this->assertTrue($this->slipData->getNotForPayment());

        $this->assertEquals('XXXXXXXXXXXXXXXXXXXX', $this->slipData->getReferenceNumber());
        $this->assertEquals('XXXXXXXXXXXXXXXXXXXXXXXXXXX', $this->slipData->getCompleteReferenceNumber(false));
        $this->assertEquals('XX XXXXX XXXXX XXXXX XXXXX XXXXX', $this->slipData->getCompleteReferenceNumber());

        $this->assertEquals('XXXXXXXXXXXXX>XXXXXXXXXXXXXXXXXXXXXXXXXXX+ XXXXXXXXX>', $this->slipData->getCodeLine());
    }
}
