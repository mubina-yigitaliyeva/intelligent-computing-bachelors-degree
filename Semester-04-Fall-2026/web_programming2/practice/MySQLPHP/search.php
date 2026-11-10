<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userSearch = $_POST["usersearch"];

    try {
        require_once "includes/database.php";

        $query = "SELECT * FROM comments 
                           WHERE username = :usersearch;"; // named arguments

        $stmt = $pdo->prepare($query); // preparing the sql statement

        $stmt->bindParam(":usersearch", $userSearch);

        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $pdo = null;
        $stmt = null;

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage()); // terminates the entire script, stops from running
    }
} else {
    header("Location: index.php");
    exit;
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
    <h3>Search results</h3>

    <?php
    if (empty($results)) {
        echo "<h4>There were no results.</h4>";
    } else {
        foreach ($results as $row) {
            echo htmlspecialchars($row["username"], ENT_QUOTES, "UTF-8") . "<br>";
            echo htmlspecialchars($row["comment_text"], ENT_QUOTES, "UTF-8") . "<br>";
            echo htmlspecialchars($row["created_at"], ENT_QUOTES, "UTF-8") . "<br>";
        }
    }
?>

</body>
</html>