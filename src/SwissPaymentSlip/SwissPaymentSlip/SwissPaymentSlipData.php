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

use InvalidArgumentException;

/**
 * Swiss Payment SLip Data
 *
 * Creates data containers for standard Swiss payment slips with or without reference number.
 * It doesn't actually do much. It's mostly a data container class to keep
 * including classes from having to care about how SwissPaymentSlip works.
 * But it provides a flexibility of which data it holds, because not always
 * all slip fields are needed in an application.
 *
 * Glossary:
 * SwissPaymentSlip = Einzahlungsschein mit Referenznummer
 * 		Payment slip with reference number
 * 		Summary term for orange payment slips in Switzerland
 * BESR = Banken-Einzahlungsschein mit Referenznummer
 * 		Banking payment slip with reference number
 * 		Orange payment slip for paying into a bank account (in contrast to a post cheque account with a VESR)
 * VESR = Verfahren für Einzahlungsschein mit Referenznummer
 * 		Procedure for payment slip with reference number
 * 		Orange payment slip for paying into a post cheque account (in contrast to a banking account with a BESR)
 * (B|V)SwissPaymentSlip+ = Einzahlungsschein mit Referenznummer ohne Betragsangabe
 * 		Payment slip with reference number without amount specification
 * 		An payment slip can be issued without a predefined payment amount
 * ES = Einzahlungsschein
 * 		Payment slip
 * 		Red payment slip for paying into a post cheque or bank account without reference number but message box
 *
 * @link https://www.postfinance.ch/content/dam/pf/de/doc/consult/manual/dlserv/inpayslip_isr_man_de.pdf German manual
 * @link http://www.six-interbank-clearing.com/en/home/standardization/dta.html
 *
 * @todo Implement full red slip support (code line + additional code line)
 * @todo Implement currency (CHF, EUR), means different prefixes in code line
 * @todo Implement payment on own account, means different prefixes in code line --> edge case!
 * @todo Implement cash on delivery (Nachnahme), means different prefixes in code line --> do it on demand
 * @todo Implement amount check for unrounded (.05) cents, document why (see manual)
 */
class SwissPaymentSlipData
{
	/**
	 * Constant for orange payment slips
	 */
	const ORANGE = 'orange';

	/**
	 * Constant for red payment slips
	 */
	const RED = 'red';

	/**
	 * Consists the array table for calculating the check digit by modulo 10
	 *
	 * @var array Table for calculating the check digit by modulo 10
	 */
	private $moduloTable = array(0,9,4,6,8,2,7,1,3,5);

	/**
	 * Determines the payment slip type.
	 * Either orange or red
	 *
	 * @var string Orange or red payment slip
	 */
	protected $type = self::ORANGE;

	/**
	 * Determines if the payment slip must not be used for payment (XXXed out)
	 *
	 * @var bool Normally false, true if not for payment
	 */
	protected $notForPayment = false;

	/**
	 * Determines if the payment slip has a recipient bank. Can be disabled for preprinted payment slips
	 *
	 * @var bool True if yes, false if no
	 */
	protected $withBank = true;

	/**
	 * Determines if the payment slip has a account number. Can be disabled for preprinted payment slips
	 *
	 * @var bool True if yes, false if no
	 */
	protected $withAccountNumber = true;

	/**
	 * Determines if the payment slip has a recipient. Can be disabled for preprinted payment slips
	 *
	 * @var bool True if yes, false if no
	 */
	protected $withRecipient = true;

	/**
	 * Determines if it's an SwissPaymentSlip or an SwissPaymentSlip+
	 *
	 * @var bool True for SwissPaymentSlip, false for SwissPaymentSlip+
	 */
	protected $withAmount = true;

	/**
	 * Determines if the payment slip has a reference number. Can be disabled for preprinted payment slips
	 *
	 * @var bool True if yes, false if no
	 */
	protected $withReferenceNumber = true;

	/**
	 * Determines if the payment slip's reference number should contain the banking customer id.
	 * Can be disabled for recipients who don't need this
	 *
	 * @var bool True if yes, false if no
	 */
	protected $withBankingCustomerId = true;

	/**
	 * Determines if the payment slip has a payer. Can be disabled for preprinted payment slips
	 *
	 * @var bool True if yes, false if no
	 */
	protected $withPayer = true;

	/**
	 * Determines if the payment slip has a IBAN specified. Can be disabled for preprinted payment slips
	 * Only possible for ES, but not for SwissPaymentSlip
	 *
	 * @var bool True if yes, false if no
	 */
	protected $withIban = false;

	/**
	 * Determines if the payment slip has a payment reason. Can be disabled for preprinted payment slips
	 * Only possible for ES, but not for SwissPaymentSlip
	 *
	 * @var bool True if yes, false if no
	 */
	protected $withPaymentReason = true;

	/**
	 * The name of the bank
	 *
	 * @var string The name of the bank
	 */
	protected $bankName = '';

	/**
	 * The postal code and city of the bank
	 *
	 * @var string The postal code and city of the bank
	 */
	protected $bankCity = '';

