<?php
$weightKg = 6.5;
$zoneCode = 'REGIONAL';

$baseCost = 0.0;
$surcharge = 0.0;
$error = "";

if ($weightKg <= 0.0) {
    $error = "Invalid package weight";
} elseif ($weightKg <= 2.0) {
    $baseCost = 5.0;
} elseif ($weightKg > 2.0 && $weightKg <= 10.0) {
    $baseCost = 12.5;
} elseif ($weightKg > 10.0) {
    $baseCost = 25.0;
}

switch ($zoneCode) {
    case 'LOCAL':
        $surcharge = 0.0;
        break;
    case 'REGIONAL':
        $surcharge = 4.5;
        break;
    case 'INTL':
        $surcharge = 18.0;
        break;
    default:
        $surcharge = 10.0;
}

$totalShipping = $baseCost + $surcharge;
if ($error !== '') {
    echo $error;
} else {
    echo "Weight: " . $weightKg . " kg\n";
    echo "Zone: " . $zoneCode . "\n";
    echo "Base Cost: $" . number_format($baseCost, 2) . "\n";
    echo "Zone Surcharge: $" . number_format($surcharge, 2) . "\n";
    echo "Total Shipping: $" . number_format($totalShipping, 2) . "\n";
}

?>