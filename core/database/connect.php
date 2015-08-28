<?php

	$connect_error='Sorry, something Error';
	$connection=mysqli_connect("localhost","root","") or die($connect_error);
	mysqli_select_db($connection,'library') or die($connect_error);
?>

