<?php
$clubs = [
    ['name' => 'Web Dev Society', 'type' => 'Tech',   'fee' => 20],
    ['name' => 'Campus Rowing',   'type' => 'Sports', 'fee' => 55],
    ['name' => 'Indie Film Club', 'type' => 'Arts',   'fee' => 30],
    ['name' => 'AI Robotics Lab', 'type' => 'Tech',   'fee' => 70]
];
$allowedTypes = ['ALL', 'Tech', 'Sports', 'Arts'];
$errors = [];
$type = '';
$maxFee = '';
$validMaxFee = '';
$resClubs = [];

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $type = $_GET['type'] ?? 'ALL';

    if (!in_array($type, $allowedTypes, true)) {
        $errors = 'Invalid type setting to ALL';

        $type = 'ALL';
    }

    $maxFee = $_GET['max_fee'] ?? 50;
    $validMaxFee = filter_var($maxFee, FILTER_VALIDATE_INT, [
        "options" => [
            'min_range' => 10,
            'max_range' => 100
        ]
    ]);

    if ($validMaxFee === false) {
        $errors[] = 'Invalid max fee setting to default 50';

        $validMaxFee = 50;
    }

    $resClubs = [];

    foreach ($clubs as $club) {
        $matchingType = (
            $type === 'ALL' ||
            $type === $club['type']
        );

        $matchingFee = $validMaxFee <= $club['fee'];

        if ($matchingType && $matchingFee) {
            $resClubs[] = $club;
        }
    } 
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
    <h1>Student Club Finder</h1>

    <form method="get">
        <label for="type">Type: </label>
        <select name="type" id="type">
            <?php foreach ($allowedTypes as $allowedType) { ?>
                <option value="<?= htmlspecialchars($allowedType) ?>"
                   <?= $type ? 'selected' : '' ?>
                >
                    <?= htmlspecialchars($allowedType) ?>
                </option>
            <?php } ?>
        </select>

        <br><br>

        <label for="maxFee">Enter max fee: </label>
        <input type="number" name="maxFee" id="maxFee" value="<?= htmlspecialchars($maxFee) ?>">

        <button type="submit">Get Result</button>
    </form>

    <pre>
        <?php var_dump($resClubs) ?>
    </pre>

</body>
</html>

