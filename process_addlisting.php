<?php
session_start();
require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $county = $_POST["county"];
    $town = $_POST["town"];
    $village = $_POST["village"];
    $property_type = $_POST["property_type"];
    $amount = $_POST["amount"];
    $details = $_POST["details"];

    // Handle image upload
    $image_path = null;
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == UPLOAD_ERR_OK) {
        $image_name = $_FILES["image"]["name"];
        $image_tmp_name = $_FILES["image"]["tmp_name"];
        $image_path = "uploads/" . $image_name; // You should create an "uploads" directory to store images
        move_uploaded_file($image_tmp_name, $image_path);
    }

    // Insert the listing into the database
    $stmt = $pdo->prepare("INSERT INTO listings (county, town, village, property_type, amount, details, image_path) VALUES (:county, :town, :village, :property_type, :amount, :details, :image_path)");
    $stmt->bindParam(":county", $county);
    $stmt->bindParam(":town", $town);
    $stmt->bindParam(":village", $village);
    $stmt->bindParam(":property_type", $property_type);
    $stmt->bindParam(":amount", $amount);
    $stmt->bindParam(":details", $details);
    $stmt->bindParam(":image_path", $image_path); 
   

    if ($stmt->execute()) {
        // Redirect to a success page or a different page
        header("Location: success.php");
        exit();
    } else {
        echo "Error adding listing.";
    }
}
?>
