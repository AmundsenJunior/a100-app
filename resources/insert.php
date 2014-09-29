<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>A100 Application - New Applicant Submit-Save Page</title>

		<!-- Bootstrap -->
		<link href="../public_html/css/bootstrap.css" rel="stylesheet">

		<!-- Signin stylesheet -->
		<link href="../public_html/css/signin.css" rel="stylesheet">

		<!-- Custom CSS for Application Form -->
		<link href="../public_html/css/form.css" rel="stylesheet">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

		<!-- Fonts -->
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,800italic,300italic,600italic,400,300,600,700,800|Montserrat:400,700' rel='stylesheet' type='text/css'>
    	<link href="public_html/css/font-awesome.min.css" rel="stylesheet">

	</head>

	<body>

		<div class="container-fluid">

			<div class="row form">

				<?php
					include "cred_int.php";

					$appCon = mysqli_connect(DB_HOST,DB_USERNAME, DB_PASSWORD, DB_APP_DATABASE);
					$formCon = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_FORM_DATABASE);

					if(mysqli_connect_errno()){
						echo "Failed to connect to MySQL: " . mysqli_connect_error();
					}

					//check for duplicates by applicant ID and cohort content
					$sqlDup = "SELECT * FROM applications INNER JOIN identity 
						ON applications.identity_id = identity.identity_id 
						WHERE identity.email = '" . $_POST['email'] . "' AND applications.cohort_name ='" . $_POST['cohort_name'] . "'";
						//!!warning var cohort_id CONTAINS cohort_name
					$dup = mysqli_query($appCon, $sqlDup);  //sql runs sql code and gets possible duplicates
					$dupCount = mysqli_num_rows($dup);  //counts total duplicate values

					//checks for duplicates, if greater than 1, throw dup record and stop else write to DB
					if($dupCount >1){
						echo "Someone has enrolled in: " . $_POST['cohort_name'] . 
							" with the provided email address already, thank you for your interest.";
					}else{
						//checks if user has submitted or saved the form, if submit switch flag to 1 to lock form else leave at 0
								if($_POST['submit'])
								{
									$status = 1;

								//checks for malformed input 
								 	$reqArray = mysqli_query($formCon, "SELECT field_name, is_required FROM fields");
								 	$malformedInput = 0;
								 	while($required = mysqli_fetch_array($reqArray))
								 		{
								 		$tempName = $required['field_name'];
								 		if($required['is_required']==1 && $_POST[$tempName]==NULL){
								 			echo "'" . $tempName . "' is a required field, you submitted: "
								 				. $_POST['$tempName'] . " please enter a correct value </br>";
								 			$malformedInput = 1;
								 			}
								 		}
								 		if($malformedInput==1){
											echo "<a href='../index.php'>Click Back</a>";
								 			exit;
								 		}

								}elseif($_POST['save'])
								{
							 			if($_POST['email']==NULL || $_POST['password']==NULL || $_POST['cohort_name']==NULL)
							 			{
								 			echo "Please Submit a valid email address and password and Select your desired Cohort to save your progress</br>";
							 				$malformedInput = 1;
							 			}

							 				
							 		if($malformedInput==1){
										echo "<a href='../index.php'>Click Back</a>";
							 			exit;
							 		}
								
									$status = 0;
									$to = $email;
									$subject = "Thank you for your interest in Apprentice 100";
									$Message = "
									<html>
									<head>
									<title>HTML email</title>
									</head>
									<body>
									<p>Thank you for your continued interest in the Apprentice 100 program. </p>
									<p> We look forward to receiving your completed application. For your reference, your login credentials to our online webportal are</p>
									" . $email . "<br>
									" . $password . "<br>
									<p>We look forward to receiving your completed application</p>
									<p>Sincerely \nA100 Developers</p>
									</body>
									</html>";
								}

						$applicationSqlInsert = "NULL";
						//needs to be modularized to read from DB
						$tableInfo = array('applicants', 'identity', 'referrals','schedules', 'experiences', 'materials', 'applications');
						for($x=0;$x<7;$x++)
							{
							$query = "SELECT * from " . $tableInfo[$x];
							if ($result = mysqli_query($appCon, $query)) {

							    /* Get field information for all fields */
							    $submitSqlTable;
							    //Base string, will be formatted as input is entered
							    $submitSqlField = "";
							    $submitSqlRecord = "";

							    $sqlFirst = 0;
							    
							    //start modifying content for insertion
							    while ($finfo = mysqli_fetch_field($result)) {
							    	//formatting Insert statement to add commas before all content excluding first entry
							    	if($sqlFirst!=0){
							    		$submitSqlField=$submitSqlField . ",";
							    		$submitSqlRecord=$submitSqlRecord . ",";
							    					}

							    	//retrieves column name and table name
							    	$colName = $finfo->name;
							    	$submitSqlTable = $finfo->table;		    	

							    	//echo "1 if required, 0 if optional : colName: ". $colName. "  input is: ".$required['is_required']."</br>";
							    	
							    	//inserts into 
							        $submitSqlField = $submitSqlField . "`" . $colName . "`";

							        //file submission, checks if field names reference resume/cover letter !! not modularized  !!
							        if($colName=="resume" || $colName=="cover_letter"){
							        	if ($_FILES[$colName]["error"] > 0) {
							        		//echo "Return Code: " . $_FILES[$colName]["error"] . "<br>";
							        	} else {
							        		//echo "Upload: " . $_FILES[$colName]["name"] . "<br>";
							        		//echo "Type: " . $_FILES[$colName]["type"] . "<br>";
							        		//echo "Size: " . ($_FILES[$colName]["size"] / 1024) . " kB<br>";
							        		//echo "Temp file: " . $_FILES[$colName]["tmp_name"] . "<br>";
							        		if (file_exists("upload/" . $_FILES[$colName]["name"])) {
							        			echo $_FILES[$colName]["name"] . " already exists. ";
							        			$fileLoc= "Stored in: " . "upload/" . $_FILES[$colName]["name"];
							        		} else {
							        			move_uploaded_file($_FILES[$colName]["tmp_name"],
							        				"upload/" . $_FILES[$colName]["name"]);
							        			$fileLoc= "Stored in: " . "upload/" . $_FILES[$colName]["name"];
							        		//	echo $fileLoc;
							        		}
							        	}
							        }

							        if($submitSqltable!="applications") {
								        	//first check if there is not submitted value, like for keys in a completed form
								        if($_POST[$colName]=="") {  
								        	//file submission as no submitted value sent via normal ways
								        	//if object name is resume or cover letter write file path to DB
								        	if($colName=="resume" || $colName=="cover_letter") {
								        		$submitSqlRecord=$submitSqlRecord."'".$fileLoc."'";	
								        	}else
								        	{
								        		// writes a NULL value like for PK
								        		if($required==1){
								        			break;
								        		}
								        		$submitSqlRecord = $submitSqlRecord . "NULL";
								        		//increment tracker so system knows to format with commas
								        		$sqlFirst = $sqlFirst + 1;
								        	}
								        }else
								        {
								        	//if POST content isn't null, write POST content with formatting into string for SQL insertion
								        	$submitSqlRecord = $submitSqlRecord . "'" . $_POST[$colName] . "'";
								        }	
							        }
							    }

							    
								//sql for writing to DB
								if($submitSqlTable!="applications"){
									$submitSql = "INSERT INTO `applications_db`.`" . $submitSqlTable . "` (" . $submitSqlField
										. ")VALUES (" . $submitSqlRecord . ")";
									//echo $submitSql;
									if (mysqli_query($appCon, $submitSql)){
										echo "Table updated successfully. \n";
									}else{
									echo "Error executing: " . $submitSql . "\nError produced: " . mysqli_error($appCon) . "\n";
									}
									$identity_id= mysqli_insert_id($appCon);
									//echo $submitSqlTable . " key: " . $identity_id;
								}
								
								//manual collection of FKs for applications table !! NOT MODULARIZED !!
								if($submitSqlTable!="applications"){
										if($submitSqlTable == "identity"){			
											$applicationSqlInsert = $applicationSqlInsert . ",'" . $identity_id . "','" 
											. $_POST['cohort_name'] . "'";
										}else{		
											$applicationSqlInsert = $applicationSqlInsert . ", '" . $identity_id . "'";
										}
									}
								

						echo "</br>";
							}
						}

						$applicationSqlInsert = $applicationSqlInsert . ", '" . $status . "',NULL";
						$submitSql = "INSERT INTO `applications_db`.`" . $submitSqlTable . "` (" . $submitSqlField
							. ")VALUES (" . $applicationSqlInsert . ")";
						//echo "final insert" . $submitSql;

						if (mysqli_query($appCon, $submitSql)){
									echo "<p>Table updated successfully.</p>";
								}else{
									echo "Error executing: " . $submitSql . "\nError produced: " . mysqli_error($appCon) . "\n";
								}
							
						mysqli_free_result($result);

					}

					mysql_close($con);
				?>

			</div>

			<div class="row form">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bottomMargin">
					<h4><a href="../index.php">Return to Application Form login</a></h4>
					<h4><a href="http://www.indie-soft.com/a100">Return to A100 Program website</a></h4>
				</div>
			</div>

		</div>

		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="public_html/js/bootstrap.js"></script>

	</body>

</html>