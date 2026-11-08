<?php

require_once('includes/functions.php');

$user = [
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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user['name'] = $_POST['name'] ?? '';
    $user['age'] = $_POST['age'] ?? '';
    $user['terms'] = (isset($_POST['terms'])) && ($_POST['terms'] === 'true');
    // $user['terms'] = ($_POST['terms'] ?? '') === 'true'

    $errors['name'] = (!is_text($user['name'], 3, 15))
    ? 'Name must be between 3-15 characters'
    : '';

    $errors['age'] = (!is_number($user['age'], 18, 65))
    ? 'Age must be between 18-65'
    : '';

    $errors['terms'] = (!$user['terms'])
    ? 'You must agree to the terms'
    : '';

    $invalid = implode($errors);
    $message = $invalid 
        ? "Please correct errors." 
        : "Your data is valid.";
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
    <h1>Student Registration</h1>

    <form method="post">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="<?=htmlspecialchars($user['name'])?>">
        <?=htmlspecialchars($errors['name'])?>

        <br><br>

        <label for="age">Age:</label>
        <input type="number" name="age" id="age" value="<?=htmlspecialchars($user['age'])?>">
        <?=htmlspecialchars($errors['age'])?>

        <br><br>
        <input type="checkbox" name="terms" id="terms" value="true" 
        <?= $user['terms'] ? 'checked' : '' ?>
        >
        <label for="terms">I agree to the terms.</label>
        <?=htmlspecialchars($errors['terms'])?>

        <br><br>

        <button type="submit">Register</button>
    </form>

    <?php
        if ($message) {
            echo $message;
        }
    ?>
</body>
</html>