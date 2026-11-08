<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Foreach with Indexed Array</h1>

    <?php
    $best_sellers = [
        "Chocolate",
        "Mints",
        "Gumballs",
        "Lollipops"
    ];
    ?>

    <ul>
        <?php foreach ($best_sellers as $candy) { ?>
        <li><?= htmlspecialchars($candy) ?></li>
        <?php } ?>
    </ul>

    <?php
    $products = [
    "Chocolate" => 2.99,
    "Mints" => 1.50,
    "Candy" => 3.50,
    "Gumballs" => 4.49,
    "Lollipops" => 1.50
    ];
    ?>

    <h1>Foreach with Associative Array</h1>

    <table border="2">
        <tr>
            <th>Product</th>
            <th>Price</th>
        </tr>
        <?php foreach($products as $name => $price) { ?>
        <tr>
            <td><?= htmlspecialchars($name) ?></td>
            <td><?= number_format($price, 2) ?></td>
        </tr>
        <?php } ?> 
    </table>

    <h1>Foreach with Multilevel Array</h1>

    <?php
    $students = [
    ['name' => 'Mubina', 'score' => 95],
    ['name' => 'Ali', 'score' => 72],
    ['name' => 'Sara', 'score' => 48],
    ['name' => 'Tom', 'score' => 85]
    ];
    ?>

    <table border="2">
        <tr>
            <th>Name</th>
            <th>Score</th>
            <th>Result</th>
        </tr>
        <?php foreach($students as $student) { ?>
            
            <tr>
                <td><?= htmlspecialchars($student['name']) ?></td>
                <td><?= $student['score'] ?></td>
                <td><?= ($student['score'] >= 60) ? "Pass" : "Fail" ?></td>
            </tr>
            
        <?php } ?>
    </table>

</body>
</html>