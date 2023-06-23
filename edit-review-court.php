<?php
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

$review_court_id = $_GET['review_court_id'];
$court_id = $_GET['court_id'];
$user_id = $_GET['user_id'];

if ($_SESSION['user_id'] != $user_id) {
    header("Location: view-court?id=$court_id");
    exit();
}


// Displaying the chosen court
    
    // Fetch the details of the court with the given ID
    $query = "SELECT review_text, rate FROM review_court WHERE review_court_id = '$review_court_id'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        // Display the details of the court
        $rate_review = mysqli_fetch_assoc($result);
    }

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
                    <li class="nav-item ">
                    <a class="nav-link" href="dashboard">Main</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="view-court?id=<?php echo $court_id; ?>">View Court</a>
                    </li>
                    <li class="nav-item active">
                    <a class="nav-link active" aria-current="page" href="#">Edit Review Court</a>
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

    <!--EDIT REVIEW COURT-->
    <br><br>
    <div class="container">
        <form method="POST" class="row g-3">
            <input type="hidden" name="review_court_id" id="review_court_id" value="<?php echo $review_court_id; ?>">
            <input type="hidden" name="court_id" id="court_id" value="<?php echo $court_id; ?>">
            <div class="col-md-9">
                <select name="rate_court" id="rate_court" required class="form-select">
                    <option disabled>Rate the court</option>
                    <option value="5" <?php echo isset($rate_review['rate']) && $rate_review['rate'] == 5 ? 'selected' : '' ?>>&#9733;&#9733;&#9733;&#9733;&#9733;</option>
                    <option value="4" <?php echo isset($rate_review['rate']) && $rate_review['rate'] == 4 ? 'selected' : '' ?>>&#9733;&#9733;&#9733;&#9733;</option>
                    <option value="3" <?php echo isset($rate_review['rate']) && $rate_review['rate'] == 3 ? 'selected' : '' ?>>&#9733;&#9733;&#9733;</option>
                    <option value="2" <?php echo isset($rate_review['rate']) && $rate_review['rate'] == 2 ? 'selected' : '' ?>>&#9733;&#9733;</option>
                    <option value="1" <?php echo isset($rate_review['rate']) && $rate_review['rate'] == 1 ? 'selected' : '' ?>>&#9733;</option>
                </select>
            </div>
            <div class="col-md-3 position-absolute end-0">
                <button type="submit" name="update_rr_court" id="update_rr_court" class="btn btn-primary yellow-button">SAVE</button>
            </div>
            <div>
                <textarea maxlength="300" style="height:300px;" name="review_court" id="review_court" placeholder="Edit review" class="form-control" required><?php echo $rate_review['review_text'] ?></textarea>
            </div> 
        </form>
    </div>

    <!--END OF EDIT REVIEW COURT-->

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