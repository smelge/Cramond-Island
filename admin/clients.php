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
		<!-- Meta Tags not required, administrator page -->
		
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
		?>
	</head>
	<body class="container-fluid">		
		<?php include ('./admin_includes/adminheader.php');?>
		<div class="row item-block">
			<table class="table table-bordered center-table">
				<tr>
					<th style="border:2px solid black;">Name</th>
					<th style="border:2px solid black;">Phone</th>
					<th style="border:2px solid black;">Email</th>
					<th style="border:2px solid black;">Disability Requirements</th>
					<th style="border:2px solid black;">Town</th>
					<th style="border:2px solid black;">Country</th>
					<th style="border:2px solid black;">Total Bookings</th>
					<th style="border:2px solid black;">Total Spend</th>
				</tr>
				<?php
					// Set up loop of all clients in database, excluding admin account, ordered by surnames
					$client_set = mysqli_query($cramond_db,"SELECT * FROM `customers` WHERE `email` <> 'admin@cramondisland.co.uk' ORDER BY `surname` ASC");
					while ($client = mysqli_fetch_array($client_set)){
						$clientId = $client['id'];
						$bookingInfo_set = mysqli_query ($cramond_db,"SELECT `cost`,`payment` FROM `bookings` WHERE `customer_id` = '$clientId'");
						$totalBookings = mysqli_num_rows($bookingInfo_set);
						$totalSpend = 0;
						// Quick loop to count up total spend per user
						while ($bookingInfo = mysqli_fetch_array($bookingInfo_set)){
							if ($bookingInfo['payment'] == 1){
								$totalSpend = $totalSpend + $bookingInfo['cost'];
							}							
						}
						// Display the customer information
						echo '
							<tr>
								<td style="border:2px solid black;">'.$client['forename'].' '.$client['surname'].'</td>
								<td style="border:2px solid black;">'.$client['phone'].'</td>
								<td style="border:2px solid black;">'.$client['email'].'</td>
								<td style="border:2px solid black;">'.$client['disability_requirements'].'</td>
								<td style="border:2px solid black;">'.$client['town'].'</td>
								<td style="border:2px solid black;">'.$client['country'].'</td>
								<td style="border:2px solid black;">'.$totalBookings.'</td>
								<td style="border:2px solid black;">&pound;'.$totalSpend.'</td>
							</tr>
						';
					}
					
				?>
			</table>
		</div>
		<?php include('../includes/footer.php');?>
	</body>
</html>