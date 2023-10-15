<!DOCTYPE html>
<html>
<head>
    <title>fumbomall</title>
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
		<h3 class="title">Find rentals near you</h3>
	</header>

    
   

    <?php
    session_start();
    require_once "db.php";

    // Check if the user is logged in as a tenant
    if (isset($_SESSION["user_id"])) {
        // Retrieve available listings from the database based on search filters
        $county = $_POST["county"] ?? "";
        $town = $_POST["town"] ?? "";
        $village = $_POST["village"] ?? "";
        $amount = $_POST["amount"] ?? "";
        $property_type = $_POST["property_type"] ?? "";

        $sql = "SELECT * FROM listings WHERE available = true";

        if (!empty($county)) {
            $sql .= " AND county = :county";
        }

        if (!empty($town)) {
            $sql .= " AND town = :town";
        }

        if (!empty($village)) {
            $sql .= " AND village = :village";
        }

        if (!empty($amount)) {
            $sql .= " AND amount <= :amount";
        }

        if (!empty($property_type)) {
            $sql .= " AND property_type = :property_type";
        }

        $stmt = $pdo->prepare($sql);

        if (!empty($county)) {
            $stmt->bindParam(":county", $county);
        }

        if (!empty($town)) {
            $stmt->bindParam(":town", $town);
        }

        if (!empty($village)) {
            $stmt->bindParam(":village", $village);
        }

        if (!empty($amount)) {
            $stmt->bindParam(":amount", $amount);
        }

        if (!empty($property_type)) {
            $stmt->bindParam(":property_type", $property_type);
        }

        $stmt->execute();
        $listings = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($listings) > 0) {
            echo "<h2>Available Listings</h2>";

            foreach ($listings as $listing) {
                echo "<div>";
                echo "<strong>Location:</strong> " . $listing["county"] . ", " . $listing["town"] . ", " . $listing["village"] . "<br>";
                echo "<strong>Type:</strong> " . ucfirst($listing["property_type"]) . "<br>";
                echo "<strong>Amount:</strong> $" . $listing["amount"] . "<br>";
                echo "<strong>Details:</strong> " . $listing["details"] . "<br>";
                echo '<a href="bookrental.php?listing_id=' . $listing["id"] . '">Book Rental</a>';
                echo "</div><br>";
            }
        } else {
            echo "<p>No matching listings found.</p>";
        }
    } else {
        echo "<p>You must be logged in as a tenant to search for rentals.</p>";
    }
    ?>

    <h2>Search Filters</h2>
    <form action="searchrental.php" method="POST">
        <label for="county">County:</label>
        <input type="text" name="county"><br><br>

        <label for="town">Town:</label>
        <input type="text" name="town"><br><br>

        <label for="village">Village:</label>
        <input type="text" name="village"><br><br>

        <label for="amount">Maximum Amount (KES):</label>
        <input type="number" name="amount"><br><br>

        <label for="property_type">Property Type:</label>
        <select name="property_type">
            <option value="">Any</option>
            <option value="single">Single</option>
            <option value="self-contained">Self-contained</option>
        </select><br><br>

        <input type="submit" name="search" value="Search">
    </form>

  

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
</footer>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>
</html>
