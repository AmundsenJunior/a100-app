<?php

	// select.php Script to execute from index.php to view the contents of test_db.Apprentices2

	include "cred_int.php";

	//Create connection
	$con = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
	// Check connection
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	/*
		HTML form variable 		MySQL test_db.Apprentices2 field 	PHP variable
		fname 					FirstName 							firstname
		lname 					LastName 							lastname
		email   				Email 								email
		password 				Password 							password
		status 					status 								status
	*/


	

	/*if(!empty($_GET['email'])){// If just the applicant login, return his own application data.

	  			//get the number of mistake
	  	$email=$_GET['email'];
	  	$result = mysqli_query($con, "SELECT * FROM Apprentices2 where email='$email'");		
	  	echo '<p><a href="../index.php">Click here to go to gateway</a></p>';
	  	// echo "<p><a href=\"update_applicant.php\">Click here to go to update_page</a></p>";
	 }else{
	 	$result = mysqli_query($con, "SELECT * FROM Apprentices2");
	 }
*/
	$result = mysqli_query($con, "SELECT * FROM Apprentices2");

	echo "<table border='1'>
	<tr>
	<th>PID</th>
	<th>First Name</th>
	<th>Last Name</th>
	<th>Email</th>
	<th>Password</th>
	<th>status</th>
	</tr>";

	while($row = mysqli_fetch_array($result)) {
		echo "<tr>";
		echo "<td>" . $row['PID'] . "</td>";
		echo "<td>" . $row['fName'] . "</td>";
		echo "<td>" . $row['lName'] . "</td>";
		echo "<td>" . $row['email'] . "</td>";
		echo "<td>" . $row['password'] . "</td>";
		// echo "<td> Not visible </td>";// Password is not visible.
			if($row['status']==0){
			echo"<td>incomplete</td>";
			}elseif($row['status']==1){
				echo "<td>complete</td>";
			}
		echo "</tr>";
	}

	echo "</table>";

	mysqli_close($con);

?>

