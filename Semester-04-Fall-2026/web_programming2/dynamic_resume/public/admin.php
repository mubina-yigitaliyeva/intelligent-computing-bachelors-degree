
<?php
session_start();

require_once '../config/database.php';
require_once '../includes/functions.php';

requireLogin();

$userId = $_SESSION['admin_id'];
$message = '';
$error = '';

$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$userId]);
$user = $stmt->fetch();

if (!$user) {
    redirect('logout.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!isset($_FILES['avatar'])) {
        $error = 'Please select an image.';

    } else {
        try {
            $filename = processAvatar($_FILES['avatar']);

            try {
                $stmt = $pdo->prepare(
                    "UPDATE users SET avatar_path = ? WHERE id = ?"
                );
                $stmt->execute([$filename, $userId]);

            } catch (PDOException $e) {
                unlink('../uploads/' . $filename);
                throw $e;
            }

            if (!empty($user['avatar_path'])) {
                $oldFile = '../uploads/' . basename($user['avatar_path']);

                if (is_file($oldFile)) {
                    unlink($oldFile);
                }
            }

            $user['avatar_path'] = $filename;
            $message = 'Photo uploaded successfully!';

        } catch (RuntimeException $e) {
            $error = $e->getMessage();

        } catch (PDOException $e) {
            error_log($e->getMessage());
            $error = 'Could not save the photo.';
        }
    }
}

$stmt = $pdo->prepare(
    "SELECT * FROM resume_entries
     WHERE user_id = ?
     ORDER BY start_date DESC"
);
$stmt->execute([$userId]);
$entries = $stmt->fetchAll();

$avatar = 'assets/photo.jpeg';

if (!empty($user['avatar_path'])) {
    $name = basename($user['avatar_path']);

    if (is_file('../uploads/' . $name)) {
        $avatar = '../uploads/' . rawurlencode($name);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <h1>Admin Dashboard</h1>
    <p>Welcome, <?= e($user['full_name']) ?>!</p>

    <br>
    <p>
        <a href="index.php">View Resume</a> |
        <a href="logout.php">Logout</a>
    </p>
    <br>

    <?php if ($message): ?>
        <p><?= e($message) ?></p>
    <?php endif; ?>

    <?php if ($error): ?>
        <p><?= e($error) ?></p>
    <?php endif; ?>

    <section class="card">
        <h2>Profile Photo</h2>

        <img src="<?= e($avatar) ?>"
            alt="Profile"
            width="150" height="150">

        <br><br> 

        <form method="POST" enctype="multipart/form-data">   
            <input type="file" name="avatar"
                accept=".jpg,.jpeg,.png" required>
            <button type="submit">Upload Photo</button>
        </form>
    </section>

    <section class="card">
        <h2>Manage Resume Entries</h2>
        <br>
        <p>
            <a href="entry_form.php">+ Add New Entry</a>
        </p>
        <br></br>

        <?php if (empty($entries)): ?>
            <p>No resume entries yet.</p>
        <?php else: ?>

            <table>
                <tr>
                    <th>Type</th>
                    <th>Title</th>
                    <th>Organization</th>
                    <th>Actions</th>
                </tr>

                <?php foreach ($entries as $entry): ?>
                    <tr>
                        <td><?= e($entry['entry_type']) ?></td>
                        <td><?= e($entry['title']) ?></td>
                        <td><?= e($entry['organization']) ?></td>

                        <td>
                            <a href="entry_form.php?id=<?= (int) $entry['id'] ?>">
                                Edit
                            </a>

                            <form method="POST"
                                action="delete_entry.php"
                                style="display:inline"
                                onsubmit="return confirm('Delete this entry?')">

                                <input type="hidden" name="id"
                                    value="<?= (int) $entry['id'] ?>">

                                <button type="submit">Delete</button>
                            </form>
                            
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>

        <?php endif; ?>
    </section>

</body>
</html>