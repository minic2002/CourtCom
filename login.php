<?php
	$title = "| Login";
	$css = "/CourtCom/static/css/login.css";
	include('database.php');
	$content = '
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
					<span class="lock-icon" onclick="togglePasswordVisibility()">&#128274;</span>
				</div>
				<p class="other-words right">
					<a href="/CourtCom/login.php" class="kuan text-magic-ink">Forgot password?</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<a href="/CourtCom/signup.php" class="kuan text-magic-ink">Create account?</a>
				</p>
				<br>
				<input type="submit" name="login" id="login" value="LOGIN">
			</form>
			</center>
		</div>
	';
	require_once('layout.php');
?>