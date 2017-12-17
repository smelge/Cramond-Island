<?php
	session_start();
	
	// If logging in from the booking page, we need to retain the booking form information
	if (isset($_POST['destination'])){
		$dateFrom = $_POST['dateFrom'];
		$dateTo =  $_POST['dateTo'];
		$guestNo = $_POST['guests'];
	}
	
	
	
	// If sessions not set, login function required
	if (!isset($_SESSION['username'])){
		//connect to database
		include_once('./user_db.php');	//$cramond_db
		// Get input username and password
		$username = $_POST['username'];
		$getUser = mysqli_query($cramond_db,"SELECT * FROM `customers` WHERE `email` = '$username'");
		// check database for username
		if (mysqli_num_rows($getUser) == 0){
			// if not in DB, return to Index
			if (isset($_POST['destination'])){
				header('Location: ../bookings.php?e=nouser&lv=1&from='.$dateFrom.'&to='.$dateTo.'&guest='.$guestNo);
			} else {
				header('Location: ../index.php?e=nouser&lv=1');
			}
			
		} else {
			$userCheck = mysqli_fetch_array($getUser);
			
			// Get relevant Salt & password for username
			$salt = $userCheck['salt'];
			$password = $_POST['password'];
			// combine input password and salt for hashed password
			$encrypted = crypt($password,$salt);
			
			// check if combined password/salt equals stored hash
			if($encrypted == $userCheck['password']){
				// if correct, set session variables
				$_SESSION['username'] = $userCheck['email'];
				$_SESSION['password'] = $_POST['password'];
				$_SESSION['customer'] = $userCheck['forename'].' '.$userCheck['surname'];
				$_SESSION['userId'] = $userCheck['id'];
				
				// Check if login is to an admin account
				if ($userCheck['email'] == 'admin@cramondisland.co.uk'){
					$_SESSION['account'] = '1';
				} else {
					$_SESSION['account'] = '0';
				}
				
				// If retaining booking info, go to relevant page to continue booking with data 
				if (isset($_POST['destination'])){
					header('Location: ../bookings.php?e=logged&lv=3&from='.$dateFrom.'&to='.$dateTo.'&guest='.$guestNo);
				} else {
					header('Location:../index.php?e=logged&lv=3');
				}
			} else {
				// if different, incorrect password, return to Index
				if (isset($_POST['destination'])){
					header('Location: ../bookings.php?e=badpass&lv=1&from='.$dateFrom.'&to='.$dateTo.'&guest='.$guestNo);
				} else {
					header('Location:../index.php?e=badpass&lv=1');
				}				
			}
		}
	// Sessions are set, so logout is required
	} else {
		//Logout function
		session_unset();
		session_destroy();
		header('Location:../index.php?e=logout&lv=3');
	}
?>