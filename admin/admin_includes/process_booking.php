<?php
	session_start();
	// Check if user should be on this page
	if ($_SESSION['account'] != 1){
		// User not an admin, take them to index
		header('Location: ../../index.php');
	}
	
	// Load essential files	
	include_once('../../includes/user_db.php'); //$cramond_db
	
	if(!isset($_GET['id'])){
		// No booking ID, back to booked.php
		header('Location: ../booked.php');
	}
	
	// Set up GET variables
	$bookingId = $_GET['id'];
	$action = $_GET['action'];
	
	if($action == 'paid'){
		// Process as paid & return to verify page
		$updateBooking = "UPDATE `bookings` SET `payment` = '1' WHERE `booking_number` = '$bookingId'";
		if(!mysqli_query($cramond_db,$updateBooking)){
		mysqli_error($cramond_db);
		} else {
			header ('Location: ../verify.php?id='.$bookingId);
		}
	} elseif ($action == 'hold'){
		// Process as on hold & return to verify page
		$updateBooking = "UPDATE `bookings` SET `payment` = '2' WHERE `booking_number` = '$bookingId'";
		if(!mysqli_query($cramond_db,$updateBooking)){
		mysqli_error($cramond_db);
		} else {
			header ('Location: ../verify.php?id='.$bookingId);
		}
	} elseif ($action == 'cancel'){
		// Process as cancelled, return to booked page as booking no longer exists
		$updateBooking = "DELETE FROM `bookings` WHERE `booking_number` = '$bookingId'";
		if(!mysqli_query($cramond_db,$updateBooking)){
		mysqli_error($cramond_db);
		} else {
			header ('Location: ../booked.php');
		}
	} else {
		// Incorrect action, return to previous page using booking Id
		header('Location: ../verify.php?id='.$bookingId);
	}
?>