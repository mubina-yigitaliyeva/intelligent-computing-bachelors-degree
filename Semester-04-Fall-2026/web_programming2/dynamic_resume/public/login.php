<?php
session_start();

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/functions.php';

if (!empty($_SESSION['admin_id'])) {
    redirect('admin.php');
}

$errors = [];
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Please enter a valid email address.';
    }

    if ($password === '') {
        $errors[] = 'Please enter your password.';
    }

    if (empty($errors)) {

        $stmt = $pdo->prepare(
            "SELECT id, full_name, email, password
             FROM users
             WHERE email = :email"
        );

        $stmt->execute([
            'email' => $email
        ]);

        $user = $stmt->fetch();

        if (
            $user &&
            password_verify($password, $user['password'])
        ) {

            session_regenerate_id(true);

            $_SESSION['admin_id'] = $user['id'];
            $_SESSION['admin_name'] = $user['full_name'];

            redirect('admin.php');

        } else {
            $errors[] = 'Invalid email or password.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Dynamic Resume</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

<div class="login-container">

    <h1>Administrator Login</h1>

    <?php if (!empty($errors)): ?>
        <div class="errors">
            <?php foreach ($errors as $error): ?>
                <p><?= e($error) ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="login.php">

        <label for="email">Email</label>

        <input
            type="email"
            id="email"
            name="email"
            value="<?= e($email) ?>"
            required
        >

        <label for="password">Password</label>

        <input
            type="password"
            id="password"
            name="password"
            required
        >

        <button type="submit">
            Login
        </button>

    </form>

    <a href="index.php" class="back-link">
        Back to Resume
    </a>

</div>

</body>
</html>