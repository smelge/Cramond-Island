<?php
	include_once('./includes/security.php');
	
	// Logged in check
	if (!isset($_SESSION['username'])){
		header('Location: ./index.php?error=Not+logged+in');
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- Meta Tags here -->
		
		<title>Cramond Island Hotel - My Bookings</title>

		<!-- CSS Files -->
		<link href="./css/bootstrap.min.css" rel="stylesheet">
		<link href="./css/cramond.css" rel="stylesheet">
		
		<!-- Fonts -->
		<link href='https://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
		
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="js/bootstrap.min.js"></script>

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<?php include ('./includes/scripts.php');?>
		
		<?php
		
			// Function to return booking status
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
			
			// Function to display date properly
			function dateEdit($dateIn){
				$dateOut = date("jS M Y", strtotime($dateIn));
				return $dateOut;
			}
		?>
	</head>
	<body class="container-fluid">
		<?php include('./includes/header.php');?>			
		<div class="row">
			<div class="col-sm-12">
				<?php
					// Set up database connection and get all bookings for this user ID
					$getBookings_set = mysqli_query($cramond_db,"SELECT * FROM `bookings` WHERE `customer_id` = '$userId' ORDER BY `booking_id` ASC, `booking_id` ASC");
					$previousBooking = '';
					$bookingLoop = 0;
					$noBookedLoop = 1;
					
					while ($getBookings = mysqli_fetch_array($getBookings_set)){						
						$currentBooking = $getBookings['booking_number'];
						$noBooked = $getBookings['no_booked'];
												
						// Set block of booking details to be reused
						if ($noBookedLoop == $noBooked){
							$totalCost_set = mysqli_query($cramond_db,"SELECT SUM(`cost`) AS `totalCost` FROM `bookings` WHERE `booking_number` = '$currentBooking'");
							$totalCost = mysqli_fetch_array($totalCost_set);
							//Some data not needed, as this has multiple bookings
							$bookingDetails = '
											<tr>
												<td style="border:2px solid black;">'.dateEdit($getBookings['date_from']).'</td>
												<td style="border:2px solid black;">'.dateEdit($getBookings['date_to']).'</td>
												<td style="border:2px solid black;">'.$getBookings['room_no'].'</td>
												<td style="border:2px solid black;">&pound;'.$getBookings['cost'].'</td>
												'.getPayment($getBookings['payment']).'									
											</tr>
										';
						} else {
							$bookingDetails = '
											<tr>
												<td style="border:2px solid black;">'.dateEdit($getBookings['date_from']).'</td>
												<td style="border:2px solid black;">'.dateEdit($getBookings['date_to']).'</td>
												<td style="border:2px solid black;">'.$getBookings['room_no'].'</td>
												<td style="border:2px solid black;">&pound;'.$getBookings['cost'].'</td>
												'.getPayment($getBookings['payment']).'									
											</tr>
										';
						}
						
						// Check if a new booking starts, otherwise add room to the current table		
						if ($previousBooking != $currentBooking){
							// If this is the first booking, no need to end a previous table
							if ($bookingLoop != 0){
								echo '</table>';
								$noBookedLoop = 1;
							}
							// Display booking number and headers for booking details
							echo '
								<table class="table table-bordered" style="width:50%;">
									<tr>
										<td style="border:2px solid black;">Booking Number</td>
										<td style="border:2px solid black;">'.$getBookings['booking_number'].'</td>
									</tr>
								</table>
								<table class="table table-bordered">
									<tr>
										<th style="border:2px solid black;">Date From</th>
										<th style="border:2px solid black;">Date To</th>
										<th style="border:2px solid black;">Room</th>
										<th style="border:2px solid black;">Cost</th>
										<th style="border:2px solid black;">Payment Status</th>
									</tr>								
							';
							// Display booking details
							echo $bookingDetails;
						} else {
							// Additional room for this booking
							echo $bookingDetails;
						}
						// Set variables to check if next entry is the same booking, and to identify as not the first table
						$previousBooking = $getBookings['booking_number'];
						$bookingLoop++;
						$noBookedLoop++;
					}
					// All bookings displayed, close last table
					echo '</table>';

					echo '<hr>';
					$customerSet = mysqli_query($cramond_db,"SELECT * FROM `customers` WHERE `id` = '$userId'");
					$customer = mysqli_fetch_array($customerSet);
					// Display Customers Details
					echo '
						<table class="table table-bordered" style="width:50%;">
							<tr>
								<td style="border:2px solid black;">'.$customerName.'\'s Details</td>
							</tr>
						</table>
						<table class="table table-bordered">
							<tr>
								<th style="border:2px solid black;">Phone</th>
								<th style="border:2px solid black;">Email</th>
								<th style="border:2px solid black;">Address</th>
							</tr>
							<tr>
								<td style="border:2px solid black;">'.$customer['phone'].'</td>
								<td style="border:2px solid black;">'.$customer['email'].'</td>
								<td style="border:2px solid black;">
									'.$customer['house'].'</br>
									'.$customer['street'].'</br>
									'.$customer['town'].'</br>
									'.$customer['postcode'].'</br>
									'.$customer['country'].'</br>
								</td>
							</tr>
						</table>
					';
				?>
			</div>
		</div>
		<?php include('./includes/footer.php');?>
	</body>
</html>