	/**
	 * The bank or post cheque account where the money will be transferred to
	 *
	 * @var string The bank or post cheque account
	 */
	protected $accountNumber = '';

	/**
	 * The first line of the recipient, e.g. "My Company Ltd."
	 *
	 * @var string The first line of the recipient
	 */
	protected $recipientLine1 = '';

	/**
	 * The second line of the recipient, e.g. "Examplestreet 61"
	 *
	 * @var string The second line of the recipient
	 */
	protected $recipientLine2 = '';

	/**
	 * The third line of the recipient, e.g. "8000 Zürich"
	 *
	 * @var string The third line of the recipient
	 */
	protected $recipientLine3 = '';

	/**
	 * The fourth line of the recipient, if needed
	 *
	 * @var string The fourth line of the recipient
	 */
	protected $recipientLine4 = '';

	/**
	 * The amount to be payed into. Can be disabled with withAmount = false for SwissPaymentSlip+ slips
	 *
	 * @var float The amount to be payed into
	 */
	protected $amount = 0.0;

	/**
	 * The reference number, without banking customer id and check digit
	 *
	 * @var string The reference number
	 */
	protected $referenceNumber = '';

	/**
	 * The banking customer id, which will be prepended to the reference number
	 *
	 * @var string The banking customer id
	 */
	protected $bankingCustomerId = '';

	/**
	 * The first line of the payer, e.g. "Hans Mustermann"
	 *
	 * @var string The first line of the payer
	 */
	protected $payerLine1 = '';

	/**
	 * The second line of the payer, e.g. "Main Street 11"
	 *
	 * @var string The second line of the payer
	 */
	protected $payerLine2 = '';

	/**
	 * The third line of the payer, e.g. "4052 Basel"
	 *
	 * @var string The third line of the payer
	 */
	protected $payerLine3 = '';

	/**
	 * The fourth line of the payer, if needed
	 *
	 * @var string The fourth line of the payer
	 */
	protected $payerLine4 = '';

	/**
	 * The IBAN of the recipient of a ES. Not available on a SwissPaymentSlip
	 *
	 * @var string The IBAN of the recipient
	 */
	protected $iban = '';

	/**
	 * The first line of the payment reason of a ES. Not available on a SwissPaymentSlip
	 *
	 * @var string The first line of the payment reason
	 */
	protected $paymentReasonLine1 = '';

	/**
	 * The second line of the payment reason of a ES. Not available on a SwissPaymentSlip
	 *
	 * @var string The second line of the payment reason
	 */
	protected $paymentReasonLine2 = '';

	/**
	 * The third line of the payment reason of a ES. Not available on a SwissPaymentSlip
	 *
	 * @var string The third line of the payment reason
	 */
	protected $paymentReasonLine3 = '';

	/**
	 * The fourth line of the payment reason of a ES. Not available on a SwissPaymentSlip
	 *
	 * @var string The fourth line of the payment reason
	 */
	protected $paymentReasonLine4 = '';

	/**
	 * Construct an empty payment slip
	 *
	 * By default it creates an empty orange payment slip.
	 * Can be changed to a red one by supplying red as parameter.
	 *
	 * @param string $type The slip type, either orange or red
	 */
	public function __construct($type = self::ORANGE)
	{
		$this->setType($type, true);
	}

	/**
	 * Set payment slip type. Resets settings and data if changing the type or being forced to
	 *
	 * @param string $type The slip type
	 * @param bool $forceReset Force a data reset according to the given type
	 * @throws \InvalidArgumentException
	 * @return bool True if successful
	 */
	public function setType($type = self::ORANGE, $forceReset = false)
	{
		if (!is_string($type)) {
			throw new InvalidArgumentException('Type parameter is not a string!');
		}
		if (!is_bool($forceReset)) {
			throw new InvalidArgumentException('ForceReset parameter is not a bool!');
		}
		$type = strtolower($type);
		if ($type !== self::ORANGE && $type !== self::RED) {
			throw new InvalidArgumentException('Invalid type parameter ' . $type . '!');
		}

		if ($this->type != $type || $forceReset) {
			$this->type = $type;

			if ($type == self::ORANGE) {
				$this->setOrangeDefaults();
			} elseif ($type == self::RED) {
				$this->setRedDefaults();
			}
		}
		return true;
	}

	/**
	 * Set the default values for the orange payment slip
	 */
	protected function setOrangeDefaults() {
		$this->setWithBank(true);
		$this->setWithAccountNumber(true);
		$this->setWithRecipient(true);
		$this->setWithAmount(true);
		$this->setWithReferenceNumber(true);
		$this->setWithBankingCustomerId(true);
		$this->setWithPayer(true);
		$this->setWithIban(false);
		$this->setWithPaymentReason(false);
	}

	/**
	 * Set the default values for the red payment slip
	 */
	protected function setRedDefaults() {
		$this->setWithBank(true);
		$this->setWithAccountNumber(true);
		$this->setWithRecipient(true);
		$this->setWithAmount(true);
		$this->setWithReferenceNumber(false);
		$this->setWithBankingCustomerId(false);
		$this->setWithPayer(true);
		$this->setWithIban(true);
		$this->setWithPaymentReason(true);
	}

