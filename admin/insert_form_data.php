<?php

include "cred_ext.php";

//build connection
$con = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_FORM_DATABASE);

//test connection
if(mysqli_connect_errno()){
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$sql = array(
	"INSERT INTO `forms_db`.`cohorts` (`cohort_id`, `name`, `cohort_decription`, `cohort_is_active`) VALUES 
		(NULL, 'Cohort 0 - Fall 2013', NULL, '0'), (NULL, 'Cohort 1 - Winter 2013/2014', NULL, '0'), 
		(NULL, 'Cohort 2 - Spring 2014', NULL, '0'), (NULL, 'Cohort 3 - Summer 2014', NULL, '1'), 
		(NULL, 'Cohort 4 - Fall 2014', NULL, '1'), (NULL, 'Cohort 5 - Winter 2014/2015', NULL, '1'), 
		(NULL, 'Cohort 6 - Spring 2015', NULL, '1'), (NULL, 'Cohort 7 - Summer 2015', NULL, '1'), 
		(NULL, 'Cohort 8 - Fall 2015', NULL, '1'), (NULL, 'Cohort 9 - Winter 2015/2016', NULL, '1')
		",
	"INSERT INTO `forms_db`.`schools` (`school_id`, `name`, `school_is_active`) VALUES 
		(NULL, 'Southern Connecticut State University', '1'), 
		(NULL, 'University of New Haven', '1'), 
		(NULL, 'Yale University', '1'), 
		(NULL, 'Quinnipiac University', '1'), 
		(NULL, 'University of Connecticut', '1')
		",
	"INSERT INTO `forms_db`.`sections` (`section_id`, `section_name`, `section_description`, `arrange`, `section_is_active`) VALUES 
		(NULL, 'Identity', NULL, '1', '1'), 
		(NULL, 'Personal Details', NULL, '2', '1'), 
		(NULL, 'Referrals', 'How did you find out about this program?', '3', '1'),
		(NULL, 'Schedule Information', NULL, '4', '1'), 
		(NULL, 'Technical Experience', NULL, '5', '1'), 
		(NULL, 'Supplemental Materials', 'We ask for a resume, cover letter, and references from at least 2 people who can attest to your suitability to work as a software developer. If you don''t yet have a resume or cover letter, feel free to submit without them for now, but make sure to complete your application by e-mailing them to krishna@indie-soft.com within TWO days of your submission.', '6', '1')
		",
	"INSERT INTO `forms_db`.`states` (`state_id`, `name`) VALUES 
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
	"INSERT INTO `forms_db`.`fields` (`field_id`, `field_name`, `field_description`, `pre_text`, `inside_text`, `post_text`, `section_id`, `inner_arrange`, `options_target`, `is_required`, `field_is_active`, `response_target`) VALUES 
		(NULL, 'first_name', NULL, 'Name', NULL, 'First Name', '1', '1', NULL, '1', '1', 'identity'), 
		(NULL, 'last_name', NULL, NULL, NULL, 'Last Name', '1', '1', NULL, '1', '1', 'identity'), 
		(NULL, 'email', NULL, 'Email', 'Use the email address you check most frequently, as this will be how we notify you of acceptance into the program.', NULL, '1', '3', NULL, '1', '1', 'identity'), 
		(NULL, 'password', NULL, 'Password', NULL, NULL, '1', '3', NULL, '1', '1', 'identity'), 
		(NULL, 'school_id', NULL, 'Please list your most recent educational institution, your major, and the date of your graduation (or anticipated graduation).', 'Select School', 'School', '2', '1', 'schools', '1', '1', 'applicants'), 
		(NULL, 'major', NULL, NULL, NULL, 'Major', '2', '1', NULL, '1', '1', 'applicants'), 
		(NULL, 'graduation_date', NULL, NULL, '[Month], [Year]', 'Graduation Date', '2', '1', NULL, '1', '1', 'applicants'), 
		(NULL, 'cohort_name', NULL, 'What cohort are you applying for?', 'Select Cohort', 'The training period will last ~2 months and you will be expected to meet at least twice per week. You will be eligible for paid internships with our Partner Companies immediately afterward. (NOTE: Cohort 2 is already in progress for the 2014 year)', '2', '4', 'cohorts', '1', '1', 'applications'), 
		(NULL, 'street_address', NULL, 'Address', NULL, 'Street Address', '2', '5', NULL, '1', '1', 'applicants'), 
		(NULL, 'city', NULL, NULL, NULL, 'City', '2', '6', NULL, '1', '1', 'applicants'), 
		(NULL, 'state', NULL, NULL, NULL, 'State', '2', '7', 'states', '1', '1', 'applicants'), 
		(NULL, 'zipcode', NULL, NULL, NULL, 'Zip Code', '2', '8', NULL, '1', '1', 'applicants'), 
		(NULL, 'phone_number', NULL, 'Mobile Phone', '(###) ###-####', NULL, '2', '9', NULL, '1', '1', 'applicants'), 
		(NULL, 'linkedin', NULL, 'LinkedIn Profile', 'No LinkedIn profile? Write NONE', NULL, '2', '10', NULL, '1', '1', 'applicants'), 
		(NULL, 'portfolio', NULL, 'Link to Online Portfolio of your work (e.g., GitHub, Bitbucket, Gitorious) or personal Website', 'No online portfolio? Write NONE', NULL, '2', '11', NULL, '1', '1', 'applicants'), 
		(NULL, 'age_check', NULL, 'Are you 18 or older?', NULL, NULL, '2', '12', 'question_options', '1', '1', 'applicants'), 
		(NULL, 'legal_status', NULL, 'I certify that I am a U.S. citizen, permanent resident, or a foreign national with authorization to work in the United States.', NULL, 'IMPORTANT: If you are a foreign student on an F-1 Visa or other student visa, please note it in the ADDITIONAL INFORMATION section at the bottom of the page. We are eager to work with international students on student visas of all types. Depending on your status, we can help counsel you on your pathway to an H1-B or similar visa type.', '2', '13', 'question_options', '1', '1', 'applicants'), 
		(NULL, 'referral_1', NULL, NULL, NULL, NULL, '3', '1', 'question_options', '0', '1', 'referrals'), 
		(NULL, 'referral_2', NULL, NULL, NULL, NULL, '3', '2', 'question_options', '0', '1', 'referrals'), 
		(NULL, 'referral_3', NULL, NULL, NULL, NULL, '3', '3', 'question_options', '0', '1', 'referrals'), 
		(NULL, 'referral_4', NULL, NULL, NULL, NULL, '3', '4', 'question_options', '0', '1', 'referrals'), 
		(NULL, 'referral_5', NULL, NULL, NULL, NULL, '3', '5', 'question_options', '0', '1', 'referrals'), 
		(NULL, 'referral_6', NULL, NULL, NULL, NULL, '3', '6', 'question_options', '0', '1', 'referrals'), 
		(NULL, 'referral_7', NULL, NULL, NULL, NULL, '3', '7', 'question_options', '0', '1', 'referrals'), 
		(NULL, 'referral_8', NULL, NULL, NULL, NULL, '3', '8', 'question_options', '0', '1', 'referrals'), 
		(NULL, 'referral_9', NULL, NULL, NULL, NULL, '3', '9', 'question_options', '0', '1', 'referrals'), 
		(NULL, 'referral_10', NULL, NULL, NULL, NULL, '3', '10', 'question_options', '0', '1', 'referrals'), 
		(NULL, 'referral_11', NULL, NULL, NULL, NULL, '3', '11', 'question_options', '0', '1', 'referrals'), 
		(NULL, 'weekly_hours', NULL, 'How many hours per week can you devote to A100 trainings and homework?', 'We expect at least a 10 hour per week commitment.', NULL, '4', '1', NULL, '1', '1', 'schedules'), 
		(NULL, 'commitments', NULL, 'What are all of your unchangeable time commitments? Please include any classes you are taking, work schedules, vacations you plan to take, and important personal commitments, including both weekdays and WEEKENDS.', NULL, NULL, '4', '2', 'textarea', '1', '1', 'schedules'), 
		(NULL, 'programming_option', NULL, 'How much programming experience do you have?', NULL, NULL, '5', '1', 'question_options', '1', '1', 'experiences'), 
		(NULL, 'work_option', NULL, 'How much work experience do you have?', NULL, NULL, '5', '2', 'question_options', '1', '1', 'experiences'), 
		(NULL, 'job_title', NULL, 'What was your last job title (or current, if you are still working there), and where?', NULL, NULL, '5', '3', NULL, '0', '1', 'experiences'), 
		(NULL, 'front_end_experience', NULL, 'Explain your experience with front-end languages (HTML/CSS/JavaScript).', NULL, NULL, '5', '4', 'textarea', '1', '1', 'experiences'), 
		(NULL, 'lamp_stack_experience', NULL, 'What is your experience relating to the LAMP (Linux, Apache, MySQL, PHP) application stack?', NULL, NULL, '5', '5', 'textarea', '1', '1', 'experiences'), 
		(NULL, 'cms_experience', NULL, 'What is your experience with Content Management Systems (Drupal, Joomla, WordPress, etc.)?', NULL, NULL, '5', '6', 'textarea', '1', '1', 'experiences'), 
		(NULL, 'mobile_experience', NULL, 'Explain your experience with mobile app development (Android, iOS, Windows Mobile).', NULL, NULL, '5', '7', 'textarea', '1', '1', 'experiences'), 
		(NULL, 'other_experience', NULL, 'Other Relevant Experience', NULL, NULL, '5', '8', 'textarea', '0', '1', 'experiences'), 
		(NULL, 'resume', NULL, 'Upload your resume with this filename format FIRSTNAME LASTNAME RESUME', NULL, 'We prefer PDF, ODF, or DOC.', '6', '1', 'file', '0', '1', 'materials'), 
		(NULL, 'cover_letter', NULL, 'Upload a cover letter (250 words maximum) with this filename format: FIRSTNAME LASTNAME COVER LETTER', NULL, 'Your cover letter should address why you are applying for the A100 Program, why you would be a good candidate, and what got you interested in startups.', '6', '2', 'file', '0', '1', 'materials'), 
		(NULL, 'reference_list', NULL, 'References', '(Example: Professor Jim Honeycutt, University of Northern Connecticut, honeycutt.j@unct.edu)', 'Please list the names of two people who can speak about your knowledge, experience, abilities, or skills. If you want a professor to be able to vouch for you, you must list them here, or by law, they cannot speak on your behalf.', '6', '3', 'textarea', '1', '1', 'materials'), 
		(NULL, 'additional_info', NULL, 'Additional Information', NULL, 'Any other information you would like to include that you think might be helpful in considering your application', '6', '4', 'textarea', '0', '1', 'materials')
		",
	"INSERT INTO `forms_db`.`question_options` (`q_option_id`, `field_name`, `option_name`, `option_description`, `input_type`, `arrange`, `option_is_active`) VALUES 
		(NULL, 'age_check', 'Yes', NULL, 'radio', '1', '1'), 
		(NULL, 'age_check', 'No', NULL, 'radio', '2', '1'), 
		(NULL, 'legal_status', 'Yes', NULL, 'radio', '1', '1'), 
		(NULL, 'legal_status', 'No', NULL, 'radio', '2', '1'), 
		(NULL, 'referral_1', 'A100 Promo Video from Vimeo', NULL, 'checkbox', '1', '1'), 
		(NULL, 'referral_2', 'A100 Program Manager', NULL, 'checkbox', '2', '1'), 
		(NULL, 'referral_3', 'Career Fair', NULL, 'checkbox', '3', '1'), 
		(NULL, 'referral_4', 'Information Session', NULL, 'checkbox', '4', '1'), 
		(NULL, 'referral_5', 'Radio/TV Ad', NULL, 'checkbox', '5', '1'), 
		(NULL, 'referral_6', 'Search Engine', NULL, 'checkbox', '6', '1'), 
		(NULL, 'referral_7', 'On-Campus Flyer', NULL, 'checkbox', '7', '1'), 
		(NULL, 'referral_8', 'Fellow Student', NULL, '', '8', '1'), 
		(NULL, 'referral_9', 'Professor/Teacher at my University/School', NULL, '', '9', '1'), 
		(NULL, 'referral_10', 'Member of the Independent Software Team', NULL, 'checkbox', '10', '1'), 
		(NULL, 'referral_11', 'Other:', NULL, '', '11', '1'), 
		(NULL, 'programming_option', 'None', NULL, 'radio', '1', '1'), 
		(NULL, 'programming_option', 'I have taken >2 courses that use the same programming language.', NULL, 'radio', '2', '1'), 
		(NULL, 'programming_option', 'I have built several projects on my own time, not for school.', NULL, 'radio', '3', '1'), 
		(NULL, 'programming_option', 'I have little formal training in programming, but have taught myself the essentials and have worked on personal projects.', NULL, 'radio', '4', '1'), 
		(NULL, 'work_option', 'None', NULL, 'radio', '1', '1'), 
		(NULL, 'work_option', 'At least one full-time job in an office setting.', NULL, 'radio', '2', '1'), 
		(NULL, 'work_option', 'At least one part-time job in an office setting.', NULL, 'radio', '3', '1'), 
		(NULL, 'work_option', 'At least one part-time job of any other kind (retail, Starbucks, construction, etc.).', NULL, 'radio', '4', '1')
		"
	);


	foreach ($sql as $stmt) {
		if (mysqli_query($con, $stmt)){
			echo "Table updated successfully. \n";
		}else{
			echo "Error executing: " . $stmt . "\nError produced: " . mysqli_error($con) . "\n";
		}
	}

//cut connection
mysqli_close($con);

?>