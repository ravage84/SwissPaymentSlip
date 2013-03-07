<?php
/**
 * Example of SwissPaymentSlipData advanced usage
 *
 * PHP version >= 5.3.0
 *
 * @licence MIT
 * @copyright 2012-2013 Some nice Swiss guys
 * @author Manuel Reinhard <manu@sprain.ch>
 * @author Peter Siska <pesche@gridonic.ch>
 * @author Marc Würth ravage@bluewin.ch
 * @link https://github.com/sprain/class.Einzahlungsschein.php
 * @version: 0.5.0
 */
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>SwissPaymentSlip Example 01-03: SwissPaymentSlipData advanced usage</title>
</head>
<body>
<h1>SwissPaymentSlip Example 01-03: SwissPaymentSlipData advanced usage</h1>
<?php
// Make sure the classes get auto-loaded
require __DIR__.'/../vendor/autoload.php';

// Import necessary classes 
use SwissPaymentSlip\SwissPaymentSlip\SwissPaymentSlipData;

// Create an payment slip data container (value object)
$paymentSlipData = new SwissPaymentSlipData('red');

// Fill some red slip data
$paymentSlipData->setIban('CH3808888123456789012');
$paymentSlipData->setPaymentReasonData('Rechnung', 'Nr.7496');

// Change type and (optionally) force data reset
$paymentSlipData->setType('orange');

// We don't want to use the banking customer ID as part of the reference number
$paymentSlipData->setWithBankingCustomerId(false);

// We use preprinted slips, we don't need bank and recipient
$paymentSlipData->setWithBank(false);
$paymentSlipData->setWithRecipient(false);

// If we don't want to contain the amount, e.g. a "not of payment" slip
$paymentSlipData->setWithAmount(false);

// Setup some more behaviours, normally optionally since they already default to appropriate setting
$paymentSlipData->setWithAccountNumber(true);
$paymentSlipData->setWithReferenceNumber(true);
$paymentSlipData->setWithPayer(true);
$paymentSlipData->setWithIban(true); // TODO Not fully implemented
$paymentSlipData->setWithPaymentReason(true); // Doesn't work for orange slips

// Fill the data container with your data
$paymentSlipData->setBankData('Seldwyla Bank', '8001 Zürich'); // This won't work, because it's disabled
$paymentSlipData->setAccountNumber('01-145-6');
$paymentSlipData->setRecipientData('H. Muster AG', 'Versandhaus', 'Industriestrasse 88', '8000 Zürich'); // This won't work, because it's disabled
$paymentSlipData->setPayerData('Rutschmann Pia', 'Marktgasse 28', '9400 Rorschach');
$paymentSlipData->setAmount(2830.50); // This won't work, because it's disabled
$paymentSlipData->setReferenceNumber('7520033455900012');
$paymentSlipData->setBankingCustomerId('215703'); // This won't work, because it's disabled

// Output the data fields of the slip
echo "Bank name: " . $paymentSlipData->getBankName() . "<br>"; // Empty, because it's disabled
echo "Bank city: " . $paymentSlipData->getBankCity() . "<br>"; // Empty, because it's disabled
echo "<br>";
echo "Recipient line 1: " . $paymentSlipData->getRecipientLine1() . "<br>"; // Empty, because it's disabled
echo "Recipient line 2: " . $paymentSlipData->getRecipientLine2() . "<br>"; // Empty, because it's disabled
echo "Recipient line 3: " . $paymentSlipData->getRecipientLine3() . "<br>"; // Empty, because it's disabled
echo "Recipient line 4: " . $paymentSlipData->getRecipientLine4() . "<br>"; // Empty, because it's disabled
echo "<br>";
echo "Account number: " . $paymentSlipData->getAccountNumber() . "<br>";
echo "<br>";
echo "Amount: " . $paymentSlipData->getAmount() . "<br>"; // Empty, because it's disabled
echo "Amount in francs: " . $paymentSlipData->getAmountFrancs() . "<br>"; // Empty, because it's disabled
echo "Amount in cents: " . $paymentSlipData->getAmountCents() . "<br>"; // Empty, because it's disabled
echo "<br>";
echo "Payer line 1: " . $paymentSlipData->getPayerLine1() . "<br>";
echo "Payer line 2: " . $paymentSlipData->getPayerLine2() . "<br>";
echo "Payer line 3: " . $paymentSlipData->getPayerLine3() . "<br>";
echo "Payer line 4: " . $paymentSlipData->getPayerLine4() . "<br>";
echo "<br>";
echo "Banking customer ID: " . $paymentSlipData->getBankingCustomerId() . "<br>"; // Empty, because it's disabled
echo "<br>";
echo "Complete reference number (without banking customer ID): " . $paymentSlipData->getCompleteReferenceNumber() . "<br>";
echo "Complete reference number (ditto), unformatted : " . $paymentSlipData->getCompleteReferenceNumber(false) . "<br>";
echo "Complete reference number (ditto), not filled with zeroes : " . $paymentSlipData->getCompleteReferenceNumber(true, false) . "<br>";
echo "<br>";
echo "Code line (at the bottom): " . $paymentSlipData->getCodeLine() . "<br>";
echo "Code line (at the bottom), not filled with zeroes: " . $paymentSlipData->getCodeLine(false) . "<br>";
echo "<br>";
echo "IBAN: " . $paymentSlipData->getIban() . "<br>"; // Empty because reset
echo "Formatted IBAN: " . $paymentSlipData->getFormattedIban() . "<br>"; // Empty because reset
echo "<br>";
echo "Payment reason line 1: " . $paymentSlipData->getPaymentReasonLine1() . "<br>"; // Empty because reset
echo "Payment reason line 2: " . $paymentSlipData->getPaymentReasonLine2() . "<br>"; // Empty because reset
echo "Payment reason line 3: " . $paymentSlipData->getPaymentReasonLine3() . "<br>"; // Empty because reset
echo "Payment reason line 4: " . $paymentSlipData->getPaymentReasonLine4() . "<br>"; // Empty because reset
echo "<br>";

// Dump object to screen
echo "This is how your data container looks now: <br>";
var_dump($paymentSlipData);
?>
</body>
</html>