	/**
	 * Get payment slip type
	 *
	 * @return string The slip type
	 */
	public function getType()
	{
		return $this->type;
	}

	/**
	 * Set payment slip for not to be used for payment
	 *
	 * XXXes out all fields to prevent people using the payment slip.
	 *
	 * @param boolean $notForPayment True if not for payment, else false
	 */
	public function setNotForPayment($notForPayment = true)
	{
		$this->notForPayment = $notForPayment;

		if ($notForPayment === true) {
			$this->setBankData('XXXXXX', 'XXXXXX');
			$this->setAccountNumber('XXXXXX');
			$this->setRecipientData('XXXXXX', 'XXXXXX', 'XXXXXX', 'XXXXXX');
			$this->setPayerData('XXXXXX', 'XXXXXX', 'XXXXXX', 'XXXXXX');

			$this->setAmount('XXXXXXXX.XX');
			$this->setReferenceNumber('XXXXXXXXXXXXXXXXXXXX');
			$this->setBankingCustomerId('XXXXXX');
		}
	}

	/**
	 * Get whether this payment slip must not be used for payment
	 *
	 * @return bool
	 */
	public function getNotForPayment() {
		return $this->notForPayment;
	}

	/**
	 * Set if payment slip has a bank specified
	 *
	 * @param bool $withBank True for yes, false for no
	 * @return bool True if successful, else false
	 */
	public function setWithBank($withBank = true)
	{
		if (is_bool($withBank)) {
			$this->withBank = $withBank;

			if (!$withBank) {
				$this->bankName = '';
				$this->bankCity = '';
			}
			return true;
		}
		return false;
	}

	/**
	 * Get if payment slip has recipient specified
	 *
	 * @return bool True if payment slip has the recipient specified, else false
	 */
	public function getWithBank()
	{
		return $this->withBank;
	}

	/**
	 * Set if payment slip has an account number specified
	 *
	 * @param bool $withAccountNumber True if yes, false if no
	 * @return bool True if successful, else false
	 */
	public function setWithAccountNumber($withAccountNumber = true)
	{
		if (is_bool($withAccountNumber)) {
			$this->withAccountNumber = $withAccountNumber;

			if (!$withAccountNumber) {
				$this->accountNumber = '';
			}
			return true;
		}
		return false;
	}

	/**
	 * Get if payment slip has an account number specified
	 *
	 * @return bool True if payment slip has an account number specified, else false
	 */
	public function getWithAccountNumber()
	{
		return $this->withAccountNumber;
	}

	/**
	 * Set if payment slip has a recipient specified
	 *
	 * @param bool $withRecipient True if yes, false if no
	 * @return bool True if successful, else false
	 */
	public function setWithRecipient($withRecipient = true)
	{
		if (is_bool($withRecipient)) {
			$this->withRecipient = $withRecipient;

			if (!$withRecipient) {
				$this->recipientLine1 = '';
				$this->recipientLine2 = '';
				$this->recipientLine3 = '';
				$this->recipientLine4 = '';
			}
			return true;
		}
		return false;
	}

	/**
	 * Get if payment slip has a recipient specified
	 *
	 * @return bool True if payment slip has a recipient specified, else false
	 */
	public function getWithRecipient()
	{
		return $this->withRecipient;
	}

	/**
	 * Set if payment slip has an amount specified
	 *
	 * @param bool $withAmount True for yes, false for no
	 * @return bool True if successful, else false
	 */
	public function setWithAmount($withAmount = true)
	{
		if (is_bool($withAmount)) {
			$this->withAmount = $withAmount;

			if (!$withAmount) {
				$this->amount = 0.0;
			}
			return true;
		}
		return false;
	}

	/**
	 * Get if payment slip has an amount specified
	 *
	 * @return bool True if payment slip has an amount specified, else false
	 */
	public function getWithAmount()
	{
		return $this->withAmount;
	}

	/**
	 * Set if payment slip has a reference number specified
	 *
	 * Resets reference number if disabled
	 *
	 * @param bool $withReferenceNumber True if yes, false if no
	 * @return bool True if successful, else false
	 */
	public function setWithReferenceNumber($withReferenceNumber = true)
	{
		if ($this->getType() == self::ORANGE) {
			if (is_bool($withReferenceNumber)) {
				$this->withReferenceNumber = $withReferenceNumber;

				if (!$withReferenceNumber) {
					$this->referenceNumber = '';
				}
				return true;
			}
		} else {
			$this->withReferenceNumber = false;
			$this->referenceNumber = '';
		}
		return false;
	}

	/**
	 * Get if payment slip has a reference number specified
	 *
	 * @return bool True if payment slip has a reference number specified, else false
	 */
	public function getWithReferenceNumber()
	{
		return $this->withReferenceNumber;
	}

