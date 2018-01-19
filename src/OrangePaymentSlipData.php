<?php
/**
 * Swiss Payment Slip
 *
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 * @copyright 2012-2016 Some nice Swiss guys
 * @author Marc Würth ravage@bluewin.ch
 * @author Manuel Reinhard <manu@sprain.ch>
 * @author Peter Siska <pesche@gridonic.ch>
 * @link https://github.com/ravage84/SwissPaymentSlip/
 */

namespace SwissPaymentSlip\SwissPaymentSlip;

use SwissPaymentSlip\SwissPaymentSlip\Exception\DisabledDataException;
use SwissPaymentSlip\SwissPaymentSlip\Exception\ReferenceNumberException;
use SwissPaymentSlip\SwissPaymentSlip\Exception\BankingCustomerIdException;

/**
 * Orange Swiss Payment Slip Data
 *
 * A data container class to encapsulate all the necessary data
 * for an orange Swiss payment slip with reference number.
 *
 * @see PaymentSlipData For more information about the various payment slips.
 * @link https://www.postfinance.ch/content/dam/pf/de/doc/consult/manual/dlserv/inpayslip_isr_man_de.pdf German manual
 * for ISRs.
 */
class OrangePaymentSlipData extends PaymentSlipData
{
    const REFNR_MAX_LENGTH = 26;
    const BANKING_CUST_ID_MAX_LENGTH = 10;

    /**
     * Determines if the payment slip has a reference number.
     * Can be disabled for pre-printed payment slips.
     *
     * @var bool
     */
    protected $withReferenceNumber = true;

    /**
     * Determines if the payment slip's reference number should contain the banking customer ID.
     * Can be disabled for recipients who don't need this.
     *
     * @var bool
     */
    protected $withBankingCustomerId = true;

    /**
     * The reference number, without banking customer ID and check digit.
     *
     * @var string
     */
    protected $referenceNumber = '';

    /**
     * The banking customer ID, which will be prepended to the reference number.
     *
     * @var string
     */
    protected $bankingCustomerId = '';

    /**
     * The banking customer ID expected length.
     *
     * @var integer
     */
    protected $bankingCustomerIdLength = 0;

    /**
     * Set if payment slip has a reference number specified
     *
     * Resets the reference number when disabling.
     *
     * @param bool $withReferenceNumber True if yes, false if no.
     * @return $this The current instance for a fluent interface.
     */
    public function setWithReferenceNumber($withReferenceNumber = true)
    {
        $this->isBool($withReferenceNumber, 'withReferenceNumber');
        $this->withReferenceNumber = $withReferenceNumber;

        if ($withReferenceNumber === false) {
            $this->referenceNumber = '';
        }

        return $this;
    }

    /**
     * Get if payment slip has a reference number specified
     *
     * @return bool True if payment slip has a reference number specified, else false.
     */
    public function getWithReferenceNumber()
    {
        return $this->withReferenceNumber;
    }

    /**
     * Set if the payment slip's reference number should contain the banking customer ID
     *
     * Resets the banking customer ID when disabling.
     *
     * @param bool $withBankingCustomerId True if successful, else false.
     * @return $this The current instance for a fluent interface.
     */
    public function setWithBankingCustomerId($withBankingCustomerId = true)
    {
        $this->isBool($withBankingCustomerId, 'withBankingCustomerId');
        $this->withBankingCustomerId = $withBankingCustomerId;

        if ($withBankingCustomerId === false) {
            $this->bankingCustomerId = '';
            $this->bankingCustomerIdLength = 0;
        }

        return $this;
    }

    /**
     * Get if the payment slip's reference number should contain the banking customer ID.
     *
     * @return bool True if payment slip has the recipient specified, else false.
     */
    public function getWithBankingCustomerId()
    {
        return $this->withBankingCustomerId;
    }

