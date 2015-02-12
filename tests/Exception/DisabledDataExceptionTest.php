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

use SwissPaymentSlip\SwissPaymentSlip\Exception\DisabledDataException;

/**
 * Tests for the DisabledDataException class
 *
 * @coversDefaultClass SwissPaymentSlip\SwissPaymentSlip\Exception\DisabledDataException
 */
class DisabledDataExceptionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests the constructor
     *
     * @return void
     * @expectedException SwissPaymentSlip\SwissPaymentSlip\Exception\DisabledDataException
     * @expectedExceptionMessage foo
     * @covers ::__construct
     */
    public function testConstructor()
    {
        throw new DisabledDataException('foo');
    }

    /**
     * Tests the getDataName method
     *
     * @return void
     * @covers ::getDataName
     */
    public function testGetDataName()
    {
        $exception = new DisabledDataException('FooBar');
        $this->assertEquals('FooBar', $exception->getDataName());
    }
}
