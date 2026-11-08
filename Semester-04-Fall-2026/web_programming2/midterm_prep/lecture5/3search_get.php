<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="search_get.php" method="GET">
        <label for="term">Search:</label>
        <input type="text" name="term" id="term">

        <button type="submit" name="sent" value="search">Search</button>
    </form>

    <?php
        $term = $_GET['term'] ?? '';
        $sent = $_GET['sent'] ?? '';

        if ($sent === "search") {
            echo "You searched for: " . htmlspecialchars($term);
        }
    ?>
</body>
</html>