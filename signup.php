<!DOCTYPE html>
</html>
<head>
  <title>Startupwala - Sign Up</title>
</head>
<body>
  <h3>Startupwala - Sign Up</h3>

<?php
  require_once('heroku_postgres_database.php');


  // Connect to the database
$herokupostgrsdatabse = new HerokuPostgresDatabase();

  if (isset($_POST['submit'])) {
    // Grab the profile data from the POST
    $username = $herokupostgrsdatabse->escape_value(trim($_POST['username']));
    $password1 = $herokupostgrsdatabse->escape_value(trim($_POST['password1']));
    $password2 = $herokupostgrsdatabse->escape_value(trim($_POST['password2']));

    if (!empty($username) && !empty($password1) && !empty($password2) && ($password1 == $password2)) {
      // Make sure someone isn't already registered using this username
      $query = "SELECT * FROM registered_users WHERE email = '$username'";
      $data = $herokupostgrsdatabse->query($query);
      if (pg_num_rows($data) == 0) {
        // The username is unique, so insert the data into the database
        $query = "INSERT INTO registered_users (email, password) VALUES ('$username', '$password1')";
        $herokupostgrsdatabse->query($query);

        // Confirm success with the user
        echo '<p>Your new account has been successfully created. You\'re now ready to <a href="login.php">log in</a>.</p>';

       
        exit();
      }
      else {
        // An account already exists for this username, so display an error message
        echo '<p class="error">An account already exists for this username. Please use a different address.</p>';
        $username = "";
      }
    }
    else {
      echo '<p class="error">You must enter all of the sign-up data, including the desired password twice.</p>';
    }
  }


?>

  <p>Please enter your username and desired password to sign up to Mismatch.</p>
  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <fieldset>
      <legend>Registration Info</legend>
      <label for="username">Username:</label>
      <input type="text" id="username" name="username" value="<?php if (!empty($username)) echo $username; ?>" /><br />
      <label for="password1">Password:</label>
      <input type="password" id="password1" name="password1" /><br />
      <label for="password2">Password (retype):</label>
      <input type="password" id="password2" name="password2" /><br />
    </fieldset>
    <input type="submit" value="Sign Up" name="submit" />
  </form>
</body> 
</html>
