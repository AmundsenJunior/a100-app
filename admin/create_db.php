<?php
DEFINE('DB_USERNAME', 'root');
DEFINE('DB_PASSWORD', 'root');
DEFINE('DB_HOST', 'localhost:3306');

//build connection to DB
$con = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD);

//verify connection
if(mysqli_connect_errno()){
	echo "Failed to connect to MySQL:".mysqli_connect_error();
}

$sql = "CREATE DATABASE test_db";
if(
	mysqli_query($con,$sql)
	){
	echo "Database test_db created successfully. \n";
}else{
	echo "Error creating database: ".mysqli_error($con);
}
mysqli_close($con);
?>