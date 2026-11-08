<?php
$stationName = "Korea Meteorological Monitor";
$sensorInput = "5"; // string
$sensorValid = 5;   // int

$temperatures = [
    'Busan'   => 24,
    'Seoul'   => 17,
    'Jeju'    => 29,
    'Incheon' => 14
];

$looseCompare = $sensorInput == $sensorValid;
$strictCompare = $sensorInput === $sensorValid;

$fullArray = [];

foreach ($temperatures as $city => $temp) {
    $outdoorStatus = $temp >= 20 ? 'Warm' : 'Cool';

    $advisory = match(true) {
        $temp >= 28 => 'Heat Advisory',
        $temp >= 20 => 'Pleasant',
        $temp >= 15 => 'Light Jacket',
        default => 'Chilly'
    };

    $fullArray[] = [
        'name' => $city,
        'temp' => $temp,
        'status' => $outdoorStatus,
        'adv' => $advisory
    ];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>City Weather Monitor</h1>
    <?= $stationName ?>
    <?= $looseCompare ?>
    <?= $looseCompare ?>


    <br><br>

    <table border="1">
        <tr>
            <th>Name</th>
            <th>Temperature</th>
            <th>Outdoor status</th>
            <th>Advisory</th>
        </tr>

        <?php foreach($fullArray as $city) { ?>
            <tr>
                <td><?= htmlspecialchars($city['name']) ?></td>
                <td><?= htmlspecialchars($city['temp']) ?></td>
                <td><?= htmlspecialchars($city['status']) ?></td>
                <td><?= htmlspecialchars($city['adv']) ?></td>
            </tr>
        <?php } ?>

    </table>

</body>
</html>