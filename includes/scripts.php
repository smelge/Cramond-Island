<!-- Set up datePicker plugin for pop-up window allowing easier date selection -->

<!-- Datepicker Stuff -->
<link rel="stylesheet" href="./css/1.11.4-jquery-ui.css">
<script src="./js/jquery-1.10.2.js"></script>
<script src="./js/1.11.4-jquery-ui.js"></script>
<script>
	$(function() {
		$( "#startDate,#endDate,#reStartDate,#reEndDate" ).datepicker({
			minDate: 1,
			dateFormat: 'dd-mm-yy'
		});
	});
</script>

<?php
	// Load modal windows
	include_once ('./includes/modals.php');
	
	function alertGrade($alertIn){
		switch ($alertIn){
			case 1: $alertGrade = 'danger';break;
			case 2: $alertGrade = 'warning';break;
			case 3: $alertGrade = 'success';break;
			default: $alertGrade = 'info';break;
		}
		return $alertGrade;
	}
	
	function alertMessage($messageIn){
		switch($messageIn){
			case 'nouser':$alertMessage='Sorry, the Username you entered does not exist in our database.';break;
			case 'badpass':$alertMessage='Sorry, the password you entered is incorrect.';break;
			case 'logged':$alertMessage='You have logged in successfully.';break;
			case 'logout':$alertMessage='You have been logged out.';break;
			case 'plog':$alertMessage='You have already used this site. Please Log In to recover your information.';break;
			case 'accfail':$alertMessage='Sorry, we are having Database Issues and your account could not be created. Please try again shortly.';break;
			case 'booked':$alertMessage='Your Booking has been placed. We will call you within 24hrs to confirm and process your Payment.';break;
			case 'email':$alertMessage='Thank You for registering. Please check your email for your Login details.</br></br>Your Booking has been placed. We will call you within 24hrs to confirm and process your Payment.';break;
			//case '':$alertMessage='';break;
		}
		return $alertMessage;
	}
?>