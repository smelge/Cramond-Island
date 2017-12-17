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
		<meta name="keywords" content="cramond,island,hotel,edinburgh,spa,gym,health,restaurant,luxury">
		<meta name="author" content="Tavy Fraser">
		
		<title>Cramond Island Hotel</title>

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
		<!-- Text left, image right -->
		<div class="row item-block flexsection">
			<div class="col-sm-7 no-padding pull-left">
				<div class="col-sm-12 item-head">
					Beautiful Sea Views
				</div>
				<div class="item-content">
					<?php include('./includes/lipsum.txt');?>
				</div>
			</div>
			<div class="col-sm-4 col-sm-offset-1 no-padding pull-right border">
				<img src="./assets/index1.jpg" alt="Cramond Island from the shore" class="img-responsive"/>
			</div>
		</div>
		<!-- Text right, image left -->
		<div class="row">
			<div class="col-sm-12">
				<div class="col-sm-4 border" style="padding-left:10px;">
					<img src="./assets/index2.jpg" alt="Cramond Island from the shore" class="img-responsive"/>
				</div>
				<div class="col-sm-7 col-sm-offset-1">
					<div class="col-sm-12 item-head">
						Historic Cramond
					</div>
					<div class="item-content">
						<?php include('./includes/lipsum.txt');?>
					</div>
				</div>
			</div>
		</div>
		<!-- Text left, image right -->
		<div class="row item-block clearfix">
			<div class="col-sm-12">
				<div class="col-sm-7">					
					<div class="col-sm-12 item-head">
						The Jewel of the Forth
					</div>
					<div class="item-content">
						<?php include('./includes/lipsum.txt');?>
					</div>
				</div>
				<div class="col-sm-4 col-sm-offset-1 lg-index-image">
					<img src="./assets/index3.jpg" alt="Cramond Island hotel and the Bridges" class="img-responsive"/>
				</div>				
			</div>
		</div>
		<?php include('./includes/footer.php');?>
	</body>
</html>