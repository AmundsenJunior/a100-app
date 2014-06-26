<?php

include "cred_ext.php";

//build connection
$con = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

//test connection
if(mysqli_connect_errno()){
	echo "Failed to connect to MySQL: ".mysqli_connect_error();
}

$sql = "CREATE TABLE Apprentices2(
PID INT NOT NULL AUTO_INCREMENT,
PRIMARY KEY(PID),
fName CHAR(30), 
lName CHAR(30),
email CHAR(50),
password CHAR(50),
status INT(1)
	)";

if (mysqli_query($con,$sql)){
	echo "Table Apprentices2 in test_db created successfully. \n";
}else{
	echo "Error creating database: ".mysqli_error($con);
}

//cut connection
mysqli_close($con);

?>