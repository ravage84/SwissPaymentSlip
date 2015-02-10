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

namespace SwissPaymentSlip\SwissPaymentSlip;

/**
 * Red Swiss Payment Slip Data
 *
 * Creates data containers for standard Swiss payment slips with or without reference number.
 * It doesn't actually do much. It's mostly a data container class to keep
 * including classes from having to care about how ESR work.
 * But it provides a flexibility of which data it holds, because not always
 * all slip fields are needed in an application.
 *
 * Glossary:
 * ESR = Einzahlungsschein mit Referenznummer
 *         ISR, (In-)Payment slip with reference number
 *         Summary term for orange payment slips in Switzerland
 * BESR = Banken-Einzahlungsschein mit Referenznummer
 *         Banking payment slip with reference number
 *         Orange payment slip for paying into a bank account (in contrast to a post cheque account with a VESR)
 * VESR = Verfahren für Einzahlungsschein mit Referenznummer
 *         Procedure for payment slip with reference number
 *         Orange payment slip for paying into a post cheque account (in contrast to a banking account with a BESR)
 * (B|V)ESR+ = Einzahlungsschein mit Referenznummer ohne Betragsangabe
 *         Payment slip with reference number without amount specification
 *         An payment slip can be issued without a predefined payment amount
 * ES = Einzahlungsschein
 *         IS, (In-)Payment slip
 *         Also summary term for all payment slips.
 *         Red payment slip for paying into a post cheque or bank account without reference number, with message box
 *
 * @link https://www.postfinance.ch/content/dam/pf/de/doc/consult/manual/dlserv/inpayslip_isr_man_de.pdf German manual
 * @link http://www.six-interbank-clearing.com/en/home/standardization/dta.html
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
     * @param bool $withIban True if yes, false if no.
     * @return $this The current instance for a fluent interface.
     */
    public function setWithIban($withIban = true)
    {
        if ($this->isBool($withIban, 'withIban')) {
            $this->withIban = $withIban;

            if ($withIban === false) {
                $this->iban = '';
            }
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
     * @param bool $withPaymentReason True if yes, false if no.
     * @return $this The current instance for a fluent interface.
     */
    public function setWithPaymentReason($withPaymentReason = true)
    {
        if ($this->isBool($withPaymentReason, 'withPaymentReason')) {
            $this->withPaymentReason = $withPaymentReason;

            if ($withPaymentReason === false) {
                $this->paymentReasonLine1 = '';
                $this->paymentReasonLine2 = '';
                $this->paymentReasonLine3 = '';
                $this->paymentReasonLine4 = '';
            }
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
     *
     * @todo Consider stripping spaces (may be optionally)
     * @todo Implement validation of the IBAN
     * @link http://code.google.com/p/php-iban/
     * @link https://github.com/jschaedl/Iban
     * @link http://www.ibancalculator.com/iban_validieren.html
     */
    public function setIban($iban)
    {
        if ($this->getWithIban()) {
            $this->iban = $iban;
        }

        return $this;
    }

    /**
     * Get the IBAN
     *
     * @return string|false The IBAN or false if withIban is false.
     */
    public function getIban()
    {
        if ($this->getWithIban()) {
            return $this->iban;
        }
        return false;
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
     */
    protected function setPaymentReasonLine1($paymentReasonLine1)
    {
        if ($this->getWithPaymentReason()) {
            $this->paymentReasonLine1 = $paymentReasonLine1;
        }

        return $this;
    }

    /**
     * Get the first line of the payment reason
     *
     * @return string|false The first line of the payment reason or false if withPaymentReason = false.
     */
    public function getPaymentReasonLine1()
    {
        if ($this->getWithPaymentReason()) {
            return $this->paymentReasonLine1;
        }
        return false;
    }

    /**
     * Set the second line of the payment reason
     *
     * @param string $paymentReasonLine2 The second line of the payment reason.
     * @return $this The current instance for a fluent interface.
     */
    protected function setPaymentReasonLine2($paymentReasonLine2)
    {
        if ($this->getWithPaymentReason()) {
            $this->paymentReasonLine2 = $paymentReasonLine2;
        }

        return $this;
    }

    /**
     * Get the second line of the payment reason
     *
     * @return string|false The second line of the payment reason or false if withPaymentReason = false.
     */
    public function getPaymentReasonLine2()
    {
        if ($this->getWithPaymentReason()) {
            return $this->paymentReasonLine2;
        }
        return false;
    }

    /**
     * Set the third line of the payment reason
     *
     * @param string $paymentReasonLine3 The third line of the payment reason.
     * @return $this The current instance for a fluent interface.
     */
    protected function setPaymentReasonLine3($paymentReasonLine3)
    {
        if ($this->getWithPaymentReason()) {
            $this->paymentReasonLine3 = $paymentReasonLine3;
        }

        return $this;
    }

    /**
     * Get the third line of the payment reason
     *
     * @return string|false The third line of the payment reason or false if withPaymentReason = false.
     */
    public function getPaymentReasonLine3()
    {
        if ($this->getWithPaymentReason()) {
            return $this->paymentReasonLine3;
        }
        return false;
    }

    /**
     * Set the fourth line of the payment reason
     *
     * @param string $paymentReasonLine4 The fourth line of the payment reason.
     * @return $this The current instance for a fluent interface.
     */
    protected function setPaymentReasonLine4($paymentReasonLine4)
    {
        if ($this->getWithPaymentReason()) {
            $this->paymentReasonLine4 = $paymentReasonLine4;
        }

        return $this;
    }

    /**
     * Get the fourth line of the payment reason
     *
     * @return string|false The fourth line of the payment reason or false if withPaymentReason = false.
     */
    public function getPaymentReasonLine4()
    {
        if ($this->getWithPaymentReason()) {
            return $this->paymentReasonLine4;
        }
        return false;
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
     * @return string|false Formatted IBAN or false if withIban is false.
     * @link http://en.wikipedia.org/wiki/International_Bank_Account_Number#Practicalities
     */
    public function getFormattedIban()
    {
        if (!$this->getWithIban()) {
            return false;
        }
        $iban = $this->getIban();
        if ($iban === false) {
            return false;
        }
        return $this->breakStringIntoBlocks($iban, 4, false);

    }

    /**
     * Get the full code line at the bottom of the ES
     *
     * @param bool $fillZeros Fill up with leading zeros.
     * @return string The full code line.
     * @throws \Exception When called,not yet implemented
     *
     * @todo Implement red slip support
     */
    public function getCodeLine($fillZeros = true)
    {
        throw new \Exception('Not yet implemented!');
    }
}
