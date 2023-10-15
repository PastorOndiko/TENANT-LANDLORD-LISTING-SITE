<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <!-- Add your CSS styles here -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
       <!-- Bootstrap core CSS -->
<link href="botstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  
</head>
<body>
<header>
		
		<h3 class="title">profile</h3>
	</header>
    
    <?php
    session_start();
    require_once "db.php";

    // Check if the user is logged in
    if (isset($_SESSION["user_id"])) {
        $user_id = $_SESSION["user_id"];

        // Determine if the user is a landlord or tenant
        $user_type = "";  // You should determine this based on your database structure
        $username = "";   // Retrieve the username from your database
        $email = "";      // Retrieve the email from your database
        $phone = "";      // Retrieve the phone number from your database
        $user_status = ""; // You should determine this based on your database structure

        if ($user_type == "landlord") {
            echo "<i class='fas fa-user'></i>";
            echo "<p><strong>Username:</strong> $username</p>";
            echo "<p><strong>Email:</strong> $email</p>";
            echo "<p><strong>Phone Number:</strong> $phone</p>";
            echo "<p><strong>User ID:</strong> $user_id</p>";
            echo "<p><strong>Status:</strong> Landlord</p>";
        } elseif ($user_type == "tenant") {
            echo "<i class='fas fa-user'></i>";
            echo "<p><strong>Username:</strong> $username</p>";
            echo "<p><strong>Email:</strong> $email</p>";
            echo "<p><strong>Phone Number:</strong> $phone</p>";
            echo "<p><strong>User ID:</strong> $user_id</p>";
            echo "<p><strong>Status:</strong> Tenant</p>";
        } else {
            echo "<p>Invalid user type.</p>";
        }
    } else {
        echo "<p>You must be logged in to view your profile.</p>";
    }
    ?>
    
    <footer>
    <div class="footer-content">
       
        <p><a href="https://www.fumbomall.com">Shop</a></p>
        <p><a href="https://www.fumbomall.com/contact">Contact Us</a></p>
        <p><a href="index.php">Home</a></p>
        <p>&copy; <?php echo date("Y"); ?> Fumbomall. All rights reserved.</p>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
