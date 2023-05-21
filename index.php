<?php
$title = " | Court Complex Booking System";
$css = "static/css/index.css";
ob_start(); // Start output buffering
?>
	<!-- Navbar -->
	<div class="container">
	<div class="first-part">
		<nav class="navbar navbar-expand-lg navbar-light ">
			<div class="container-fluid">
			<a class="navbar-brand" href="dashboard"><img src="static/images/CourtCom_Logo_more_stroke.png" width="135"></a>
				<!-- Left side of navbar -->
				<div class="navbar-nav me-auto">
					<a class="nav-link active nav-link-hover" aria-current="page" href="/CourtCom">Home</a>
					<a class="nav-link active nav-link-hover" aria-current="page" href="#How">About Us</a>
				</div>

				<!-- Right side of navbar -->
				<div class="navbar-nav ms-auto">
					<a class="nav-link active nav-link-hover" aria-current="page" href="login">Login</a>
					<a class="nav-link active sign-up" aria-current="page" href="signup">Sign Up</a>
				</div>
			</div>
		</nav>
		</div>
		</div>
		<section id="hero">
  		<div class="herocon">
   			 <div class="info">
      			<h2>BOOK YOUR FAVORITE SPORT ANYTIME! ANYWHERE!</h2>
      			<p>Discover CourtCom, your all-in-one sports platform for easy court booking, flexible rentals, and expert coaching. With a user-friendly interface, book your preferred courts effortlessly. Choose from various rental options to fit your schedule and budget. Elevate your game with personalized coaching sessions. Join CourtCom today and experience convenience, flexibility, and professional expertise.</p>
    		</div>
 		 </div>
		</section>
	<section id="CourtRent">
		<p>Court Rental</p>
		
</section>
<section id="Coach">
	Coach Services
</section>
<section id="How">
	Our Services
	<div class="con">
		
		<div class="box">
			<h2>01</h2>
			<h3>Easy Court Booking</h3>
			<p>Effortlessly book your preferred courts with our user-friendly platform.</p>
		</div>
	</div>
	<div class="con">
		<div class="box">
			<h2>02</h2>
			<h3>Court Rental Marketplace</h3>
			<p> List and rent out your own courts, connecting court owners with users in need of a space.</p>
		</div>
	</div>
	<div class="con">
		<div class="box">
			<h2>03</h2>
			<h3>Expert Coaching Services</h3>
			<p> Improve your skills with personalized training sessions from experienced coaches.</p>
		</div>
	</div>
</section>
<div class="button">
    <a href="#"><i class="fa fa-arrow-up"></i></a>
  </div>

	
<script>
	document.getElementById("button").addEventListener("click", function() {
  window.scrollTo({
    top: 0,
    behavior: "smooth" // This creates a smooth scrolling effect
  });
});
</script>
 
<?php

$content = ob_get_clean(); // Get the buffered output and clear the buffer
require_once "layout.php";
?>