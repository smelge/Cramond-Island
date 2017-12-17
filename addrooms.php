<?php
	include ('./includes/user_db.php');
	//Add 25 rooms per floor over 20 floors
	
	// 2 disabled single
	// 3 disabled double
	// 4 family
	// 6 single
	// 10 double
	
	$facilities = 'En-suite, Bath, Shower, Television, Netflix';
	
	$floorNo = 1;
	while ($floorNo <= 9){
		$roomNo = 0;
		while ($roomNo <= 25){
			$roomNum = str_pad($floorNo.$roomNo,3,'0',STR_PAD_LEFT);
			if ($roomNo == 0 || $roomNo == 1){
				// 2 Disabled 
				$capacity = 1;				
				$disabled = 1;
				$costSingle = 50;
				$costDouble = 0;
				$roomType = 'single';				
			} elseif ($roomNo == 2 || $roomNo == 3 || $roomNo == 4){
				// 3 Disabled Doubles
				$capacity = 2;				
				$disabled = 1;
				$costSingle = 65;
				$costDouble = 80;
				$roomType = 'double';					
			} elseif ($roomNo >= 5 && $roomNo <= 8){
				// 4 Family Rooms
				$capacity = 4;				
				$disabled = 0;
				$costSingle = 230;
				$costDouble = 230;
				$roomType = 'family';
			} elseif ($roomNo >= 9 && $roomNo <= 15){
				// 6 Single Rooms
				$capacity = 1;				
				$disabled = 0;
				$costSingle = 45;
				$costDouble = 0;
				$roomType = 'single';
			} else {
				// 10 Double Rooms
				$capacity = 2;				
				$disabled = 0;
				$costSingle = 55;
				$costDouble = 75;
				$roomType = 'double';
			}
			
			$roomQuery = 
					"
						INSERT INTO 
							`rooms` 
								(`room_no`,`capacity`,`facilities`,`disabled`,`cost_single`,`cost_full`,`room_type`)
							VALUES
								('$roomNum','$capacity','$facilities','$disabled','$costSingle','$costDouble','$roomType')
					";
			$roomNo++;
			
			// Insert into DB
			
			$addrooms = mysqli_query($cramond_db,$roomQuery) or die(mysqli_error($cramond_db));
		}	
		$floorNo++;
	}
	echo 'Rooms Added';
?>