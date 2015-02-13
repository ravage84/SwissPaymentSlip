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
	<title>SwissPaymentSlip Example 02-01: OrangePaymentSlip basic usage</title>
</head>
<body>
<h1>SwissPaymentSlip Example 02-01: OrangePaymentSlip basic usage</h1>
<?php
// Make sure the classes get auto-loaded
require __DIR__.'/../vendor/autoload.php';

// Import necessary classes
use SwissPaymentSlip\SwissPaymentSlip\OrangePaymentSlipData;
use SwissPaymentSlip\SwissPaymentSlip\OrangePaymentSlip;

// Create an orange payment slip data container (value object)
$paymentSlipData = new OrangePaymentSlipData();

// Fill the data container with your data
$paymentSlipData->setBankData('Seldwyla Bank', '8001 Zürich')
    ->setAccountNumber('01-145-6')
    ->setRecipientData('H. Muster AG', 'Versandhaus', 'Industriestrasse 88', '8000 Zürich')
    ->setPayerData('Rutschmann Pia', 'Marktgasse 28', '9400 Rorschach')
    ->setAmount(2830.50)
    ->setReferenceNumber('7520033455900012')
    ->setBankingCustomerId('215703');

// Create an orange payment slip object, pass in the prepared data container
$paymentSlip = new OrangePaymentSlip($paymentSlipData);

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
