<?php

$username = '';
$message = '';
$action = '';
$preview = false;
$invalid = '';

$errors = [
    'username' => '',
    'message' => ''
];

$submitted = $_SERVER['REQUEST_METHOD'] === 'POST';

if ($submitted) {
    $username = $_POST['username'] ?? '';
    $message = $_POST['message'] ?? '';
    $action = $_POST['action'] ?? '';

    $usernameLength = mb_strlen($username);
    $errors['username'] = (
        $usernameLength < 3 ||
        $usernameLength > 30
    ) 
    ? 'Username should contain 3-30 characters.'
    : '';

    $messageLength = mb_strlen($message);
    $errors['message'] = (
        $messageLength < 5 ||
        $messageLength > 200
    ) 
    ? 'Message should contain 5-200 characters.'
    : '';

    $invalid = implode($errors);

    if (!$invalid) {
        if ($action === 'preview') {
            $preview = true;
        }

        if ($action === 'submit') {
            header('Location: q14_thankyou.php?user=' . urlencode($username));
            exit;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Support Ticket Submission</title>
</head>
<body>
    <h2>Support Ticket Submission</h2>

    <form method="POST">
        <label for="username">Username: </label>
        <input type="text" name="username" id="username"
        value="<?= htmlspecialchars($username, ENT_QUOTES, 'UTF-8') ?>"
        >

        <?= htmlspecialchars($errors['username'], ENT_QUOTES, 'UTF-8') ?>

        <br><br>

        <label for="message">Message: </label>
        <textarea name="message" id="message" cols="30" rows="5"><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></textarea>

        <?= htmlspecialchars($errors['message'], ENT_QUOTES, 'UTF-8') ?>

        <br><br>

        <button type="submit" name="action" value="preview">Preview</button>
        <button type="submit" name="action" value="submit">Submit Final</button>
    </form>

    <?php if($preview) { ?>
        <h3>Message Preview</h3>
        <p>Username: <?= htmlspecialchars($username, ENT_QUOTES, 'UTF-8') ?></p>
        <p>Message: <?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></p>
    <?php } ?>
</body>
</html>