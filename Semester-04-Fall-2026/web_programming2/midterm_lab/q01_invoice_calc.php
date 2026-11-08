<?php
$customerName = "Alex Rivera";
$itemTitle    = "Mechanical Keyboard";
$unitPrice    = 89.99;      // float
$quantity     = 3;          // int
$taxRate      = 0.08;       // float (8%)
$promoInput   = "100";      // string from user input
$targetPromo  = 100;        // int target code 

$subtotal = $unitPrice * $quantity;
$taxAmount = $subtotal * $taxRate;
$grandTotal = $subtotal + $taxAmount;

$receiptHeader = "Customer: " . $customerName . " | Item: " . $itemTitle;

$looseMatch = $promoInput == $targetPromo;
$strictMatch = $promoInput === $targetPromo;

echo $receiptHeader . "\n";
echo "Grand Total: " . number_format($grandTotal, 2) . "\n";
echo "Unit Price Type: " . gettype($unitPrice) . "\n";
echo "Loose Match: " . var_export($looseMatch, true) . "\n";
echo "Strict Match: " . var_export($strictMatch, true) . "\n";
?>