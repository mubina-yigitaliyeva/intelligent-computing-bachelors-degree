<?php

$message = '';
$agreed = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $agreed = (isset($_POST['term']) && $_POST['term'] === 'true');
    // $agreed = ($_POST['term'] ?? '') === 'true';
    $message = $agreed ? 'Thank you' : 'You must agree to the terms.';
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
    <h1>Terms and Conditions</h1>

    <form method="POST">
        <input 
            type="checkbox" 
            name="term" 
            id="term" 
            value="true"
            <?= $agreed ? 'checked' : '' ?>
        >
        <label for="term">
            I agree to the terms and conditions
        </label>

        <br><br>

        <button type="submit">Submit</button>
    </form>

    <br>

    <?php
        if ($message) {
            echo htmlspecialchars($message);
        }
    ?>
</body>
</html>