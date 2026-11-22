
<?php
session_start();

require_once '../config/database.php';
require_once '../includes/functions.php';

requireLogin();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('admin.php');
}

$id = filter_input(
    INPUT_POST,
    'id',
    FILTER_VALIDATE_INT
);

if (!$id || $id <= 0) {
    exit('Invalid entry ID.');
}

$stmt = $pdo->prepare(
    "DELETE FROM resume_entries
     WHERE id = ? AND user_id = ?"
);

$stmt->execute([
    $id,
    $_SESSION['admin_id']
]);

redirect('admin.php');
