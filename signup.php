<?php
	$title = "| Sign Up";
	$css = "static/css/signup.css";
	include('database.php');
	$content = '
		<div class="bottom-right">
			<a href="/CourtCom"><img src="static/images/CourtCom_Logo_more_stroke.png" width="225"></a>
		</div>
		<div class="center-left">
			
			<div class="login-word"><b>SIGN UP</b></div>
			<form action="" method="POST">
				<p class="other-words">Already have an account? <a href="login.php" class="kuan text-magic-ink">Login</a></p>
				<input type="text" name="fname" id="fname" placeholder="First Name" required><br>
				<input type="text" name="lname" id="lname" placeholder="Last Name" required><br>
				<select name="usertype" id="usertype">
					<option disabled>Select User Type</option>
					<option value="Court Owner">Court Owner</option>
					<option value="Coach">Coach</option>
					<option value="User">User</option>
					<option value="Court Owner & User">Court Owner & User</option>
					<option value="Court Owner & Coach">Court Owner & Coach</option>
					<option value="Coach & User">Coach & User</option>
					<option value="Court Owner, Coach & User">Court Owner, Coach & User</option>
				</select><br>
				<input type="email" name="email" id="email" placeholder="Email" onkeypress="return event.charCode != 32" required><br>
				<input type="number" name="pnumber" id="pnumber" pattern="[0-9]{11}" placeholder="Phone Number" required><br>
				<div class="password-container">
					<input type="password" name="password" id="password" placeholder="Password" onkeypress="return event.charCode != 32" required><br>
					<span class="lock-icon" onclick="togglePasswordVisibility()">&#128274;</span>
				</div>
				<input type="submit" name="signup" value="SIGN UP">
			</form>
			
		</div>
	';
	require_once('layout.php');
?>