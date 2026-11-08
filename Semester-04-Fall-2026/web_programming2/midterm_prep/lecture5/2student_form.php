<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $age = $_POST['age'] ?? '';
    $major = $_POST['major'] ?? '';
    $preference = $_POST['preference'] ?? '';
    $checkbox = $_POST['terms'] ?? 'no';

    echo '<pre>';
    var_dump($_POST);
    echo '</pre>';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
</head>
<body>
    <h1>Student Registration</h1>

    <form action="student_form.php" method="POST">

        <label for="name">Name: </label>
        <input type="text" id="name" name="name">

        <br><br>

        <label for="age">Age: </label>  
        <input type="number" name="age" id="age">

        <br><br>

        <label for="major">Major: </label>
        <select name="major" id="major">
            <option value="IT">IT</option>
            <option value="Business">Business</option>
            <option value="Tourism">Tourism</option>
        </select>

        <br><br>

        <p>Study Preference</p>

        <input type="radio" id="online" name="preference" value="Online">
        <label for="online">Online</label>

        <input type="radio" id="offline" name="preference" value="Offline">
        <label for="offline">Offline</label>

        <br><br>

        <input type="checkbox" id="terms" name="terms" value="yes">
        <label for="terms">I agree to the terms</label>

        <br><br>

        <button type="submit">Submit Registration</button>
    </form>

    <?php
        if($_SERVER['REQUEST_METHOD'] === 'POST') { ?>
        <p>Name: <?= htmlspecialchars($name) ?></p> 
        <p>Age: <?= htmlspecialchars($age) ?></p>
        <p>Major: <?= htmlspecialchars($major) ?></p>
        <p>Preference: <?= htmlspecialchars($preference) ?></p>
        <p>Terms: <?= $checkbox ?></p>
        <?php }?>
</body>
</html>