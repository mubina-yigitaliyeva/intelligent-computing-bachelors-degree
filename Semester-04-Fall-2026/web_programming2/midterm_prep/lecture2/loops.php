<?php
    $price = 2.99;
    $counter = 1;
    $packs = 9;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>While</h1>
    <p>
        <?php 
            while($counter <= $packs) {
                echo "Price for " . $counter . " counter is " . $counter * $price;
                $counter++;
                echo "<br>";
            }
        ?>
    </p>

    <h1>Do While</h1>
    <p>
        <?php
        $i = 1;
        do {
            echo $i . " ";
            $i++;
        } while($i <= 5); 
        ?>
    </p>

    <h1>For Loop</h1>
    <p>
        <?php
        for ($i = 1; $i <= 5; $i++) {
            echo $i * 10;
            echo "<br>";
        }
        ?>
    </p>

</body>
</html>