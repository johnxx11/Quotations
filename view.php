<!-- 
This is the home page for Final Project, Quotation Service. 
It is a PHP file because later on you will add PHP code to this file.

File name quotes.php 
    
Author: Yanxu Wu
-->

<!DOCTYPE html>
<html>
<head>
<title>Quotation Service</title>
<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body onload="showQuotes()">

	<h1>Quotation Service</h1>
<?php
require_once './DatabaseAdaptor.php';
session_start();
unset($_SESSION['registrationError']);

if (isset($_SESSION['user'])) {
    echo '&nbsp;&nbsp;<button type="button"><a href="addQuote.php">Add Quote</a></button><br>';
    echo '<form autocomplete="off"  action="controller.php" method="post">&nbsp;&nbsp;<input type="submit" name="logout" value="Logout" />';
    echo '<i> Hello ' . $_SESSION['user'] . "</i>";
    unset($_SESSION['loginError']);
    
} else {
    echo '<style type="text/css">
#del {
display: none;
}

</style>';
    echo '&nbsp;&nbsp;<button type="button"><a href="register.php">Register</a></button><br>';
    echo '&nbsp;&nbsp;<button type="button"><a href="login.php">Login</a></button><br>';
}

?>

<div id="quotes"></div>


	<script>
var element = document.getElementById("quotes");
function showQuotes() {
	var ajax = new XMLHttpRequest();
	ajax.open('GET', 'controller.php?todo=getQuotes', true);
	ajax.send();
	ajax.onreadystatechange = function() {
		if (ajax.readyState === 4 && ajax.status === 200) {
				element.innerHTML = ajax.responseText;
		}
	};
}

</script>

</body>
</html>
