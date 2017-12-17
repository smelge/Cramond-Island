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
			// Load modal windows
			include_once ('../includes/modals.php');
		?>
	</head>
	<body class="container-fluid">
		<!-- Debug Window -->

		<div class="row">
			<div class="col-sm-12 debug">
				<span>Debug Window</span>
				<hr style="margin:5px 0;width:10%;border:1px solid black;">
				<?php
					if (isset($_SESSION['username'])){
						echo 'Debug - Logged In as '.$_SESSION['username'].'</br>';
						echo 'SESSION Variables: ';
						print_r($_SESSION);
					} else {
						echo 'Debug - Logged Out<br>';
					}
					
					// Generate salt & password prior to registration system functionality
					
					//$salt = '$5$'.md5(time());			
					//$password = 'cramondisland';
					
					/*
					$salt = '$5$c5f5b0334933bddaf6a5fbd1b1bf31e0';
					echo '</br>Salt: '.$salt.'</br>';
					echo 'Password: '.crypt($password,$salt);
					*/
				?>
			</div>
		</div>
		<?php include ('./admin_includes/adminheader.php');?>

		<div class="row item-block">
			Welcome to admin
		</div>
		<?php include('../includes/footer.php');?>
	</body>
</html>