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
     * Setup the object under test
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

        // Set data when enabled, also check for returned instance
        $returned = $this->slipData->setIban('CH380123456789');
        $this->assertInstanceOf('SwissPaymentSlip\SwissPaymentSlip\RedPaymentSlipData', $returned);
        $this->assertEquals('CH380123456789', $this->slipData->getIban());

        // Disable feature, also check for returned instance
        $returned = $this->slipData->setWithIban(false);
        $this->assertInstanceOf('SwissPaymentSlip\SwissPaymentSlip\RedPaymentSlipData', $returned);
        $this->assertFalse($this->slipData->getWithIban());

        // Re-enable feature, using no parameter
        $this->slipData->setWithIban();
        $this->assertTrue($this->slipData->getWithIban());
        $this->assertEquals('', $this->slipData->getIban());
    }

    /**
     * Tests the setIban method when disabled
     *
     * @return void
     * @expectedException \SwissPaymentSlip\SwissPaymentSlip\Exception\DisabledDataException
     * @expectedExceptionMessage You are accessing the disabled IBAN. You need to re-enable it first.
     * @covers ::setIban
     */
    public function testSetIbanWhenDisabled()
    {
        $this->slipData->setWithIban(false);
        $this->slipData->setIban('');
    }

    /**
     * Tests the getIban method when disabled
     *
     * @return void
     * @expectedException \SwissPaymentSlip\SwissPaymentSlip\Exception\DisabledDataException
     * @expectedExceptionMessage You are accessing the disabled IBAN. You need to re-enable it first.
     * @covers ::getIban
     */
    public function testGetIbanWhenDisabled()
    {
        $this->slipData->setWithIban(false);
        $this->slipData->getIban();
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

        // Set data when enabled, also check for returned instance
        $returned = $this->slipData->setPaymentReasonData('AAAAAAAAAA', 'BBBBBBBBBB', 'CCCCCCCCCC', 'DDDDDDDDDD');
        $this->assertInstanceOf('SwissPaymentSlip\SwissPaymentSlip\RedPaymentSlipData', $returned);
        $this->assertEquals('AAAAAAAAAA', $this->slipData->getPaymentReasonLine1());
        $this->assertEquals('BBBBBBBBBB', $this->slipData->getPaymentReasonLine2());
        $this->assertEquals('CCCCCCCCCC', $this->slipData->getPaymentReasonLine3());
        $this->assertEquals('DDDDDDDDDD', $this->slipData->getPaymentReasonLine4());

        // Disable feature, also check for returned instance
        $returned = $this->slipData->setWithPaymentReason(false);
        $this->assertInstanceOf('SwissPaymentSlip\SwissPaymentSlip\RedPaymentSlipData', $returned);
        $this->assertFalse($this->slipData->getWithPaymentReason());

        // Re-enable feature, using no parameter
        $this->slipData->setWithPaymentReason();
        $this->assertTrue($this->slipData->getWithPaymentReason());
        $this->assertEquals('', $this->slipData->getPaymentReasonLine1());
        $this->assertEquals('', $this->slipData->getPaymentReasonLine2());
        $this->assertEquals('', $this->slipData->getPaymentReasonLine3());
        $this->assertEquals('', $this->slipData->getPaymentReasonLine4());
    }

    /**
     * Tests the setPaymentReasonLine1 method when disabled
     *
     * @return void
     * @expectedException \SwissPaymentSlip\SwissPaymentSlip\Exception\DisabledDataException
     * @expectedExceptionMessage You are accessing the disabled payment reason line 1. You need to re-enable it first.
     * @covers ::setPaymentReasonLine1
     */
    public function testSetPaymentReasonLine1WhenDisabled()
    {
        $this->slipData->setWithPaymentReason(false);
        $this->slipData->setPaymentReasonLine1('');
    }

    /**
     * Tests the getPaymentReasonLine1 method when disabled
     *
     * @return void
     * @expectedException \SwissPaymentSlip\SwissPaymentSlip\Exception\DisabledDataException
     * @expectedExceptionMessage You are accessing the disabled payment reason line 1. You need to re-enable it first.
     * @covers ::getPaymentReasonLine1
     */
    public function testGetPaymentReasonLine1WhenDisabled()
    {
        $this->slipData->setWithPaymentReason(false);
        $this->slipData->getPaymentReasonLine1();
    }

    /**
     * Tests the setPaymentReasonLine2 method when disabled
     *
     * @return void
     * @expectedException \SwissPaymentSlip\SwissPaymentSlip\Exception\DisabledDataException
     * @expectedExceptionMessage You are accessing the disabled payment reason line 2. You need to re-enable it first.
     * @covers ::setPaymentReasonLine2
     */
    public function testSetPaymentReasonLine2WhenDisabled()
    {
        $this->slipData->setWithPaymentReason(false);
        $this->slipData->setPaymentReasonLine2('');
    }

    /**
     * Tests the getPaymentReasonLine2 method when disabled
     *
     * @return void
     * @expectedException \SwissPaymentSlip\SwissPaymentSlip\Exception\DisabledDataException
     * @expectedExceptionMessage You are accessing the disabled payment reason line 2. You need to re-enable it first.
     * @covers ::getPaymentReasonLine2
     */
    public function testGetPaymentReasonLine2WhenDisabled()
    {
        $this->slipData->setWithPaymentReason(false);
        $this->slipData->getPaymentReasonLine2();
    }

    /**
     * Tests the setPaymentReasonLine3 method when disabled
     *
     * @return void
     * @expectedException \SwissPaymentSlip\SwissPaymentSlip\Exception\DisabledDataException
     * @expectedExceptionMessage You are accessing the disabled payment reason line 3. You need to re-enable it first.
     * @covers ::setPaymentReasonLine3
     */
    public function testSetPaymentReasonLine3WhenDisabled()
    {
        $this->slipData->setWithPaymentReason(false);
        $this->slipData->setPaymentReasonLine3('');
    }

    /**
     * Tests the getPaymentReasonLine3 method when disabled
     *
     * @return void
     * @expectedException \SwissPaymentSlip\SwissPaymentSlip\Exception\DisabledDataException
     * @expectedExceptionMessage You are accessing the disabled payment reason line 3. You need to re-enable it first.
     * @covers ::getPaymentReasonLine3
     */
    public function testGetPaymentReasonLine3WhenDisabled()
    {
        $this->slipData->setWithPaymentReason(false);
        $this->slipData->getPaymentReasonLine3();
    }

    /**
     * Tests the setPaymentReasonLine4 method when disabled
     *
     * @return void
     * @expectedException \SwissPaymentSlip\SwissPaymentSlip\Exception\DisabledDataException
     * @expectedExceptionMessage You are accessing the disabled payment reason line 4. You need to re-enable it first.
     * @covers ::setPaymentReasonLine4
     */
    public function testSetPaymentReasonLine4WhenDisabled()
    {
        $this->slipData->setWithPaymentReason(false);
        $this->slipData->setPaymentReasonLine4('');
    }

    /**
     * Tests the getPaymentReasonLine4 method when disabled
     *
     * @return void
     * @expectedException \SwissPaymentSlip\SwissPaymentSlip\Exception\DisabledDataException
     * @expectedExceptionMessage You are accessing the disabled payment reason line 4. You need to re-enable it first.
     * @covers ::getPaymentReasonLine4
     */
    public function testGetPaymentReasonLine4WhenDisabled()
    {
        $this->slipData->setWithPaymentReason(false);
        $this->slipData->getPaymentReasonLine4();
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
    public function testGetFormattedIban()
    {
        $this->slipData->setIban('CH3808888123456789012');

        $this->assertEquals('CH3808888123456789012', $this->slipData->getIban());
        $this->assertEquals('CH38 0888 8123 4567 8901 2', $this->slipData->getFormattedIban());
    }

    /**
     * Tests the setNotForPayment method
     *
     * @return void
     * @covers ::setNotForPayment
     * @covers ::getNotForPayment
     * @covers ::getFormattedIban
     */
    public function testSetNotForPayment()
    {
        $returned = $this->slipData->setNotForPayment(true);
        $this->assertInstanceOf('SwissPaymentSlip\SwissPaymentSlip\RedPaymentSlipData', $returned);
        $this->assertTrue($this->slipData->getNotForPayment());

        $this->assertEquals('XXXXXXXXXXXXXXXXXXXXX', $this->slipData->getIban());

        $this->assertEquals('XXXXXX', $this->slipData->getPayerLine1());
        $this->assertEquals('XXXXXX', $this->slipData->getPayerLine2());
        $this->assertEquals('XXXXXX', $this->slipData->getPayerLine3());
        $this->assertEquals('XXXXXX', $this->slipData->getPayerLine4());

        $this->assertEquals('XXXX XXXX XXXX XXXX XXXX X', $this->slipData->getFormattedIban());
    }
}
