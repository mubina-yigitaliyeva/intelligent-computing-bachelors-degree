<?php
$form = [];
$filters = [
    'email' => FILTER_VALIDATE_EMAIL,
    'age' => [
        'filter'=> FILTER_VALIDATE_INT,
        'options' => [
            'min_range' => 16,
            'max_range' => 65
        ]
    ]
];
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $form = filter_input_array(INPUT_POST, $filters);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Multiple Input Validation</title>
</head>
<body>

    <h1>Student Information</h1>

    <form method="POST">

        <label for="email">Email:</label>
        <input
            type="text"
            name="email"
            id="email"
            value="<?= htmlspecialchars($form['email'] ?? '') ?>"
        >

        <br><br>

        <label for="age">Age:</label>
        <input
            type="text"
            name="age"
            id="age"
            value="<?= htmlspecialchars($form['age'] ?? '') ?>"
        >

        <br><br>

        <button type="submit">Validate Information</button>

    </form>

    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST') { ?>
    <pre><?php var_dump($form); ?></pre>
    <?php } ?>

</body>
</html>