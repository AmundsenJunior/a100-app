<?php

include "cred_ext.php";

//build connection
$con = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_FORM_DATABASE);

//test connection
if(mysqli_connect_errno()){
	echo "Failed to connect to MySQL: ".mysqli_connect_error();
}

$sql = array(
	"CREATE TABLE IF NOT EXISTS fields(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	field_name VARCHAR(50) NOT NULL,
	field_description TEXT,
	pre_text TEXT,
	inside_text TINYTEXT,
	post_text TEXT,
	section_id INT UNSIGNED NOT NULL REFERENCES sections(id),
	arrange TINYINT UNSIGNED NOT NULL,
	is_dependent BIT NOT NULL,
	parent_field_id INT UNSIGNED NOT NULL REFERENCES id,
	is_required BIT NOT NULL,
	is_active BIT NOT NULL
	)",
	"CREATE TABLE IF NOT EXISTS sections(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	section_name VARCHAR(50) NOT NULL,
	arrange TINYINT UNSIGNED NOT NULL,
	is_active BIT NOT NULL
	)",
	"CREATE TABLE IF NOT EXISTS schools(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	school_name VARCHAR(50) NOT NULL,
	is_active BIT NOT NULL
	)",
	"CREATE TABLE IF NOT EXISTS cohorts(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	cohort_name VARCHAR(50) NOT NULL,
	cohort_decription TEXT,
	is_active BIT NOT NULL
	)",
	"CREATE TABLE IF NOT EXISTS referrals(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	option_name VARCHAR(50) NOT NULL,
	option_description TEXT,
	arrange TINYINT UNSIGNED NOT NULL,
	is_active BIT NOT NULL
	)",
	"CREATE TABLE IF NOT EXISTS programming_experience(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	level_name VARCHAR(50) NOT NULL,
	level_description TEXT,
	arrange TINYINT UNSIGNED NOT NULL,
	is_active BIT NOT NULL
	)",
	"CREATE TABLE IF NOT EXISTS work_experience(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	level_name VARCHAR(50) NOT NULL,
	level_description TEXT,
	arrange TINYINT UNSIGNED NOT NULL,
	is_active BIT NOT NULL
	)"
	);


	foreach ($sql as $stmt) {
		if (mysqli_query($con, $stmt)){
			echo "Table created successfully. \n";
		}else{
			echo "Error executing: " . $stmt . "\nError produced: " . mysqli_error($con) . "\n";
		}
	}

//cut connection
mysqli_close($con);

?>