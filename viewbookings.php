<!DOCTYPE html>
<html>
<head>
    <title>View Bookings</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
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
		<h3 class="title">Your potential tenants</h3>
	</header>
    <?php
    session_start();
    require_once "db.php";

    // Check if the user is logged in as a landlord
    if (isset($_SESSION["user_id"])) {
        $landlord_id = $_SESSION["user_id"];

        // Retrieve booking requests for the current landlord
        $stmt = $pdo->prepare("SELECT b.*, t.username AS tenant_username, l.county, l.town, l.village FROM bookings b
                            JOIN listings l ON b.listing_id = l.id
                            JOIN tenants t ON b.tenant_id = t.id
                            WHERE l.landlord_id = :landlord_id AND b.status = 'pending'");
        $stmt->bindParam(":landlord_id", $landlord_id);
        $stmt->execute();
        $bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($bookings) > 0) {
            echo "<h2>Pending Booking Requests</h2>";

            foreach ($bookings as $booking) {
                echo "<div>";
                echo "<strong>Listing Location:</strong> " . $booking["county"] . ", " . $booking["town"] . ", " . $booking["village"] . "<br>";
                echo "<strong>Tenant Username:</strong> " . $booking["tenant_username"] . "<br>";
                echo "<strong>Status:</strong> " . ucfirst($booking["status"]) . "<br>";

                // Allow landlord to accept or decline the booking
                echo '<form action="process_booking_approval.php" method="POST">';
                echo '<input type="hidden" name="booking_id" value="' . $booking["id"] . '">';
                echo '<select name="approval_status">';
                echo '<option value="approved">Approve</option>';
                echo '<option value="rejected">Reject</option>';
                echo '</select>';
                echo '<input type="submit" name="update_approval" value="Update Approval">';
                echo '</form>';
                echo "</div><br>";
            }
        } else {
            echo "<p>No pending booking requests found.</p>";
        }
    } else {
        echo "<p>You must be logged in as a landlord to view booking requests.</p>";
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
