<?php
session_start();
require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    var_dump($_POST); // Debug: This will display the POST data for troubleshooting.

    if (isset($_POST["signup_username"]) && isset($_POST["signup_email"]) && isset($_POST["signup_phone"]) && isset($_POST["signup_password"]) && isset($_POST["signup_user_type"])) {
        // The rest of your code...
    } else {
        echo "Some POST data is missing.";
    }
}


if (empty($_POST["signup_username"])) {
    echo "Username is missing in POST data.";
} else {
    $signup_username = $_POST["signup_username"];
    // Proceed with the rest of the code...
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["signup_username"]) && isset($_POST["signup_email"]) && isset($_POST["signup_phone"]) && isset($_POST["signup_password"]) && isset($_POST["signup_user_type"])) {
    $signup_username = $_POST["signup_username"];
    $signup_email = $_POST["signup_email"];
    $signup_phone = $_POST["signup_phone"];
    $signup_password = $_POST["signup_password"];
    $signup_user_type = $_POST["signup_user_type"];

    if (empty($signup_username) || empty($signup_email) || empty($signup_phone) || empty($signup_password)) {
        echo "All fields must be filled out.";
    } else {
        $hashed_password = password_hash($signup_password, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("INSERT INTO users (username, email, phone, password, user_type) VALUES (:username, :email, :phone, :password, :user_type)");
        $stmt->bindParam(":username", $signup_username);
        $stmt->bindParam(":email", $signup_email);
        $stmt->bindParam(":phone", $signup_phone);
        $stmt->bindParam(":password", $hashed_password);
        $stmt->bindParam(":user_type", $signup_user_type);

        if ($stmt->execute()) {
            $_SESSION["user_id"] = $pdo->lastInsertId();
            if ($signup_user_type == "tenant") {
                header("Location: tenant.php");
            } else {
                header("Location: landlord.php");
            }
            exit();
        } else {
            echo "Error creating user.";
        }
    }
} else {
    echo "Invalid POST data.";
}
?>
