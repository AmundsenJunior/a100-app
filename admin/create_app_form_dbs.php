<?php
	include "cred_ext.php";

	//build connection to DB
	$con = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD);

	//verify connection
	if(mysqli_connect_errno()){
		echo "Failed to connect to MySQL:" . mysqli_connect_error();
	}

	// Create database
	$db_names = array("applications_db", "forms_db");

	foreach ($db_names as $db_name) {
		$sql = "CREATE DATABASE " . $db_name;
		if (mysqli_query($con, $sql)){
			echo "Database created successfully. \n";
		}else{
			echo "Error executing: " . $sql . "\nError produced: " . mysqli_error($con);
		}
	}

	// Application form DB user
	$appUserSql = "GRANT SELECT, INSERT, UPDATE ON *.* TO 'applicant'@'localhost' 
		IDENTIFIED BY PASSWORD '*71E5FEBADB96F17037F4F3431EA2C7FA1E417599'";
	// Admin DB user
	$adminUserSql = "GRANT SELECT, INSERT, UPDATE, CREATE, FILE, ALTER ON *.* TO 'admin'@'localhost' 
		IDENTIFIED BY PASSWORD '*4ACFE3202A5FF5CF467898FC58AAB1D615029441'";
	
	// Create users in MySQL
	$usersSql = array($appUserSql, $adminUserSql);
	
	foreach ($usersSql as $user) {
		if (mysqli_query($con, $user)){
			echo "User created successfully.\n";
		}else{
			echo "Error executing: " . $user . "\nError produced: " . mysqli_error($con);
		}
	}

	// Close DB connection
	mysqli_close($con);

?>