    /**
     * Set the reference number
     *
     * @param string $referenceNumber The reference number.
     * @return $this The current instance for a fluent interface.
     * @throws DisabledDataException If the data is disabled.
     * @throws ReferenceNumberException If the length exceeds REFNR_MAX_LENGTH when adding banking customer length.
     */
    public function setReferenceNumber($referenceNumber)
    {
        if (!$this->getWithReferenceNumber()) {
            throw new DisabledDataException('reference number');
        }

        if (strlen($referenceNumber) + $this->bankingCustomerIdLength > self::REFNR_MAX_LENGTH) {
            throw new ReferenceNumberException('Reference number will exceed the maximum '
                    . 'of '. self::REFNR_MAX_LENGTH . ' digits when banking customer will be prepended');
        }

        // TODO validate reference number
        $this->referenceNumber = $referenceNumber;

        return $this;
    }

    /**
     * Get the reference number
     *
     * @return string The reference number, if withReferenceNumber is set to true.
     * @throws DisabledDataException If the data is disabled.
     */
    public function getReferenceNumber()
    {
        if (!$this->getWithReferenceNumber()) {
            throw new DisabledDataException('reference number');
        }
        return $this->referenceNumber;
    }

    /**
     * Set the banking customer ID
     *
     * @param string $bankingCustomerId The banking customer ID.
     * @return $this The current instance for a fluent interface.
     * @throws DisabledDataException If the data is disabled.
     * @throws ReferenceNumberException If the total length is greater than REFNR_MAX_LENGTH digits.
     * @throws BankingCustomerIdException If the length is greater than the expected length.
     */
    public function setBankingCustomerId($bankingCustomerId, $bankingCustomerIdLength = 6)
    {
        if (!$this->getWithBankingCustomerId()) {
            throw new DisabledDataException('banking customer ID');
        }

        if ($bankingCustomerIdLength > self::BANKING_CUST_ID_MAX_LENGTH) {
            throw new BankingCustomerIdException('Banking cutomer ID must not be longer than '
                    . self::BANKING_CUST_ID_MAX_LENGTH . ' digits');
        }

        if (strlen($bankingCustomerId) > $bankingCustomerIdLength) {
            throw new BankingCustomerIdException('Banking cutomer ID must not be longer than the specified length');
        }

        if (strlen($this->referenceNumber) + $bankingCustomerIdLength > self::REFNR_MAX_LENGTH) {
            throw new ReferenceNumberException('Reference number will exceed the maximum '
                    . 'of ' . self::REFNR_MAX_LENGTH . ' digits when banking customer will be prepended');
        }

        $this->bankingCustomerIdLength = $bankingCustomerIdLength;
        $this->bankingCustomerId = $bankingCustomerId;

        return $this;
    }

    /**
     * Get the banking customer ID padded with zeroes
     *
     * @return string The banking customer ID, if withBankingCustomerId is set to true.
     * @throws DisabledDataException If the data is disabled.
     */
    public function getBankingCustomerId()
    {
        if (!$this->getWithBankingCustomerId()) {
            throw new DisabledDataException('banking customer ID');
        }

        return str_pad($this->bankingCustomerId, $this->bankingCustomerIdLength, '0', STR_PAD_LEFT);
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
            if ($this->getWithReferenceNumber() === true) {
                $this->setReferenceNumber('XXXXXXXXXXXXXXXXXXXX');
            }
            if ($this->getWithBankingCustomerId() === true) {
                $this->setBankingCustomerId('XXXXXX');
            }
        }

