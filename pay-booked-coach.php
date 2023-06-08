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

    // Retrieve coach ID from URL parameter
    $bcch_id = mysqli_real_escape_string($conn, $_GET['id']);
    
    // Fetch coach details
    $query = "SELECT U.fname, U.lname, CC.fname AS coach_fname, CC.lname AS coach_lname, CO.coach_id, CO.rph, BC.Start_Time, BC.End_Time, BC.Booking_Date FROM book_coach BC INNER JOIN USERS U ON BC.user_id = U.user_id INNER JOIN COACH CO ON BC.coach_id = CO.coach_id INNER JOIN USERS CC ON CO.user_id = CC.user_id WHERE BC.bcch_id = '$bcch_id'";
    $result = mysqli_query($conn, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    }

    //restrict other user from accessing
    if ($_SESSION["usertype"] == "User") {
        $quer_l = "SELECT book_coach.user_id FROM book_coach JOIN users ON book_coach.user_id = users.user_id WHERE book_coach.bcch_id = '$bcch_id'";
        $result = mysqli_query($conn, $quer_l);
        if ($result && mysqli_num_rows($result) > 0) {
            $book_coach = mysqli_fetch_assoc($result);
            if ($_SESSION["user_id"] != $book_coach["user_id"]) {
                header("Location: dashboard");
                exit();
            }
        }
    }

    //check if the user already paid
    $sql = "SELECT * FROM pay_booked_coach WHERE bcch_id = '$bcch_id'";
    $resulta = mysqli_query($conn, $sql);

    if ($resulta && mysqli_num_rows($resulta) > 0) {
        // User has already booked the court, redirect them to a different page or display an error message
        header("Location: user-booking-coach");
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
        <title>CourtCom | Pay Booked Court </title>
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
					<a class="nav-link" href="view-coach?id=<?php echo $row["coach_id"]; ?>">View Coach</a>
					</li>
					<li class="nav-item">
					<a class="nav-link active" aria-current="page" href="#">Pay Booked Coach</a>
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
                    <form>
                        <div class="mb-3">
                            <h2>BOOKER INFO</h2>
                        </div>
                        <hr style="border: none;height: 4px;background-color: #000;">
                        <div class="mb-3">
                            <label class="form-label">Coach Booked</label>
                            <input type="text" class="form-control" value="<?php echo $row["coach_fname"] . " " . $row["coach_lname"]; ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Booker Name</label>
                            <input type="text" class="form-control" value="<?php echo $row["fname"] . " " . $row["lname"]; ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Start Time</label>
                            <input type="text" class="form-control" value="<?php echo $row["Start_Time"]; ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">End Time</label>
                            <input type="text" class="form-control" value="<?php echo $row["End_Time"]; ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Booking Date</label>
                            <input type="text" class="form-control" value="<?php echo $row["Booking_Date"]; ?>" readonly>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                <?php
                    //Generating payment amount
                    
                    //convert start time to float
                    $start = $row["Start_Time"];
                    $startInSeconds = strtotime($start);
                    $floatStartValue = (float)date('H.i', $startInSeconds);

                    //convert end time to float
                    $end = $row["End_Time"];
                    $endInSeconds = strtotime($end);
                    $floatEndValue = (float)date('H.i', $endInSeconds);

                    //calculate the hour
                    $time = $floatEndValue - $floatStartValue;
                    $amount_payment = $time * $row["rph"];
                ?>

                <form method="post">
                    <div class="mb-3">
                        <h2>PAYMENT INFO</h2>
                    </div>
                    <hr style="border: none;height: 4px;background-color: #000;">
                    <input type="hidden" name="bcch_id" id="bcch_id" value="<?php echo $bcch_id; ?>">
                    <div class="mb-3">
                        <label for="paytype" class="form-label">Payment Type</label>
                        <select class="form-select" id="paytype" name="paytype" required>
                            <option disabled> Choose Payment Type </option>
                            <option value="Walk-In Payment">Walk-In Payment</option>
                            <option disabled> GCash </option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="amount" class="form-label">Payment Amount</label>
                        <input type="text" class="form-control" id="amount" name="amount" value="<?php echo $amount_payment; ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <input type="submit" name="pabo_coach" id="pabo_coach" value="Confirm">
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