	/**
	 * Set if the payment slip's reference number should contain the banking customer id
	 *
	 * @param bool $withBankingCustomerId True if successful, else false
	 * @return bool True if successful, else false
	 */
	public function setWithBankingCustomerId($withBankingCustomerId = true)
	{
		if ($this->getType() == self::ORANGE) {
			if (is_bool($withBankingCustomerId)) {
				$this->withBankingCustomerId = $withBankingCustomerId;

				if (!$withBankingCustomerId) {
					$this->bankingCustomerId = '';
				}
				return true;
			}
		} else {
			$this->withBankingCustomerId = false;
			$this->bankingCustomerId = '';
		}
		return false;
	}

	/**
	 * Get if the payment slip's reference number should contain the banking customer id.
	 *
	 * @return bool True if payment slip has the recipient specified, else false
	 */
	public function getWithBankingCustomerId()
	{
		return $this->withBankingCustomerId;
	}

	/**
	 * Set if payment slip has a payer specified
	 *
	 * @param bool $withPayer True if yes, false if no
	 * @return bool True if successful, else false
	 */
	public function setWithPayer($withPayer = true)
	{
		if (is_bool($withPayer)) {
			$this->withPayer = $withPayer;

			if (!$withPayer) {
				$this->payerLine1 = '';
				$this->payerLine2 = '';
				$this->payerLine3 = '';
				$this->payerLine4 = '';
			}
			return true;
		}
		return false;
	}

	/**
	 * Get if payment slip has a payer specified
	 *
	 * @return bool True if payment slip has a payer specified, else false
	 */
	public function getWithPayer()
	{
		return $this->withPayer;
	}

	/**
	 * Set if payment slip has an IBAN specified.
	 * Only available for red payment slips
	 *
	 * @param bool $withIban True if yes, false if no
	 * @return bool True if successful, else false
	 */
	public function setWithIban($withIban = false)
	{
		if ($this->getType() == self::RED) {
			if (is_bool($withIban)) {
				$this->withIban = $withIban;

				if (!$withIban) {
					$this->iban = '';
				}
				return true;
			}
		} else {
			$this->withIban = false;
			$this->iban = '';
		}
		return false;
	}

	/**
	 * Get if payment slip has an IBAN specified
	 *
	 * @return bool True if payment slip has an IBAN specified, else false
	 */
	public function getWithIban()
	{
		return $this->withIban;
	}

	/**
	 * Set if payment slip has a payment reason specified.
	 * Only available for red payment slips
	 *
	 * @param bool $withPaymentReason
	 * @return bool True if successful, else false
	 */
	public function setWithPaymentReason($withPaymentReason = false)
	{
		if ($this->getType() == self::RED) {
			if (is_bool($withPaymentReason)) {
				$this->withPaymentReason = $withPaymentReason;

				if (!$withPaymentReason) {
					$this->paymentReasonLine1 = '';
					$this->paymentReasonLine2 = '';
					$this->paymentReasonLine3 = '';
					$this->paymentReasonLine4 = '';
				}
				return true;
			}
		} else {
			$this->withPaymentReason = false;
			$this->paymentReasonLine1 = '';
			$this->paymentReasonLine2 = '';
			$this->paymentReasonLine3 = '';
			$this->paymentReasonLine4 = '';
		}
		return false;
	}

	/**
	 * Get if payment slip has a payment reason specified
	 *
	 * @return bool True if payment slip has a payment reason specified, else false
	 */
	public function getWithPaymentReason()
	{
		return $this->withPaymentReason;
	}

	/**
	 * Sets the name, city and account number of the bank
	 *
	 * @param string $bankName       Name of the bank
	 * @param string $bankCity       City of the bank
	 * @return bool True if successful, else false
	 */
	public function setBankData($bankName, $bankCity)
	{
		if (!$this->setBankName($bankName)) {
			return false;
		}
		if (!$this->setBankCity($bankCity)) {
			return false;
		}

		return true;
	}

	// TODO create a getBankData with formatting parameter

	/**
	 * Set the name of the bank
	 *
	 * @param string $bankName The name of the bank
	 * @return bool True if successful, else false
	 *
	 * @todo Implement max length check
	 */
	protected function setBankName($bankName)
	{
		if ($this->getWithBank()) {
			$this->bankName = $bankName;
			return true;
		}
		return false;
	}

	/**
	 * Get the name of the bank
	 *
	 * @return string|bool The name of the bank or false if withBank = false
	 */
	public function getBankName()
	{
		if ($this->getWithBank()) {
			return $this->bankName;
		}
		return false;
	}

	/**
	 * Set the postal code and city of the bank
	 *
	 * @param string $bankCity The postal code and city of the bank
	 * @return bool True if successful, else false
	 *
	 * @todo Implement max length check
	 */
	protected function setBankCity($bankCity)
	{
		if ($this->getWithBank()) {
			$this->bankCity = $bankCity;
			return true;
		}
		return false;
	}

	/**
	 * Get the postal code and city of the bank
	 *
	 * @return string|bool The postal code and city of the bank or false if withBank = false
	 */
	public function getBankCity()
	{
		if ($this->getWithBank()) {
			return $this->bankCity;
		}
		return false;
	}

