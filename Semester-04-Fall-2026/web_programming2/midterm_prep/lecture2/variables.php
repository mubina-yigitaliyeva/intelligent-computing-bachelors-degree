<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Candy Store - Variables</h1>
    <?php
    $customer = "Guest";
    $customer = "Mubina";
    $candy = "chocolate";
    $price = 5.50;
    $quantity = 3;
    $available = true;
    $total = $price * $quantity;
    ?>
    <p><?php echo gettype($price); ?></p>
    <p><?php var_dump($price); ?></p>

</body>
</html>