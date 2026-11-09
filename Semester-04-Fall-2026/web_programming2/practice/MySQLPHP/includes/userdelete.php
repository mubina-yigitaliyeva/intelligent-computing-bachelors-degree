<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];

    try {
        require_once "database.php";

        $query = "DELETE FROM users WHERE 
                                    username = :username 
                                    AND 
                                    pwd = :pwd;";

        $stmt = $pdo->prepare($query); // preparing the sql statement

        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":pwd", $pwd);

        $stmt->execute();

        $pdo = null;
        $stmt = null;

        header("Location: ../index.php");

        die();
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage()); // terminates the entire script, stops from running
    }
} else {
    header("Location: ../index.php");
    exit;
}
