function togglePasswordVisibility() {
	var passwordField = document.getElementById("password");
	var lockIcon = document.querySelector(".lock-icon");

	if (passwordField.type === "password") {
		passwordField.type = "text";
		lockIcon.innerHTML = "&#128275;";
	} else {
		passwordField.type = "password";
		lockIcon.innerHTML = "&#128274;";
	}
}