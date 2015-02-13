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
     * @expectedExceptionMessage You are accessing the disabled FooBar. You need to re-enable it first
     * @covers ::__construct
     */
    public function testConstructor()
    {
        throw new DisabledDataException('FooBar');
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
