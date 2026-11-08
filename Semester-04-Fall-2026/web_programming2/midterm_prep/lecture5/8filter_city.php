<?php
    $city = filter_input(INPUT_GET, 'city');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>City Filter Example</h1>
    <a href="8filter_city.php?city=London">London</a>
    <a href="8filter_city.php?city=Sydney">Sydney</a>

    <h2>Selected City:</h2>

    <?php var_dump($city); ?>
</body>
</html>