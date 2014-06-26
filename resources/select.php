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
		mname 					MiddleName 							middlename
		lname 					LastName 							lastname
		dbirth 					DayBirth 							daybirth
		mbirth 					MonthBirth 							monthbirth
		ybirth 					YearBirth 							yearbirth
		gender 					Gender 								gender
		age 					AgeCheck 							agecheck
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

