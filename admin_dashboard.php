<?php
session_start();

// Check if the user is logged in as admin
if (isset($_SESSION["admin_logged_in"]) && $_SESSION["admin_logged_in"] === true) {
    // Display admin's dashboard with edit and delete options for listings

    // Add logic here to retrieve and display listings
    // Example: $listings = retrieveListingsFromDatabase();

    echo "<h1>Admin Dashboard</h1>";
    
    // Display listings and provide edit/delete links
    foreach ($listings as $listing) {
        echo "<div>";
        echo "<strong>Location:</strong> " . $listing["county"] . ", " . $listing["town"] . ", " . $listing["village"] . "<br>";
        echo "<strong>Type:</strong> " . ucfirst($listing["property_type"]) . "<br>";
        echo "<strong>Amount:</strong> $" . $listing["amount"] . "<br>";
        echo "<strong>Details:</strong> " . $listing["details"] . "<br>";
        
        // Edit and delete links for listings
        echo '<a href="edit_listing.php?listing_id=' . $listing["id"] . '">Edit</a>';
        echo ' | ';
        echo '<a href="delete_listing.php?listing_id=' . $listing["id"] . '">Delete</a>';
        
        echo "</div><br>";
    }

    // Add links to delete content on addlisting.php and tenant.php
    echo '<a href="delete_content.php?page=addlisting.php">Delete Content on addlisting.php</a>';
    echo '<br>';
    echo '<a href="delete_content.php?page=tenant.php">Delete Content on tenant.php</a>';

} else {
    // Redirect to the admin login page
    header("Location: admin_login.php");
    exit();
}
?>
