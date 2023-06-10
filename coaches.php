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
		<link rel="stylesheet" type="text/css" href="static/css/coaches.css">
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
					<a class="nav-link" href="dashboard">Main</a>
					</li>
					<li class="nav-item">
					<a class="nav-link" href="courts">Court</a>
					</li>
					<li class="nav-item">
					<a class="nav-link active" aria-current="page" href="#">Coach</a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="categoriesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							Category
						</a>
						<ul class="dropdown-menu" aria-labelledby="categoriesDropdown">
							<li><a class="dropdown-item" href="categories?category=Badminton">Badminton</a></li>
							<li><a class="dropdown-item" href="categories?category=Basketball">Basketball</a></li>
							<li><a class="dropdown-item" href="categories?category=Dance">Dance</a></li>
							<li><a class="dropdown-item" href="categories?category=Gymnastics">Gymnastics</a></li>
							<li><a class="dropdown-item" href="categories?category=Swimming">Swimming</a></li>
							<li><a class="dropdown-item" href="categories?category=Table+Tennis">Table Tennis</a></li>
							<li><a class="dropdown-item" href="categories?category=Tennis">Tennis</a></li>
							<li><a class="dropdown-item" href="categories?category=Volleyball">Volleyball</a></li>
							<li><a class="dropdown-item" href="categories?category=General">General</a></li>
						</ul>
					</li>
				</ul>
				<div class="profile-icon" onclick="toggleSideMenu()">
					<img src="<?php echo $_SESSION["user_pic"]; ?>" width="20">
				</div>
				<div class="side-menu">
					<ul>
					<li><a href="#"><?php echo $_SESSION["fname"] . " " . $_SESSION["lname"]; ?></a></li>
					<li><a href="bookings"><i class="fa fa-clock-o"></i> Court Bookings </a></li>
					<li><a href="user-booking-coach"><i class="fa fa-clock-o"></i> Coach Bookings </a></li>
					<li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
					<li><a href="logout"><i class="fa fa-sign-out"></i> Logout</a></li>
					</ul>
				</div>
				</div>
			</div>
		</nav>

		<!--END OF NAVIGATION BAR-->
		<br> 
		
<!--DISPLAY COACHES-->
<?php
// Your database connection code here
include "userdb.php";
// Your query here
$query = "SELECT coach.coach_ID, users.user_pic, users.fname, users.lname FROM coach JOIN users ON coach.user_ID = users.user_id;";

// Execute the query
$result = mysqli_query($conn, $query);
?>

<div class="container">
    <div class="row">
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <div class="col-md-4">

                <img src="<?php echo $row['user_pic']; ?>" class="rounded-circle" width="140" height="140" style="object-fit: cover;">

                <h2><?php echo $row['fname'] . ' ' . $row['lname']; ?></h2>
                <p><a class="btn btn-secondary" href="view-coach?id=<?php echo $row['coach_ID']; ?>">View details »</a></p>

            </div><!-- /.col-lg-4 -->

        <?php } ?>
    </div>
</div>

<?php
// Close the database connection
mysqli_close($conn);
?>

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

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var courtCards = document.querySelectorAll(".court-card");

        courtCards.forEach(function(card) {
            var courtId = card.getAttribute("data-courtid");
            card.addEventListener("click", function() {
                window.location.href = "view-court?id=" + courtId;
            });
        });
    });

</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="static/js/courtcom.js"></script>
<!--END OF JAVASCRIPT-->

	</body>
</html>