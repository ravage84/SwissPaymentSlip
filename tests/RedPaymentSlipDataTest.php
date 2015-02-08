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
     * Tests the setWithIban method with a red slip
     *
     * @return void
     * @covers ::setWithIban
     * @covers ::getWithIban
     */
    public function testSetWithIbanNumber()
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
    public function testSetWithPaymentReason()
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
     * @todo Implement testGetCodeLine
     */
    public function testGetCodeLine()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
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
