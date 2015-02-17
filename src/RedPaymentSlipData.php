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

namespace SwissPaymentSlip\SwissPaymentSlip;

use SwissPaymentSlip\SwissPaymentSlip\Exception\DisabledDataException;

/**
 * Red Swiss Payment Slip Data
 *
 * A data container class to encapsulate all the necessary data
 * for a red Swiss payment slip without reference number.
 *
 * @see PaymentSlipData For more information about the various payment slips.
 *
 * @todo Implement full red slip support (code line + additional code line)
 * @todo Create a getPaymentReason with formatting parameter, e.g. stripping blank lines
 */
class RedPaymentSlipData extends PaymentSlipData
{

    /**
     * Determines if the payment slip has an IBAN specified. Can be disabled for pre-printed payment slips
     * Only possible for ES, but not for ESR
     *
     * @var bool True if yes, false if no.
     */
    protected $withIban = true;

    /**
     * Determines if the payment slip has a payment reason. Can be disabled for pre-printed payment slips
     * Only possible for ES, but not for ESR
     *
     * @var bool True if yes, false if no.
     */
    protected $withPaymentReason = true;

    /**
     * The IBAN of the recipient of a ES. Not available on a ESR
     *
     * @var string The IBAN of the recipient.
     */
    protected $iban = '';

    /**
     * The first line of the payment reason of a ES. Not available on a ESR
     *
     * @var string The first line of the payment reason.
     */
    protected $paymentReasonLine1 = '';

    /**
     * The second line of the payment reason of a ES. Not available on a ESR
     *
     * @var string The second line of the payment reason.
     */
    protected $paymentReasonLine2 = '';

    /**
     * The third line of the payment reason of a ES. Not available on a ESR
     *
     * @var string The third line of the payment reason.
     */
    protected $paymentReasonLine3 = '';

    /**
     * The fourth line of the payment reason of a ES. Not available on a ESR
     *
     * @var string The fourth line of the payment reason.
     */
    protected $paymentReasonLine4 = '';

    /**
     * Set if payment slip has an IBAN specified
     *
     * Resets the IBAN when disabling.
     *
     * @param bool $withIban True if yes, false if no.
     * @return $this The current instance for a fluent interface.
     */
    public function setWithIban($withIban = true)
    {
        $this->isBool($withIban, 'withIban');
        $this->withIban = $withIban;

        if ($withIban === false) {
            $this->iban = '';
        }

        return $this;
    }

    /**
     * Get if payment slip has an IBAN specified
     *
     * @return bool True if payment slip has an IBAN specified, else false.
     */
    public function getWithIban()
    {
        return $this->withIban;
    }

    /**
     * Set if payment slip has a payment reason specified.
     *
     * Resets the payment reason data when disabling.
     *
     * @param bool $withPaymentReason True if yes, false if no.
     * @return $this The current instance for a fluent interface.
     */
    public function setWithPaymentReason($withPaymentReason = true)
    {
        $this->isBool($withPaymentReason, 'withPaymentReason');
        $this->withPaymentReason = $withPaymentReason;

        if ($withPaymentReason === false) {
            $this->paymentReasonLine1 = '';
            $this->paymentReasonLine2 = '';
            $this->paymentReasonLine3 = '';
            $this->paymentReasonLine4 = '';
        }

        return $this;
    }

    /**
     * Get if payment slip has a payment reason specified
     *
     * @return bool True if payment slip has a payment reason specified, else false.
     */
    public function getWithPaymentReason()
    {
        return $this->withPaymentReason;
    }

    /**
     * Set the IBAN
     *
     * @param string $iban The IBAN.
     * @return $this The current instance for a fluent interface.
     * @throws DisabledDataException If the data is disabled.
     *
     * @todo Consider stripping spaces (may be optionally)
     * @todo Implement validation of the IBAN
     * @link http://code.google.com/p/php-iban/
     * @link https://github.com/jschaedl/Iban
     * @link http://www.ibancalculator.com/iban_validieren.html
     */
    public function setIban($iban)
    {
        if (!$this->getWithIban()) {
            throw new DisabledDataException('IBAN');
        }
        $this->iban = $iban;

        return $this;
    }

    /**
     * Get the IBAN
     *
     * @return string The IBAN, if withIban is set to true.
     * @throws DisabledDataException If the data is disabled.
     */
    public function getIban()
    {
        if (!$this->getWithIban()) {
            throw new DisabledDataException('IBAN');
        }
        return $this->iban;
    }

    /**
     * Set payment reason lines
     *
     * @param string $paymentReasonLine1 The first line of the payment reason.
     * @param string $paymentReasonLine2 The second line of the payment reason.
     * @param string $paymentReasonLine3 The third line of the payment reason.
     * @param string $paymentReasonLine4 The fourth line of the payment reason.
     * @return $this The current instance for a fluent interface.
     */
    public function setPaymentReasonData(
        $paymentReasonLine1 = '',
        $paymentReasonLine2 = '',
        $paymentReasonLine3 = '',
        $paymentReasonLine4 = ''
    ) {
        $this->setPaymentReasonLine1($paymentReasonLine1);
        $this->setPaymentReasonLine2($paymentReasonLine2);
        $this->setPaymentReasonLine3($paymentReasonLine3);
        $this->setPaymentReasonLine4($paymentReasonLine4);

        return $this;
    }

