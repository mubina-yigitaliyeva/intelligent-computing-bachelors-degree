<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Password Validation - Regex Usage</h1>

    <form method="POST">
        <label for="password">Password:</label>
        <input type="text" name="password" id="password">

        <button type="submit">Submit</button>
    </form>

    <?php
        require_once('includes/functions.php');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $password = $_POST['password'] ?? '';

            if (is_valid_password($password)) {
                echo 'Password is valid.';
            } else {
                echo 'Invalid password.';
            }
        }
    ?>
</body>
</html>