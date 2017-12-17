<div class="row no-padding">
	<div class="col-sm-12 header">
		<a href="./index.php">
			<div class="col-sm-2 logo-image">
				<img class="img-responsive" src="./assets/cramond-logo.png" alt="Cramond Island Logo"/>
			</div>
		</a>
		<div class="col-sm-10 align-right">
			<a href="./index.php">
				<div class="col-sm-12 site-title">
					Cramond Island Hotel & Health Spa
				</div>
			</a>
			<div class="col-sm-12 navigation">
				<ul>
					<a data-toggle="modal" data-target="#bookingModal"><li>bookings</li></a>
					<a href="./eat.php"><li>restaurant</li></a>
					<a href="./health.php"><li>health spa</li></a>
					<?php
						if (isset($_SESSION['username'])){
							//Logged In							
							if ($_SESSION['account'] == 1){
								echo '
									<!-- Admin Menu Items -->
									<a href="./admin/booked.php"><li>Admin</li></a>									
								';
							} else {
								echo '
									<li>'.$_SESSION['customer'].'
										<ul>
											<a href="./mybookings.php"><li>My Bookings</li></a>
									';	
							}
							echo '
										<a data-toggle="modal" data-target="#logOutModal"><li>Log Out</li></a>
									</ul>
								</li>
							';
						} else {
							//Logged Out
							echo '<a data-toggle="modal" data-target="#loginModal"><li>log in</li></a>';
						}
					?>
					
				</li>
			</div>
		</div>		
	</div>
</div>
<!-- Solid black block for STYLE -->
<div class="row">
	<div class="col-sm-12 header-block"></div>
</div>
<!-- Gradient to segue from black to white -->
<div class="row">
	<div class="col-sm-12 header-gradient"></div>
</div>

<!-- Alert box for status notifications -->

<?php
	if (isset($_GET['e'])){
		echo '
			<div class="row no-padding">
				<div class="col-sm-12">
					<div class="alert alert-'.alertGrade($_GET['lv']).' alert-dismissible border2" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						'.alertMessage($_GET['e']).'
					</div>
				</div>
			</div>
		';
	}
?>