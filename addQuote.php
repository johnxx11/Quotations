<!-- 
Author: Yanxu Wu
-->
<!DOCTYPE html>
<html>
<head>
<title>addQuote</title>
<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<?php
require_once './DatabaseAdaptor.php';
session_start();
?>

<h3>Add a Quote</h3>
	<form autocomplete="off" action="controller.php" method="post">
		<div class="addQuoteContainer">
			<textarea name="quote" rows="5" cols="80"
				placeholder='Enter new quote' required></textarea>
			<br> <input type="text" name="author" placeholder='Author' required>
			<br>
			<br> <input type="submit" value="Add Quote"> <br>

		</div>

	</form>
