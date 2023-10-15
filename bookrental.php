<!DOCTYPE html>
<html>
<head>
    <title>Fumbomall</title>
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
      <li class="nav-item"><a href="tenant.php" class="nav-link px-2 text-muted">Home</a></li>
      <li class="nav-item"><a href="bookrental.php" class="nav-link px-2 text-muted">Book</a></li>
      <li class="nav-item"><a href="searchrental.php" class="nav-link px-2 text-muted">Search</a></li>
      <li class="nav-item"><a href="profile.php" class="nav-link px-2 text-muted">Profile</a></li>
      <li class="nav-item"><a href="logout.php" class="nav-link px-2 text-muted">Logout</a></li>
    </ul>
    
  </footer>
</div>
		<h3 class="title">Make your booking</h3>
	</header>

    <?php
    session_start();
    require_once "db.php";

    // Check if the user is logged in as a tenant
    if (isset($_SESSION["user_id"])) {
        $tenant_id = $_SESSION["user_id"];

        if (isset($_GET["listing_id"])) {
            $listing_id = $_GET["listing_id"];

            // Check if the listing is available
            $stmt = $pdo->prepare("SELECT * FROM listings WHERE id = :listing_id AND available = true");
            $stmt->bindParam(":listing_id", $listing_id);
            $stmt->execute();
            $listing = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($listing) {
                echo "<h2>Selected Listing</h2>";
                echo "<strong>Location:</strong> " . $listing["county"] . ", " . $listing["town"] . ", " . $listing["village"] . "<br>";
                echo "<strong>Type:</strong> " . ucfirst($listing["property_type"]) . "<br>";
                echo "<strong>Amount:</strong> $" . $listing["amount"] . "<br>";
                echo "<strong>Details:</strong> " . $listing["details"] . "<br>";

                // Allow tenant to book the rental and wait for landlord approval
                echo '<form action="process_booking.php" method="POST">';
                echo '<input type="hidden" name="tenant_id" value="' . $tenant_id . '">';
                echo '<input type="hidden" name="listing_id" value="' . $listing_id . '">';
                echo '<input type="submit" name="book" value="Book Rental">';
                echo '</form>';
            } else {
                echo "<p>Invalid or unavailable listing.</p>";
            }
        } else {
            echo "<p>Invalid listing selection.</p>";
        }
    } else {
        echo "<p>You must be logged in as a tenant to book a rental.</p>";
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
