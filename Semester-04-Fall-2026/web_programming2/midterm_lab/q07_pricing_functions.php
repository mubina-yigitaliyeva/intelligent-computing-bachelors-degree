<?php

/**
 * Calculates the final price after applying a discount and tax.
 *
 * First subtracts the discount from the base price.
 * Then calculates tax on the discounted price.
 *
 * @param float $basePrice The original price before discount and tax.
 * @param float $discountPercent The discount percentage (default: 0%).
 * @param float $taxPercent The tax percentage (default: 10%).
 *
 * @return float The final price after discount and tax.
 */
function calculateNetPrice(
    float $basePrice,
    float $discountPercent = 0.0,
    float $taxPercent = 10.0
): float {

    $discountPrice = $basePrice - ($basePrice * ($discountPercent / 100));

    $taxAmount = $discountPrice * ($taxPercent / 100);

    return $discountPrice + $taxAmount;
}

function formatCurrency(float $amount, string $symbol = '$') : string {
    return $symbol . number_format($amount, 2)
}

?>