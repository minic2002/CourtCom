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
    $coach_id = mysqli_real_escape_string($conn, $_GET['id']);
    
    // Fetch the details of the court with the given ID
    $query = "SELECT users.user_pic, users.fname, users.lname, COALESCE(ROUND(AVG(review_coach.rate), 1),'Unrated') AS total_rating, coach.sport_type, coach.RPH, coach.coach_desc FROM coach INNER JOIN users ON coach.user_ID = users.user_id INNER JOIN review_coach ON coach.coach_ID = review_coach.coach_id WHERE coach.coach_ID = '$coach_id'";
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
    <title>CourtCom | View Coach </title>
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
					<a class="nav-link active" aria-current="page" href="#">View Coach</a>
					</li>
				</ul>
				<div class="profile-icon" onclick="toggleSideMenu()">
                    <img src="<?php echo $_SESSION["user_pic"]; ?>" width="20">
				</div>
				<div class="side-menu">
					<ul>
					<li><a><?php echo $_SESSION["fname"] . " " . $_SESSION["lname"]; ?></a></li>
					<li><a href="bookings"><i class="fa fa-clock-o"></i> Bookings </a></li>
					<li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
					<li><a href="logout"><i class="fa fa-sign-out"></i> Logout</a></li>
					</ul>
				</div>
				</div>
			</div>
		</nav>
		<!--END OF NAVIGATION BAR-->
    <br>
    <!--VIEW COACH-->
            <div class="container">
                <div class= "row">
                    <div class="col-md-6">
                        <img src="<?php echo $row['user_pic']; ?>" class='card-img-top crop-img shaonimg' alt="<?php echo $row['fname'] . " " . $row['lname']; ?>">
                    </div>
                    <div class="col-md-6">
                        <h2><?php echo strtoupper($row['fname'] . " " . $row['lname']) . ' <span class="fa fa-star"></span> ' . $row['total_rating']; ?></h2>
                        <h4>Coach Description: <?php echo $row['coach_desc']; ?></h4>
                        <h4>Sport Type: <?php echo $row['sport_type']; ?></h4>
                        <h4>Rate Per Hour: &#8369; <?php echo $row['RPH']; ?> </h4>
                        <button onclick="location.href='book-coach?id=<?php echo $coach_id; ?>'"> BOOK </button>
                    </div>
                </div>
            </div>

    <!--END OF VIEW COACH-->
    <br>
    <!--RATINGS AND REVIEW-->
        <div class="container">
        <h2>RATINGS AND REVIEWS</h2>
        <!--Make a review and rate-->
            <form method="POST" class="row g-3">
                <input type="hidden" name="coach_id" id="coach_id" value="<?php echo $coach_id; ?>">
                <div class="col-md-6">
                    <textarea maxlength="300" name="review_coach" id="review_coach" placeholder="Write a review" class="form-control" required></textarea>
                </div>
                <div class="col-md-3">
                    <select name="rate_coach" id="rate_coach" required class="form-select">
                        <option disabled>Rate the coach</option>
                        <option value="5">&#9733;&#9733;&#9733;&#9733;&#9733;</option>
                        <option value="4">&#9733;&#9733;&#9733;&#9733;</option>
                        <option value="3">&#9733;&#9733;&#9733;</option>
                        <option value="2">&#9733;&#9733;</option>
                        <option value="1">&#9733;</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" name="rr_coach" id="rr_coach" class="btn btn-primary yellow-button">POST</button>
                </div>
            </form>

        <!--End of making-->

        <!--Display ratings and reviews-->
        <?php
            $query = "SELECT users.user_pic, users.fname, users.lname, review_coach.review_text, review_coach.rate, review_coach.review_date FROM review_coach JOIN users ON review_coach.user_id = users.user_id WHERE review_coach.coach_id = '$coach_id' ORDER BY review_coach.rate DESC";
            $result = mysqli_query($conn, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="card mt-3">';
                    echo '<div class="card-body">';
                    echo '<div class="d-flex align-items-center">';
                    echo '<img src="'.$row['user_pic'].'" class="rounded-circle me-3" width="50" height="50" alt="User Picture">';
                    echo '<div>';
                    echo '<h5 class="card-title mb-0">'.$row['fname'].' '.$row['lname']. ' ' . '<span class="fa fa-star"></span> ' . $row['rate'] . '</h5>';
                    echo '<h6 class="text-muted">'.$row['review_date'].'</h6>';
                    echo '</div>';
                    echo '</div>';
                    echo '<div class="mt-3">';
                    echo '<h4 class="card-text">'.$row['review_text'].'</h4>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<br><br><h5 class="text-center">No ratings and reviews available.</h5> <br><br>';
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