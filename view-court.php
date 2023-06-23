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

// Displaying the chosen court
    // Sanitize the input to prevent SQL injection
    $court_id = mysqli_real_escape_string($conn, $_GET['id']);
    
    // Fetch the details of the court with the given ID
    $query = "SELECT court.court_image, court.court_name, users.fname, users.lname, COALESCE(ROUND(AVG(review_court.rate), 1),'Unrated') AS total_rating, court.court_address, court.court_desc, court.court_type, court.rph FROM court INNER JOIN users ON court.user_ID = users.user_id INNER JOIN review_court ON review_court.court_id = court.court_id WHERE court.court_id = '$court_id'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        // Display the details of the court
        $row = mysqli_fetch_assoc($result);
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
    <link rel="stylesheet" type="text/css" href="static/css/view-court.css">
    <title>CourtCom | View Court </title>
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
					<li class="nav-item">
					<a class="nav-link" href="dashboard">Main</a>
					</li>
					<li class="nav-item active">
					<a class="nav-link active" aria-current="page" href="#">View Court</a>
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
    <!--VIEW COURT-->
            <div class="container">
                <div class= "row">
                    <div class="col-md-6">
                        <img src="<?php echo $row['court_image']; ?>" class='card-img-top crop-img shaonimg' alt="<?php echo $row['court_name']; ?>">
                    </div>
                    <div class="col-md-6">
                        <h2><?php echo strtoupper($row['court_name']) . ' <span class="fa fa-star"></span> ' . $row['total_rating']; ?></h2>
                        <h4> Court Owner: <?php echo $row['fname'] . " " . $row['lname']; ?></h4>
                        <h4>Court Address: <?php echo $row['court_address']; ?></h4>
                        <h4>Court Description: <?php echo $row['court_desc']; ?></h4>
                        <h4>Court Type: <?php echo $row['court_type']; ?></h4>
                        <h4>Rate Per Hour: &#8369; <?php echo $row['rph']; ?> </h4>
                        <button onclick="location.href='book-court?id=<?php echo $court_id; ?>'"> BOOK </button>
                    </div>
                </div>
            </div>

    <!--END OF VIEW COURT-->
    <br>
    <!--RATINGS AND REVIEW-->
        <div class="container">
        <h2>RATINGS AND REVIEWS</h2>
        <!--Make a review and rate-->
            <form method="POST" class="row g-3">
                <input type="hidden" name="court_id" id="court_id" value="<?php echo $court_id; ?>">
                <div class="col-md-6">
                    <textarea maxlength="300" name="review_court" id="review_court" placeholder="Write a review" class="form-control" required></textarea>
                </div>
                <div class="col-md-3">
                    <select name="rate_court" id="rate_court" required class="form-select">
                        <option disabled>Rate the court</option>
                        <option value="5">&#9733;&#9733;&#9733;&#9733;&#9733;</option>
                        <option value="4">&#9733;&#9733;&#9733;&#9733;</option>
                        <option value="3">&#9733;&#9733;&#9733;</option>
                        <option value="2">&#9733;&#9733;</option>
                        <option value="1">&#9733;</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" name="rr_court" id="rr_court" class="btn btn-primary yellow-button">POST</button>
                </div>
            </form>

        <!--End of making-->

        <!--Display ratings and reviews-->
        <?php
        $query = "SELECT users.user_id, users.user_pic, users.fname, users.lname, review_court.review_court_id, review_court.review_text, review_court.rate, review_court.review_date FROM review_court JOIN users ON review_court.user_id = users.user_id WHERE review_court.court_id = '$court_id' ORDER BY review_court.rate DESC";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
            <div class="card mt-3">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <img src="<?php echo $row['user_pic']; ?>" class="rounded-circle me-3" width="50" height="50" alt="<?php echo $row['fname'].' '.$row['lname']; ?>">
                        <div>
                            <h5 class="card-title mb-0"><?php echo $row['fname'].' '.$row['lname']; ?><span class="fa fa-star"></span> <?php echo $row['rate']; ?></h5>
                            <h6 class="text-muted"><?php echo $row['review_date']; ?></h6>
                        </div>
                        <?php echo $_SESSION['user_id'] == $row['user_id'] ? '<div class="position-absolute top-0 end-0" style="margin-right: 10px;"><span class="fa fa-ellipsis-v" data-bs-toggle="dropdown"></span><div class="dropdown-menu"><a class="dropdown-item" href="edit-review-court?review_court_id=' . $row['review_court_id'] . '&court_id=' . $court_id . '&user_id=' . $row['user_id'] . '">Edit</a><a class="dropdown-item" href="delete-review-court?review_court_id=' . $row['review_court_id'] . '&court_id=' . $court_id . '&user_id=' . $row['user_id'] . '">Delete</a></div></div>' : '' ?>
                    </div>
                    <div class="mt-3">
                        <h4 class="card-text"><?php echo $row['review_text']; ?></h4>
                    </div>
                </div>
            </div>
        <?php
            }
        } else {
            echo '<br><br><h5 class="text-center">No ratings and reviews available.</h5><br><br>';
        }
        ?>
        <!--End of displaying-->

        </div>
    <!--END OF RATINGS AND REVIEW-->


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