	/**
	 * Set the bank or post cheque account where the money will be transferred to
	 *
	 * @param string $accountNumber The bank or post cheque account
	 * @return bool True if successful, else false
	 *
	 * @todo Implement parameter validation (two hyphens, min & max length)
	 */
	public function setAccountNumber($accountNumber)
	{
		if ($this->getWithAccountNumber()) {
			$this->accountNumber = $accountNumber;
			return true;
		}
		return false;
	}

	/**
	 * Get the bank or post cheque account where the money will be transferred to
	 *
	 * @return string|bool The bank or post cheque account or false if withAccountNumber = false
	 */
	public function getAccountNumber()
	{
		if ($this->getWithAccountNumber()) {
			return $this->accountNumber;
		}
		return false;
	}

	/**
	 * Sets the four lines of the recipient
	 *
	 * @param string $recipientLine1 The first line of the recipient, e.g. "My Company Ltd."
	 * @param string $recipientLine2 The second line of the recipient, e.g. "Examplestreet 61"
	 * @param string $recipientLine3 The third line of the recipient, e.g. "8000 Zürich"
	 * @param string $recipientLine4 The fourth line of the recipient, if needed
	 * @return bool True if successful, else false
	 */
	public function setRecipientData($recipientLine1, $recipientLine2, $recipientLine3 = '', $recipientLine4 = '')
	{
		if (!$this->setRecipientLine1($recipientLine1) ||
			!$this->setRecipientLine2($recipientLine2) ||
			!$this->setRecipientLine3($recipientLine3) ||
			!$this->setRecipientLine4($recipientLine4)) {
			return false;
		}
		return true;
	}

	// TODO create a getRecipientData with formatting parameter

	/**
	 * Set the first line of the recipient
	 *
	 * @param string $recipientLine1 The first line of the recipient, e.g. "My Company Ltd."
	 * @return bool True if successful, else false
	 */
	protected function setRecipientLine1($recipientLine1)
	{
		if ($this->getWithRecipient()) {
			$this->recipientLine1 = $recipientLine1;
			return true;
		}
		return false;
	}

	/**
	 * Get the first line of the recipient
	 *
	 * @return string|bool The first line of the recipient or false if withRecipient = false
	 */
	public function getRecipientLine1()
	{
		if ($this->getWithRecipient()) {
			return $this->recipientLine1;
		}
		return false;
	}

	/**
	 * Set the second line of the recipient
	 *
	 * @param string $recipientLine2 The second line of the recipient, e.g. "Examplestreet 61"
	 * @return bool True if successful, else false
	 */
	protected function setRecipientLine2($recipientLine2)
	{
		if ($this->getWithRecipient()) {
			$this->recipientLine2 = $recipientLine2;
			return true;
		}
		return false;
	}

	/**
	 * Get the second line of the recipient
	 *
	 * @return string|bool The second line of the recipient or false if withRecipient = false
	 */
	public function getRecipientLine2()
	{
		if ($this->getWithRecipient()) {
			return $this->recipientLine2;
		}
		return false;
	}

	/**
	 * Set the third line of the recipient
	 *
	 * @param string $recipientLine3 The third line of the recipient, e.g. "8000 Zürich"
	 * @return bool True if successful, else false
	 */
	protected function setRecipientLine3($recipientLine3)
	{
		if ($this->getWithRecipient()) {
			$this->recipientLine3 = $recipientLine3;
			return true;
		}
		return false;
	}

	/**
	 * Get the third line of the recipient
	 *
	 * @return string|bool The third line of the recipient or false if withRecipient = false
	 */
	public function getRecipientLine3()
	{
		if ($this->getWithRecipient()) {
			return $this->recipientLine3;
		}
		return false;
	}

	/**
	 * Set the fourth line of the recipient
	 *
	 * @param string $recipientLine4 The fourth line of the recipient, if needed
	 * @return bool True if successful, else false
	 */
	protected function setRecipientLine4($recipientLine4)
	{
		if ($this->getWithRecipient()) {
			$this->recipientLine4 = $recipientLine4;
			return true;
		}
		return false;
	}

	/**
	 * Get the fourth line of the recipient
	 *
	 * @return string|bool The fourth line of the recipient or false if withRecipient = false
	 */
	public function getRecipientLine4()
	{
		if ($this->getWithRecipient()) {
			return $this->recipientLine4;
		}
		return false;
	}

	/**
	 * Set the amount of the payment slip. Only possible if it's not a SwissPaymentSlip+
	 *
	 * @param float $amount The amount to be payed into
	 * @return bool True if successful, else false
	 */
	public function setAmount($amount = 0.0)
	{
		if ($this->getWithAmount()) {
			$this->amount = $amount;
			return true;
		}
		return false;
	}

	/**
	 * Get the amount to be payed into
	 *
	 * @return float The amount to be payed into
	 */
	public function getAmount()
	{
		if ($this->getWithAmount()) {
			return $this->amount;
		}
		return false;
	}

