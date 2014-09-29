<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>A100 Application Gateway</title>

		<!-- Bootstrap -->
		<link href="public_html/css/bootstrap.css" rel="stylesheet">

		<!-- Signin stylesheet -->
		<link href="public_html/css/signin.css" rel="stylesheet">

		<!-- Custom CSS for Application Form -->
		<link href="public_html/css/form.css" rel="stylesheet">

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

		<!-- PHP to pull Cohort Dropdown Options -->
		<?php
			include "resources/cred_int.php";

			$formCon = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_FORM_DATABASE);
				// Check connection
				if (mysqli_connect_errno()) {
					echo "Failed to connect to form_db MySQL: " . mysqli_connect_error();
				}

			$dropdownSql = "SELECT name FROM cohorts WHERE cohort_is_active='1'";
			$dropdownArray = mysqli_query($formCon, $dropdownSql);
		?>


		<div class="container-fluid">

			<div class="row centered">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bottomMargin">
					<h1>Apprentice Applications</h1>
				</div>
			</div>

		    <div class="row form-signin">
		    	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 topMarginSmall bottomMargin">
			    	<button class="btn btn-lg btn-primary btn-block" onClick="location.href='resources/new_applicant.php'">
			    		New applicant? Click here.</button>
			    </div>
			</div>

			<div class="row form-signin">

				<form action="resources/existing_applicant.php" method="post" class="form-signin" role="form">
			        <h3 class="form-signin-heading">Returning Applicants</h3>
			        <input type="email" class="form-control" placeholder="Email address" name="emailLogin" required autofocus>
			        <input type="password" class="form-control" placeholder="Password" name="passwordLogin" required>
			        <select type="cohort" class="form-control" placeholder="Select cohort" name="cohortLogin" required>
			        	<?php
			        		// echo "<option>Select cohort</option>";
			        		while($row=mysqli_fetch_array($dropdownArray))
								{
									echo "<option value='" . $row['name'] . "'>" . $row['name'] . "</option>";
								}
						?>
					</select>

			        <button class="btn btn-lg btn-primary btn-block" type="submit" name="login" value="login">
			        	Resume application now.</button>
			    </form>

			</div>

		</div>

		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="public_html/js/bootstrap.js"></script>

	</body>

</html>