    /**
     * Set the first line of the payment reason
     *
     * @param string $paymentReasonLine1 The first line of the payment reason.
     * @return $this The current instance for a fluent interface.
     * @throws DisabledDataException If the data is disabled.
     */
    public function setPaymentReasonLine1($paymentReasonLine1)
    {
        if (!$this->getWithPaymentReason()) {
            throw new DisabledDataException('payment reason line 1');
        }
        $this->paymentReasonLine1 = $paymentReasonLine1;

        return $this;
    }

    /**
     * Get the first line of the payment reason
     *
     * @return string The first line of the payment reason, if withPaymentReason is set to true.
     * @throws DisabledDataException If the data is disabled.
     */
    public function getPaymentReasonLine1()
    {
        if (!$this->getWithPaymentReason()) {
            throw new DisabledDataException('payment reason line 1');
        }
        return $this->paymentReasonLine1;
    }

    /**
     * Set the second line of the payment reason
     *
     * @param string $paymentReasonLine2 The second line of the payment reason.
     * @return $this The current instance for a fluent interface.
     * @throws DisabledDataException If the data is disabled.
     */
    public function setPaymentReasonLine2($paymentReasonLine2)
    {
        if (!$this->getWithPaymentReason()) {
            throw new DisabledDataException('payment reason line 2');
        }
        $this->paymentReasonLine2 = $paymentReasonLine2;

        return $this;
    }

    /**
     * Get the second line of the payment reason
     *
     * @return string The second line of the payment reason, if withPaymentReason is set to true.
     * @throws DisabledDataException If the data is disabled.
     */
    public function getPaymentReasonLine2()
    {
        if (!$this->getWithPaymentReason()) {
            throw new DisabledDataException('payment reason line 2');
        }
        return $this->paymentReasonLine2;
    }

    /**
     * Set the third line of the payment reason
     *
     * @param string $paymentReasonLine3 The third line of the payment reason.
     * @return $this The current instance for a fluent interface.
     * @throws DisabledDataException If the data is disabled.
     */
    public function setPaymentReasonLine3($paymentReasonLine3)
    {
        if (!$this->getWithPaymentReason()) {
            throw new DisabledDataException('payment reason line 3');
        }
        $this->paymentReasonLine3 = $paymentReasonLine3;

        return $this;
    }

    /**
     * Get the third line of the payment reason
     *
     * @return string The third line of the payment reason, if withPaymentReason is set to true.
     * @throws DisabledDataException If the data is disabled.
     */
    public function getPaymentReasonLine3()
    {
        if (!$this->getWithPaymentReason()) {
            throw new DisabledDataException('payment reason line 3');
        }
        return $this->paymentReasonLine3;
    }

    /**
     * Set the fourth line of the payment reason
     *
     * @param string $paymentReasonLine4 The fourth line of the payment reason.
     * @return $this The current instance for a fluent interface.
     * @throws DisabledDataException If the data is disabled.
     */
    public function setPaymentReasonLine4($paymentReasonLine4)
    {
        if (!$this->getWithPaymentReason()) {
            throw new DisabledDataException('payment reason line 4');
        }
        $this->paymentReasonLine4 = $paymentReasonLine4;

        return $this;
    }

    /**
     * Get the fourth line of the payment reason
     *
     * @return string The fourth line of the payment reason, if withPaymentReason is set to true.
     * @throws DisabledDataException If the data is disabled.
     */
    public function getPaymentReasonLine4()
    {
        if (!$this->getWithPaymentReason()) {
            throw new DisabledDataException('payment reason line 4');
        }
        return $this->paymentReasonLine4;
    }

    /**
     * Set payment slip for not to be used for payment
     *
     * XXXes out all fields to prevent people using the payment slip.
     *
     * @param boolean $notForPayment True if not for payment, else false.
     * @return $this The current instance for a fluent interface.
     */
    public function setNotForPayment($notForPayment = true)
    {
        parent::setNotForPayment($notForPayment);

        if ($notForPayment === true) {
            $this->setPaymentReasonData('XXXXXX', 'XXXXXX', 'XXXXXX', 'XXXXXX');
            $this->setIban('XXXXXXXXXXXXXXXXXXXXX');
        }

        return $this;
    }

    /**
     * Get the IBAN number in human readable format
     *
     * Not valid for electronic transactions.
     *
     * @return string Formatted IBAN, if withIban is set to true.
     * @link http://en.wikipedia.org/wiki/International_Bank_Account_Number#Practicalities
     */
    public function getFormattedIban()
    {
        $iban = $this->getIban();
        return $this->breakStringIntoBlocks($iban, 4, false);

    }
}
