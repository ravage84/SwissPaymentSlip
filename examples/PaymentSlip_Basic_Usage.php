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
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>SwissPaymentSlip Example 02-01: PaymentSlip basic usage</title>
</head>
<body>
<h1>SwissPaymentSlip Example 02-01: PaymentSlip basic usage</h1>
<?php
// Make sure the classes get auto-loaded
require __DIR__.'/../vendor/autoload.php';

// Import necessary classes
use SwissPaymentSlip\SwissPaymentSlip\PaymentSlipData;
use SwissPaymentSlip\SwissPaymentSlip\PaymentSlip;

// Create an payment slip data container (value object)
$paymentSlipData = new PaymentSlipData();

// Fill the data container with your data
$paymentSlipData->setBankData('Seldwyla Bank', '8001 Zürich');
$paymentSlipData->setAccountNumber('01-145-6');
$paymentSlipData->setRecipientData('H. Muster AG', 'Versandhaus', 'Industriestrasse 88', '8000 Zürich');
$paymentSlipData->setPayerData('Rutschmann Pia', 'Marktgasse 28', '9400 Rorschach');
$paymentSlipData->setAmount(2830.50);
$paymentSlipData->setReferenceNumber('7520033455900012');
$paymentSlipData->setBankingCustomerId('215703');

// Create an payment slip object, pass in the prepared data container
$paymentSlip = new PaymentSlip($paymentSlipData);

// Get all elements (data fields with layout configuration)
$elements = $paymentSlip->getAllElements();

// Iterate through the elements (its lines and attributes)
foreach ($elements as $elementName => $element) {
    echo "<h2>Element: " . $elementName . "</h2>";
    foreach ($element['lines'] as $lineNr => $line) {
        echo "-- Line " . $lineNr . ": " . $line . " <br>";
    }
    echo "<br>";
    foreach ($element['attributes'] as $lineNr => $line) {
        echo "-- Attribute " . $lineNr . ": " . $line . " <br>";
    }
}

echo "<br>";

// Dump object to screen
echo "This is how your slip object looks now: <br>";
var_dump($paymentSlip);
?>
</body>
</html>
