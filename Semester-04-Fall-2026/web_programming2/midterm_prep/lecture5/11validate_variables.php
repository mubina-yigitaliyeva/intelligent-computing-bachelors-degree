<?php
    $form = [];
    $filtered_form = [];
    $filters = [
        'email' => FILTER_VALIDATE_EMAIL,
        'age' => [
            'filter' => FILTER_VALIDATE_INT,
            'options' => [
                'min_range' => 18,
                'max_range' => 65
            ]
        ],
        'terms' => FILTER_VALIDATE_BOOLEAN
    ];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $form = filter_input_array(INPUT_POST) ?? [];
        $filtered_form = filter_var_array($form, $filters);
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
    <h1>Registration Validation</h1>

<form method="POST">

    <label for="email">Email:</label>
    <input type="text" name="email" id="email" value="<?= htmlspecialchars($form['email'] ?? '')?>">

    <br><br>

    <label for="age">Age:</label>
    <input type="text" name="age" id="age" value="<?= htmlspecialchars($form['age'] ?? '')?>">

    <br><br>

    <input
        type="checkbox"
        name="terms"
        id="terms"
        value="true"
        <?= ($form['terms'] ?? '') === 'true' ? 'checked' : '' ?>
    >
    <label for="terms">I agree to the terms</label>

    <br><br>

    <button type="submit">Validate</button>
</form>

    <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            var_dump($form);
            echo "<br>";
            var_dump($filtered_form);
        }
    ?>
</body>
</html>