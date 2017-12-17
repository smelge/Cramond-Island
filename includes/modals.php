<!-- Modals For Cramond Island Hotel -->


<!-- Log In -->
<div class="modal fade" tabindex="-1" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="loginModalLabel">Log In</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" action="./includes/login_process.php" method="POST">
					<?php
						// If coming from booking form, retain dates and guest number
						if (isset($_POST['startDate']) || isset($_POST['reStartDate'])){
							echo '
								<div class="form-group">
									<input type="hidden" name="dateFrom" value="'.$dateFrom.'"/>
									<input type="hidden" name="dateTo" value="'.$dateTo.'"/>
									<input type="hidden" name="guests" value="'.$guestNo.'"/>
									<input type="hidden" name="destination" value="booking"/>
								</div>
							';
						}
					?>
				
				
					<div class="form-group">
						<label for="username" class="col-sm-2 control-label">Email</label>
						<div class="col-sm-10">
							<input type="email" name="username" class="form-control" id="username" required placeholder="Email">
						</div>
					</div>
					<div class="form-group">
						<label for="password" class="col-sm-2 control-label">Password</label>
						<div class="col-sm-10">
							<input type="password" name="password" class="form-control" id="password" required placeholder="Password">
						</div>
					</div>
					<div class="form-group padding">
						<input class="btn btn-success btn-block" type="submit" value="Submit"/>
						<a class="btn btn-danger btn-block" data-dismiss="modal" aria-label="Close">Cancel</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- Log Out -->
<div class="modal fade" tabindex="-1" id="logOutModal" tabindex="-1" role="dialog" aria-labelledby="logOutModalLabel" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="logOutModalLabel">Log Out</h4>				
			</div>
			<div class="modal-body">
				<a class="btn btn-danger btn-lg btn-block" href="./includes/login_process.php">Log Out?</a>
			</div>
		</div>
	</div>
</div>

<!-- Admin Log Out -->
<!-- Needs its own script as the route to the directory for logout is different to regular logout -->
<div class="modal fade" tabindex="-1" id="adminLogOutModal" tabindex="-1" role="dialog" aria-labelledby="adminLogOutModalLabel" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="adminLogOutModalLabel">Log Out</h4>				
			</div>
			<div class="modal-body">
				<a class="btn btn-danger btn-lg btn-block" href="../includes/login_process.php">Log Out?</a>
			</div>
		</div>
	</div>
</div>


<!-- Booking -->

<div class="modal fade" tabindex="-1" id="bookingModal" tabindex="-1" role="dialog" aria-labelledby="bookingModalLabel" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="bookingModalLabel">Booking</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" action="./bookings.php" method="POST">
					<div class="form-group">
						<label for="startDate" class="col-sm-2 control-label">Start Date</label>
						<div class="col-sm-10">
							<input type="text" name="startDate" class="form-control" id="startDate" required placeholder="dd/mm/yyyy">
						</div>
					</div>
					<div class="form-group">
						<label for="endDate" class="col-sm-2 control-label">End Date</label>
						<div class="col-sm-10">
							<input type="text" name="endDate" class="form-control" id="endDate" required placeholder="dd/mm/yyyy">
						</div>
					</div>
					<div class="form-group">
						<label for="guests" class="col-sm-2 control-label">Number of Guests</label>
						<div class="col-sm-10">
							<select class="form-control" id="guests" name="guests" required>
								<?php
									for ($guests = 1; $guests <=4; $guests++){
										echo '<option value="'.$guests.'">'.$guests.'</option>';
									}
								?>								
							</select>
						</div>
					</div>
					<div class="form-group padding">
						<input class="btn btn-success btn-block" type="submit" value="Check Dates"/>
						<a class="btn btn-danger btn-block" data-dismiss="modal" aria-label="Close">Cancel</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>