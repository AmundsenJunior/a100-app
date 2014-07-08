<?php

include "cred_ext.php";

//build connection
$con = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_APP_DATABASE);

//test connection
if(mysqli_connect_errno()){
	echo "Failed to connect to MySQL: ".mysqli_connect_error();
}

$sql = array(
	"CREATE TABLE IF NOT EXISTS identity(
	identity_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	first_name VARCHAR(30) NOT NULL, 
	last_name VARCHAR(30) NOT NULL,
	email VARCHAR(50) NOT NULL,
	password VARCHAR(50) NOT NULL
	)",
	"CREATE TABLE IF NOT EXISTS applications(
	application_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	applicant_id INT UNSIGNED NOT NULL REFERENCES applicants(applicant_id),
	cohort_id INT UNSIGNED NOT NULL REFERENCES `forms_db`.cohorts(cohort_id),
	referral_id INT UNSIGNED NOT NULL REFERENCES referrals(referral_id),
	schedule_id INT UNSIGNED NOT NULL REFERENCES schedules(schedule_id),
	experience_id INT UNSIGNED NOT NULL REFERENCES experiences(experience_id),
	material_id INT UNSIGNED NOT NULL REFERENCES materials(material_id),
	is_complete BIT NOT NULL,
	submit_timestamp TIMESTAMP NOT NULL
	)",
	"CREATE TABLE IF NOT EXISTS applicants(
	applicant_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	identity_id INT UNSIGNED NOT NULL REFERENCES identity(identity_id),
	school_id INT UNSIGNED NOT NULL REFERENCES `forms_db`.schools(school_id),
	major VARCHAR(50),
	graduation_date VARCHAR(30),
	street_address VARCHAR(100) NOT NULL,
	city VARCHAR(50) NOT NULL,
	state VARCHAR(20) NOT NULL,
	zipcode CHAR(5) NOT NULL,
	phone_number VARCHAR(15) NOT NULL,
	linkedin VARCHAR(50) NOT NULL,
	portfolio VARCHAR (50) NOT NULL,
	age_check BIT NOT NULL,
	legal_status BIT NOT NULL
	)",
	"CREATE TABLE IF NOT EXISTS referrals(
	referral_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	option_1 BIT,
	option_2 BIT,
	option_3 BIT,
	option_4 BIT,
	option_5 BIT,
	option_6 BIT,
	option_7 BIT,
	option_8 VARCHAR(100),
	option_9 VARCHAR(100),
	option_10 BIT,
	option_11 VARCHAR(100)
	)",
	"CREATE TABLE IF NOT EXISTS schedules(
	schedule_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	weekly_hours TINYINT UNSIGNED NOT NULL,
	commitments TEXT NOT NULL
	)",
	"CREATE TABLE IF NOT EXISTS experiences(
	experience_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	programming_option VARCHAR(100) NOT NULL,
	work_option VARCHAR(100) NOT NULL,
	job_title VARCHAR(100),
	front_end_experience TEXT,
	lamp_stack_experience TEXT,
	mobile_experience TEXT,
	cms_experience TEXT,
	other_experience TEXT
	)",
	"CREATE TABLE IF NOT EXISTS materials(
	material_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	resume BLOB NOT NULL,
	cover_letter BLOB NOT NULL,
	reference_list TEXT NOT NULL,
	additional_info TEXT
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