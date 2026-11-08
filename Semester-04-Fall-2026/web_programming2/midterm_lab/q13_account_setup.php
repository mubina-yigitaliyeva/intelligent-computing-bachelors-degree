<?php

$submitted = $_SERVER['REQUEST_METHOD'] === 'POST';
$invalid = '';

$availableTracks = [
    'php8' => 'Modern PHP 8 Features',
    'sql'  => 'SQL Query Optimization',
    'sec'  => 'Web Security & XSS Defense',
    'api'  => 'RESTful API Design'
];

$selectedTopics = [];
$agreed = false;

$errors = [
    'password' => '',
    'topics' => '',
    'agree_terms' => ''
];

if ($submitted) {

    // 1. Read submitted data
    $password = $_POST['password'] ?? '';
    $selectedTopics = $_POST['topics'] ?? [];
    $agreed = isset($_POST['agree_terms']);

    // 2. Validate password
    $errors['password'] = (
        strlen($password) < 8 ||
        !preg_match('/[A-Z]/', $password) ||
        !preg_match('/[0-9]/', $password)
    )
        ? 'Password must contain at least 8 characters, one uppercase letter, and one digit.'
        : '';

    // 3. Validate selected workshop tracks
    if (!is_array($selectedTopics)) {

        $errors['topics'] = 'Invalid workshop selection.';
        $selectedTopics = [];

    } else {

        $allowedKeys = array_keys($availableTracks);

        foreach ($selectedTopics as $topic) {

            if (!in_array($topic, $allowedKeys, true)) {
                $errors['topics'] = 'Invalid workshop track selected.';
                break;
            }
        }

        if (count($selectedTopics) < 1 || count($selectedTopics) > 3) {
            $errors['topics'] = 'Please select between 1 and 3 tracks.';
        }
    }

    // 4. Validate Terms of Service
    $errors['agree_terms'] = !$agreed
        ? 'You must agree to the Terms of Service.'
        : '';

    // 5. Check if there are errors
    $invalid = implode($errors);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Developer Workshop Registration</title>
</head>
<body>

    <h2>Developer Workshop Registration</h2>

    <?php if (!$submitted || $invalid) { ?>

        <form method="POST">

            <label for="password">Password:</label>
            <input
                type="password"
                name="password"
                id="password"
            >

            <p>
                <?= htmlspecialchars($errors['password']) ?>
            </p>

            <h3>Choose Workshop Tracks (1-3)</h3>

            <?php foreach ($availableTracks as $key => $label) { ?>

                <label>
                    <input
                        type="checkbox"
                        name="topics[]"
                        value="<?= htmlspecialchars($key) ?>"
                        <?= in_array($key, $selectedTopics, true) ? 'checked' : '' ?>
                    >

                    <?= htmlspecialchars($label) ?>
                </label>

                <br>

            <?php } ?>

            <p>
                <?= htmlspecialchars($errors['topics']) ?>
            </p>

            <br>

            <label>
                <input
                    type="checkbox"
                    name="agree_terms"
                    value="yes"
                    <?= $agreed ? 'checked' : '' ?>
                >

                I agree to the Terms of Service
            </label>

            <p>
                <?= htmlspecialchars($errors['agree_terms']) ?>
            </p>

            <br>

            <button type="submit">Register</button>

        </form>

    <?php } else { ?>

        <h3>Registration successful!</h3>

        <p>Your selected workshops:</p>

        <ul>
            <?php foreach ($selectedTopics as $topic) { ?>
                <li>
                    <?= htmlspecialchars($availableTracks[$topic]) ?>
                </li>
            <?php } ?>
        </ul>

    <?php } ?>

</body>
</html>
