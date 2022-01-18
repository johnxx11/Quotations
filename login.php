<!-- 
Author: Yanxu Wu
-->
<!DOCTYPE html>
<html>
<head>
<title>Longin</title>
<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<?php 
require_once './DatabaseAdaptor.php';
  session_start();
?>

<h3>Login</h3>
<form autocomplete="off"  action="controller.php" method="post">
<div class="loginContainer">
<input type="text" name="loginUsername" placeholder='Username' required>
<br>
<input type="text" name="loginPassword" placeholder='Password' required>
<br><br>
<input type="submit" value="Login"> <br>
<?php 


if( isset($_SESSION ['loginError']))
    echo $_SESSION ['loginError'];
unset($_SESSION['loginError']);
?>

</div>

</form>
