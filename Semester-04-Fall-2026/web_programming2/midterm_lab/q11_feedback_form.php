<?php
    $name = '';
    $comment = '';
    $message = '';

    $errors = [
        'name' => '',
        'comment' => ''  
    ];
    $invalid = '';

    $submitted = $_SERVER['REQUEST_METHOD'] === 'POST';

    if ($submitted) {
        $name = trim($_POST['name'] ?? '');
        $comment = trim($_POST['comment'] ?? '');

        $nameLength = mb_strlen($name);
        $commentLength = mb_strlen($comment);

        $errors['name'] = ($nameLength < 2 || $nameLength > 50)
        ? "Name should contain 2-50 characters"
        : '';

        $errors['comment'] = ($commentLength < 10 || $commentLength > 300)
        ? "Comment should contain 10-300 characters"
        : '';

        $invalid = implode($errors);
        $message = $invalid 
        ? "Please correct following errors !"
        :  "Valid data.";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Feedback Form</title>
</head>
<body>
    <?php if($message) { ?>
            <p><?= htmlspecialchars($message) ?></p>

        <?php } ?>

    <?php if (!$submitted || $invalid) { ?>

    <form method="POST">
        <label for="name">Name:</label>

        <input type="text" name="name" id="name" value="<?= htmlspecialchars($name) ?>">

        <p><?= htmlspecialchars($errors['name']) ?></p>

        <label for="comment">Comment:</label>

        <textarea name="comment" id="comment" cols="40" rows="5"><?=htmlspecialchars($comment)?></textarea>
        
        <p><?= htmlspecialchars($errors['comment']) ?></p>

        <button type="submit">Submit</button>
    </form>

    <?php } else { ?>
        <h3>Feedback submitted successfully!</h3>
        <p>Name: <?= htmlspecialchars($name) ?></p>
        <p>Comment: <?= htmlspecialchars($comment) ?></p>
    <?php } ?>
</body>
</html>