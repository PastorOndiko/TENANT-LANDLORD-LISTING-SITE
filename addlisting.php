<!DOCTYPE html>
<html>
<head>
    <title>Add Listing</title>
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
		<h3 class="title">Add your listing</h3>
	</header>
   

    <form action="process_addlisting.php" method="POST" enctype="multipart/form-data">
        <label for="county">County:</label>
        <input type="text" name="county" required><br><br>

        <label for="town">Town:</label>
        <input type="text" name="town" required><br><br>

        <label for="village">Village:</label>
        <input type="text" name="village" required><br><br>

        <label for="property_type">Property Type:</label>
        <select name="property_type" required>
            <option value="single">Single</option>
            <option value="self-contained">Self-contained</option>
        </select><br><br>

        <label for="amount">Amount (KES):</label>
        <input type="number" name="amount" step="0.01" required><br><br>

        <label for="details">Details:</label>
        <textarea name="details" rows="4" cols="50" required></textarea><br><br>

        <label for="image">Upload Image:</label>
        <input type="file" name="image"><br><br>

        <input type="submit" name="submit" value="Submit">
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

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>
</html>
