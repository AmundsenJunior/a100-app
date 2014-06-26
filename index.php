<html>
 <head><title>PHP Test</title></head>
 <body>
 <h1>A100 Application Portal</h1>
 <p>Returning Applicants please enter your email address and pass phrase</p>
 <p>credentials</p>
<div>
	<form action="resources/existing_applicant.php" method="post">
	Email: <input type="text" name="emailLogin">
	<br>
	Password: <input type="password" name="passwordLogin">
	</br><input type="submit" name="login" value="login">
	<a href="resources/existing_applicant.php">Hello</a>
</form>
</div>
<div>
	<p><a href="resources/new_applicant.php">New Applicants Click Here</a></p>
</div>

<p>Admin Functionality</p>
<p><a href="resources/select.php">Click here to view table</a></p>
<?php include 'resources/select.php' ?>
 </body>
</html>