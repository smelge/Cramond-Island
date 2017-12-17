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
		<meta name="keywords" content="cramond,island,hotel,edinburgh,restaurant,menu,dining,vegetarian,luxury">
		<meta name="author" content="Tavy Fraser">
		
		<title>Cramond Island Hotel - Restaurant</title>

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
		
		<?php
			// If page selected is 'restaurant', display relevant content
			if (isset($_GET['p'])){
				if ($_GET['p'] == 'restaurant'){
					$pageContent = 
						'
							<div class="row" style="margin-bottom:20px;">
								<div class="col-sm-4 image-frame">
									<img class="img-responsive" src="./assets/eat3.jpg" alt="Eat in our Restaurant"/>
								</div>
								<div class="col-sm-8">
									<div class="col-sm-12 border5 content">
										Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam mi dui, tincidunt in lectus sollicitudin, 
										blandit aliquam risus. Donec sit amet lectus in lacus tempus viverra. Praesent id urna at erat fringilla 
										sodales quis et lorem. Nunc eu ultricies diam. Pellentesque maximus vestibulum molestie. Pellentesque congue 
										tristique nisl eget imperdiet. Pellentesque eget lacinia nunc.</br>
										</br>
										In accumsan lobortis neque vel efficitur. Nulla sodales, quam ac pretium feugiat, ligula metus elementum 
										ex, a tempor ligula magna eget magna. Nulla sed enim volutpat odio lobortis dapibus scelerisque nec purus. 
										Fusce sit amet lectus ligula. In est ligula, aliquam in mauris non, fermentum faucibus est. Sed eu ante 
										non lorem sagittis pharetra. Aliquam dolor nulla, gravida ultricies rhoncus et, facilisis sed massa. 
										Nullam gravida dui felis, in maximus urna iaculis nec. Ut laoreet vulputate est in vehicula. Vivamus 
										condimentum tempus elementum. Sed at accumsan risus. Ut interdum, nibh a congue egestas, nibh justo 
										venenatis libero, ac interdum lacus lectus ut ante. Mauris sed placerat sapien. Praesent nec odio purus.</br>
										</br>
										In accumsan lobortis neque vel efficitur. Nulla sodales, quam ac pretium feugiat, ligula metus elementum 
										ex, a tempor ligula magna eget magna. Nulla sed enim volutpat odio lobortis dapibus scelerisque nec purus. 
										Fusce sit amet lectus ligula. In est ligula, aliquam in mauris non, fermentum faucibus est. Sed eu ante 
										non lorem sagittis pharetra. Aliquam dolor nulla, gravida ultricies rhoncus et, facilisis sed massa. 
										Nullam gravida dui felis, in maximus urna iaculis nec. Ut laoreet vulputate est in vehicula. Vivamus 
										condimentum tempus elementum. Sed at accumsan risus. Ut interdum, nibh a congue egestas, nibh justo 
										venenatis libero, ac interdum lacus lectus ut ante. Mauris sed placerat sapien. Praesent nec odio purus.
									</div>
								</div>
							</div>
							<div class="row">
								<a href="./eat.php?p=menu">
									<div class="col-sm-6 col-sm-offset-3 image-frame no-padding">
										<div class="image-banner">
											Menus
										</div>
										<img class="img-responsive" src="./assets/eat2.jpg" alt="See our Menus"/>
									</div>
								</a>
							</div>						
						';
				} elseif ($_GET['p'] == 'menu'){
					// If page selected is 'menu', display relevant content
					$pageContent = 
						'
							<div class="row" style="margin-bottom:20px;">
								<div class="col-sm-4">
									<div class="menu-head">
										Menu 1
									</div>
									<div class="menu-content">
										Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam mi dui, tincidunt in lectus sollicitudin, 
										blandit aliquam risus. Donec sit amet lectus in lacus tempus viverra. Praesent id urna at erat fringilla 
										sodales quis et lorem. Nunc eu ultricies diam. Pellentesque maximus vestibulum molestie. Pellentesque congue 
										tristique nisl eget imperdiet. Pellentesque eget lacinia nunc.</br>
										</br>
										In accumsan lobortis neque vel efficitur. Nulla sodales, quam ac pretium feugiat, ligula metus elementum 
										ex, a tempor ligula magna eget magna. Nulla sed enim volutpat odio lobortis dapibus scelerisque nec purus. 
										Fusce sit amet lectus ligula. In est ligula, aliquam in mauris non, fermentum faucibus est. Sed eu ante 
										non lorem sagittis pharetra. Aliquam dolor nulla, gravida ultricies rhoncus et, facilisis sed massa. 
										Nullam gravida dui felis, in maximus urna iaculis nec. Ut laoreet vulputate est in vehicula. Vivamus 
										condimentum tempus elementum. Sed at accumsan risus. Ut interdum, nibh a congue egestas, nibh justo 
										venenatis libero, ac interdum lacus lectus ut ante. Mauris sed placerat sapien. Praesent nec odio purus.
									</div>
								</div>
								<div class="col-sm-4">
									<div class="menu-head">
										Menu 2
									</div>
									<div class="menu-content">
										Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam mi dui, tincidunt in lectus sollicitudin, 
										blandit aliquam risus. Donec sit amet lectus in lacus tempus viverra. Praesent id urna at erat fringilla 
										sodales quis et lorem. Nunc eu ultricies diam. Pellentesque maximus vestibulum molestie. Pellentesque congue 
										tristique nisl eget imperdiet. Pellentesque eget lacinia nunc.</br>
										</br>
										In accumsan lobortis neque vel efficitur. Nulla sodales, quam ac pretium feugiat, ligula metus elementum 
										ex, a tempor ligula magna eget magna. Nulla sed enim volutpat odio lobortis dapibus scelerisque nec purus. 
										Fusce sit amet lectus ligula. In est ligula, aliquam in mauris non, fermentum faucibus est. Sed eu ante 
										non lorem sagittis pharetra. Aliquam dolor nulla, gravida ultricies rhoncus et, facilisis sed massa. 
										Nullam gravida dui felis, in maximus urna iaculis nec. Ut laoreet vulputate est in vehicula. Vivamus 
										condimentum tempus elementum. Sed at accumsan risus. Ut interdum, nibh a congue egestas, nibh justo 
										venenatis libero, ac interdum lacus lectus ut ante. Mauris sed placerat sapien. Praesent nec odio purus.
									</div>
								</div>
								<div class="col-sm-4">
									<div class="menu-head">
										Vegetarian
									</div>
									<div class="menu-content">
										Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam mi dui, tincidunt in lectus sollicitudin, 
										blandit aliquam risus. Donec sit amet lectus in lacus tempus viverra. Praesent id urna at erat fringilla 
										sodales quis et lorem. Nunc eu ultricies diam. Pellentesque maximus vestibulum molestie. Pellentesque congue 
										tristique nisl eget imperdiet. Pellentesque eget lacinia nunc.</br>
										</br>
										In accumsan lobortis neque vel efficitur. Nulla sodales, quam ac pretium feugiat, ligula metus elementum 
										ex, a tempor ligula magna eget magna. Nulla sed enim volutpat odio lobortis dapibus scelerisque nec purus. 
										Fusce sit amet lectus ligula. In est ligula, aliquam in mauris non, fermentum faucibus est. Sed eu ante 
										non lorem sagittis pharetra. Aliquam dolor nulla, gravida ultricies rhoncus et, facilisis sed massa. 
										Nullam gravida dui felis, in maximus urna iaculis nec. Ut laoreet vulputate est in vehicula. Vivamus 
										condimentum tempus elementum. Sed at accumsan risus. Ut interdum, nibh a congue egestas, nibh justo 
										venenatis libero, ac interdum lacus lectus ut ante. Mauris sed placerat sapien. Praesent nec odio purus.
									</div>
								</div>
							</div>
							<div class="row">
								<a href="./eat.php?p=restaurant">
									<div class="col-sm-6 col-sm-offset-3 image-frame no-padding">
										<div class="image-banner">
											Forth View Restaurant
										</div>
										<img class="img-responsive" src="./assets/eat1.jpg" alt="Eat at the Forth View Restaurant"/>
									</div>
								</a>
							</div>						
						';
				}
			} else {
				// No specific page selected, show default page content
				$pageContent = 
					'
						<div class="row no-padding" style="margin-bottom:10px;">
							<div class="col-sm-12 image-frame no-padding">
								<img class="img-responsive" src="./assets/eatmain.jpg" alt="Forth View Restaurant"/>
							</div>
						</div>
						<div class="row">
							<a href="./eat.php?p=restaurant">
								<div class="col-sm-6 image-frame no-padding">
									<div class="image-banner">
										Forth View Restaurant
									</div>
									<img class="img-responsive" src="./assets/eat1.jpg" alt="Eat at the Forth View Restaurant"/>
								</div>
							</a>
							<a href="./eat.php?p=menu">
								<div class="col-sm-6 image-frame no-padding">
									<div class="image-banner">
										Menus
									</div>
									<img class="img-responsive" src="./assets/eat2.jpg" alt="See our Menus"/>
								</div>
							</a>
						</div>
					';
			}
		?>
	</head>
	<body class="container-fluid">
		<?php 
			include('./includes/header.php');
			// Show the content
			echo $pageContent;
		?>			
		
		<?php include('./includes/footer.php');?>
	</body>
</html>