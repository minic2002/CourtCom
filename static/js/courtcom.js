function togglePasswordVisibility() {
	var passwordField = document.getElementById("password");
	var lockIcon = document.querySelector(".lock-icon");

	if (passwordField.type == "password") {
		passwordField.type = "text";
		lockIcon.innerHTML = "<i class=\"fa fa-eye\"></i>";
	} else {
		passwordField.type = "password";
		lockIcon.innerHTML = "<i class=\"fa fa-eye-slash\"></i>";
	}
}


