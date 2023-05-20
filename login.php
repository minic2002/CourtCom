<?php
	include 'database.php';

	if (isset($_SESSION["user_id"])) {
		if ($_SESSION["usertype"] == "User") {
			header("Location: dashboard");
		}
		elseif ($_SESSION["usertype"] == "Court Owner") {
			header("Location: dashboard_court");
		}
		else {
			header("Location: dashboard_coach");
		}
		exit();
	}

$title = "| Login";
$css = "/CourtCom/static/css/login.css";
ob_start(); // Start output buffering
?>
	<div class="top-left">
		<a href="/CourtCom"><img src="/CourtCom/static/images/CourtCom_Logo_more_stroke.png" width="225"></a>
	</div>
	<div class="center-right ">
		<center>
		<p class="login-word"><b>LOGIN</b></p>
		<form action="" method="POST">
			<input type="text" name="emailornumber" id="emailornumber" placeholder="Email or Phone Number" onkeypress="return event.charCode != 32" required><br>
			<div class="password-container">
				<input type="password" name="password" id="password" placeholder="Password" onkeypress="return event.charCode != 32" required>
				<span class="lock-icon" onclick="togglePasswordVisibility()"><i class="fa fa-eye-slash"></i></span>
			</div>
			<p class="other-words right">
				<a href="login" class="kuan text-magic-ink">Forgot password?</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="signup" class="kuan text-magic-ink">Create account?</a>
			</p>
			<br>
			<input type="submit" name="login" id="login" value="LOGIN">
			
		</form>
		</center>
	</div>

<?php
$content = ob_get_clean(); // Get the buffered output and clear the buffer
require_once "layout.php";
?>