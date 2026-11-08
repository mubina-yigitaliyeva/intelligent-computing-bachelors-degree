<?php
    $form = [];
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $form = filter_input_array(INPUT_POST);
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
    <h1>Email Form</h1>

    <form method="POST">

        <label for="email">Email:</label>
        <input type="text" id="email" name="email"
        value=<?= $form['email'] ?>
        >

        <br><br>

        <input type="checkbox" id="terms" name="terms" value="true"
        <?= ($form['terms'] ?? '') === "true" ? 'checked' : '' ?>
        >
        <label for="terms">I agree to the terms</label>

        <br><br>

        <button type="submit">Submit</button>

        <br><br>

        <?php var_dump($form); ?>

    </form>
</body>
</html>