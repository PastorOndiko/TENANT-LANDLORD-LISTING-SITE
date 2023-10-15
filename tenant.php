<!DOCTYPE html>
<html>
<head>
    <title>Tenant Dashboard</title>
    <link rel="stylesheet" type="text/css" href="dash.css">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="stylesheet" type="text/css" href="roles.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
       <!-- Bootstrap core CSS -->
<link href="botstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  

    
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

<header>
		<h1 class="heading">Fumbo Komboa Nyumba</h1>

		<h3 class="title">Welcome tenant</h3>
	</header>

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
    <?php
    session_start();
    require_once "db.php";

    // Check if the user is logged in as a tenant
    if (isset($_SESSION["user_id"])) {
        $tenant_id = $_SESSION["user_id"];

        // Fetch and display available listings
        echo "<h2>Available Listings</h2>";
        $stmt = $pdo->prepare("SELECT * FROM listings WHERE available = true");
        $stmt->execute();
        $listings = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($listings) > 0) {
            echo "<ul>";
            foreach ($listings as $listing) {
                echo "<li>";
                echo "Location: " . $listing["county"] . ", " . $listing["town"] . ", " . $listing["village"] . "<br>";
                echo "Type: " . ucfirst($listing["property_type"]) . "<br>";
                echo "Amount: KES" . $listing["amount"] . "<br>";
                echo "Details: " . $listing["details"] . "<br>";
                echo '<a href="bookrental.php?listing_id=' . $listing["id"] . '">Book Now</a>';
                echo "</li>";
            }
            echo "</ul>";
        } else {
            echo "<p>No available listings at the moment.</p>";
        }
    } else {
        echo "<p>You must be logged in as a tenant to access this page.</p>";
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

   
</body>
</html>
