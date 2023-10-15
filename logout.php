<?php
session_start();
session_destroy();
header("Location: index.php"); // Redirect to the login/signup page
exit();
?>
