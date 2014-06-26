<html>
 <head><title>PHP Test</title></head>
 <body>
 <?php echo '<p>A100 Application Form</p>'; ?> 
<form action="insert.php" method="post">
	Name:</br>
	First Name: <input type="text" name="fName">
	Last Name: <input type="text" name="lName">
	</br>credentials:</br>
	Email: <input type="text" name="email">
	Password: <input type="password" name="password">
	</br>
	<input type="submit" name ="submit" Value ="submit">
	<input type="submit" name ="save" Value ="save">
</form>

	<p><a href="select.php">Click here to view table</a></p>
	<?php include 'select.php' ?>

<p><a href="../index.php">Click here to go to gateway</a></p>
 </body>

</html>