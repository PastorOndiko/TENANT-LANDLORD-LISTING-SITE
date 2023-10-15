<?php
session_start();
require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update_approval"])) {
    $landlord_id = $_SESSION["user_id"]; // Assuming you have stored the landlord's user ID in the session
    $booking_id = $_POST["booking_id"];
    $approval_status = $_POST["approval_status"]; // It will be "approved" or "rejected"

    // Check if the booking belongs to the landlord
    $stmt = $pdo->prepare("SELECT * FROM bookings WHERE id = :booking_id AND status = 'pending'");
    $stmt->bindParam(":booking_id", $booking_id);
    $stmt->execute();
    $booking = $stmt->fetch();

    if ($booking) {
        // Update the booking status based on landlord's decision
        $stmt = $pdo->prepare("UPDATE bookings SET status = :approval_status WHERE id = :booking_id");
        $stmt->bindParam(":approval_status", $approval_status);
        $stmt->bindParam(":booking_id", $booking_id);
        $stmt->execute();

        // Optionally, send notifications to the tenant (not implemented in this code)

        // Redirect back to viewbookings.php
        header("Location: viewbookings.php");
        exit();
    } else {
        echo "Invalid or already processed booking.";
    }
}
?>
