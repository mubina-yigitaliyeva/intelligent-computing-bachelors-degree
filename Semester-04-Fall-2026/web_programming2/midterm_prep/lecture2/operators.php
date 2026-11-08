<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Shopping Calculator - Operators</h1>

    <?php
    $product = "Chocolate";
    $price = 15;
    $quantity = 4;
    $money = 100;
    $age = 20;
    $hasMembership = true;

    $total = $price * $quantity;
    $left = $money - $total
    $check = ($age >= 18) && $hasMembership;
    $product .= " - Thank YOU~";

    ?>

    <p>Total cost: <?= $total; ?></p>
    <p>Remaining money: <?= $left; ?></p>
    <p><?= $check; ?></p>
    <p><?= $product; ?></p>
</body>
</html>