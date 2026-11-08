<?php
$cities = [
    'London' => 'Kamal Chunchie Way, London',
    'Busan' => '1001 Jungang-daero, Yeonje-gu',
    'NYC' => 'City Hall Park, New York'
];

$city = $_GET['city'] ?? '';
$valid = array_key_exists($city, $cities);

if ($valid) {
    $data = $cities[$city];
} else {
    // $data = 'Please select a valid city';
    header('Location: page-not-found.php');
    exit;
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
    <h1>City Address Finder</h1>

    <div style="display:flex; gap:15px;">
        <?php foreach ($cities as $city => $info ) { ?>
        <a href="cities.php?city=<?= urlencode($city) ?>">
            <?= htmlspecialchars($city) ?> 
        </a>
    <?php } ?>
    </div>

    <h2><?= htmlspecialchars($data) ?></h2>
</body>
</html>