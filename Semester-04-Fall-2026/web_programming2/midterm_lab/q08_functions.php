<?php

declare(strict_types=1);

function buildShippingLabel(
    string $recipient,
    float $weightKg,
    bool $fragile = false,
    bool $express = false,
    ?string $deliveryNote = null
) : string
{
    $note = $deliveryNote ?? 'None';

    $fragileText = $fragile ? "Yes" : "No";
    $expressText = $express ? "Yes" : "No";

    return "Recipient: $recipient\n" .
           "Weight: $weightKg kg\n" .
           "Fragile: $fragileText\n" .
           "Express: $expressText\n" .
           "Delivery Note: $note";
}
?>