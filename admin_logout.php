<?php
session_start();

// Logout admin
$_SESSION["admin_logged_in"] = false;
session_destroy();

// Redirect to the admin login page
header("Location: admin_login.php");
exit();
?>