        return $this;
    }

    /**
     * Get complete reference number
     *
     * @param bool $formatted Should the returned reference be formatted in blocks of five (for better readability).
     * @param bool $fillZeros Fill up with leading zeros, only applies to the case where no banking customer ID is used.
     * @return string The complete (with/without bank customer ID), formatted reference number with check digit.
     * @throws ReferenceNumberException if wrong length or is not numerical.
     */
    public function getCompleteReferenceNumber($formatted = true, $fillZeros = true)
    {
        $referenceNumber = $this->getReferenceNumber();
        $notForPayment = $this->getNotForPayment();

        $completeReferenceNumber = $referenceNumber;
        if ($notForPayment) {
            $completeReferenceNumber = str_pad($referenceNumber, self::REFNR_MAX_LENGTH, 'X', STR_PAD_LEFT);
        } elseif ($this->getWithBankingCustomerId()) {
            // Get reference number and fill with zeros
            $padLength = self::REFNR_MAX_LENGTH - $this->bankingCustomerIdLength;
            $referenceNumber = str_pad($referenceNumber, $padLength, '0', STR_PAD_LEFT);
            // Prepend banking customer identification code
            $completeReferenceNumber = $this->getBankingCustomerId() . $referenceNumber;

            if (strlen($completeReferenceNumber) !== self::REFNR_MAX_LENGTH) {
                throw new ReferenceNumberException('Reference number must have '
                        . self::REFNR_MAX_LENGTH . ' digits');
            }

            if (!is_numeric($completeReferenceNumber)) {
                throw new ReferenceNumberException('Reference number [ '
                        . $completeReferenceNumber . '] must be a numerical value');
            }
        } elseif ($fillZeros) {
            // Get reference number and fill with zeros
            $completeReferenceNumber = str_pad($referenceNumber, self::REFNR_MAX_LENGTH, '0', STR_PAD_LEFT);
        }

        // Add check digit
        $completeReferenceNumber = $this->appendCheckDigit($completeReferenceNumber, $notForPayment);

        if ($formatted) {
            $completeReferenceNumber = $this->breakStringIntoBlocks($completeReferenceNumber);
        }

        return $completeReferenceNumber;
    }

    /**
     * Append the check digit to the reference number
     *
     * Simply appends an 'X' if the slip is not meant for payment.
     *
     * @param string $referenceNumber The reference number to calculate the prefix with.
     * @param bool $notForPayment Whether the payment slip is not ment. for payment.
     * @return string The reference number with the appended check digit.
     */
    protected function appendCheckDigit($referenceNumber, $notForPayment = false)
    {
        if ($notForPayment === true) {
            return $referenceNumber . 'X';
        }
        return $referenceNumber . $this->modulo10($referenceNumber);
    }

    /**
     * Get the full code line at the bottom of the ESR
     *
     * @param bool $fillZeros Whether to fill up the code line with leading zeros.
     * @return string The full code line.
     */
    public function getCodeLine($fillZeros = true)
    {
        $referenceNumber = $this->getCompleteReferenceNumber(false, $fillZeros);
        $accountNumber = $this->getAccountDigits();

        if ($this->getWithAmount()) {
            $francs = $this->getAmountFrancs();
            $cents = $this->getAmountCents();
            $francs = str_pad($francs, 8, '0', STR_PAD_LEFT);
            $cents = str_pad($cents, 2, '0', STR_PAD_RIGHT);
            $amountPart = $francs . $cents;

            // Only in case where the $amountPart is numeric to avoid PHP7.1 warning
            // These variables are set below
            if($this->getNotForPayment() === false) {
                $amountPrefix = '01';
                $amountCheck = $this->modulo10($amountPrefix . $amountPart);
            }
        } else {
            $amountPrefix = '04';
            $amountPart = '';
            $amountCheck = '2';
        }

        if ($fillZeros) {
            $referenceNumberPart = str_pad($referenceNumber, 27, '0', STR_PAD_LEFT);
        } else {
            $referenceNumberPart = $referenceNumber;
        }

        $accountNumberPart = substr($accountNumber, 0, 2) .
            str_pad(substr($accountNumber, 2), 7, '0', STR_PAD_LEFT);

        if ($this->getNotForPayment()) {
            $amountPrefix = 'XX';
            $amountCheck = 'X';
        }

        $codeLine = sprintf(
            '%s%s%s>%s+ %s>',
            $amountPrefix,
            $amountPart,
            $amountCheck,
            $referenceNumberPart,
            $accountNumberPart
        );

        return $codeLine;
    }
}
