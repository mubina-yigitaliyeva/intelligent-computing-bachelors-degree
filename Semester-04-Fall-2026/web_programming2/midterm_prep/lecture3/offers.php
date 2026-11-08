<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Switch and Match</h1>

    <?php
    $day = "Wednesday";

    switch ($day) {
        case "Monday":
            echo "<p>20% off chocolate</p>";
            break;
        case "Tuesday":
            echo "<p>30% off fudge</p>";
            break;
        case "Wednesday":
            echo "<p>50% off candy</p>";
            break;
        default:
            echo "<p>No special offer</p>";
    }

    $day = "Sunday";
    $check = match($day) {
        "Monday" => "20% off chocolate",
        "Tuesday" => "30% off fudge",
        "Wednesday" => "50% off candy",
        default => "no discount"
    };

    echo "<p> $check </p>"
    ?>

</body>
</html>