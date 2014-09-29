<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>A100 Application - New Applicant Form</title>

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

			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bottomMargin">
					<h1>A100 Application Form</h1>
				</div>
			</div>

			<div class="row">
				<form action="insert.php" method="post" enctype="multipart/form-data">

					<?php
						include "cred_int.php";

							//Create connection
						$formCon = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_FORM_DATABASE);
						// Check connection
						if (mysqli_connect_errno()) {
							echo "Failed to connect to form_db MySQL: " . mysqli_connect_error();
						}

						//sorts content by section on sections.arrange
						$qstnSql = "SELECT * FROM fields INNER JOIN sections 
							ON fields.section_id=sections.section_id ORDER BY sections.arrange"; 
						$qstnArray = mysqli_query($formCon, $qstnSql);

						$arrangeCounter = 0;
						while($row = mysqli_fetch_array($qstnArray))
							{
							// checks if moving to a new section, if counter is less than section.arrange, print header and body if available
							if($arrangeCounter<$row['arrange'])
							{
								if($row['pre_text']==NULL && $row['post_text']==NULL)
								{
									echo "<h3>" . $row['section_name'] . "*</h3>";
								}else
								{
									echo "<h3>" . $row['section_name'] . "</h3>";
								}
								echo "<b>" . $row['section_description'] . "</b>";
								$arrangeCounter = $row['arrange'];
								}

							if($row['is_active']==X){  //flag functionality not working right now due to ambiguous column headers
								echo "is active flag:" . $row['is_active'];
							}else
							{
								if($row['is_required']==1 && $row['post_text']==NULL && $row['pre_text']!= NULL){
									echo "<h4>" . $row['pre_text'] . "*</h4>";
								}else{
									echo "<h4>" . $row['pre_text'] . "</h4>";}

								$insideText = "";  //variable to hold inside text content/reduce need for " and '
								$fieldName = $row['field_name'];  //variable to hold DB name content/reduce need for " and '
								$fieldId = $row['field_id'];  //variable to hold DB name content/reduce need for " and '
								
								if($row['inside_text']!=NULL){
									$insideText = $row['inside_text'];
								}

								if($row['options_target']==NULL)
								{
									echo "<input class='form-control' type='text' name='$fieldName' placeholder='$insideText'>";
								}elseif($row['options_target']=='textarea'){
									echo "</br><textarea class='form-control' name='$fieldName' placeholder='$insideText'></textarea>";
								}elseif($row['options_target']=='file'){
									//echo "</br><label for=".$fieldName.">".$fieldName."</label>";
									echo "<input type='file' name=" . $fieldName . " id=" . $fieldName . "><br>";
								}
								elseif($row['options_target']=="question_options"){
									
									//handles multiple choice options reading from question_options table
									$optnSql="SELECT * FROM fields INNER JOIN question_options 
										WHERE fields.field_name = '$fieldName' AND question_options.field_name='$fieldName'";
									$optnArray = mysqli_query($formCon, $optnSql);

									while($optnRow=mysqli_fetch_array($optnArray)){
										$optnInputType = $optnRow['input_type'];
										//$optnFieldId=$optnRow['field_id'];
										$optnId=$optnRow['q_option_id'];
										$optnName=$optnRow['option_name'];
										if($optnInputType!=NULL){
											echo "<input type='$optnInputType' name='$fieldName' value='$optnId'>$optnName";	
										}else{echo "$optnName <input type='$optnInputType' name='$fieldName'>";}
										echo "</br>";
									}

								}else{
									$targetTable = $row['options_target'];
									$dropDownSql = "SELECT * FROM $targetTable";
									$dropDownArray = mysqli_query($formCon,$dropDownSql);
									echo "</br>";
									echo "<select name='$fieldName'>";
									echo "<option>Select a value</option>";
										while($dropDownRow = mysqli_fetch_array($dropDownArray)){
											echo "test";
											$dropDownValue = $dropDownRow['name'];
											echo "<option value='$dropDownValue'>$dropDownValue</option>";
										}
									echo "</select>";
								}
								
								echo "</br>";
								if($row['post_text']!=NULL)
								{
									if($row['is_required']==1){
										echo $row['post_text'] . "*";
									}else{
										echo $row['post_text'];
									}
								}
							}
						}

					?>

					<div class="row form">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 topMarginSmall bottomMargin">
							<button class="btn btn-lg btn-primary btn-block" type="submit" name ="submit" Value ="submit">
								Submit Completed Application</button>
							<button class="btn btn-lg btn-primary btn-block" type="submit" name ="save" Value ="save">
								Save Application to Complete Later</button>
						</div>
					</div>

				</form>
			
			</div>

		</div>

		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="public_html/js/bootstrap.js"></script>

	</body>

</html>
