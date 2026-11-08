<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Welcome to PHP Bookstore</h1>
    <?php
    $book = "Learning PHP";
    $author = "Jon Duckett";
    $price = 25;
    $quantity = 4;
    
    $total = $price * $quantity;
    ?>

    <p>Book: <?php echo $book; ?></p>
    <p>Author: <?php echo $author; ?></p>
    <p>Price: <?php echo $price; ?></p>
    <p>Quantity: <?php echo $quantity; ?></p>
    <p>Total price: <?php echo "<strong>$total</strong>"; ?></p>
    <?php
    // practice single line comment 
    /* multi-line 
    comment
    */
    ?>

    <p><a href="../index.php">Back to Home</a></p>
</body>
</html>