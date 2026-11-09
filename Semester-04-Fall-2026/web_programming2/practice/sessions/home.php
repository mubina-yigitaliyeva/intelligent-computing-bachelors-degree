<?php

session_start();

if (isset($_POST["unset_username"])) {
    unset($_SESSION["username"]); // unsetting one variable
}

if (isset($_POST["unset_all"])) {
    session_unset(); // unsetting all variables
}

if (isset($_POST["logout"])) {
    $_SESSION = []; // emptying the session array
    session_destroy(); // destroying the entire session

    header("Location: index.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Session Practice</title>
</head>
<body>
    <h2>This is the home page</h2>

    <p>
        Username: 
        <?= htmlspecialchars($_SESSION["username"] ?? "Not set", ENT_QUOTES, "UTF-8") ?>
    </p>

    <p>
        Password: 
        <?= isset($_SESSION["password"])
            ? htmlspecialchars($_SESSION["password"], ENT_QUOTES, "UTF-8") . " (stored for practice)"
            : "Not set"
?>
    </p>
    
    <form action="home.php" method="post">
        <input type="submit" name="unset_username" value="Unset username">
        <input type="submit" name="unset_all" value="Unset all session variables">
        <input type="submit" name="logout" value="Log out">
    </form>

</body>
</html>