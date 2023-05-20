<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: login");
    exit();
}

if ($_SESSION["usertype"] == "Court Owner" || $_SESSION["usertype"] == "User") {
    if ($_SESSION["usertype"] == "Court Owner") {
        header("Location: dashboard_court");
    } elseif ($_SESSION["usertype"] == "User") {
        header("Location: dashboard");
    }
    exit();
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="chrome=1.0, ie-edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>CourtCom | Coach Dashboard </title>
		<link rel="icon" type="image/x-icon" href="static/images/favicon.ico">
		<link rel="stylesheet" type="text/css" href="static/bootstrap/bootstrap-5.0.2-dist/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="static/css/dashboard.css">
	</head>
	<body class="bg-container">
		<div>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark" aria-label="Ninth navbar example">
	<div class="container-xl">
	  <a class="navbar-brand" href="dashboard_coach"><img src="static/images/CourtCom_Logo_more_stroke.png" width="135"></a>
	  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample07XL" aria-controls="navbarsExample07XL" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	  </button>
  
	  <div class="collapse navbar-collapse" id="navbarsExample07XL">
		<ul class="navbar-nav me-auto mb-2 mb-lg-0">
		  <li class="nav-item">
			<a class="nav-link active" aria-current="page" href="dashboard_coach">Main</a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" href="#">Court</a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" href="#">Coach</a>
		  </li>
		</ul>
		<div class="profile-icon" onclick="toggleSideMenu()">
		  <img src="static/images/user_icon.png" width="20">
		</div>
		<div class="side-menu">
		  <ul>
			<li><a href="#"><?php echo $_SESSION["fname"] . " " . $_SESSION["lname"]; ?></a></li>
			<li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
			<li><a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a></li>
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
		</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
	<script src="static/js/courtcom.js"></script>
	</body>
</html>