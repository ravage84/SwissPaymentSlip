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
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>SwissPaymentSlip Example 01-02: RedPaymentSlipData basic usage</title>
</head>
<body>
<h1>SwissPaymentSlip Example 01-02: RedPaymentSlipData basic usage</h1>
<?php
// Make sure the classes get auto-loaded
require __DIR__.'/../vendor/autoload.php';

// Import necessary classes
use SwissPaymentSlip\SwissPaymentSlip\RedPaymentSlipData;

// Create a red payment slip data container (value object)
$paymentSlipData = new RedPaymentSlipData();

// Fill the data container with your data
$paymentSlipData->setBankData('Seldwyla Bank', '8021 Zuerich')
    ->setAccountNumber('80-939-3')
    ->setRecipientData('Muster AG', 'Bahnhofstrasse 5', '8001 Zuerich')
    ->setIban('CH3808888123456789012')
    ->setPayerData('M. Beispieler', 'Bahnhofstrasse 356', '', '7000 Chur')
    ->setAmount(8479.25)
    ->setPaymentReasonData('Rechnung', 'Nr.7496');

// Output the data fields of the slip
echo "Bank name: " . $paymentSlipData->getBankName() . "<br>";
echo "Bank city: " . $paymentSlipData->getBankCity() . "<br>";
echo "<br>";
echo "Recipient line 1: " . $paymentSlipData->getRecipientLine1() . "<br>";
echo "Recipient line 2: " . $paymentSlipData->getRecipientLine2() . "<br>";
echo "Recipient line 3: " . $paymentSlipData->getRecipientLine3() . "<br>";
echo "Recipient line 4: " . $paymentSlipData->getRecipientLine4() . "<br>";
echo "<br>";
echo "IBAN: " . $paymentSlipData->getIban() . "<br>";
echo "Formatted IBAN: " . $paymentSlipData->getFormattedIban() . "<br>";
echo "<br>";
echo "Account number: " . $paymentSlipData->getAccountNumber() . "<br>";
echo "<br>";
echo "Amount: " . $paymentSlipData->getAmount() . "<br>";
echo "Amount in francs: " . $paymentSlipData->getAmountFrancs() . "<br>";
echo "Amount in cents: " . $paymentSlipData->getAmountCents() . "<br>";
echo "<br>";
echo "Payer line 1: " . $paymentSlipData->getPayerLine1() . "<br>";
echo "Payer line 2: " . $paymentSlipData->getPayerLine2() . "<br>";
echo "Payer line 3: " . $paymentSlipData->getPayerLine3() . "<br>";
echo "Payer line 4: " . $paymentSlipData->getPayerLine4() . "<br>";
echo "Payer line 5: " . $paymentSlipData->getPayerLine5() . "<br>";
echo "<br>";
echo "Payment reason line 1: " . $paymentSlipData->getPaymentReasonLine1() . "<br>";
echo "Payment reason line 2: " . $paymentSlipData->getPaymentReasonLine2() . "<br>";
echo "Payment reason line 3: " . $paymentSlipData->getPaymentReasonLine3() . "<br>";
echo "Payment reason line 4: " . $paymentSlipData->getPaymentReasonLine4() . "<br>";
echo "<br>";

// Dump object to screen
echo "This is how your data container looks now: <br>";
var_dump($paymentSlipData);
?>
</body>
</html>
