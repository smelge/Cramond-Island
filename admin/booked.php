<?php
	session_start();
	// Check if user should be on this page
	if ($_SESSION['account'] != 1){
		// User not an admin, take them to index
		header('Location: ../index.php');
	}
	
	// Load essential files	
	include_once('../includes/user_db.php'); //$cramond_db
	
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

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- No meta tags, admin page -->
		
		<title>Cramond Island Hotel</title>

		<!-- CSS Files -->
		<link href="../css/bootstrap.min.css" rel="stylesheet">
		<link href="../css/cramond.css" rel="stylesheet">
		
		<!-- Fonts -->
		<link href='https://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
		
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="../js/bootstrap.min.js"></script>

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<?php
			// Load modal windows
			include_once ('../includes/modals.php');
			
			$currentBookings = '';
			
			// Format date from YYYY-MM-DD to 16th December 2016 style
			function dateEdit($dateIn){
				$dateOut = date("jS M Y", strtotime($dateIn));
				return $dateOut;
			}
			
			// Function to colourise and display payment status
			function getPayment($status){
				switch ($status){
					case 0:
						$paymentOption = '<td class="danger" style="border:2px solid black;">Unpaid</td>';
						break;
					case 1:
						$paymentOption = '<td class="success" style="border:2px solid black;">Paid</td>';
						break;
					case 2:
						$paymentOption = '<td class="warning" style="border:2px solid black;">On Hold</td>';
						break;
				}
				return $paymentOption;
			}
		?>
	</head>
	<body class="container-fluid">		
		<?php include ('./admin_includes/adminheader.php');?>

		<div class="row item-block">
			<table class="table table-bordered center-table">
				<tr>
					<th style="border:2px solid black;">Booking Number</th>
					<th style="border:2px solid black;">From</th>
					<th style="border:2px solid black;">To</th>
					<th style="border:2px solid black;">Rooms</th>
					<th style="border:2px solid black;">Guests</th>
					<th style="border:2px solid black;">Requirements</th>
					<th style="border:2px solid black;">Cost</th>
					<th style="border:2px solid black;">Payment Status</th>
					<th style="border:2px solid black;">View</th>
				</tr>
				<?php
					// Set up loop of all bookings
					$bookings_set = mysqli_query($cramond_db,"SELECT * FROM `bookings` ORDER BY `date_from` ASC, `booking_number`");
					while ($bookings = mysqli_fetch_array($bookings_set)){
						if ($bookings['booking_number'] != $currentBookings){
							// Get number of room bookings for this user
							$currentBookings = $bookings['booking_number'];
							$getBookingTotal_set = mysqli_query($cramond_db,"SELECT * FROM `bookings` WHERE `booking_number` = '$currentBookings'");
							
							$totalCost = 0;
							$totalRooms = '';
							while ($getBookingTotal = mysqli_fetch_array($getBookingTotal_set)){
								$totalCost = $totalCost + $getBookingTotal['cost'];
								$totalRooms .= $getBookingTotal['room_no'].'</br>';
							}
							// Display all info on this booking
							echo '
								<tr>
									<td style="border:2px solid black;">'.$bookings['booking_number'].'</td>
									<td style="border:2px solid black;">'.dateEdit($bookings['date_from']).'</td>
									<td style="border:2px solid black;">'.dateEdit($bookings['date_to']).'</td>
									<td style="border:2px solid black;">'.$totalRooms.'</td>
									<td style="border:2px solid black;">'.$bookings['no_booked'].'</td>
									<td style="border:2px solid black;">'.$bookings['requirements'].'</td>
									<td style="border:2px solid black;">&pound;'.$totalCost.'</td>
									'.getPayment($bookings['payment']).'
									<td style="border:2px solid black;"><a class="btn btn-block btn-default" href="./verify.php?id='.$bookings['booking_number'].'">View</a></td>
								</tr>
							';
						}						
					} 
				?>				
			</table>
		</div>
		<?php include('../includes/footer.php');?>
	</body>
</html>