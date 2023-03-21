<!--Nav bar on top-->
	<div id="top-nav">
		<ul class="nav">
			<li class="nav-item">
				<a class="navbar-brand" href="index.php">Car Booking System</a>
			</li>
			<li class="nav-item">
		    	<a class="nav-link active" href="index.php">Home</a>
		  	</li>
		  	<li class="nav-item">
		    	<a class="nav-link active" href="bookinglist.php">Booking</a>
		  	</li>
		  	<li class="nav-item">
		    	<a class="nav-link" href="userlist.php">Users</a>
		  	</li>
		  	<li class="nav-item">
		    	<a class="nav-link" href="carlist.php">Car</a>
		  	</li>
		  	<li class="nav-item">
		  	  	<a class="nav-link" href="edituser.php?uid=<?php echo $_SESSION['uid'] ?>">profile</a>
		  	</li>
		  	<li class="nav-item">
		    	<a class="nav-link" href="../logout.php">log out</a>
		  	</li>
		</ul>
	</div>