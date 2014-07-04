<html>
 <head><title>PHP Test</title></head>
 <body>
 <h1>A100 Application Portal</h1>
 <p>Returning Applicants please enter your email address and pass phrase</p>
<div>
	<form action="resources/update_applicant.php" method="post">
	Email: <input type="text" name="emailLogin">
	<br>
	Password: <input type="password" name="passwordLogin">
	</br><input type="submit" name="login" value="login">
	</form>	
</div>
<div>
	<?php
	  		if(!empty($_GET['errno'])){

	  			//get the number of mistake
	  			/*$errno=$_GET['errno'];
	  			if($errno==1){

	  				echo "<font color='red' size='3'> No Such User exists, please log in with a valid email address and password.</fond>";
	  			}*/
	  			$errno=$_GET['errno'];
	  			if($errno==1){

	  				echo "<font color='red' size='3'> No Such User exists, please log in with a valid email address and password.</fond>";
	  			}else{
	  				if ($errno==2) {
	  					echo "<font color='red' size='3'> Password is wrong, please log in with a valid email address and password.</fond>";# code...
	  				}
	  			}
	  		}
	  	?>
</div>
<div>
	<p><a href="resources/new_applicant.php">New Applicants Click Here</a></p>
</div>

<h2>Admin Functionality</h2>
<?php include 'resources/select.php' ?>
 </body>
</html>