	/**
	 * Set the reference number
	 *
	 * @param string $referenceNumber The reference number
	 * @return bool True if successful, else false
	 */
	public function setReferenceNumber($referenceNumber)
	{
		if ($this->getWithReferenceNumber()) {
			// TODO validate reference number
			$this->referenceNumber = $referenceNumber;
			return true;
		}
		return false;
	}

	/**
	 * Get the reference number
	 *
	 * @return string|bool The reference number or false if withReferenceNumber is false
	 */
	public function getReferenceNumber()
	{
		if ($this->getWithReferenceNumber()) {
			return $this->referenceNumber;
		}
		return false;
	}

	/**
	 * Set the banking customer id
	 *
	 * @param string $bankingCustomerId The banking customer id
	 * @return bool True if successful, else false
	 */
	public function setBankingCustomerId($bankingCustomerId)
	{
		if ($this->getWithBankingCustomerId()) {
			// TODO check length (exactly 6)
			$this->bankingCustomerId = $bankingCustomerId;
			return true;
		}
		return false;
	}

	/**
	 * Get the banking customer id
	 *
	 * @return string|bool The  banking customer id or false if withBankingCustomerId is false
	 */
	public function getBankingCustomerId()
	{
		if ($this->getWithBankingCustomerId()) {
			return $this->bankingCustomerId;
		}
		return false;
	}

	/**
	 * Sets the four lines of the payer
	 *
	 * @param string $payerLine1 The first line of the payer, e.g. "Hans Mustermann"
	 * @param string $payerLine2 The second line of the payer, e.g. "Main Street 11"
	 * @param string $payerLine3 The third line of the payer, e.g. "4052 Basel"
	 * @param string $payerLine4 The fourth line of the payer, if needed
	 * @return bool True if successful, else false
	 */
	public function setPayerData($payerLine1, $payerLine2, $payerLine3 = '', $payerLine4 = '')
	{
		if (!$this->setPayerLine1($payerLine1) ||
			!$this->setPayerLine2($payerLine2) ||
			!$this->setPayerLine3($payerLine3) ||
			!$this->setPayerLine4($payerLine4)) {
			return false;
		}
		return true;
	}

	/**
	 * Set the first line of the payer
	 *
	 * @param string $payerLine1 The first line of the payer, e.g. "Hans Mustermann"
	 * @return bool True if successful, else false
	 */
	protected function setPayerLine1($payerLine1)
	{
		if ($this->getWithPayer()) {
			$this->payerLine1 = $payerLine1;
			return true;
		}
		return false;
	}

	/**
	 * Get the first line of the payer
	 *
	 * @return string|bool The first line of the payer or false if withPayer = false
	 */
	public function getPayerLine1()
	{
		if ($this->getWithPayer()) {
			return $this->payerLine1;
		}
		return false;
	}

	/**
	 * Set the second line of the payer
	 *
	 * @param string $payerLine2 The second line of the payer, e.g. "Main Street 11"
	 * @return bool True if successful, else false
	 */
	protected function setPayerLine2($payerLine2)
	{
		if ($this->getWithPayer()) {
			$this->payerLine2 = $payerLine2;
			return true;
		}
		return false;
	}

	/**
	 * Get the second line of the payer
	 *
	 * @return string|bool The second line of the payer or false if withPayer = false
	 */
	public function getPayerLine2()
	{
		if ($this->getWithPayer()) {
			return $this->payerLine2;
		}
		return false;
	}

	/**
	 * Set the third line of the payer
	 *
	 * @param string $payerLine3 The third line of the payer, e.g. "4052 Basel"
	 * @return bool True if successful, else false
	 */
	protected function setPayerLine3($payerLine3)
	{
		if ($this->getWithPayer()) {
			$this->payerLine3 = $payerLine3;
			return true;
		}
		return false;
	}

	/**
	 * Get the third line of the payer
	 *
	 * @return string|bool The third line of the payer or false if withPayer = false
	 */
	public function getPayerLine3()
	{
		if ($this->getWithPayer()) {
			return $this->payerLine3;
		}
		return false;
	}

	/**
	 * Set the fourth line of the payer
	 *
	 * @param string $payerLine4 The fourth line of the payer, if needed
	 * @return bool True if successful, else false
	 */
	protected function setPayerLine4($payerLine4)
	{
		if ($this->getWithPayer()) {
			$this->payerLine4 = $payerLine4;
			return true;
		}
		return false;
	}

	/**
	 * Get the fourth line of the payer
	 *
	 * @return string|bool The fourth line of the payer or false if withPayer = false
	 */
	public function getPayerLine4()
	{
		if ($this->getWithPayer()) {
			return $this->payerLine4;
		}
		return false;
	}

	/**
	 * Set the IBAN
	 *
	 * @param $iban String The IBAN
	 * @return bool True if successful, else false
	 */
	public function setIban($iban)
	{
		if ($this->getWithIban()) {
			// TODO plausible IBAN method http://www.six-interbank-clearing.com/de/tkicch_financialinstitutions_ibanipi.htm
			// TODO check if to implement http://code.google.com/p/php-iban/ (composer!)
			// TODO At least strip spaces (may be more?)
			$this->iban = $iban;
			return true;
		}
		return false;
	}

