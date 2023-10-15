<?php
session_start();
require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["book"])) {
    $tenant_id = $_POST["tenant_id"];
    $listing_id = $_POST["listing_id"];

    // Create a booking
    $stmt = $pdo->prepare("INSERT INTO bookings (tenant_id, listing_id) VALUES (:tenant_id, :listing_id)");
    $stmt->bindParam(":tenant_id", $tenant_id);
    $stmt->bindParam(":listing_id", $listing_id);
    $stmt->execute();

    // Send a notification to the landlord (not implemented in this code)

    // Redirect to a success page or a different page
    header("Location: success_booking.php");
    exit();
}
?>
