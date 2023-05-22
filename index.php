<?php
$title = " | Court Complex Booking System";
$css = "static/css/index.css";
ob_start(); // Start output buffering
?>
	<!-- Navbar -->
		
	
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			<div class="container-fluid">
			<a class="navbar-brand" href="dashboard"><img src="static/images/CourtCom_Logo_more_stroke.png" width="135"></a>
				<!-- Left side of navbar -->
				<div class="navbar-nav me-auto">
					<a class="nav-link active nav-link-hover" aria-current="page" href="#">Home</a>
					<a class="nav-link active nav-link-hover" aria-current="page" href="#About">About Us</a>
				</div>

				<!-- Right side of navbar -->
				<div class="navbar-nav ms-auto">
					<a class="nav-link active nav-link-hover" aria-current="page" href="login">Login</a>
					<a class="nav-link active nav-link-hover" aria-current="page" href="signup">Sign Up</a>
				</div>
			</div>
		</nav>
		
		
		<section id="hero">
  		<div class="herocon">
   			 <div class="info">
      			<h2>BOOK YOUR FAVORITE SPORT ANYTIME! ANYWHERE!</h2>
      			<p>Discover CourtCom: Your all-in-one sports platform for court booking, rentals, and expert coaching. With a user-friendly interface, book courts effortlessly. Choose flexible rentals to fit your schedule and budget. Elevate your game with personalized coaching sessions. Join CourtCom today for convenience, flexibility, and professional expertise.</p>
    		</div>
 		 </div>
		</section>
	<section id="CourtRent">
		<div class="container">
        <h1>ARE YOU A COURT/GYM OWNER?</h1>
        <hr>
        <h2>Earn Money by Renting Your Court/Gym!</h2>
		
        <div class="boxitems">
            <div class="one">
                <h3>Additional Income</h3>
                <p>Renting out your court/gym brings in extra revenue for you.</p>
             
            </div>
            <div class="two">
                <h3>Increased Utilization</h3>
                <p> More people can use your court, leading to higher booking rates and better overall utilization.</p>
          
            </div>
            <div class="three">
                <h3> Enhanced Visibility and Promotion</h3>
                <p>Listing your court increases its visibility, attracting new users</p>
                
            </div>
        </div>
		<a href="signup" class="btn btn-primary">List Your Court</a>
    </div>
</section>
<section id="Coach">

        <div class="row">
            <div class="col-md-6 image-column">
                <img src="static/images/coach.jpg" alt="Image" class="img-fluid">
				
            </div>
            <div class="col-md-6 description-column">
                <h2>Welcome, Coaches!</h2>
                <p>Unlock your coaching potential and take your skills to the next level.</p>
				<a href="signup" class="btn btn-primary">Get Started</a>
			</div>
		</div>
		
</section>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<section id="About">
	<div class="main">
		<img src="static/images/CourtCom_Logo_more_stroke.png">
		<div class="about-text">
			<h1>About Us</h1>
			<p>Welcome to CourtCom! We are dedicated to making your sports and fitness experience seamless and convenient. Our user-friendly platform allows you to easily browse available time slots, select your preferred date and time, and secure your court or gym reservation with just a few clicks. We are committed to promoting an active lifestyle and providing facilities with an efficient system to manage bookings and optimize resources. Join us in our mission to make sports facilities more accessible to all and start your journey to a healthier you. Thank you for choosing CourtCom.</p>
		</div>
	</div>
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
<section id="team">
	<h2>Meet our Team</h2>

	<div class="teamcon">
		<div class="card">
			<div class="teamcontent">
				<div class="imgBx"><img src="static/images/randalpic.jpg"></div>
			<div class="contentBx">
				<h3>Randall Dela Pisa<br><span>Team Leader|UI/UX Designer</span></h3>
			</div>
			</div>
			<ul class="sci">
			<li style="--i:1">
				<a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
			</li>
			<li style="--i:2">
				<a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
			</li>
			<li style="--i:3">
				<a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
			</li>
		</ul>
		</div>
		<div class="card">
			<div class="teamcontent">
				<div class="imgBx"><img src="static/images/janinepic.jpg"></div>
			<div class="contentBx">
				<h3>Janine Ubal<br><span>UI/UX Designer|Front End Designer</span></h3>
			</div>
			</div>
			<ul class="sci">
			<li style="--i:1">
				<a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
			</li>
			<li style="--i:2">
				<a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
			</li>
			<li style="--i:3">
				<a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
			</li>
		</ul>
		</div>
		<div class="card">
			<div class="teamcontent">
				<div class="imgBx"><img src="static/images/navospic.jpg"></div>
			<div class="contentBx">
				<h3>Dominic Navos<br><span>Back End Developer|Front End Designer</span></h3>
			</div>
			</div>
			<ul class="sci">
			<li style="--i:1">
				<a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
			</li>
			<li style="--i:2">
				<a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
			</li>
			<li style="--i:3">
				<a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
			</li>
		</ul>
		</div>
		<div class="card">
			<div class="teamcontent">
				<div class="imgBx"><img src="static/images/ericsonpic.jpg"></div>
			<div class="contentBx">
				<h3>Ericson Anuada<br><span>Front End Designer</span></h3>
			</div>
			</div>
			<ul class="sci">
			<li style="--i:1">
				<a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
			</li>
			<li style="--i:2">
				<a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
			</li>
			<li style="--i:3">
				<a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
			</li>
		</ul>
		</div>
		<div class="card">
			<div class="teamcontent">
				<div class="imgBx"><img src="static/images/marpic.jpg"></div>
			<div class="contentBx">
				<h3>Mardon Dela Peña<br><span>Back End Developer</span></h3>
			</div>
			</div>
			<ul class="sci">
			<li style="--i:1">
				<a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
			</li>
			<li style="--i:2">
				<a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
			</li>
			<li style="--i:3">
				<a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
			</li>
		</ul>
		</div>
	</div>
</section>
<section id="foot">
	<div class="footcontent">
  <p>Copyright &copy; <script>document.write(new Date().getFullYear());</script>, CourtCom</p>
<ul class="socials">
                <li><a href="https://www.facebook.com/groups/804841717826396"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                <li><a href="#"><i class="fa fa-youtube"></i></a></li>
            </ul>
<div>
</section>
<div class="button">
    <a href="#"><i class="fa fa-arrow-up"></i></a>
  </div>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	

  
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