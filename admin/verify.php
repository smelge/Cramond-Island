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
		<!-- Meta Tags here -->
		
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
			// Check if ID for a booking is already entered
			if (isset($_GET['id']) || isset($_POST['bookingInput'])){
				if (isset($_GET['id'])){
					$bookingId = $_GET['id'];
				} elseif (isset($_POST['bookingInput'])){
					$bookingId = $_POST['bookingInput'];
				}	
				
				// Check if Booking ID is valid
				$checkBooking_set = mysqli_query($cramond_db,"SELECT * FROM `bookings` WHERE `booking_number` = '$bookingId'");
					
				if ($numberOfBookings = mysqli_num_rows($checkBooking_set) == 0){
					// If not valid, display find booking number with error message
					header('Location: ./verify.php?badid='.$bookingId);
				}
			}
			
			// Function to return payment status
			function paymentStatus($payment){
				switch ($payment){
					case 0:
						$paymentOutput = 'UNPAID';
						break;
					case 1:
						$paymentOutput = 'PAID';
						break;
					case 2:
						$paymentOutput = 'ON HOLD';
						break;
				}
				return ($paymentOutput);
			}
			
			// Function to format date from yyyy-mm-dd to something like 16th June 2016
			function dateEdit($dateIn){
				$dateOut = date("jS M Y", strtotime($dateIn));
				return $dateOut;
			}
			
			// Load modal windows
			include_once ('../includes/modals.php');
		?>
		
	</head>
	<body class="container-fluid">
		<!-- Debug Window -->

		<?php include ('./admin_includes/adminheader.php');?>

		<div class="row item-block">
			<?php
				// Check if bookingId is set
				if (isset($bookingId)){
					// Match found, connect to database and load the results into an array
					$checkBooking = mysqli_fetch_array($checkBooking_set);
					$customerId = $checkBooking['customer_id'];
					$customer_set = mysqli_query($cramond_db,"SELECT * FROM `customers` WHERE `id` = '$customerId'");
					$customer = mysqli_fetch_array($customer_set);
					
					// Set initial variable values
					$totalCost = 0;
					$totalRooms = '';
					// set up query and loop to total up the total cost of this booking, as well as all rooms in the booking
					$getTotals_set = mysqli_query($cramond_db,"SELECT * FROM `bookings` WHERE `booking_number` = '$bookingId'");
					while ($getTotals = mysqli_fetch_array($getTotals_set)){
						$totalCost = $totalCost + $getTotals['cost'];
						$totalRooms .= ' '.$getTotals['room_no'];
					}
					
					// Loop through booking array and display booking details
					echo '
						<div class="col-sm-12">
							<table class="table table-bordered">
								<tr>
									<td>Booking Number</td>
									<td>'.$bookingId.'</td>
								</tr>
							</table>
						</div>
						<div class="col-sm-12">
							<table class="table table-bordered">
								<tr>
									<td class="col-sm-6">
										<div class="col-sm-4">Email</div>
										<div class="col-sm-8 center-table">'.$customer['email'].'</div>
										<div class="col-sm-4">Phone</div>
										<div class="col-sm-8 center-table">'.$customer['phone'].'</div>
										<div class="col-sm-4">Address</div>
										<div class="col-sm-8 center-table">
											'.$customer['house'].'</br>
											'.$customer['street'].'</br>
											'.$customer['town'].'</br>
											'.$customer['postcode'].'</br>
											'.$customer['country'].'
										</div>
									</td>
									<td class="col-sm-6">
										<div class="col-sm-4">Name</div>
										<div class="col-sm-8 center-table">'.$customer['forename'].' '.$customer['surname'].'</div>
										<div class="col-sm-4">Date of Birth</div>
										<div class="col-sm-8 center-table">'.dateEdit($customer['date_of_birth']).'</div>
										<div class="col-sm-4">Gender</div>
										<div class="col-sm-8 center-table">'.$customer['gender'].'</div>
										<div class="col-sm-4">Disability Requirements</div>
										<div class="col-sm-8 center-table">'.$customer['disability_requirements'].'</div>
									</td>
								</tr>
								<tr>
									<td class="col-sm-6">
										<div class="col-sm-4">Date From</div>
										<div class="col-sm-8 center-table">'.dateEdit($checkBooking['date_from']).'</div>
										<div class="col-sm-4">Date To</div>
										<div class="col-sm-8 center-table">'.dateEdit($checkBooking['date_to']).'</div>
										<div class="col-sm-4">Rooms</div>
										<div class="col-sm-8 center-table">'.$totalRooms.'</div>
										<div class="col-sm-4">Total Guests</div>
										<div class="col-sm-8 center-table">'.$checkBooking['no_booked'].'</div>
									</td>
									<td class="col-sm-6">
										<div class="col-sm-4">Total Cost</div>
										<div class="col-sm-8 center-table">&pound;'.$totalCost.'</div>
										<div class="col-sm-12"><h3>'.paymentStatus($checkBooking['payment']).'</h3></div>
									</td>
								</tr>
							</table>
						</div>
						<div class="col-sm-12 btn-group">
							
					';
					// If the booking is paid for, the Paid and On Hold buttons should be disabled
					if ($checkBooking['payment'] == 1){
						echo '
							<div class="col-sm-4">
								<a class="btn btn-success btn-block btn-lg" disabled="disabled">Paid</a>
							</div>
							<div class="col-sm-4">
								<a class="btn btn-warning btn-block btn-lg" disabled="disabled">On Hold</a>
							</div>
						';
					} else {
						// Payment not made yet, so Paid and On Hold buttons should be enabled
						echo '
							<div class="col-sm-4">
								<a class="btn btn-success btn-block btn-lg" href="./admin_includes/process_booking.php?id='.$bookingId.'&action=paid">Paid</a>
							</div>
							<div class="col-sm-4">
								<a class="btn btn-warning btn-block btn-lg" href="./admin_includes/process_booking.php?id='.$bookingId.'&action=hold">On Hold</a>
							</div>
						';
					}
					// Cancelled button is always displayed
					echo '
							<div class="col-sm-4">
								<a class="btn btn-danger btn-block btn-lg" href="./admin_includes/process_booking.php?id='.$bookingId.'&action=cancel">Cancelled</a>
							</div>
						</div>
					';
				} else {
					// Check if bad ID has been returned
					if (isset($_GET['badid'])){
						echo '
							<div class="alert alert-warning" role="alert">
								Sorry, the Booking Number <b>'.$_GET['badid'].'</b> does not exist.
							</div>
						';
					}
					// Get booking number through form
					echo '
						<div class="col-sm-6 col-sm-offset-3 verify-panel">
							<form class="form-horizontal col-sm-12 padding" action="./verify.php" method="POST">
								<div class="form-group">
									<label for="bookingInput" class="control-label">Booking Number</label>
									<input type="text" class="form-control" name="bookingInput"/>
								</div>
								<div class="form-group">
									<div class="col-sm-5 no-padding">
										<input type="submit" class="btn btn-success btn-block" value="Submit"/>
									</div>
									<div class="col-sm-5 col-sm-offset-2 no-padding">
										<input type="reset" class="btn btn-danger btn-block" value="Reset Form"/>
									</div>
								</div>
							</form>
						</div>
					';
				}
				
			?>
		</div>
		<?php include('../includes/footer.php');?>
	</body>
</html>