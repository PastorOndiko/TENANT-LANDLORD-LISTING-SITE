<!DOCTYPE html>
<html>
<head>
    <title>Manage Listings</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
       <!-- Bootstrap core CSS -->
<link href="botstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  
</head>
<body>
<header>
		<h1 class="heading">Fumbo Komboa Nyumba</h1>

        <ul>
    <div class="container">
  <footer class="py-3 my-4">
    <ul class="nav justify-content-center border-bottom pb-3 mb-3">
      <li class="nav-item"><a href="landlord.php" class="nav-link px-2 text-muted">Home</a></li>
      <li class="nav-item"><a href="bookrental.php" class="nav-link px-2 text-muted">Book</a></li>
      <li class="nav-item"><a href="searchrental.php" class="nav-link px-2 text-muted">Search</a></li>
      <li class="nav-item"><a href="profile.php" class="nav-link px-2 text-muted">Profile</a></li>
      <li class="nav-item"><a href="logout.php" class="nav-link px-2 text-muted">Logout</a></li>
    </ul>
    
  </footer>
</div>
		<h3 class="title">Manage listings</h3>
	</header>

    <?php
    session_start();
    require_once "db.php";

    // Check if the user is logged in as a landlord
    if (isset($_SESSION["user_id"])) {
        $landlord_id = $_SESSION["user_id"];

        // Check if the form for deleting a listing has been submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_listing"])) {
            $listing_id = $_POST["listing_id"];

            // Check if the listing belongs to the current landlord
            $stmt = $pdo->prepare("SELECT * FROM listings WHERE id = :listing_id AND landlord_id = :landlord_id");
            $stmt->bindParam(":listing_id", $listing_id);
            $stmt->bindParam(":landlord_id", $landlord_id);
            $stmt->execute();
            $listing = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($listing) {
                // Delete the listing from the database
                $stmt = $pdo->prepare("DELETE FROM listings WHERE id = :listing_id");
                $stmt->bindParam(":listing_id", $listing_id);

                if ($stmt->execute()) {
                    echo "<p>Listing deleted successfully.</p>";
                } else {
                    echo "<p>Error deleting listing.</p>";
                }
            } else {
                echo "<p>Invalid or unauthorized action.</p>";
            }
        }

        // Retrieve and display the landlord's listings
        $stmt = $pdo->prepare("SELECT * FROM listings WHERE landlord_id = :landlord_id");
        $stmt->bindParam(":landlord_id", $landlord_id);
        $stmt->execute();
        $listings = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($listings) > 0) {
            echo "<h2>Your Listings</h2>";

            foreach ($listings as $listing) {
                echo "<div>";
                echo "<strong>Location:</strong> " . $listing["county"] . ", " . $listing["town"] . ", " . $listing["village"] . "<br>";
                echo "<strong>Type:</strong> " . ucfirst($listing["property_type"]) . "<br>";
                echo "<strong>Amount:</strong> $" . $listing["amount"] . "<br>";
                echo "<strong>Details:</strong> " . $listing["details"] . "<br>";
                echo '<form action="manage.php" method="POST">';
                echo '<input type="hidden" name="listing_id" value="' . $listing["id"] . '">';
                echo '<input type="submit" name="delete_listing" value="Delete Listing">';
                echo '</form>';
                echo "</div><br>";
            }
        } else {
            echo "<p>You don't have any listings.</p>";
        }
    } else {
        echo "<p>You must be logged in as a landlord to manage your listings.</p>";
    }
    ?>

<div class="container">
  <footer class="py-3 my-4">
    <ul class="nav justify-content-center border-bottom pb-3 mb-3">
      <li class="nav-item"><a href="index.php" class="nav-link px-2 text-muted">Home</a></li>
      <li class="nav-item"><a href="https://www.fumbomall.com/contact" class="nav-link px-2 text-muted">Contact Us</a></li>
      <li class="nav-item"><a href="www.fumbomall.com" class="nav-link px-2 text-muted">Shop</a></li>
      <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">FAQs</a></li>
      <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">About</a></li>
    </ul>
    <p class="text-center text-muted">&copy; <?php echo date("Y"); ?> Fumbomall.</p>
  </footer>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>
</html>
