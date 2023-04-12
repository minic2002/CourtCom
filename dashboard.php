<?php
	$title = "";
	$css = 'static/css/dashboard.css';
	$content = '
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark" aria-label="Ninth navbar example">
	<div class="container-xl">
	  <a class="navbar-brand" href="#"><img src="static/images/CourtCom_Logo_more_stroke.png" width="150"></a>
	  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample07XL" aria-controls="navbarsExample07XL" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	  </button>
  
	  <div class="collapse navbar-collapse" id="navbarsExample07XL">
		<ul class="navbar-nav me-auto mb-2 mb-lg-0">
		  <li class="nav-item">
			<a class="nav-link active" aria-current="page" href="/CourtCom">Main</a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" href="/CourtCom">Court</a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" href="/CourtCom">Coach</a>
		  </li>
		</ul>
		<div class="profile-icon" onclick="toggleSideMenu()">
		  <img src="static/images/user_icon.png" width="20">
		</div>
		<div class="side-menu">
		  <ul>
			<li><a href="#">Profile</a></li>
			<li><a href="#">Settings</a></li>
			<li><a href="/CourtCom">Logout</a></li>
		  </ul>
		</div>
	  </div>
	</div>
  </nav>
    
	<script>
		function toggleSideMenu() {
			document.querySelector(".side-menu").classList.toggle("active");
			document.addEventListener("click", function(event) {
				const target = event.target;
				if (!target.closest(".side-menu") && !target.closest(".profile-icon")) {
					document.querySelector(".side-menu").classList.remove("active");
				}
			});
		}
	</script>
	';
	
	require_once('layout_2.php');
?>

