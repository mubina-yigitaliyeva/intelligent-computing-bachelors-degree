<?php
$username = $_GET['user'] ?? 'Guest';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank you</title>
</head>
<body>
    <h2>Thank you!</h2>

    <p>Thank you, <?= htmlspecialchars($username) ?>!
    You ticket has been submitted.
    </p>
</body>
</html>