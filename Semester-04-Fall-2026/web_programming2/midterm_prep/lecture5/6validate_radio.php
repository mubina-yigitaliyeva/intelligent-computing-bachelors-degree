<?php
$stars = '';
$message = '';
$allowed_stars = [1, 2, 3, 4, 5];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stars = $_POST['rating'] ?? '';
    $valid = in_array($stars, $allowed_stars);
    $message = $valid ? 'Thank you' : 'Select an option';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Rate Our Service</h1>

    <form method="post">
        <!-- <input type="radio" name="rating" value="1"> 1 
        <input type="radio" name="rating" value="2"> 2 
        <input type="radio" name="rating" value="3"> 3 
        <input type="radio" name="rating" value="4"> 4
        <input type="radio" name="rating" value="5"> 5 -->

        <?php foreach ($allowed_stars as $star) { ?>
                <?= $star ?> <input 
                    type="radio" 
                    name="rating" 
                    value="<?= $star ?>" 
                    <?= ($star == $stars) ? 'checked' : '' ?>>

            <?php } ?>

        <button type="submit">submit</button>
    </form>

    <?php if ($message) { ?>
        <p><?= htmlspecialchars($message) ?></p>
    <?php } ?>
</body>
</html>