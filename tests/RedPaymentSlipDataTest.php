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
     * Tests the getWithIban and setWithIban methods
     *
     * @return void
     * @covers ::setWithIban
     * @covers ::getWithIban
     * @covers ::isBool
     * @covers ::setIban
     * @covers ::getIban
     */
    public function testSetWithIban()
    {
        // Test default values
        $this->assertEquals('', $this->slipData->getIban());
        $this->assertTrue($this->slipData->getWithIban());

        // Set data when enabled
        $this->slipData->setIban('CH380123456789');
        $this->assertEquals('CH380123456789', $this->slipData->getIban());

        // Disable feature, also check for returned instance
        $returned = $this->slipData->setWithIban(false);
        $this->assertInstanceOf('SwissPaymentSlip\SwissPaymentSlip\RedPaymentSlipData', $returned);
        $this->assertFalse($this->slipData->getWithIban());
        $this->assertEquals('', $this->slipData->getIban());

        // Re-enable feature, using no parameter
        $this->slipData->setWithIban();
        $this->assertTrue($this->slipData->getWithIban());
        $this->assertEquals('', $this->slipData->getIban());
    }

    /**
     * Tests the setWithIban method with an invalid parameter
     *
     * @return void
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $withIban is not a boolean.
     * @covers ::setWithIban
     * @covers ::isBool
     */
    public function testSetWithIbanInvalidParameter()
    {
        $this->slipData->setWithIban(1);
    }

    /**
     * Tests the getWithPaymentReason and setWithPaymentReason methods
     *
     * @return void
     * @covers ::setWithPaymentReason
     * @covers ::getWithPaymentReason
     * @covers ::isBool
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
    public function testSetWithPaymentReason()
    {
        // Test default values
        $this->assertEquals('', $this->slipData->getPaymentReasonLine1());
        $this->assertEquals('', $this->slipData->getPaymentReasonLine2());
        $this->assertEquals('', $this->slipData->getPaymentReasonLine3());
        $this->assertEquals('', $this->slipData->getPaymentReasonLine4());
        $this->assertTrue($this->slipData->getWithPaymentReason());

        // Set data when enabled
        $this->slipData->setPaymentReasonData('AAAAAAAAAA', 'BBBBBBBBBB', 'CCCCCCCCCC', 'DDDDDDDDDD');
        $this->assertEquals('AAAAAAAAAA', $this->slipData->getPaymentReasonLine1());
        $this->assertEquals('BBBBBBBBBB', $this->slipData->getPaymentReasonLine2());
        $this->assertEquals('CCCCCCCCCC', $this->slipData->getPaymentReasonLine3());
        $this->assertEquals('DDDDDDDDDD', $this->slipData->getPaymentReasonLine4());

        // Disable feature, also check for returned instance
        $returned = $this->slipData->setWithPaymentReason(false);
        $this->assertInstanceOf('SwissPaymentSlip\SwissPaymentSlip\RedPaymentSlipData', $returned);
        $this->assertFalse($this->slipData->getWithPaymentReason());
        $this->assertEquals('', $this->slipData->getPaymentReasonLine1());
        $this->assertEquals('', $this->slipData->getPaymentReasonLine2());
        $this->assertEquals('', $this->slipData->getPaymentReasonLine3());
        $this->assertEquals('', $this->slipData->getPaymentReasonLine4());

        // Re-enable feature, using no parameter
        $this->slipData->setWithPaymentReason();
        $this->assertTrue($this->slipData->getWithPaymentReason());
        $this->assertEquals('', $this->slipData->getPaymentReasonLine1());
        $this->assertEquals('', $this->slipData->getPaymentReasonLine2());
        $this->assertEquals('', $this->slipData->getPaymentReasonLine3());
        $this->assertEquals('', $this->slipData->getPaymentReasonLine4());
    }

    /**
     * Tests the setWithPaymentReason method with an invalid parameter
     *
     * @return void
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $withPaymentReason is not a boolean.
     * @covers ::setWithPaymentReason
     * @covers ::isBool
     */
    public function testSetWithPaymentReasonInvalidParameter()
    {
        $this->slipData->setWithPaymentReason(1);
    }

    /**
     * Tsets the getFormattedIban method
     *
     * @return void
     * @covers ::getFormattedIban
     */
    public function estGetFormattedIban()
    {
        $this->slipData->setIban('CH3808888123456789012');

        $this->assertEquals('CH3808888123456789012', $this->slipData->getIban());
        $this->assertEquals('CH38 0888 8123 4567 8901 2', $this->slipData->getFormattedIban());

        $this->slipData->setWithIban(false);
        $this->assertEquals(false, $this->slipData->getFormattedIban());
    }

    /**
     * Tests the getCodeLine method
     *
     * @return void
     * @covers ::getCodeLine
     * @covers ::modulo10
     * @covers ::getAccountDigits
     * @todo Implement testGetCodeLine
     */
    public function estGetCodeLine()
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
     * @covers ::getCodeLine
     * @covers ::getFormattedIban
     */
    public function testSetNotForPayment()
    {
        $this->slipData->setNotForPayment(true);
        $this->assertTrue($this->slipData->getNotForPayment());

        $this->assertEquals('XXXXXXXXXXXXXXXXXXXXX', $this->slipData->getIban());

        $this->assertEquals('XXXXXX', $this->slipData->getPayerLine1());
        $this->assertEquals('XXXXXX', $this->slipData->getPayerLine2());
        $this->assertEquals('XXXXXX', $this->slipData->getPayerLine3());
        $this->assertEquals('XXXXXX', $this->slipData->getPayerLine4());

        $this->assertEquals('XXXX XXXX XXXX XXXX XXXX X', $this->slipData->getFormattedIban());

        //$this->assertEquals(
        //'XXXXXXXXXXXXX>XXXXXXXXXXXXXXXXXXXXXXXXXXX+ XXXXXXXXX>', $this->slipData->getCodeLine()
        //);
    }
}
