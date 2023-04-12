<?php
	$title = " | Court Complex Booking System";
	$css = "static/css/index.css";
	$content = '
		<!-- Navbar -->
		<div class="first-part">
		<nav class="navbar navbar-expand-lg navbar-light ">
			<div class="container-fluid">
				<!-- Left side of navbar -->
				<div class="navbar-nav me-auto">
					<a class="nav-link active" aria-current="page" href="/CourtCom">Home</a>
					<a class="nav-link active" aria-current="page" href="#">About Us</a>
				</div>

				<!-- Right side of navbar -->
				<div class="navbar-nav ms-auto">
					<a class="nav-link active" aria-current="page" href="login.php">Login</a>
					<a class="nav-link active" aria-current="page" href="signup.php">Sign Up</a>
				</div>
			</div>
		</nav>

			<!-- Logo and description -->
			<div class="container-fluid logo-desc">
				<div class="logo-container">
					<a href="/CourtCom"><img src="static/images/CourtCom_Logo_more_stroke.png" alt="Logo" class="img-fluid logo"></a>
				</div>
				<p class="text-left text-white txt-shadow">A Web Platform for Court Complex Booking System</p>
			</div>
		</div>
	';
	require_once('layout.php');
?>