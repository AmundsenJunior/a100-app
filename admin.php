<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>A100 Admin Page</title>

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

		<div class="container-fluid">

			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bottomMargin">
					<h1>Admin Functionality</h1>
				</div>
			</div>

			<!-- Use admin DB credentials -->
			<?php include 'admin/cred_admin.php' ?>

			<!-- Select all applications table include statement -->
			<?php include 'resources/select.php' ?>

		</div>	

		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="public_html/js/bootstrap.js"></script>

	</body>
	
</html>
