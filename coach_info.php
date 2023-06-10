<?php
include "database.php";

// Check if user is logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: signup");
    exit();
}

if ($_SESSION["usertype"] == "Court Owner" || $_SESSION["usertype"] == "User") {
    if ($_SESSION["usertype"] == "Court Owner") {
        header("Location: court_info");
    } elseif ($_SESSION["usertype"] == "User") {
        header("Location: dashboard");
    }
    exit();
}

// Check if user is a coach
if ($_SESSION["usertype"] == "Coach") {
    // Check if coach information form has already been submitted
    $user_id = $_SESSION["user_id"];
    $sql = "SELECT * FROM coach WHERE user_id = '$user_id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // Coach information form has already been submitted, redirect to dashboard_coach
        header("Location: dashboard_coach");
        exit();
    }
}
?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="chrome=1.0, ie-edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>CourtCom | Coach Information </title>
		<link rel="icon" type="image/x-icon" href="static/images/favicon.ico">
		<link rel="stylesheet" type="text/css" href="static/bootstrap/bootstrap-5.0.2-dist/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="static/css/coach_info.css">
	</head>
	<body>
		
		<div class="container">
			<div class="bottom-right">
				<a href="/CourtCom"><img src="static/images/CourtCom_Logo_more_stroke.png" width="225"></a>
			</div>
			<div class="center-left">
				<div class="login-word"><b>COACH INFO</b></div>
				<form action="coach_info.php" method="POST">					
					<textarea maxlength="300" name="coachdesc" id="coachdesc" placeholder="Coach Description"></textarea> <br>					
					<select name="sport_type" id="sport_type" required>
						<option disabled>Select Sport Type</option>
						<option value="Badminton">Badminton</option>
						<option value="Basketball">Basketball</option>
						<option value="Dance">Dance</option>
						<option value="Gymnastics">Gymnastics</option>
						<option value="Swimming">Swimming</option>
						<option value="Table tennis">Table tennis</option>
						<option value="Tennis">Tennis</option>
						<option value="Volleyball">Volleyball</option>
						<option value="General">General</option>
					</select><br>					
					<input type="number" name="rph" id="rph" min="1" step="0.01" placeholder="Rate Per Hour" required><br>
					<input type="submit" name="regcoach" value="REGISTER COACH ">
				</form>
			</div>
		</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
	<script src="static/js/courtcom.js"></script>
	</body>
	<!--<footer>
		&copy; <?php //echo date('Y'); ?> - CourtCom
	</footer>-->
</html>