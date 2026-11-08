<?php
$scores = [
    'Kim Min-jun'   => 92,
    'Park Seo-yeon' => 64,
    'Lee Ji-hoon'   => 78,
    'Choi Su-bin'   => 85,
    'Jung Woo-jin'  => 59,
    'Han Ji-min'    => 95
];


$total = 0;
$avg = 0.0;
$count = 0;
$passed = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
        <tr>
            <th>Student Name</th>
            <th>Score</th>
            <th>Status</th>
        </tr>
        <?php foreach ($scores as $name => $score) { ?>
        <tr>
            <td><?= htmlspecialchars($name) ?></td>
            <td><?= htmlspecialchars($score) ?></td>
            <?php
                $check = $score >= 70;
                if ($check) {
                    $passed++;
                }
                $total += $score;
                $count++;
        ?>
            <td><?= $check ? 'Pass' : 'Retake' ?></td>
        </tr>
        <?php } ?>
    </table>

    <p>Total Students: <?= $count ?></p>
    <p>Passed: <?= $passed ?></p>
    <p>Class Average: <?= number_format(($total / $count), 1) ?></p>
</body>
</html>