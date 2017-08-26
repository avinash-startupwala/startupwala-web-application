<?php
  error_reporting(E_ALL);
    ini_set('display_errors', 1);
echo "<h1>WELCOME TO STARTUPWALA</h1> \n";
echo "<br>";
echo "<br>";

  session_start();

  // If the session vars aren't set, try to set them with a cookie
  if (!isset($_SESSION['user_id'])) {
    if (isset($_COOKIE['user_id']) && isset($_COOKIE['username'])) {
      $_SESSION['user_id'] = $_COOKIE['user_id'];
      $_SESSION['username'] = $_COOKIE['username'];
    }
  }
  // Generate the navigation menu
  if (isset($_SESSION['username'])) {
    echo "\n";
    echo '&#10084; <a href="viewprofile.php">View Profile</a><br />';
    echo '&#10084; <a href="editprofile.php">Edit Profile</a><br />';
    echo '&#10084; <a href="logout.php">Log Out (' . $_SESSION['username'] . ')</a>';
  }
  else {
    echo '&#10084; <a href="https://startupwala.herokuapp.com/login.php">Log In</a><br />';
    echo '&#10084; <a href="https://startupwala.herokuapp.com/signup.php">Sign Up</a><br />';

  }
?>
