<?php
	session_start();
	
	// Load essential files	
	include_once('./includes/user_db.php'); //$cramond_db
	
	// Check if logged in already
	if(isset($_SESSION['username'])){
		
		// Logged in, set variables
		$userId = $_SESSION['userId'];
		$userEmail = $_SESSION['username'];
		$customerName = $_SESSION['customer'];
	} else {
		// Not logged in
	}
?>