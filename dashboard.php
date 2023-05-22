<?php
//START OF SESSION
session_start();

// Check if user is logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: login");
    exit();
}

// Check if user is a Court Owner or Coach
if ($_SESSION["usertype"] == "Court Owner" || $_SESSION["usertype"] == "Coach") {
    // Redirect user to the appropriate dashboard
    if ($_SESSION["usertype"] == "Court Owner") {
        header("Location: dashboard_court");
    } else {
        header("Location: dashboard_coach");
    }
    exit();
}
//END OF SESSION
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="chrome=1.0, ie-edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>CourtCom | User Dashboard </title>
		<link rel="icon" type="image/x-icon" href="static/images/favicon.ico">
		<link rel="stylesheet" type="text/css" href="static/bootstrap/bootstrap-5.0.2-dist/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="static/css/dashboard.css">
	</head>
	<body class="bg-container">
		<!--NAVIGATION BAR-->
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			<div class="container-xl">
				<a class="navbar-brand" href="dashboard"><img src="static/images/CourtCom_Logo_more_stroke.png" width="135"></a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample07XL" aria-controls="navbarsExample07XL" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarsExample07XL">
				<ul class="navbar-nav me-auto mb-2 mb-lg-0">
					<li class="nav-item active">
					<a class="nav-link active" aria-current="page" href="#">Main</a>
					</li>
					<li class="nav-item">
					<a class="nav-link" href="courts">Court</a>
					</li>
					<li class="nav-item">
					<a class="nav-link" href="coaches">Coach</a>
					</li>
					<li class="nav-item">
					<a class="nav-link" href="#">Categories</a>
					</li>
				</ul>
				<div class="profile-icon" onclick="toggleSideMenu()">
					<img src="<?php echo $_SESSION["user_pic"]; ?>" width="20">
				</div>
				<div class="side-menu">
					<ul>
					<li><a href="#"><?php echo $_SESSION["fname"] . " " . $_SESSION["lname"]; ?></a></li>
					<li><a href="bookings"><i class="fa fa-clock-o"></i> Bookings </a></li>
					<li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
					<li><a href="logout"><i class="fa fa-sign-out"></i> Logout</a></li>
					</ul>
				</div>
				</div>
			</div>
		</nav>
		<!--END OF NAVIGATION BAR-->

		<!--DISPLAY COURTS-->
		<div >
			<div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
			<div class="carousel-indicators">
				<?php
				// Your database connection code here
				include "userdb.php";
				// Your query here
				$query = "SELECT court.court_id, court.court_name, court.court_image, users.fname, users.lname FROM court INNER JOIN users ON court.user_ID = users.user_id INNER JOIN review_court ON review_court.court_id = court.court_id GROUP BY court.court_id, court.court_name, court.court_image, users.fname, users.lname HAVING AVG(review_court.rate) >= 3.8 ORDER BY AVG(review_court.rate) DESC";

				// Execute the query
				$result = mysqli_query($conn, $query);

				// Check if the query was successful
				if ($result) {
					// Loop through the results and display the indicators
					$count = 0;
					while ($row = mysqli_fetch_assoc($result)) {
					$active = "";
					if ($count == 0) {
						$active = "active";
					}
				?>
					<button type="button" data-bs-target="#myCarousel" data-bs-slide-to="<?php echo $count; ?>" class="<?php echo $active; ?>" aria-label="Slide <?php echo $count+1; ?>" aria-current="<?php echo $count == 0 ? 'true' : 'false'; ?>"></button>
				<?php
					$count++;
					}
					// Free result set
					mysqli_free_result($result);
				} else {
					echo "Error: " . mysqli_error($conn);
				}

				// Close the database connection
				mysqli_close($conn);
				?>
			</div>

			<div class="carousel-inner">
				<?php
				// Your database connection code here
				include "userdb.php";
				// Your query here
				$query = "SELECT court.court_id, court.court_name, court.court_image, users.fname, users.lname FROM court INNER JOIN users ON court.user_ID = users.user_id INNER JOIN review_court ON review_court.court_id = court.court_id GROUP BY court.court_id, court.court_name, court.court_image, users.fname, users.lname HAVING AVG(review_court.rate) >= 3.8 ORDER BY AVG(review_court.rate) DESC";

				// Execute the query
				$result = mysqli_query($conn, $query);

				// Check if the query was successful
				if ($result) {
					// Loop through the results and display them
					$count = 0;
					while ($row = mysqli_fetch_assoc($result)) {
					$active = "";
					if ($count == 0) {
						$active = "active";
					}
				?>
					<div class="carousel-item <?php echo $active; ?>">
						<img src="<?php echo $row['court_image']; ?>" class="d-block w-100 crop-img" alt="<?php echo $row['court_name']; ?>">
						<div class="container">
						<div class="carousel-caption text-start">
							<h1><?php echo $row['court_name']; ?></h1>
							<p>Owned by <?php echo $row['fname'].' '.$row['lname']; ?></p>
							<p><a class="btn btn-lg btn-primary" href="view-court?id=<?php echo $row['court_id']; ?>">View Court</a></p>
						</div>
						</div>
					</div>
				<?php
					$count++;
					}
					// Free result set
					mysqli_free_result($result);
				} else {
					echo "Error: " . mysqli_error($conn);
				}

				// Close the database connection
				mysqli_close($conn);
				?>
			</div>

			<button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="visually-hidden">Previous</span>
			</button>
				<button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="visually-hidden">Next</span>
				</button>
			</div>
		</div>

		<!--END OF DISPLAY-->

		<!--JAVASCRIPT AREA-->
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

		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
		<script src="static/js/courtcom.js"></script>
		<!--END OF JAVASCRIPT-->
	</body>
</html>