
<?php
session_start();

require_once '../config/database.php';
require_once '../includes/functions.php';

requireLogin();

$userId = $_SESSION['admin_id'];

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$isEdit = $id !== null && $id !== false && $id > 0;

$errors = [];

$entry = [
    'entry_type' => 'experience',
    'title' => '',
    'organization' => '',
    'start_date' => '',
    'end_date' => '',
    'description' => ''
];

if ($isEdit) {
    $stmt = $pdo->prepare(
        "SELECT * FROM resume_entries
         WHERE id = ? AND user_id = ?"
    );

    $stmt->execute([$id, $userId]);
    $entry = $stmt->fetch();

    if (!$entry) {
        http_response_code(404);
        exit('Entry not found.');
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $entry = [
        'entry_type' => $_POST['entry_type'] ?? '',
        'title' => trim($_POST['title'] ?? ''),
        'organization' => trim($_POST['organization'] ?? ''),
        'start_date' => $_POST['start_date'] ?? '',
        'end_date' => $_POST['end_date'] ?? '',
        'description' => trim($_POST['description'] ?? '')
    ];

    $errors = validateEntry($entry);

    if (empty($errors)) {

        $values = [
            $entry['entry_type'],
            $entry['title'],
            $entry['organization'],
            $entry['start_date'],
            $entry['end_date'] ?: null,
            $entry['description']
        ];

        if ($isEdit) {

            // UPDATE
            $stmt = $pdo->prepare(
                "UPDATE resume_entries
                 SET entry_type = ?,
                     title = ?,
                     organization = ?,
                     start_date = ?,
                     end_date = ?,
                     description = ?
                 WHERE id = ? AND user_id = ?"
            );

            $stmt->execute([
                ...$values,
                $id,
                $userId
            ]);

        } else {
            // INSERT
            $stmt = $pdo->prepare(
                "INSERT INTO resume_entries
                 (user_id, entry_type, title,
                  organization, start_date,
                  end_date, description)
                 VALUES (?, ?, ?, ?, ?, ?, ?)"
            );

            $stmt->execute([
                $userId,
                ...$values
            ]);
        }

        redirect('admin.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $isEdit ? 'Edit' : 'Add' ?> Entry</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <h1><?= $isEdit ? 'Edit' : 'Add' ?> Resume Entry</h1>

    <?php foreach ($errors as $error): ?>
        <p style="color:red"><?= e($error) ?></p>
    <?php endforeach; ?>

    <br>

    <form method="POST">
        <p>
            <label>Entry Type</label>
            <select name="entry_type">
                <?php foreach (['experience', 'education', 'project'] as $type): ?>
                    <option value="<?= $type ?>"
                        <?= $entry['entry_type'] === $type ? 'selected' : '' ?>>
                        <?= ucfirst($type) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </p>

        <p>
            <label>Title</label>
            <input type="text" name="title"
                    maxlength="120"
                    value="<?= e($entry['title']) ?>" required>
        </p>

        <p>
            <label>Organization</label>
            <input type="text" name="organization"
                    maxlength="120"
                    value="<?= e($entry['organization']) ?>" required>
        </p>

        <p>
            <label>Start Date</label>
            <input type="date" name="start_date"
                    value="<?= e($entry['start_date']) ?>" required>
        </p>

        <p>
            <label>End Date (leave empty for Present)</label>
            <input type="date" name="end_date"
                    value="<?= e($entry['end_date']) ?>">
        </p>

        <p>
            <label>Description</label>
            <textarea name="description" rows="5"
                        required><?= e($entry['description']) ?></textarea>
        </p>

        <br><br>

        <button type="submit">
            <?= $isEdit ? 'Update Entry' : 'Add Entry' ?>
        </button>

    </form>

    <br>

    <p><a href="admin.php">Back to Dashboard</a></p>

</body>
</html>