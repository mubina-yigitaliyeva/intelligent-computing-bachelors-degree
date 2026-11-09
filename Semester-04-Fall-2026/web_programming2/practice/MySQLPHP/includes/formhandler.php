<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];
    $email = $_POST["email"];

    try {
        require_once "database.php";

        // $query = "INSERT INTO users (username, pwd, email)
        //           VALUES ($username, $pwd, $email);";
        $query = "INSERT INTO users (username, pwd, email)
                  VALUES (:username, :pwd, :email);"; // named arguments

        $stmt = $pdo->prepare($query); // preparing the sql statement

        // method 1
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":pwd", $pwd);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        // method 2
        // $stmt->execute([$username, $pwd, $email]); // executing the statement

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
