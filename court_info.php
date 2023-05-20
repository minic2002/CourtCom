<?php
include "database.php";

// Check if user is logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: signup");
    exit();
}

if ($_SESSION["usertype"] == "User" || $_SESSION["usertype"] == "Coach") {
    if ($_SESSION["usertype"] == "User") {
        header("Location: dashboard");
    } elseif ($_SESSION["usertype"] == "Coach") {
        header("Location: coach_info");
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
		<title>CourtCom | Court Information </title>
		<link rel="icon" type="image/x-icon" href="static/images/favicon.ico">
		<link rel="stylesheet" type="text/css" href="static/bootstrap/bootstrap-5.0.2-dist/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="static/css/court_info.css">
	</head>
	<body>
		
		<div class="container">
			<div class="bottom-right">
				<a href="/CourtCom"><img src="static/images/CourtCom_Logo_more_stroke.png" width="225"></a>
			</div>
			<div class="center-left">
				<div class="login-word"><b>COURT INFO</b></div>
				<form action="court_info.php" method="POST" enctype="multipart/form-data">
					<input type="file" name="court_image" id="court_image" accept="image/jpeg,image/png,image/jpg" required>
					<input type="text" name="court_name" id="court_name" placeholder="Court Name" required><br>
					<input type="text" name="court_address" id="court_address" placeholder="Court Address" required><br>
					<textarea maxlength="300" name="court_desc" id="court_desc" placeholder="Court Description"></textarea> <br>
					<select name="court_type" id="court_type" required>
						<option disabled>Select Court Type</option>
						<option value="Badminton">Badminton</option>
						<option value="Basketball">Basketball</option>
						<option value="Dance">Dance</option>
						<option value="Gymnastics">Gymnastics</option>
						<option value="Swimming">Swimming</option>
						<option value="Table tennis">Table tennis</option>
						<option value="Tennis">Tennis</option>
						<option value="Volleyball">Volleyball</option>
					</select><br>
					<input type="number" name="rph" id="rph" min="1" step="0.01" placeholder="Rate Per Hour" required><br>
					<input type="submit" name="regcourt" value="REGISTER COURT ">
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