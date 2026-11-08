
<?php

// 1. Initialize variables
$form = [
    'name' => '',
    'age' => '',
    'terms' => false
];

$errors = [
    'name' => '',
    'age' => '',
    'terms' => ''
];

$message = '';

// 2. Define validation filters
$filters = [
    'name' => [
        'filter' => FILTER_VALIDATE_REGEXP,
        'options' => [
            'regexp' => '/^[A-Za-z]{2,20}$/'
        ]
    ],
    'age' => [
        'filter' => FILTER_VALIDATE_INT,
        'options' => [
            'min_range' => 16,
            'max_range' => 65
        ]
    ],
    'terms' => FILTER_VALIDATE_BOOLEAN
];

// 3. Process submitted form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Get original values for sticky form
    $form = filter_input_array(INPUT_POST) ?? [];

    // Get validated values
    $validated_form = filter_input_array(INPUT_POST, $filters) ?? [];

    // 4. Validate name
    $errors['name'] = !($validated_form['name'] ?? false)
        ? 'Name must contain 2-20 letters.'
        : '';

    // 5. Validate age
    $errors['age'] = !is_int($validated_form['age'] ?? null)
        ? 'Age must be between 16 and 65.'
        : '';

    // 6. Validate terms
    $agreed = ($form['terms'] ?? '') === 'true';

    $errors['terms'] = !$agreed
        ? 'You must agree to the terms.'
        : '';

    // 7. Check all errors
    $invalid = implode($errors);

    $message = $invalid
        ? 'Please correct the following errors.'
        : 'Your data was valid.';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Full Form Validation</title>
</head>
<body>

    <h1>Student Registration</h1>

    <form method="POST">

        <!-- NAME -->
        <label for="name">Name:</label>

        <input
            type="text"
            name="name"
            id="name"
            value="<?= htmlspecialchars((string)($form['name'] ?? '')) ?>"
        >

        <br>

        <?php if ($errors['name']) { ?>
            <p style="color: red;">
                <?= htmlspecialchars($errors['name']) ?>
            </p>
        <?php } ?>

        <br>

        <!-- AGE -->
        <label for="age">Age:</label>

        <input
            type="text"
            name="age"
            id="age"
            value="<?= htmlspecialchars($form['age'] ?? '') ?>"
        >

        <br>

        <?php if ($errors['age']) { ?>
            <p style="color: red;">
                <?= htmlspecialchars($errors['age']) ?>
            </p>
        <?php } ?>

        <br>

        <!-- TERMS -->
        <input
            type="checkbox"
            name="terms"
            id="terms"
            value="true"
            <?= $form['terms'] === 'true' ? 'checked' : '' ?>
        >

        <label for="terms">
            I agree to the terms and conditions
        </label>

        <br>

        <?php if ($errors['terms']) { ?>
            <p style="color: red;">
                <?= htmlspecialchars($errors['terms']) ?>
            </p>
        <?php } ?>

        <br>

        <button type="submit">Register</button>

    </form>

    <?php if ($message) { ?>

        <p style="color: <?= $invalid ? 'red' : 'green' ?>;">
            <?= htmlspecialchars($message) ?>
        </p>

    <?php } ?>

</body>
</html>
