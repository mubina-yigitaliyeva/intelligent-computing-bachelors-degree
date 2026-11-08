<?php

require_once __DIR__ . "/q08_functions.php";

echo "<pre>";

echo buildShippingLabel(
    recipient: "Kim Tae-hyung",
    weightKg: 4.5,
    express: true,
    deliveryNote: "Leave at front desk"
);

echo "\n\n";

echo buildShippingLabel(
    weightKg: 1.25,
    recipient: "Choi Ji-woo",
    fragile: true
);

echo "</pre>";

?>