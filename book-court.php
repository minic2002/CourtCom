<?php
//START OF SESSION
include "database.php";

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

    // Retrieve court ID from URL parameter
    $court_id = mysqli_real_escape_string($conn, $_GET['id']);
    
    // Fetch court details
    $query = "SELECT court.court_image, court.court_name, users.fname, users.lname, court.court_address, court.court_desc, court.court_type, court.rph FROM court JOIN users ON court.user_ID = users.user_id WHERE court_id = '$court_id'";
    $result = mysqli_query($conn, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    }

    // Check if user has already booked the court
    $user_id = $_SESSION["user_id"];
    $sql = "SELECT book_court.bcrt_id FROM book_court INNER JOIN users ON book_court.user_id = users.user_id INNER JOIN court ON book_court.court_id = court.court_id WHERE book_court.court_id = '$court_id' AND book_court.user_id = '$user_id'";
    $resulta = mysqli_query($conn, $sql);

    if ($resulta && mysqli_num_rows($resulta) > 0) {
            $book_court = mysqli_fetch_assoc($resulta);
            $bcrt_id = $book_court['bcrt_id'];
        // User has already booked the court, redirect them pay booked court if they haven't paid yet
        header("Location: pay-booked-court?id=$bcrt_id");
        exit();
    }

//END OF SESSION
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="static/bootstrap/bootstrap-5.0.2-dist/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="static/css/book-court.css">
        <title>CourtCom | Book Court </title>
        <link rel="icon" type="image/x-icon" href="static/images/favicon.ico">
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
					<a class="nav-link" href="view-court?id=<?php echo $court_id; ?>">View Court</a>
					</li>
					<li class="nav-item">
					<a class="nav-link active" aria-current="page" href="#">Book Court</a>
					</li>
				</ul>
				<div class="profile-icon" onclick="toggleSideMenu()">
                    <img src="<?php echo $_SESSION["user_pic"]; ?>" width="20">
				</div>
				<div class="side-menu">
					<ul>
					<li><a><?php echo $_SESSION["fname"] . " " . $_SESSION["lname"]; ?></a></li>
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
        <!--Info of booker-->
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                <img src="<?php echo $row['court_image']; ?>" class='card-img-top crop-img shaonimg' alt="<?php echo $row['court_name']; ?>">
                <h2><?php echo strtoupper($row['court_name']); ?></h2>
                <h4> Owned by <?php echo $row['fname'] . " " . $row['lname']; ?></h4>
                </div>
                <div class="col-md-6">
                    <h2>BOOKER INFO</h2>
                    <form method="post">
                        <div class="mb-3">
                            <label for="b_fullname" class="form-label">Booker Name</label>
                            <input type="text" class="form-control" id="b_fullname" name="b_fullname" value="<?php echo $_SESSION["fname"] . " " . $_SESSION["lname"]; ?>" readonly>
                        </div>
                        <input type="hidden" name="court_id" value="<?php echo $court_id; ?>">
                        <div class="mb-3">
                            <label for="s_time" class="form-label">Start Time</label>
                            <input type="time" class="form-control" id="s_time" name="s_time" required>
                        </div>
                        <div class="mb-3">
                            <label for="e_time" class="form-label">End Time</label>
                            <input type="time" class="form-control" id="e_time" name="e_time" required>
                        </div>
                        <div class="mb-3">
                            <label for="bodate" class="form-label">Booking Date</label>
                            <input type="date" class="form-control" id="bodate" name="bodate" required>
                        </div>
                        <div class="mb-3">
                            <input type="submit" name="bo_court" id="bo_court" value="Book Now">
                        </div>
                    </form>
                </div>
            </div>
        </div>



        <!--JAVASCRIPT-->
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