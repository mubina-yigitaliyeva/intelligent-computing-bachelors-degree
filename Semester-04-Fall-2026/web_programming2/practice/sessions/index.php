<?php

// session = SGB used to store information on a user
//           to be used accross multiple pages.
//           A user is assigned a session-id
//           ex. Login credentials

session_start();

$error = "";

if (isset($_POST["login"])) {

    $username = trim($_POST["username"] ?? "");
    $password = $_POST["password"] ?? "";

    if ($username !== "" && $password !== "") {

        session_regenerate_id(true);

        $_SESSION["username"] = $username;
        $_SESSION["password"] = $password;

        header("Location: home.php");
        exit;
    } else {
        $error = "Missing username or password.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Practice</title>
</head>
<body>
    <h2>Login</h2>

    <form action="index.php" method="post">
        <label for="username">Username:</label><br>
        <input type="text" name="username" id="username"><br>

        <label for="password">Password:</label><br>
        <input type="password" name="password" id="password"><br>

        <input type="submit" name="login" value="login"><br>
    </form>

    <p><?= htmlspecialchars($error, ENT_QUOTES, "UTF-8") ?></p>
</body>
</html>
