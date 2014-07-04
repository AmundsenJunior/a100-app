<?php
include "cred_int.php";

$con = mysqli_connect(DB_HOST,DB_USERNAME, DB_PASSWORD, DB_DATABASE);
if(mysqli_connect_errno()){
	echo "Failed to connect to MySQL: ".mysqli_connect_error();
}
/*if (!$testtable=mysqli_query("desc Apprentices2")) {
	# code...
	// echo "testtable=".$testtable."end";
	include "create_table.php";
}*/
$firstName = mysqli_real_escape_string($con, $_POST['fName']);
$lastName = mysqli_real_escape_string($con, $_POST['lName']);
$email = mysqli_real_escape_string($con, $_POST['email']);
$password = mysqli_real_escape_string($con, $_POST['password']);


$sqlDup = "SELECT * FROM Apprentices2 Where email='$email' /*AND password='$password'*/";  //commented out section implements addition password security if needed
$dup = mysqli_query($con, $sqlDup);  //sql runs sql code and gets possible duplicates
$dupCount = mysqli_num_rows($dup);  //counts total duplicate values
echo "results: ".$dupCount;

if($_POST['submit'])
{
	$status = 1;
}elseif($_POST['save'])
{
	$status = 0;
}


if($dupCount>0){
	echo "A user with this email address and password has already enrolled";
}else{
$sql = "INSERT INTO Apprentices2 (fName, lName, email, password, status) 
VALUES('$firstName', '$lastName', '$email', sha1('$password'), '$status')";



if(!mysqli_query($con,$sql)){
	die('Error: '.mysqli_error($con));
}else{
	echo "1 record added<br>";
	echo "<a href='../index.php'>Click Back</a>";
}

}

mysql_close($con);
?>