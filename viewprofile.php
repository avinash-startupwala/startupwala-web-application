<?php
		
		
		
		$user = $_GET['q'];
		echo "WELCOME ".$user;
		echo "<br>";
		echo "";


			

	require_once("heroku_postgres_database.php");
	$herokupostgrsdatabse = new HerokuPostgresDatabase();

	$user_email = $herokupostgrsdatabse->escape_value(trim($user));

	$fetch_from_saleforce_contact=  "SELECT  first_name, last_name, email, phone,city, looking_for FROM registered_users WHERE email = '$user_email'";


  	  
  	$fetched_saleforce_data =  $herokupostgrsdatabse->query($fetch_from_saleforce_contact);

  	if(pg_num_rows($fetched_saleforce_data) < 1)
  	{

  			echo "<br>";
  		echo "<h2>Sorry No data available in salesforce with username {$user}</h2>";
  	}

			
	while( $row = pg_fetch_array($fetched_saleforce_data))
			   {

			   	 print "\n";


			   	 ?>
			   	 <pre>
			   	 <?php
			 		print_r($row);
			   	 ?>
			   	 </pre>
			   	 <?php


			   }

?>
