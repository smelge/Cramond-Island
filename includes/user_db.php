<?php
	$hostname = "#";
	$username = "#";
	$password = "#";

	$cramond_db = mysqli_connect($hostname, $username, $password);
	mysqli_select_db($cramond_db, "#") or die ("Could not connect to Member Server");
?>