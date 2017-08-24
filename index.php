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
  <title>Welcome to Startupwala</title>
</head>
<body>
  <h3>Welcome to Startupwala!</h3>

<?php
 
  // Generate the navigation menu
  if (isset($_SESSION['username'])) {
  	echo '&#10084; <a href="editprofile.php">Edit Profile</a><br />';
    echo '&#10084; <a href="logout.php">Log Out (' . $_SESSION['username'] . ')</a>';
    echo '&#10084; <a href="viewprofile.php">View Profile</a><br />';
    
  }
  else {
    echo '&#10084; <a href="login.php">Log In</a><br />';
    echo '&#10084; <a href="signup.php">Sign Up</a>';
  }


?>

</body> 
</html>
