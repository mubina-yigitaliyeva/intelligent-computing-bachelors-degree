<?php

require_once('includes/functions.php');

$name = '';
$age = '';
$name_error = '';
$age_error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $age = $_POST['age'] ?? '';

    $name_error = !is_text($name, 3, 18) 
        ? 'Name must be between 3-15 characters.' 
        : '';

    $age_error = !is_number($age, 16, 65) 
        ? 'Age must be between 16-75' 
        : '';
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
    <form action="validate_student.php" method="POST">
        <label for="name">Name: </label>
        <input  type="text" 
                name="name"
                id="name" 
                value="<?= htmlspecialchars($name) ?>">

        <br><br>

        <label for="age">Age: </label>
        <input  type="number" 
                name="age" 
                id="age"
                value="<?= htmlspecialchars($age) ?>">

        <button type="submit">Submit</button>
    </form>

    <h2>Student Validation</h2>
    <?php
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($name_error) {
                echo $name_error . '<br>';
            } else {
                echo 'Username is valid.' . '<br>';
            }
            if ($age_error) {
                echo $age_error . '<br>';
            } else {
                echo 'Age is valid.' . '<br>';
            }
        }
    ?>

</body>
</html>