	/**
	 * Get the IBAN
	 *
	 * @return string|bool The IBAN or false if withIban is false
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
	 * @param string $paymentReasonLine1 The first line of the payment reason
	 * @param string $paymentReasonLine2 The second line of the payment reason
	 * @param string $paymentReasonLine3 The third line of the payment reason
	 * @param string $paymentReasonLine4 The fourth line of the payment reason
	 * @return bool True if successful, else false
	 */
	public function setPaymentReasonData($paymentReasonLine1 = '',$paymentReasonLine2 = '',
									 $paymentReasonLine3 = '', $paymentReasonLine4 = '')
	{
		if (!$this->setPaymentReasonLine1($paymentReasonLine1) ||
			!$this->setPaymentReasonLine2($paymentReasonLine2) ||
			!$this->setPaymentReasonLine3($paymentReasonLine3) ||
			!$this->setPaymentReasonLine4($paymentReasonLine4)) {
			return false;
		}
		return true;
	}

	// TODO create a getPaymentReason with formatting parameter

	/**
	 * Set the first line of the payment reason
	 *
	 * @param string $paymentReasonLine1 The first line of the payment reason
	 * @return bool True if successful, else false
	 */
	protected function setPaymentReasonLine1($paymentReasonLine1)
	{
		if ($this->getWithPaymentReason()) {
			$this->paymentReasonLine1 = $paymentReasonLine1;
			return true;
		}
		return false;
	}

	/**
	 * Get the first line of the payment reason
	 *
	 * @return string|bool The first line of the payment reason or false if withPaymentReason = false
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
	 * @param string $paymentReasonLine2 The second line of the payment reason
	 * @return bool True if successful, else false
	 */
	protected function setPaymentReasonLine2($paymentReasonLine2)
	{
		if ($this->getWithPaymentReason()) {
			$this->paymentReasonLine2 = $paymentReasonLine2;
			return true;
		}
		return false;
	}

	/**
	 * Get the second line of the payment reason
	 *
	 * @return string|bool The second line of the payment reason or false if withPaymentReason = false
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
	 * @param string $paymentReasonLine3 The third line of the payment reason
	 * @return bool True if successful, else false
	 */
	protected function setPaymentReasonLine3($paymentReasonLine3)
	{
		if ($this->getWithPaymentReason()) {
			$this->paymentReasonLine3 = $paymentReasonLine3;
			return true;
		}
		return false;
	}

	/**
	 * Get the third line of the payment reason
	 *
	 * @return string|bool The third line of the payment reason or false if withPaymentReason = false
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
	 * @param string $paymentReasonLine4 The fourth line of the payment reason
	 * @return bool True if successful, else false
	 */
	protected function setPaymentReasonLine4($paymentReasonLine4)
	{
		if ($this->getWithPaymentReason()) {
			$this->paymentReasonLine4 = $paymentReasonLine4;
			return true;
		}
		return false;
	}

	/**
	 * Get the fourth line of the payment reason
	 *
	 * @return string|bool The fourth line of the payment reason or false if withPaymentReason = false
	 */
	public function getPaymentReasonLine4()
	{
		if ($this->getWithPaymentReason()) {
			return $this->paymentReasonLine4;
		}
		return false;
	}

	/**
	 * Get complete reference number
	 *
	 * @param bool $formatted Should the returned reference be formatted in blocks of five (for better readability)
	 * @param bool $fillZeros Fill up with leading zeros, only applies to the case where no banking customer id is used
	 * @return string|bool The complete (with/without bank customer id), formatted reference number with check digit
	 * or false if withReferenceNumber is false
	 */
	public function getCompleteReferenceNumber($formatted = true, $fillZeros = true)
	{
		if ($this->getWithReferenceNumber()) {
			if ($this->getWithBankingCustomerId()) {
				// Get reference number and fill with zeros
				$completeReferenceNumber = str_pad($this->getReferenceNumber(), 20 ,'0', STR_PAD_LEFT);
				// Add banking customer identification code
				$completeReferenceNumber = $this->getBankingCustomerId() . $completeReferenceNumber;
			} else {
				if ($fillZeros) {
					// Get reference number and fill with zeros
					$completeReferenceNumber = str_pad($this->getReferenceNumber(), 26 ,'0', STR_PAD_LEFT);
				} else{
					// Get just reference number
					$completeReferenceNumber = $this->getReferenceNumber();
				}
			}

			// Add check digit
			if ($this->getNotForPayment()) {
				$completeReferenceNumber .= 'X';
			} else {
				$completeReferenceNumber .= $this->modulo10($completeReferenceNumber);
			}

			if ($formatted) {
				$completeReferenceNumber = $this->breakStringIntoBlocks($completeReferenceNumber);
			}

			return $completeReferenceNumber;
		}
		return false;
	}

