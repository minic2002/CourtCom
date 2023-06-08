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
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="static/bootstrap/bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="static/css/bookings.css">
    <title>CourtCom | Bookings </title>
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
					<a class="nav-link active" aria-current="page" href="#">Court Bookings</a>
					</li>
				</ul>
				<div class="profile-icon" onclick="toggleSideMenu()">
                    <img src="<?php echo $_SESSION["user_pic"]; ?>" width="20">
				</div>
				<div class="side-menu">
					<ul>
					<li><a><?php echo $_SESSION["fname"] . " " . $_SESSION["lname"]; ?></a></li>
					<li><a href="#"><i class="fa fa-clock-o"></i> Court Bookings </a></li>
					<li><a href="user-booking-coach"><i class="fa fa-clock-o"></i> Coach Bookings </a></li>
					<li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
					<li><a href="logout"><i class="fa fa-sign-out"></i> Logout</a></li>
					</ul>
				</div>
				</div>
			</div>
		</nav>
		<!--END OF NAVIGATION BAR-->

        <!--BOOKINGS TABLE-->
        <?php

        include "userdb.php";

        $query = "SELECT book_court.bcrt_id, court.court_name, book_court.Start_Time, book_court.End_Time, book_court.Booking_Date, book_court.Booking_Status, pay_booked_court.payment_amount, pay_booked_court.payment_status FROM book_court INNER JOIN court ON book_court.court_id = court.court_ID INNER JOIN pay_booked_court ON pay_booked_court.bcrt_id = book_court.bcrt_id WHERE book_court.user_id = {$_SESSION['user_id']}";
        $result = mysqli_query($conn, $query);

        if ($result) {
            echo '<table class="table table-striped">';
            echo '<thead><tr><th scope="col">Booking ID</th><th scope="col">Court Name</th><th scope="col">Start Time</th><th scope="col">End Time</th><th scope="col">Booking Date</th><th scope="col">Booking Status</th><th scope="col">Payment Amount</th><th scope="col">Payment Status</th><th scope="col">Action</th></tr></thead><tbody>';

            while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . $row['bcrt_id'] . '</td>';
            echo '<td>' . $row['court_name'] . '</td>';
            echo '<td>' . $row['Start_Time'] . '</td>';
            echo '<td>' . $row['End_Time'] . '</td>';
            echo '<td>' . $row['Booking_Date'] . '</td>';
            echo '<td>' . $row['Booking_Status'] . '</td>';
            echo '<td>' . $row['payment_amount'] . '</td>';
            echo '<td>' . $row['payment_status'] . '</td>';
            echo '<td> <button onclick="delete_booked_court(' . $row['bcrt_id'] . ')"> <i class="fa fa-trash"></i> </button></td>';
            echo '</tr>';
            }
            echo '</tbody></table>';
        } else {
            echo "<p>NO BOOKINGS WERE MADE</p>";
        }

        mysqli_close($conn);
        ?>
        <!--END OF BOOKINGS TABLE-->
       
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
                function delete_booked_court(bcrt_id){
                    var ok = confirm("Do you want to cancel your booking to this particular court?")
                    if (ok){
                        location.href="delete-booked-court?id="+bcrt_id;
                    }
                    idno="";
                }
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="static/js/courtcom.js"></script>
        <!--END OF JAVASCRIPT-->
</body>
</html>