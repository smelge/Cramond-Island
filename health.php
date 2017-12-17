<?php
	include_once('./includes/security.php');
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- Meta Tags here -->
		<meta name="description" content="Cramond Island Hotel - Home page">
		<meta name="keywords" content="cramond,island,hotel,edinburgh,spa,gym,health,fitness,exercise,swimming,therapy,treatments,luxury">
		<meta name="author" content="Tavy Fraser">
		
		<title>Cramond Island Hotel - Health Spa</title>

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
		<?php include ('./includes/modals.php');?>
		<?php include ('./includes/scripts.php');?>
	</head>
	
	<body class="container-fluid">
		<?php include('./includes/header.php');?>			
		<div class="row item-block">
			<div class="col-sm-12">
				<div class="col-sm-6">
					<div class="item-content">
						<?php include('./includes/lipsum.txt');?>
						</br>
						<?php include('./includes/lipsum.txt');?>
						</br>
						<?php include('./includes/lipsum.txt');?>
					</div>
				</div>
				<div class="col-sm-6">
					<img class="img-responsive border5 no-padding pull-right" src="./assets/health1.jpg" alt="Try our luxury Spa"/>
				</div>
			</div>
		</div>
		<div class="row item-block">
			<div class="col-sm-12">				
				<div class="col-sm-6">
					<img class="img-responsive border5 no-padding" src="./assets/health2.jpg" alt="Experience our treatments"/>
				</div>
				<div class="col-sm-6">
					<div class="item-content">
						<?php include('./includes/lipsum.txt');?>
						</br>
						<?php include('./includes/lipsum.txt');?>
						</br>
						<?php include('./includes/lipsum.txt');?>
					</div>
				</div>
			</div>
		</div>
		<div class="row item-block">
			<div class="col-sm-12">
				<div class="col-sm-6">
					<div class="item-content">
						<?php include('./includes/lipsum.txt');?>
						</br>
						<?php include('./includes/lipsum.txt');?>
						</br>
						<?php include('./includes/lipsum.txt');?>
					</div>
				</div>
				<div class="col-sm-6">
					<img class="img-responsive border5 no-padding pull-right" src="./assets/health3.jpg" alt="Keep healthy in our fully stocked Gym"/>
				</div>
			</div>
		</div>
		<?php include('./includes/footer.php');?>
	</body>
</html>