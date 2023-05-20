<?php
include "database.php";

if (isset($_SESSION["user_id"])) {
    if ($_SESSION["usertype"] == "User") {
        header("Location: dashboard");
    } elseif ($_SESSION["usertype"] == "Court Owner") {
        header("Location: dashboard_court");
    } else {
        header("Location: dashboard_coach");
    }
    exit();
}

$title = "| Sign Up";
$css = "static/css/signup.css";
ob_start(); // Start output buffering
?>

    <div class="bottom-right">
        <a href="/CourtCom"><img src="static/images/CourtCom_Logo_more_stroke.png" width="225"></a>
    </div>
    <div class="center-left">
        <div class="login-word"><b>SIGN UP</b></div>
        <form action="signup.php" method="POST" enctype="multipart/form-data">
            <p class="other-words">Already have an account? <a href="login" class="kuan text-magic-ink">Login</a></p>
            <input type="file" name="profile_pic" id="profile_pic" accept="image/jpeg,image/png,image/jpg" required>
            <input type="text" name="fname" id="fname" placeholder="First Name" required><br>
            <input type="text" name="lname" id="lname" placeholder="Last Name" required><br>
            <select name="usertype" id="usertype" required>
                <option disabled>Select User Type</option>
                <option value="Court Owner">Court Owner</option>
                <option value="Coach">Coach</option>
                <option value="User">User</option>
            </select><br>
            <input type="email" name="email" id="email" placeholder="Email" onkeypress="return event.charCode != 32" required><br>
            <input type="number" name="pnumber" id="pnumber" pattern="[0-9]{11}" placeholder="Phone Number" required><br>
            <div class="password-container">
                <input type="password" name="password" id="password" placeholder="Password" onkeypress="return event.charCode != 32" required><br>
                <span class="lock-icon" onclick="togglePasswordVisibility()"><i class="fa fa-eye-slash"></i></span>
            </div>
            <input type="submit" name="signup" value="SIGN UP">
        </form>
    </div>

<?php
$content = ob_get_clean(); // Get the buffered output and clear the buffer
require_once "layout.php";
?>