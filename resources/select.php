<?php

	// select.php Script to execute from index.php to view the contents of test_db.Apprentices2

	include "cred_int.php";

	//Create connection
	$appCon = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_APP_DATABASE);
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

		$applicationSql="SELECT * FROM applications   
		INNER JOIN applicants ON applications.applicant_id=applicants.applicant_id 
		INNER JOIN identity ON applications.identity_id=identity.identity_id
		INNER JOIN referrals ON applications.referral_id=referrals.referral_id
		INNER JOIN schedules ON applications.schedule_id=schedules.schedule_id
		INNER JOIN experiences ON applications.experience_id=experiences.experience_id
		INNER JOIN materials ON applications.material_id=materials.material_id";
	$result = mysqli_query($appCon, $applicationSql);
	echo "<table border='1'><tr>";
	$fieldArray=array();
	while($applicationField = mysqli_fetch_field($result))
	{
		$fName = $applicationField->name;
		array_push($fieldArray, $fName);
		echo "<th>".$fName."</th>";
	}
	echo "</tr>";

	while($row = mysqli_fetch_array($result)) {
		echo "<tr>";
		foreach($fieldArray as $val){
			$content = $row[$val];
			echo "<td>" . $content . "</td>";
		}
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

