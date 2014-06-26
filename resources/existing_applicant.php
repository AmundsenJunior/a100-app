<html>
 <head><title>PHP Test</title></head>
 <body>
 <?php echo '<p>A100 Application Form</p>'; ?> 
<form action="replace.php" method="post">

<?php

	// select.php Script to execute from index.php to view the contents of test_db.Apprentices2

	include "cred_int.php";

	//Create connection
	$con = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
	// Check connection
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

$email = $_POST["emailLogin"];  //receives content from email field in gateway page
$password =$_POST["passwordLogin"];  //receives content from password field in gateway page

	$result = mysqli_query($con, "SELECT * FROM Apprentices2 Where email='$email' AND password='$password'");  //sql where statements must be wrapped in apostrophes
	if(mysqli_num_rows($result)>0){
		$row=mysqli_fetch_array($result);
		if($row['status'] ==1){
			echo "This application has been submitted already and is no longer available for editting.";
		}else{
				echo "Name:<br>";
				echo "First Name: <input type='text' name='fName' value='" . $row['fName'] . "'>";
				echo "Last Name: <input type='text' name='lName' value='" . $row['lName'] . "'>";
				echo "<br>credentials: <br>";
				echo "email: <input type='text' name='email' value='" . $row['email'] . "'>";
				echo "password: <input type='password' name='password' value='". $row['password'] . "'>";
				if($row['status']==0){
					echo "status: incomplete";
				}elseif($row['status']==1){
					echo "status: complete";
				}
				echo  "</br>";
				echo "<input type='submit' name ='submit' Value ='submit'>";
				echo "<input type='submit' name ='save' Value ='save'>";	
		}
			
	}else{
		echo "No Such User exists, please log in with a valid email address and password";
	}
	
	mysqli_close($con);

?>
	
</form>
	<p><a href="../index.php">Click here to go to gateway</a></p>
	<p><a href="select.php">Click here to view table</a></p>
	<?php include 'select.php' ?>
 </body>
</html>
