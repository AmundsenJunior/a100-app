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
	first_name VARCHAR(30), 
	last_name VARCHAR(30),
	email VARCHAR(50) NOT NULL,
	password VARCHAR(50) NOT NULL
	)",
	"CREATE TABLE IF NOT EXISTS applications(
	application_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	applicant_id INT UNSIGNED NOT NULL REFERENCES applicants(applicant_id),
	identity_id INT UNSIGNED NOT NULL REFERENCES identity(identity_id),
	cohort_name varchar(150) NOT NULL,
	referral_id INT UNSIGNED NOT NULL REFERENCES referrals(referral_id),
	schedule_id INT UNSIGNED NOT NULL REFERENCES schedules(schedule_id),
	experience_id INT UNSIGNED NOT NULL REFERENCES experiences(experience_id),
	material_id INT UNSIGNED NOT NULL REFERENCES materials(material_id),
	is_complete BIT NOT NULL,
	submit_timestamp TIMESTAMP NOT NULL
	)",
	"CREATE TABLE IF NOT EXISTS applicants(
	applicant_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	school_id VARCHAR(150),
	major VARCHAR(50),
	graduation_date VARCHAR(30),
	street_address VARCHAR(100),
	city VARCHAR(50),
	state VARCHAR(20),
	zipcode CHAR(10),
	phone_number VARCHAR(15),
	linkedin VARCHAR(50),
	portfolio VARCHAR (50),
	age_check INT UNSIGNED,
	legal_status INT UNSIGNED
	)",
	"CREATE TABLE IF NOT EXISTS referrals(
	referral_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	referral_1 INT UNSIGNED,
	referral_2 INT UNSIGNED,
	referral_3 INT UNSIGNED,
	referral_4 INT UNSIGNED,
	referral_5 INT UNSIGNED,
	referral_6 INT UNSIGNED,
	referral_7 INT UNSIGNED,
	referral_8 VARCHAR(100),
	referral_9 VARCHAR(100),
	referral_10 INT UNSIGNED,
	referral_11 VARCHAR(100)
	)",
	"CREATE TABLE IF NOT EXISTS schedules(
	schedule_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	weekly_hours TINYINT UNSIGNED,
	commitments TEXT
	)",
	"CREATE TABLE IF NOT EXISTS experiences(
	experience_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	programming_option INT UNSIGNED,
	work_option INT UNSIGNED,
	job_title VARCHAR(100),
	front_end_experience TEXT,
	lamp_stack_experience TEXT,
	mobile_experience TEXT,
	cms_experience TEXT,
	other_experience TEXT
	)",
	"CREATE TABLE IF NOT EXISTS materials(
	material_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	resume BLOB,
	cover_letter BLOB,
	reference_list TEXT,
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