	/**
	 * Get IBAN number in human readable format.
	 * Not valid for electronic transactions.
	 *
	 * @return string|bool Formatted IBAN or false if withIban is false
	 * @link http://en.wikipedia.org/wiki/International_Bank_Account_Number#Practicalities
	 */
	public function getFormattedIban()
	{
		if ($this->getWithIban()) {
			return $this->breakStringIntoBlocks($this->getIban(), 4, false);
		}
		return false;
	}

	/**
	 * Get the full code line at the bottom of the SwissPaymentSlip
	 *
	 * @param bool $fillZeros Fill up with leading zeros
	 * @return string|bool Either the full code line or false if something was wrong
	 *
	 * @todo implement red slip support
	 */
	public function getCodeLine($fillZeros = true)
	{
		$francs = $this->getAmountFrancs();
		$cents = $this->getAmountCents();

		$referenceNumber = $this->getCompleteReferenceNumber(false, $fillZeros);
		if ($referenceNumber === false) {
			return false;
		}
		$accountNumber = $this->getAccountDigits();
		if ($accountNumber === false) {
			return false;
		}

		if ($this->getWithAmount()) {
			$francs = str_pad($francs, 8 ,'0', STR_PAD_LEFT);
			$cents = str_pad($cents, 2 ,'0', STR_PAD_RIGHT);
			$amountPrefix = '01';
			$amountPart = $francs . $cents;
			$amountCheck = $this->modulo10($amountPrefix . $amountPart);
		} else {
			$amountPrefix = '04';
			$amountPart = '';
			$amountCheck = '2';
		}
		if ($fillZeros) {
			$referenceNumberPart = str_pad($referenceNumber, 27 ,'0', STR_PAD_LEFT);
		} else {
			$referenceNumberPart = $referenceNumber;
		}
		$accountNumberPart = substr($accountNumber,0, 2) .
			str_pad(substr($accountNumber, 2), 7 ,'0', STR_PAD_LEFT);

		if ($this->getNotForPayment()) {
			$amountPrefix = 'XX';
			$amountCheck = 'X';
		}

		$codeLine = sprintf('%s%s%s>%s+ %s>',
			$amountPrefix,
			$amountPart,
			$amountCheck,
			$referenceNumberPart,
			$accountNumberPart
		);

		return $codeLine;
	}

	/**
	 * Clear the account of the two hyphens
	 */
	protected function getAccountDigits()
	{
		if ($this->getWithAccountNumber()) {
			if ($this->getNotForPayment()) {
				return 'XXXXXXXXX';
			}
			$accountNumber = $this->getAccountNumber();
			if ($accountNumber) {
				$accountDigits = str_replace('-', '', $accountNumber, $replacedHyphens);
				if ($replacedHyphens == 2) {
					return $accountDigits;
				}
			}
		}
		return false;
	}

	/**
	 * Returns francs amount without cents
	 *
	 * @return bool|int Francs amount without cents
	 */
	public function getAmountFrancs() {
		$amount = $this->getAmount();
		if ($this->getNotForPayment()) {
			return 'XXXXXXXX';
		}
		if ($amount === false) {
			return false;
		}
		$francs = intval($amount);
		return $francs;
	}

	/**
	 * Returns zero filled, right padded, two digits long cents amount
	 *
	 * @return bool|string Amount of Cents, zero filled, right padded, two digits long
	 */
	public function getAmountCents() {
		$amount = $this->getAmount();
		if ($this->getNotForPayment()) {
			return 'XX';
		}
		if ($amount === false) {
			return false;
		}
		$francs = intval($amount);
		$cents = round(($amount - $francs) * 100);
		return str_pad($cents, 2 ,'0', STR_PAD_RIGHT);
	}

	/**
	 * Creates Modulo10 recursive check digit
	 *
	 * @copyright As found on http://www.developers-guide.net/forums/5431,modulo10-rekursiv (thanks, dude!)
	 * @param string $number Number to create recursive check digit off
	 * @return int Recursive check digit
	 */
	private function modulo10($number)
	{
		$next = 0;
		for ($i=0; $i < strlen($number); $i++) {
			$next = $this->moduloTable[($next + substr($number, $i, 1)) % 10];
		}

		return (10 - $next) % 10;
	}

	/**
	 * Returns a given string in blocks of a certain size
	 * Example: 000000000000000 becomes more readable 00000 00000 00000
	 *
	 * @param string $string To be formatted string
	 * @param int $blockSize Block size of choice
	 * @param bool $alignFromRight Right aligned, blocks are build from right
	 * @return string Given string divided in blocks of given block size separated by one space
	 */
	private function breakStringIntoBlocks($string, $blockSize = 5, $alignFromRight = true)
	{
		// Lets reverse the string (because we want the block to be aligned from the right)
		if ($alignFromRight) {
			$string = strrev($string);
		}

		// Chop it into blocks
		$string = trim(chunk_split($string, $blockSize, ' '));

		// Re-reverse
		if ($alignFromRight) {
			$string = strrev($string);
		}

		return $string;
	}
}
