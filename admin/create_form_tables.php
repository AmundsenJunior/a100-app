<?php

include "cred_ext.php";

//build connection
$con = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_FORM_DATABASE);

//test connection
if(mysqli_connect_errno()){
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$sql = array(
	"CREATE TABLE IF NOT EXISTS fields(
	field_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	field_name VARCHAR(50) NOT NULL,
	field_description TEXT,
	pre_text TEXT,
	inside_text TEXT,
	post_text TEXT,
	section_id INT UNSIGNED NOT NULL REFERENCES sections(section_id),
	inner_arrange TINYINT UNSIGNED NOT NULL,
	options_target VARCHAR(30),
	is_required BOOLEAN NOT NULL,
	field_is_active BOOLEAN NOT NULL,
	response_target VARCHAR(30) NOT NULL
	)",
	"CREATE TABLE IF NOT EXISTS sections(
	section_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	section_name VARCHAR(50) NOT NULL,
	section_description TEXT,
	arrange TINYINT UNSIGNED NOT NULL,
	section_is_active BOOLEAN NOT NULL
	)",
	"CREATE TABLE IF NOT EXISTS states(
	state_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(50) NOT NULL
	)",
	"CREATE TABLE IF NOT EXISTS schools(
	school_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(50) NOT NULL,
	school_is_active BOOLEAN NOT NULL
	)",
	"CREATE TABLE IF NOT EXISTS cohorts(
	cohort_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(50) NOT NULL,
	cohort_decription TEXT,
	cohort_is_active BOOLEAN NOT NULL
	)",
	"CREATE TABLE IF NOT EXISTS question_options(
	q_option_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	field_name VARCHAR(150) NOT NULL,
	option_name VARCHAR(150) NOT NULL,
	option_description TEXT,
	input_type VARCHAR(30),
	arrange TINYINT UNSIGNED NOT NULL,
	option_is_active BOOLEAN NOT NULL
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