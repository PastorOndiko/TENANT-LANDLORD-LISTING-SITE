<!DOCTYPE html>
<html>
<head>
    <title>My Listings</title>
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
      <li class="nav-item"><a href="viewlistings.php" class="nav-link px-2 text-muted">See Bookings</a></li>
      <li class="nav-item"><a href="mylistings.php" class="nav-link px-2 text-muted">My Lists</a></li>
      <li class="nav-item"><a href="manage.php" class="nav-link px-2 text-muted">Manage</a></li>
      <li class="nav-item"><a href="profile.php" class="nav-link px-2 text-muted">Profile</a></li>
      <li class="nav-item"><a href="logout.php" class="nav-link px-2 text-muted">Logout</a></li>
    </ul>
    
  </footer>
</div>
		<h3 class="title">My rentals and listings</h3> 
	</header>

    <?php
    session_start();
    require_once "db.php";

    // Check if the user is logged in as a landlord
    if (isset($_SESSION["user_id"])) {
        $landlord_id = $_SESSION["user_id"];

        // Retrieve listings for the current landlord
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
                echo "</div><br>";
            }
        } else {
            echo "<p>You don't have any listings. <a href='addlisting.php'>Click here</a> to add a new listing.</p>";
        }
    } else {
        echo "<p>You must be logged in as a landlord to view your listings.</p>";
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
