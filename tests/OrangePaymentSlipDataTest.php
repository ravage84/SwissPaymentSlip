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
     * Tests the setWithReferenceNumber method with an orange slip
     *
     * @return void
     * @covers ::setWithReferenceNumber
     * @covers ::getWithReferenceNumber
     */
    public function testSetWithReferenceNumberNumber()
    {
        $this->slipData = new OrangePaymentSlipData();
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
    public function testSetWithBankingCustomerIdNumber()
    {
        $this->slipData = new OrangePaymentSlipData();
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
     * Tests the setReferenceNumber method
     *
     * @return void
     * @covers ::setReferenceNumber
     * @covers ::getReferenceNumber
     */
    public function testSetReferenceNumber()
    {
        $this->slipData = new OrangePaymentSlipData();
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
        $this->slipData = new OrangePaymentSlipData();
        $this->slipData->setBankingCustomerId('123456');

        $this->assertEquals('123456', $this->slipData->getBankingCustomerId());

        $this->slipData->setWithBankingCustomerId(false);
        $this->slipData->setBankingCustomerId('123456');

        $this->assertEquals(false, $this->slipData->getBankingCustomerId());
    }

    /**
     * Tests the getCompleteReferenceNumber method for an orange slip
     *
     * @return void
     * @covers ::getCompleteReferenceNumber
     * @covers ::appendCheckDigit
     * @covers ::breakStringIntoBlocks
     * @covers ::modulo10
     */
    public function testGetCompleteReferenceNumber()
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
    public function testGetCodeLine()
    {
        $this->slipData = new OrangePaymentSlipData();
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
     * @todo The tested method will throw exceptions in the future, adjust the test
     */
    public function testGetCodeLineWithInvalidPreconditions()
    {
        $this->slipData->setAmount(2830.50);
        $this->slipData->setReferenceNumber('7520033455900012');
        $this->slipData->setBankingCustomerId('215703');

        $this->slipData->setAccountNumber('123456789');

        //$this->assertEquals(false, $this->slipData->getCodeLine());
        //$this->assertEquals(false, $this->slipData->getCodeLine(false));

        $this->slipData->setAccountNumber('01-145-6');
        $this->slipData->setWithAccountNumber(false);

        //$this->assertEquals(false, $this->slipData->getCodeLine());
        //$this->assertEquals(false, $this->slipData->getCodeLine(false));

        $this->slipData->setWithAccountNumber(true);
        $this->slipData->setAccountNumber('01-145-6');
        $this->slipData->setWithReferenceNumber(false);

        //$this->assertEquals(false, $this->slipData->getCodeLine());
        //$this->assertEquals(false, $this->slipData->getCodeLine(false));
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
