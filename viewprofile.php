<?php
  session_start();

  // If the session vars aren't set, try to set them with a cookie
  if (!isset($_SESSION['user_id'])) {
    if (isset($_COOKIE['user_id']) && isset($_COOKIE['username'])) {
      $_SESSION['user_id'] = $_COOKIE['user_id'];
      $_SESSION['username'] = $_COOKIE['username'];
    }
  }
?>

<!DOCTYPE html>
<html>
<head>
  <title>Startupwala - View Profile</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
  <h3>Startupwala - View Profile</h3>

<?php
    require_once('heroku_postgres_database.php');

  // Make sure the user is logged in before going any further.
  if (!isset($_SESSION['user_id'])) {
    echo '<p class="login">Please <a href="login.php">log in</a> to access this page.</p>';
    exit();
  }
  else {
    echo('<p class="login">You are logged in as ' . $_SESSION['username'] . '. <a href="logout.php">Log out</a>.</p>');
  }

  // Connect to the database
$herokupostgrsdatabse = new HerokuPostgresDatabase();

  // Grab the profile data from the database
  if (!isset($_GET['user_id'])) {
    $query = "SELECT  first_name, last_name, phone, city, looking_for, email FROM registered_users WHERE user_id = '" . $_SESSION['user_id'] . "'";
  }
  else {
    $query = "SELECT  first_name, last_name, phone, city, looking_for, email FROM registered_users WHERE user_id = '" . $_GET['user_id'] . "'";
  }
  $data = $herokupostgrsdatabse->query($query);

  if (pg_num_rows($data) == 1) { 
    // The user row was found so display the user data
    $row = $herokupostgrsdatabse->fetch_array($data);
    echo '<table>';
    if (!empty($row['first_name'])) {
      echo '<tr><td class="label">first_name:</td><td>' . $row['first_name'] . '</td></tr>';
    }
    if (!empty($row['last_name'])) {
      echo '<tr><td class="label">last_name:</td><td>' . $row['last_name'] . '</td></tr>';
    }
    if (!empty($row['phone'])) {
      echo '<tr><td class="label">phone:</td><td>' . $row['phone'] . '</td></tr>';
    }
   
      echo '</td></tr>';
    }
   
 
   // End of check for a single row of user results
  else {
    echo '<p class="error">There was a problem accessing your profile.</p>';
  }


?>
</body> 
</html>
