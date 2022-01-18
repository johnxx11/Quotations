<!-- 
This code will appear when the Register menu item is chosen in the Final Exam.

This form will be absorbed by the controller.

Author: Yanxu Wu
-->
<!DOCTYPE html>
<html>
<head>
<title>Register</title>
<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<?php
require_once './DatabaseAdaptor.php';
session_start();
?>

<h3>Register</h3>
	<form autocomplete="off" action="controller.php" method="post">
		<div class="registerContainer">
			<input type="text" name="registerUsername" placeholder='Username'
				required> <br> <input type="text" name="registerPassword"
				placeholder='Password' required> <br>
			<br> <input type="submit" value="Register"> <br>
<?php
if (isset($_SESSION['registrationError']))
    echo $_SESSION['registrationError'];
unset($_SESSION['registrationError']);
?>

</div>

	</form>
