<?php
session_start();
require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login_username = $_POST["login_username"];
    $login_password = $_POST["login_password"];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->bindParam(":username", $login_username);
    $stmt->execute();
    $user = $stmt->fetch();

    if ($user && password_verify($login_password, $user["password"])) {
        $_SESSION["user_id"] = $user["id"];
        if ($user["user_type"] == "tenant") {
            header("Location: tenant.php");
        } else {
            header("Location: landlord.php");
        }
        exit();
    } else {
        echo "Invalid login credentials.";
    }
}
?>
