<?php
	include_once('./includes/security.php');
	
	// Set up variables from booking modal, check if coming from modal or changing dates from booking form	
	if (isset($_POST['reStartDate'])){
		$dateFrom = $_POST['reStartDate'];
		$dateTo = $_POST['reEndDate'];
		$guestNo = $_POST['guests'];
	} elseif (isset($_POST['startDate'])){
		$dateFrom = $_POST['startDate'];
		$dateTo = $_POST['endDate'];
		$guestNo = $_POST['guests'];
	} elseif (isset($_GET['from'])){
		$dateFrom = $_GET['from'];
		$dateTo = $_GET['to'];
		$guestNo = $_GET['guest'];
	}
	
	$roomQuery = "SELECT * FROM `rooms` GROUP BY `room_type`, `disabled` ORDER BY `cost_single` ASC";
	$roomList_set = mysqli_query($cramond_db,$roomQuery);
	$roomSelector = '';
	
	/*
		Room selector codes
		No. of rooms/room_type/disabled (1 or 0)/full or single
		e.g.
		3-single-1-single
		1-family-0-full
		etc	
	*/
	
	switch ($guestNo){
		case 1: 
			// If 1 guest, display all room types with single occupancy price
			
			while ($roomList = mysqli_fetch_array($roomList_set)){
				$roomCode = $roomList['room_type'].'-'.$roomList['disabled'];
				
				if ($roomList['disabled'] == 1){					
					$roomSelector .= '<option value="1-'.$roomCode.'-'.$roomList['cost_single'].'">Disabled '.$roomList['room_type'].' Room: &pound;'.$roomList['cost_single'].'</option>';
				} else {
					$roomSelector .= '<option value="1-'.$roomCode.'-'.$roomList['cost_single'].'">'.$roomList['room_type'].' Room: &pound;'.$roomList['cost_single'].'</option>';
				}
			}
			break;
		case 2:
			// If 2 guests
			
				while ($roomList = mysqli_fetch_array($roomList_set)){
					$roomCode = $roomList['room_type'].'-'.$roomList['disabled'];
					// 2 x single rooms @ full price
					if ($roomList['room_type'] == 'single'){ 
						if ($roomList['disabled'] == 1){
							
							$roomSelector .= '<option value="2-'.$roomCode.'-'.$roomList['cost_single'].'">2x Disabled '.$roomList['room_type'].' Room: &pound;'.$roomList['cost_single'] * 2 .'</option>';
						} else {
							$roomSelector .= '<option value="2-'.$roomCode.'-'.$roomList['cost_single'].'">2x '.$roomList['room_type'].' Room: &pound;'.$roomList['cost_single'] * 2 .'</option>';
						}
					
					// double @ full price 	
					} elseif ($roomList['room_type'] == 'double'){
						if ($roomList['disabled'] == 1){
							$roomSelector .= '<option value="1-'.$roomCode.'-'.$roomList['cost_full'].'">Disabled '.$roomList['room_type'].' Room: &pound;'.$roomList['cost_full'].'</option>';
						} else {
							$roomSelector .= '<option value="1-'.$roomCode.'-'.$roomList['cost_full'].'">'.$roomList['room_type'].' Room: &pound;'.$roomList['cost_full'].'</option>';
						}
						
					// family rooms @ single price
					} else {
						if ($roomList['disabled'] == 1){
							$roomSelector .= '<option value="1-'.$roomCode.'-'.$roomList['cost_full'].'">Disabled '.$roomList['room_type'].' Room: &pound;'.$roomList['cost_full'].'</option>';
						} else {
							$roomSelector .= '<option value="1-'.$roomCode.'-'.$roomList['cost_full'].'">'.$roomList['room_type'].' Room: &pound;'.$roomList['cost_full'].'</option>';
						}
					}
				}
			break;
		case 3:
			// If 3 guests
				while ($roomList = mysqli_fetch_array($roomList_set)){
					$roomCode = $roomList['room_type'].'-'.$roomList['disabled'];
					// 3 x single rooms @ full price
					if ($roomList['room_type'] == 'single'){ 
						if ($roomList['disabled'] == 1){
							$roomSelector .= '<option value="3-'.$roomCode.'-'.$roomList['cost_single'].'">3x Disabled '.$roomList['room_type'].' Room: &pound;'.$roomList['cost_single'] * 3 .'</option>';
						} else {
							$roomSelector .= '<option value="3-'.$roomCode.'-'.$roomList['cost_single'].'">3x '.$roomList['room_type'].' Room: &pound;'.$roomList['cost_single'] * 3 .'</option>';
						}
					
					// 1 x double @ full + 1 x double @ single
					} elseif ($roomList['room_type'] == 'double'){
						if ($roomList['disabled'] == 1){
							$roomSelector .= '<option value="2-'.$roomCode.'-'.$roomList['cost_full'].'">2x Disabled '.$roomList['room_type'].' Room: &pound;'.($roomList['cost_full'] + $roomList['cost_single']).'</option>';
						} else {
							$roomSelector .= '<option value="2-'.$roomCode.'-'.$roomList['cost_full'].'">2x '.$roomList['room_type'].' Room: &pound;'.($roomList['cost_full'] + $roomList['cost_single']).'</option>';
						}
						
					// family rooms @ single price
					} else {
						if ($roomList['disabled'] == 1){
							$roomSelector .= '<option value="1-'.$roomCode.'-'.$roomList['cost_full'].'">Disabled '.$roomList['room_type'].' Room: &pound;'.$roomList['cost_full'].'</option>';
						} else {
							$roomSelector .= '<option value="1-'.$roomCode.'-'.$roomList['cost_full'].'">'.$roomList['room_type'].' Room: &pound;'.$roomList['cost_full'].'</option>';
						}
					}
				}
			break;
		case 4:
			// if 4 guests
				while ($roomList = mysqli_fetch_array($roomList_set)){
					$roomCode = $roomList['room_type'].'-'.$roomList['disabled'];
					// 4 x single rooms @ full price
					if ($roomList['room_type'] == 'single'){ 
						if ($roomList['disabled'] == 1){
							$roomSelector .= '<option value="4-'.$roomCode.'-'.$roomList['cost_single'].'">4x Disabled '.$roomList['room_type'].' Room: &pound;'.$roomList['cost_single'] * 4 .'</option>';
						} else {
							$roomSelector .= '<option value="4-'.$roomCode.'-'.$roomList['cost_single'].'">4x '.$roomList['room_type'].' Room: &pound;'.$roomList['cost_single'] * 4 .'</option>';
						}
					
					// 2 x double @ full
					} elseif ($roomList['room_type'] == 'double'){
						if ($roomList['disabled'] == 1){
							$roomSelector .= '<option value="2-'.$roomCode.'-'.$roomList['cost_full'].'">2x Disabled '.$roomList['room_type'].' Room: &pound;'.($roomList['cost_full'] * 2).'</option>';
						} else {
							$roomSelector .= '<option value="2-'.$roomCode.'-'.$roomList['cost_full'].'">2x '.$roomList['room_type'].' Room: &pound;'.($roomList['cost_full'] * 2).'</option>';
						}
						
					// 1 family rooms @ full
					} else {
						if ($roomList['disabled'] == 1){
							$roomSelector .= '<option value="1-'.$roomCode.'-'.$roomList['cost_full'].'">Disabled '.$roomList['room_type'].' Room: &pound;'.$roomList['cost_full'].'</option>';
						} else {
							$roomSelector .= '<option value="1-'.$roomCode.'-'.$roomList['cost_full'].'">'.$roomList['room_type'].' Room: &pound;'.$roomList['cost_full'].'</option>';
						}
					}
				}
			break;
	}
		
	
	
	// Check if user is logged in to auto-populate booking form
	if (isset($_SESSION['username'])){
		$loggedIn = true;
		$userDetails_set = mysqli_query($cramond_db,"SELECT * FROM `customers` WHERE `id` = '$userId'");
		$userDetails = mysqli_fetch_array($userDetails_set);
		
		// Date of birth is stored in DB as YYYY-DD-MM, split it into an array on each - symbol
		$dob = explode("-",$userDetails['date_of_birth']);
		
		$forename = $userDetails['forename'];
		$surname = $userDetails['surname'];
		$gender = $userDetails['gender'];
		
		// Get the array segment for the relevant Date of Birth data
		$dayBirth = $dob[1];
		$monthBirth = $dob[2];
		$yearBirth = $dob[0];
		
		$email = $userDetails['email'];
		$phone = $userDetails['phone'];
		$house = $userDetails['house'];
		$street = $userDetails['street'];
		$town = $userDetails['town'];
		$postcode = $userDetails['postcode'];
		$country = $userDetails['country'];
		$disability = $userDetails['disability_requirements'];		
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- Meta Tags here -->
		<meta name="description" content="Cramond Island Hotel -Booking Page">
		<meta name="keywords" content="cramond,island,hotel,edinburgh,luxury,booking,reservation,rooms">
		<meta name="author" content="Tavy Fraser">
		
		<title>Cramond Island Hotel - Bookings</title>

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
		
	</head>
	<body class="container-fluid">
		<?php include('./includes/header.php');?>
		<div class="row">
			<div class="col-sm-12 image-frame no-padding">
				<div class="image-banner">
					Bookings
				</div>
				<img class="img-responsive" src="./assets/booking-image.jpg" alt="Cramond Island Hotel Reception"/>
			</div>
		</div>
		<?php
			if (!isset($_SESSION['username'])){
				echo '
					<div class="row padding-0" style="margin:0;">
						<div class="col-sm-12">
							<div class="alert alert-warning alert-dismissible border2" role="alert">											
								This site stores User Information and Details securely and in accordance with the Data Protection Act 1998.</br>
								Your information will be used solely for Booking purposes and records, and will not be shared with any other parties.</br>
								<button class="btn btn-success" data-dismiss="alert" aria-label="Close">Accept</button></br>
							</div>
						</div>
					</div>
				';
			}
		?>
		<div class="row booking-backer">		
			<div class="col-sm-12">	
				<div class="col-sm-4">
					<!-- Change Dates Form -->
					<?php
						// If not logged in, pops up login box to make booking easier
						if (!isset($_SESSION['username'])){
							echo '
								<div class="col-sm-12 no-padding" style="margin:20px 0;">
									<!-- Log in Box -->
									<a class="btn btn-block btn-lg btn-success" data-toggle="modal" data-target="#loginModal">Log In?</a>
								</div>
							';
						}
					?>
					<form class="form-horizontal col-sm-12 no-padding" action="./bookings.php" method="POST">	
						<!-- Allow user to change dates -->
						Change Your Booking Date<hr>
						<div class="form-group">
							<label for="reStartDate" class="col-sm-2 control-label">Start Date</label>
							<div class="col-sm-10">							
								<input type="text" name="reStartDate" class="form-control" id="reStartDate" required value="<?php echo $dateFrom;?>">
							</div>
						</div>
						<div class="form-group">
							<label for="reEndDate" class="col-sm-2 control-label">End Date</label>
							<div class="col-sm-10">
								<input type="text" name="reEndDate" class="form-control" id="reEndDate" required  value="<?php echo $dateTo;?>">
							</div>
						</div>
						<div class="form-group">
							<label for="guests" class="col-sm-2 control-label">Number of Guests</label>
							<div class="col-sm-10">
								<select class="form-control" id="guests" name="guests" required>
									<?php
										for ($guests = 1; $guests <=4; $guests++){
											if ($guestNo == $guests){
												echo '<option selected value="'.$guests.'">'.$guests.'</option>';
											} else {
												echo '<option value="'.$guests.'">'.$guests.'</option>';
											}											
										}
									?>								
								</select>
							</div>
						</div>
						<div class="form-group padding">
							<input type="submit" class="btn btn-success btn-block" value="Change Dates"/>
						</div>
					</form>
				</div>
				
				
				<!-- Main Form -->
				<form class="form-horizontal" action="./includes/booking_process.php" method="POST">					
					<div class="col-sm-8 padding" style="border-left:2px solid black;">
						<!-- Show Rooms Available -->
						<div class="form-group">
							<label for="availableRooms" class="col-sm-12 control-label" style="text-align:left;">Available Rooms</label>
							<div class="col-sm-12">
								<select class="form-control capitals" id="availableRooms" name="availableRooms" required>
									<option value="" disabled selected>Select a Room...</option>
									<?php
										echo $roomSelector;
									?>
								</select>
							</div>
							<input type="hidden" name="dateFrom" value="<?php echo $dateFrom;?>"/>
							<input type="hidden" name="dateTo" value="<?php echo $dateTo;?>"/>
							<input type="hidden" name="guests" value="<?php echo $guestNo;?>"/>
						</div>
						
						<?php
							// Rest of form not required if logged in
							
							if(!isset($_SESSION['username'])){
							?>
							<div class="form-group">
								<label for="forename" class="col-sm-6 control-label" style="text-align:left;">Forename</label>
								<label for="surname" class="col-sm-6 control-label" style="text-align:left;">Surname</label>
								<div class="col-sm-6">
									<input type="text" name="forename" class="form-control" id="forename" required <?php if (isset($_SESSION['username'])){echo 'value="'.$forename.'"';} else {echo 'placeholder="Forename"';}?>/>
								</div>
								<div class="col-sm-6">
									<input type="text" name="surname" class="form-control" id="surname" required <?php if (isset($_SESSION['username'])){echo 'value="'.$surname.'"';} else {echo 'placeholder="Surname"';}?>/>
								</div>
							</div>
							<div class="form-group">
								<label for="gender" class="col-sm-3 control-label" style="text-align:left;">Gender</label>
								<label for="dayofbirth" class="col-sm-9 control-label" style="text-align:left;">Date of Birth</label>
								<div class="col-sm-3">
									<select class="form-control" id="gender" name="gender" required>									
										<?php
											if ($gender == 'female'){
												echo '
													<option value="female" selected>Female</option>
													<option value="male">Male</option>
												';
											} else {
												echo '
													<option value="female">Female</option>
													<option value="male" selected>Male</option>
												';
											}
										?>									
									</select>
								</div>
								<div class="col-sm-3">
									<select class="form-control" id="dayofbirth" name="dayofbirth" required>
										<?php
											// Generate days from 1 - 31
											for ($day = 1;$day <=31;$day++){
												// Add 'st' 'nd' 'rd' or 'th' to the day
												if ($day == 1||$day == 21||$day == 31){
													$postfix = 'st';
												} elseif ($day == 2||$day == 22){
													$postfix = 'nd';
												} elseif ($day == 3||$day == 23){
													$postfix = 'rd';
												} else {
													$postfix = 'th';
												}
												
												// If logged in, check if this date is users day of birth
												
												if ($dayBirth == $day){
													echo '<option value="'.$day.'" selected>'.$day.$postfix.'</option>';
												} else {
													echo '<option value="'.$day.'">'.$day.$postfix.'</option>';
												}
											}
										?>
									</select>
								</div>
								<div class="col-sm-3">
									<select class="form-control" id="monthofbirth" name="monthofbirth" required>
										<?php
											$monthNames = array("January","February","March","April","May","June","July","August","September","October","November","December");
											
											// For loop to select each month, starting from 0
											for ($month = 0;$month <=11;$month++){
												// Add one for actual month number
												$monthValue = $month + 1;	
												// if logged in, check if users month of birth
												if ($monthBirth == $monthValue){
													echo '<option value="'.$monthValue.'" selected>'.$monthNames[$month].'</option>';
												} else {
													echo '<option value="'.$monthValue.'">'.$monthNames[$month].'</option>';
												}
											}
										?>
									</select>
								</div>
								<div class="col-sm-3">
									<select class="form-control" id="yearofbirth" name="yearofbirth" required>
										<?php
											// Get current year to start Year of Birth select
											$currentYear = date("Y");
											
											for ($year = $currentYear; $year >= 1900; $year--){
												// if logged in, check if users year of birth
												if ($yearBirth == $year){
													echo '<option value="'.$year.'" selected>'.$year.'</option>';
												} else {
													echo '<option value="'.$year.'">'.$year.'</option>';
												}
											}
											
										?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="email" class="col-sm-6 control-label" style="text-align:left;">Email</label>
								<label for="phone" class="col-sm-6 control-label" style="text-align:left;">Phone Number</label>
								<div class="col-sm-6">
									<input type="email" name="email" class="form-control" id="email" required <?php if (isset($_SESSION['username'])){echo 'value="'.$email.'"';} else {echo 'placeholder="Email"';}?>/>
								</div>
								<div class="col-sm-6">
									<input type="text" name="phone" class="form-control" id="phone" required <?php if (isset($_SESSION['username'])){echo 'value="'.$phone.'"';} else {echo 'placeholder="Phone Number"';}?>/>
								</div>
							</div>
							<div class="form-group">
								<label for="house" class="col-sm-12 control-label" style="text-align:left;">House / Number</label>
								<div class="col-sm-12">
									<input type="text" name="house" class="form-control" id="house" required <?php if (isset($_SESSION['username'])){echo 'value="'.$house.'"';} else {echo 'placeholder="House / Number"';}?>/>
								</div>
							</div>
							<div class="form-group">
								<label for="street" class="col-sm-12 control-label" style="text-align:left;">Street</label>
								<div class="col-sm-12">
									<input type="text" name="street" class="form-control" id="street" required <?php if (isset($_SESSION['username'])){echo 'value="'.$street.'"';} else {echo 'placeholder="Street"';}?>/>
								</div>
							</div>
							<div class="form-group">
								<label for="town" class="col-sm-12 control-label" style="text-align:left;">Town / City</label>
								<div class="col-sm-12">
									<input type="text" name="town" class="form-control" id="town" required <?php if (isset($_SESSION['username'])){echo 'value="'.$town.'"';} else {echo 'placeholder="Town / City"';}?>/>
								</div>
							</div>
							<div class="form-group">
								<label for="postcode" class="col-sm-12 control-label" style="text-align:left;">Postcode</label>
								<div class="col-sm-12">
									<input type="text" name="postcode" class="form-control" id="postcode" required <?php if (isset($_SESSION['username'])){echo 'value="'.$postcode.'"';} else {echo 'placeholder="Postcode"';}?>/>
								</div>
							</div>
							<div class="form-group">
								<label for="country" class="col-sm-12 control-label" style="text-align:left;">Country</label>
								<div class="col-sm-12">
									<select name="country" id="country" class="form-control">
										<?php
											$country_array = array("United Kingdom","Afghanistan", "Aland Islands", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Barbuda", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Trty.", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Caicos Islands", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "French Guiana", "French Polynesia", "French Southern Territories", "Futuna Islands", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guernsey", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard", "Herzegovina", "Holy See", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Isle of Man", "Israel", "Italy", "Jamaica", "Jan Mayen Islands", "Japan", "Jersey", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea", "Korea (Democratic)", "Kuwait", "Kyrgyzstan", "Lao", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macao", "Macedonia", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "McDonald Islands", "Mexico", "Micronesia", "Miquelon", "Moldova", "Monaco", "Mongolia", "Montenegro", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "Nevis", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Palestinian Territory, Occupied", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Principe", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Barthelemy", "Saint Helena", "Saint Kitts", "Saint Lucia", "Saint Martin (French part)", "Saint Pierre", "Saint Vincent", "Samoa", "San Marino", "Sao Tome", "Saudi Arabia", "Senegal", "Serbia", "Seychelles", "Sierra Leone", "Singapore", "Slovakia", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia", "South Sandwich Islands", "Spain", "Sri Lanka", "Sudan", "Suriname", "Svalbard", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan", "Tajikistan", "Tanzania", "Thailand", "The Grenadines", "Timor-Leste", "Tobago", "Togo", "Tokelau", "Tonga", "Trinidad", "Tunisia", "Turkey", "Turkmenistan", "Turks Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "Uruguay", "US Minor Outlying Islands", "Uzbekistan", "Vanuatu", "Vatican City State", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (US)", "Wallis", "Western Sahara", "Yemen", "Zambia", "Zimbabwe");
											foreach ($country_array as $countryList){
												if ($country == $countryList){
													echo '<option value="'.$countryList.'" selected>'.$countryList.'</option>';
												} else {
													echo '<option value="'.$countryList.'">'.$countryList.'</option>';
												}
											}
										?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="disability" class="col-sm-12 control-label" style="text-align:left;">Disability Requirements</label>
								<div class="col-sm-12">
									<input type="text" name="disability" class="form-control" id="disability" <?php if (isset($_SESSION['username'])){echo 'value="'.$disability.'"';} else {echo 'placeholder="Disability Requirements"';}?>/>
								</div>
							</div>
						<?php
							}
						?>
						<div class="form-group">
							<div class="col-sm-6">
								<input type="submit" class="btn btn-success btn-block" value="Book"/>
							</div>
							<div class="col-sm-6">
								<input type="reset" class="btn btn-danger btn-block" value="Reset"/>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="row">
			<div class="booking-gradient"></div>
		</div>
		<?php include('./includes/footer.php');?>
	</body>
</html>