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
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>SwissPaymentSlip Example 01-03: OrangePaymentSlipData advanced usage</title>
</head>
<body>
<h1>SwissPaymentSlip Example 01-03: OrangePaymentSlipData advanced usage</h1>
<?php
// Make sure the classes get auto-loaded
require __DIR__.'/../vendor/autoload.php';

// Import necessary classes
use SwissPaymentSlip\SwissPaymentSlip\OrangePaymentSlipData;

// Create an orange payment slip data container (value object)
$paymentSlipData = new OrangePaymentSlipData();

// We don't want to use the banking customer ID as part of the reference number
$paymentSlipData->setWithBankingCustomerId(false);

// We use pre-printed slips, we don't need bank and recipient
$paymentSlipData->setWithBank(false);
$paymentSlipData->setWithRecipient(false);

// If we don't want to contain the amount, e.g. a "not of payment" slip
$paymentSlipData->setWithAmount(false);

// Setup some more behaviours, normally optionally since they already default to appropriate setting
$paymentSlipData->setWithAccountNumber(true)
    ->setWithReferenceNumber(true)
    ->setWithPayer(true);

// Fill the data container with your data
$paymentSlipData->setAccountNumber('01-145-6');

// This won't work, because it's disabled
$paymentSlipData->setRecipientData(
    'H. Muster AG',
    'Versandhaus',
    'Industriestrasse 88',
    '8000 Zürich'
);

$paymentSlipData->setPayerData('Rutschmann Pia', 'Marktgasse 28', '9400 Rorschach')
    ->setReferenceNumber('7520033455900012');

// Output the data fields of the slip
// All fields that are disabled can't be requested, they will throw an exception
echo "Account number: " . $paymentSlipData->getAccountNumber() . "<br>";
echo "<br>";
echo "Payer line 1: " . $paymentSlipData->getPayerLine1() . "<br>";
echo "Payer line 2: " . $paymentSlipData->getPayerLine2() . "<br>";
echo "Payer line 3: " . $paymentSlipData->getPayerLine3() . "<br>";
echo "Payer line 4: " . $paymentSlipData->getPayerLine4() . "<br>";
echo "<br>";
echo "Complete reference number (without banking customer ID): " .
    $paymentSlipData->getCompleteReferenceNumber() . "<br>";
echo "Complete reference number (ditto), unformatted : " .
    $paymentSlipData->getCompleteReferenceNumber(false) . "<br>";
echo "Complete reference number (ditto), not filled with zeroes : " .
    $paymentSlipData->getCompleteReferenceNumber(true, false) . "<br>";
echo "<br>";
echo "Code line (at the bottom): " . $paymentSlipData->getCodeLine() . "<br>";
echo "Code line (at the bottom), not filled with zeroes: " . $paymentSlipData->getCodeLine(false) . "<br>";
echo "<br>";

// Dump object to screen
echo "This is how your data container looks now: <br>";
var_dump($paymentSlipData);
?>
</body>
</html>
