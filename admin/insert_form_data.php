<?php

include "cred_ext.php";

//build connection
$con = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_FORM_DATABASE);

//test connection
if(mysqli_connect_errno()){
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$sql = array(
	"INSERT INTO `forms_db`.`cohorts` (`cohort_id`, `cohort_name`, `cohort_decription`, `is_active`) VALUES 
		(NULL, 'Cohort 0 - Fall 2013', NULL, b'1'), (NULL, 'Cohort 1 - Winter 2013/2014', NULL, b'1'), 
		(NULL, 'Cohort 2 - Spring 2014', NULL, b'1'), (NULL, 'Cohort 3 - Summer 2014', NULL, b'1'), 
		(NULL, 'Cohort 4 - Fall 2014', NULL, b'1'), (NULL, 'Cohort 5 - Winter 2014/2015', NULL, b'1'), 
		(NULL, 'Cohort 6 - Spring 2015', NULL, b'1'), (NULL, 'Cohort 7 - Summer 2015', NULL, b'1'), 
		(NULL, 'Cohort 8 - Fall 2015', NULL, b'1'), (NULL, 'Cohort 9 - Winter 2015/2016', NULL, b'1')
		",
	"INSERT INTO `forms_db`.`schools` (`school_id`, `school_name`, `is_active`) VALUES 
		(NULL, 'Southern Connecticut State University', b'1'), 
		(NULL, 'University of New Haven', b'1'), 
		(NULL, 'Yale University', b'1'), 
		(NULL, 'Quinnipiac University', b'1'), 
		(NULL, 'University of Connecticut', b'1')
		",
	"INSERT INTO `forms_db`.`sections` (`section_id`, `section_name`, `section_description`, `arrange`, `is_active`) VALUES 
		(NULL, 'Identity', NULL, '1', b'1'), 
		(NULL, 'Personal Details', '2', b'1'), 
		(NULL, 'Schedule Information', NULL, '3', b'1'), 
		(NULL, 'Technical Experience', NULL, '4', b'1'), 
		(NULL, 'Supplemental Materials', 'We ask for a resume, cover letter, and references from at least 2 people who can attest to your suitability to work as a software developer. If you don''t yet have a resume or cover letter, feel free to submit without them for now, but make sure to complete your application by e-mailing them to krishna@indie-soft.com within TWO days of your submission.', '5', b'1')
		",
	"INSERT INTO `forms_db`.`states` (`state_id`, `state_name`) VALUES 
		(NULL, 'Alabama'), 
		(NULL, 'Alaska'), 
		(NULL, 'Arizona'), 
		(NULL, 'Arkansas'), 
		(NULL, 'California'), 
		(NULL, 'Colorado'), 
		(NULL, 'Connecticut'), 
		(NULL, 'Delaware'), 
		(NULL, 'District of Columbia'), 
		(NULL, 'Florida'), 
		(NULL, 'Georgia'), 
		(NULL, 'Hawaii'), 
		(NULL, 'Idaho'), 
		(NULL, 'Illinois'), 
		(NULL, 'Indiana'), 
		(NULL, 'Iowa'), 
		(NULL, 'Kansas'), 
		(NULL, 'Kentucky'), 
		(NULL, 'Louisiana'), 
		(NULL, 'Maine'), 
		(NULL, 'Maryland'), 
		(NULL, 'Massachusetts'), 
		(NULL, 'Michigan'), 
		(NULL, 'Minnesota'), 
		(NULL, 'Mississippi'), 
		(NULL, 'Missouri'), 
		(NULL, 'Montana'), 
		(NULL, 'Nebraska'), 
		(NULL, 'Nevada'), 
		(NULL, 'New Hampshire'), 
		(NULL, 'New Jersey'), 
		(NULL, 'New Mexico'), 
		(NULL, 'New York'), 
		(NULL, 'North Carolina'), 
		(NULL, 'North Dakota'), 
		(NULL, 'Ohio'), 
		(NULL, 'Oklahoma'), 
		(NULL, 'Oregon'), 
		(NULL, 'Pennsylvania'), 
		(NULL, 'Rhode Island'), 
		(NULL, 'South Carolina'), 
		(NULL, 'South Dakota'), 
		(NULL, 'Tennessee'), 
		(NULL, 'Texas'), 
		(NULL, 'Utah'), 
		(NULL, 'Vermont'), 
		(NULL, 'Virginia'), 
		(NULL, 'Washington'), 
		(NULL, 'West Virginia'), 
		(NULL, 'Wisconsin'), 
		(NULL, 'Wyoming')
		",
	"INSERT INTO `forms_db`.`fields` (`field_id`, `field_name`, `field_description`, `pre_text`, `inside_text`, `post_text`, `section_id`, `arrange`, `options_target`, `is_required`, `is_active`) VALUES 
		(NULL, 'first_name', NULL, 'Name', NULL, 'First Name', '1', '1', NULL, b'1', b'1'), 
		(NULL, 'last_name', NULL, NULL, NULL, 'Last Name', '1', '2', NULL, b'1', b'1'), 
		(NULL, 'email', NULL, 'Email', 'Use the email address you check most frequently, as this will be how we notify you of acceptance into the program.', NULL, '1', '3', NULL, b'1', b'1'), 
		(NULL, 'password', NULL, 'Password', NULL, NULL, '1', '4', NULL, b'1', b'1'), 
		(NULL, 'school_id', NULL, 'Please list your most recent educational institution, your major, and the date of your graduation (or anticipated graduation).', 'Select School', 'School', '2', '1', 'schools', b'1', b'1'), 
		(NULL, 'major', NULL, NULL, NULL, 'Major', '2', '2', NULL, b'1', b'1'), 
		(NULL, 'graduation_date', NULL, NULL, '[Month], [Year]', 'Graduation Date', '2', '3', NULL, b'1', b'1'), 
		(NULL, 'cohort_id', NULL, 'What cohort are you applying for?', 'Select Cohort', 'The training period will last ~2 months and you will be expected to meet at least twice per week. You will be eligible for paid internships with our Partner Companies immediately afterward. (NOTE: Cohort 2 is already in progress for the 2014 year)', '2', '4', 'cohorts', b'1', b'1'), 
		(NULL, 'street_address', NULL, 'Address', NULL, NULL, '2', '5', NULL, b'1', b'1'), 
		(NULL, 'city', NULL, NULL, NULL, 'City', '2', '6', NULL, b'1', b'1'), 
		(NULL, 'state', NULL, NULL, NULL, 'State', '2', '7', 'states', b'1', b'1'), 
		(NULL, 'zipcode', NULL, NULL, NULL, 'Zip Code', '2', '8', NULL, b'1', b'1'), 
		(NULL, 'phone_number', NULL, 'Mobile Phone', '(###) ###-####', NULL, '2', '9', NULL, b'1', b'1'), 
		(NULL, 'linkedin', NULL, 'LinkedIn Profile', 'No LinkedIn profile? Write NONE', NULL, '2', '10', NULL, b'1', b'1'), 
		(NULL, 'portfolio', NULL, 'Link to Online Portfolio of your work (e.g., GitHub, Bitbucket, Gitorious) or personal Website', 'No online portfolio? Write NONE', NULL, '2', '11', NULL, b'1', b'1'), 
		(NULL, 'age_check', NULL, 'Are you 18 or older?', NULL, NULL, '2', '12', 'question_options', b'1', b'1'), 
		(NULL, 'legal_status', NULL, 'I certify that I am a U.S. citizen, permanent resident, or a foreign national with authorization to work in the United States.', NULL, 'IMPORTANT: If you are a foreign student on an F-1 Visa or other student visa, please note it in the ADDITIONAL INFORMATION section at the bottom of the page. We are eager to work with international students on student visas of all types. Depending on your status, we can help counsel you on your pathway to an H1-B or similar visa type.', '2', '13', 'question_options', b'1', b'1'), 
		(NULL, 'referral_id', NULL, 'How did you find out about this program?', NULL, NULL, '2', '14', 'question_options', b'1', b'1'), 
		(NULL, 'weekly_hours', NULL, 'How many hours per week can you devote to A100 trainings and homework?', 'We expect at least a 10 hour per week commitment.', NULL, '3', '1', NULL, b'1', b'1'), 
		(NULL, 'commitments', NULL, 'What are all of your unchangeable time commitments? Please include any classes you are taking, work schedules, vacations you plan to take, and important personal commitments, including both weekdays and WEEKENDS.', NULL, NULL, '3', '2', NULL, b'1', b'1'), 
		(NULL, 'programming_option', NULL, 'How much programming experience do you have?', NULL, NULL, '4', '1', 'question_options', b'1', b'1'), 
		(NULL, 'work_option', NULL, 'How much work experience do you have?', NULL, NULL, '4', '2', 'question_options', b'1', b'1'), 
		(NULL, 'job_title', NULL, 'What was your last job title (or current, if you are still working there), and where?', NULL, NULL, '4', '3', NULL, b'0', b'1'), 
		(NULL, 'front_end_experience', NULL, 'Explain your experience with front-end languages (HTML/CSS/JavaScript).', NULL, NULL, '4', '4', NULL, b'1', b'1'), 
		(NULL, 'lamp_stack_experience', NULL, 'What is your experience relating to the LAMP (Linux, Apache, MySQL, PHP) application stack?', NULL, NULL, '4', '5', NULL, b'1', b'1'), 
		(NULL, 'mobile_experience', NULL, 'Explain your experience with mobile app development (Android, iOS, Windows Mobile).', NULL, NULL, '4', '6', NULL, b'1', b'1'), 
		(NULL, 'other_experience', NULL, 'Other Relevant Experience', NULL, NULL, '4', '7', NULL, b'0', b'1'), 
		(NULL, 'resume', NULL, 'Upload your resume with this filename format FIRSTNAME LASTNAME RESUME', NULL, 'We prefer PDF, ODF, or DOC.', '5', '1', 'file', b'0', b'1'), 
		(NULL, 'cover_letter', NULL, 'Upload a cover letter (250 words maximum) with this filename format: FIRSTNAME LASTNAME COVER LETTER', NULL, 'Your cover letter should address why you are applying for the A100 Program, why you would be a good candidate, and what got you interested in startups.', '5', '2', 'file', b'0', b'1'), 
		(NULL, 'reference_list', NULL, 'References', '(Example: Professor Jim Honeycutt, University of Northern Connecticut, honeycutt.j@unct.edu)', 'Please list the names of two people who can speak about your knowledge, experience, abilities, or skills. If you want a professor to be able to vouch for you, you must list them here, or by law, they cannot speak on your behalf.', '5', '3', NULL, b'1', b'1'), 
		(NULL, 'additional_info', NULL, 'Additional Information', NULL, 'Any other information you would like to include that you think might be helpful in considering your application', '5', '4', NULL, b'0', b'1')
		",
	"INSERT INTO `forms_db`.`question_options` (`q_option_id`, `field_id`, `option_name`, `option_description`, `input_type`, `arrange`, `is_active`) VALUES 
		(NULL, '16', 'Yes', NULL, 'radio', '1', b'1'), 
		(NULL, '16', 'No', NULL, 'radio', '2', b'1'), 
		(NULL, '17', 'Yes', NULL, 'radio', '1', b'1'), 
		(NULL, '17', 'No', NULL, 'radio', '2', b'1'), 
		(NULL, '18', 'A100 Promo Video from Vimeo', NULL, 'check', '1', b'1'), 
		(NULL, '18', 'A100 Program Manager', NULL, 'check', '2', b'1'), 
		(NULL, '18', 'Career Fair', NULL, 'check', '3', b'1'), 
		(NULL, '18', 'Information Session', NULL, 'check', '4', b'1'), 
		(NULL, '18', 'Radio/TV Ad', NULL, 'check', '5', b'1'), 
		(NULL, '18', 'Search Engine', NULL, 'check', '6', b'1'), 
		(NULL, '18', 'On-Campus Flyer', NULL, 'check', '7', b'1'), 
		(NULL, '18', 'Fellow Student', NULL, '', '8', b'1'), 
		(NULL, '18', 'Professor/Teacher at my University/School', NULL, '', '9', b'1'), 
		(NULL, '18', 'Member of the Independent Software Team', NULL, 'check', '10', b'1'), 
		(NULL, '18', 'Other:', NULL, '', '11', b'1'), 
		(NULL, '21', 'None', NULL, 'radio', '1', b'1'), 
		(NULL, '21', 'I have taken >2 courses that use the same programming language.', NULL, 'radio', '2', b'1'), 
		(NULL, '21', 'I have built several projects on my own time, not for school.', NULL, 'radio', '3', b'1'), 
		(NULL, '21', 'I have little formal training in programming, but have taught myself the essentials and have worked on personal projects.', NULL, 'radio', '4', b'1'), 
		(NULL, '22', 'None', NULL, 'radio', '1', b'1'), 
		(NULL, '22', 'At least one full-time job in an office setting.', NULL, 'radio', '2', b'1'), 
		(NULL, '22', 'At least one part-time job in an office setting.', NULL, 'radio', '3', b'1'), 
		(NULL, '22', 'At least one part-time job of any other kind (retail, Starbucks, construction, etc.).', NULL, 'radio', '4', b'1')
		"
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