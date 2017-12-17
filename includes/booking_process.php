<?php
	session_start();
	
	// Load essential files	
	include_once('./user_db.php'); //$cramond_db
	
	// Debug
	/*
	print_r($_POST);
	echo '<hr>';
	*/
	// Get the type of room booked
	$bookingType = explode("-",$_POST['availableRooms']);
	$bookingRoomNo = $bookingType[0];
	$bookingRoom = $bookingType[1];
	$bookingDisabled = $bookingType[2];
	$bookingPrice = $bookingType[3];
	
	// Get dates and guests
	
	$dateFrom = $_POST['dateFrom'];
	$dateFrom = date("Y-m-d", strtotime($dateFrom));
	$dateTo = $_POST['dateTo'];
	$dateTo = date("Y-m-d", strtotime($dateTo));
	$guests = $_POST['guests'];
	
	if (isset($_SESSION['username'])){
		// Logged in, set variables & add booking details
		$userId = $_SESSION['userId'];
	} else {
		// Not registered or not logged in
		$email = $_POST['email'];
		
		$checkEmail_set = mysqli_query($cramond_db, "SELECT * FROM `customers` WHERE `email` = '$email'");
		if (mysqli_num_rows($checkEmail_set) == 1){
			// Email already registered
			header('Location: ../bookings.php?e=plog&lv=2&from='.$dateFrom.'&to='.$dateTo.'&guest='.$guests);
		}
		
		// Unregistered user, create account, strip tags to avoid unpleasantness getting into the database
		
		$forename = strip_tags($_POST['forename']);
		$surname = strip_tags($_POST['surname']);
		$gender = strip_tags($_POST['gender']);
		$day_of_birth = strip_tags($_POST['dayofbirth']);
		$month_of_birth = strip_tags($_POST['monthofbirth']);
		$year_of_birth = strip_tags($_POST['yearofbirth']);
			$dateOfBirth = $year_of_birth.'-'.$month_of_birth.'-'.$day_of_birth;
			
		$phone = strip_tags($_POST['phone']);
		$email = strip_tags($_POST['email']);
		$house = strip_tags($_POST['house']);
		$street = strip_tags($_POST['street']);
		$town = strip_tags($_POST['town']);
		$postcode = strip_tags($_POST['postcode']);
		$country = strip_tags($_POST['country']);
		$disability_requirements = strip_tags($_POST['disability']);
			if ($_POST['disability'] == true){
				$disability = 1;
			} else {
				$disability = 0;
			}
		
		// Generate salt and password
		$salt = '$5$'.md5(time());	
		$password = crypt($forename.$surname,$salt);
		
		// Insert into Database
		$newCustomerQuery = 
			"
				INSERT INTO
					`customers`
					(
						`forename`,
						`surname`,
						`gender`,
						`date_of_birth`,
						`phone`,
						`email`,
						`house`,
						`street`,
						`town`,
						`postcode`,
						`country`,
						`disability`,
						`disability_requirements`,
						`password`,
						`salt`
					)
				VALUES
					(
						'$forename',
						'$surname',
						'$gender',
						'$dateOfBirth',
						'$phone',
						'$email',
						'$house',
						'$street',
						'$town',
						'$postcode',
						'$country',
						'$disability',
						'$disability_requirements',
						'$password',
						'$salt'
					)
			";
		// If the account cannot be created, display URL error
		if(!mysqli_query($cramond_db,$newCustomerQuery)){
			mysqli_error($cramond_db);
			header('Location: ../index.php?e=accfail&lv=1');
		} else {
			// Get customer_id
			$userId = mysqli_insert_id($cramond_db);
			// Send email to customer with account name and password
			$subject = 'Cramond Island Hotel Registration & Bookings';
			$body = 
				'
Thank you for booking and registering with Cramond Island Hotel.

Your login details are as follows:
Username: '.$email.'
Password: '.$forename.$surname.'

Please log in to view your bookings. We will contact you within 24 hours to arrange payment and confirm your booking.

Thank You from Cramond Island Hotel!
				';
			$headers = 'From: bookings@cramondisland.co.uk';
			
			mail($email,$subject,$body,$headers);
		}
	}

	// Make booking
	// Generate Booking Number
		/* Booking No Structure:
			1/2 - Customer Initials
			3/4/5 - Day of year
			6/7 - Year
			8/9/10 - Randomised characters
		*/
		
		// Generate random 3 character string from allowed characters, ignoring easily confused combinations such as I and 1
		$Allowed_Characters = '23456789ABCDEFGHJLKMNOPQRSTUVWXYZ';
		$randomBookingString = substr(str_shuffle($Allowed_Characters), 0, 3);
		// Create full unique booking number
		$getUser_set = mysqli_query($cramond_db, "SELECT * FROM `customers` WHERE `id` = '$userId'");
		$getUser = mysqli_fetch_array($getUser_set);
		$bookingNo = substr($getUser['forename'],0,1).substr($getUser['surname'],0,1).date("z").date("y").$randomBookingString;	
		
				

		// Find and assign room numbers
		$roomNumbers = '';
		
		print_r($_POST);
		echo '<hr>';
		
		$getRoomQuery = "SELECT * FROM `rooms` WHERE `room_type` = '$bookingRoom' AND `disabled` = '$bookingDisabled'";
		$getRoom_set = mysqli_query($cramond_db,$getRoomQuery);
		
		while($roomsBooked < $bookingRoomNo){
			while ($getRoom = mysqli_fetch_array($getRoom_set)){
				if ($roomsBooked < $bookingRoomNo){
					$checkRoomNo = $getRoom['room_no'];
					$bookingQuery = "
						INSERT INTO `bookings` 
							(`booking_number`,`room_no`,`customer_id`,`requirements`,`date_from`,`date_to`,`no_booked`,`cost`)
						VALUES
							('$bookingNo','$checkRoomNo','$userId','$bookingDisabled','$dateFrom','$dateTo','$guests','$bookingPrice')
					";
					if(!mysqli_query($cramond_db,$bookingQuery)){
						mysqli_error($cramond_db);
					}
					$roomsBooked++;
				}
			}
			echo $getRoom['room_no'].'</br>';
		}
		/*	
		$rooms_booked = 0;
		while ($getRoom = mysqli_fetch_assoc($getRoom_set)){
			$checkRoomNo = $getRoom['room_no'];
			$checkAvailable_set = mysqli_query($cramond_db,"SELECT * FROM `bookings` WHERE `room_no` = '$checkRoomNo'");
			
			// We need to check if there are enough available rooms
			while ($checkAvailable = mysqli_fetch_array($checkAvailable_set)){					
				if ($dateFrom > $checkAvailable['date_from'] && $dateFrom < $checkAvailable['date_to']){
					// Room cannot be booked, try again
				} elseif ($dateTo > $checkAvailable['date_from'] && $dateTo < $checkAvailable['date_to']){
					// Room cannot be booked, try again
				} else {
					$availableRooms++;
				}
			}
			
			if ($availableRooms >= $bookingRoomNo){
				while ($rooms_booked < $bookingRoomNo){
					// Get room number and check if dates available				
					$checkDate_set = mysqli_query($cramond_db,"SELECT * FROM `bookings` WHERE `room_no` = '$checkRoomNo'");
					$checkDate_results = mysqli_num_rows($checkDate_set);
					
					// Check if dates available
					if ($checkDate_results != 0){
						echo '<hr>Bookings made for this room<hr>';
						while ($checkDate = mysqli_fetch_array($checkDate_set)){					
							if ($dateFrom > $checkDate['date_from'] && $dateFrom < $checkDate['date_to']){
								// Room cannot be booked, try again
							} elseif ($dateTo > $checkDate['date_from'] && $dateTo < $checkDate['date_to']){
								// Room cannot be booked, try again
							} else {
								$bookingQuery = "
									INSERT INTO `bookings` 
										(`booking_number`,`room_no`,`customer_id`,`requirements`,`date_from`,`date_to`,`no_booked`,`cost`)
									VALUES
										('$bookingNo','$checkRoomNo','$userId','$bookingDisabled','$dateFrom','$dateTo','$guests','$bookingPrice')
								";
								
								if(!mysqli_query($cramond_db,$bookingQuery)){
									mysqli_error($cramond_db);
									// Room did not book
								}
								// Room booked
								$rooms_booked++;
							}							
						}					
					} else {
						// Room is free, book
						
						$bookingQuery = "
							INSERT INTO `bookings` 
								(`booking_number`,`room_no`,`customer_id`,`requirements`,`date_from`,`date_to`,`no_booked`,`cost`)
							VALUES
								('$bookingNo','$checkRoomNo','$userId','$bookingDisabled','$dateFrom','$dateTo','$guests','$bookingPrice')
						";
						
						if(!mysqli_query($cramond_db,$bookingQuery)){
							mysqli_error($cramond_db);
							// Did not book
						} else {
							// Booked
							$rooms_booked++;
						}
					}
				}	
			} else {
				header('Location: ../mybookings.php?e=nospace&lv=1');
			}	
		}*/
		// Send user to relevant page
		if (isset($_SESSION['username'])){
			// Go to myBookings.php
			header('Location: ../mybookings.php?e=booked&lv=3');
		} else {
			// go to index with check email message
			header('Location: ../index.php?e=email&lv=3');
		}
?>