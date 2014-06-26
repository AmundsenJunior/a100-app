<?php
include "cred_int.php";

$con = mysqli_connect(DB_HOST,DB_USERNAME, DB_PASSWORD, DB_DATABASE);
if(mysqli_connect_errno()){
	echo "Failed to connect to MySQL: ".mysqli_connect_error();
}

$firstName = mysqli_real_escape_string($con, $_POST['fName']);
$lastName = mysqli_real_escape_string($con, $_POST['lName']);
$email = mysqli_real_escape_string($con, $_POST['email']);
$password = mysqli_real_escape_string($con, $_POST['password']);

//assumes email is unique, deletes all entries with matching emails
//mysqli_query($con, "DELETE FROM Apprentices2 Where email='$email' /*AND password='$password'*/");

if($_POST['submit'])
{
	$status = 1;
}elseif($_POST['save'])
{
	$status = 0;
}
$sql = "UPDATE Apprentices2
		SET fName = '$firstName',
			lName = '$lastName',
			email = '$email',
			password = '$password',
			status = '$status'
		WHERE email = '$email'";

/*
$sql = "INSERT INTO Apprentices2 (fName, lName, email, password, status) 
VALUES('$firstName', '$lastName', '$email', '$password', '$status')";
*/

if(!mysqli_query($con,$sql)){
	die('Error: '.mysqli_error($con));
}else{
	echo "1 record added\n";
	echo "<a href='../index.php'>Click Back</a>";
}

mysql_close($con);
?>