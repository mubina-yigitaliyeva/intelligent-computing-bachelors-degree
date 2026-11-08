<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Welcome Page</h1>

    <?php
    $name = "Mubina";
    $greeting = "Hello";
    if ($name !== "") {
        $greeting .= ", " . $name . "!";
    }

    $stock = 0;
    if ($stock > 0) {
        echo "Available";
    } else {
        echo "More stock coming soon...";
    }

    $check_stock = ($stock > 0) ? "Available" : "More stock coming soon...";

    $ordered = 10;
    if ($stock > 0) {
        echo "Available.";
    } elseif ($ordered > 0) {
        echo "Coming soon.";
    } else {
        echo "Sold out.";
    }

    ?>

    <p><?= $greeting;?></p>
</body>
</html>