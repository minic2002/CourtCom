<?php
session_start();

	$host = "localhost";
	$user = "root";
	$password = "";
	$dbname = "courtcom";
	//connect to the database
	$conn = mysqli_connect($host, $user, $password, $dbname);
	
	//Sign Up
	if (isset($_POST['signup'])) {

		  $fname = $_POST['fname'];
		  $lname = $_POST['lname'];
		  $usertype = $_POST['usertype'];
		  $email = $_POST['email'];
		  $pnumber = $_POST['pnumber'];
		  $password = $_POST['password'];
		  
		  $double_check = "SELECT * FROM users WHERE email = '$email' OR pnumber = '$pnumber'";
		  $result = mysqli_query($conn, $double_check);
		  $user = mysqli_fetch_assoc($result);
		  
		  if ($user) {
			if ($user['email'] === $email){
				echo "<script>alert('Email already exists');</script>";
			}
			if ($user['pnumber'] === $pnumber){
				echo "<script>alert('Phone Number already exists');</script>";
			}
		  }
		  else {
			  // Insert the user information into the database
			  $password = md5($password);
			  $sql = "INSERT INTO users (fname, lname, usertype, email, pnumber, password)
					  VALUES ('$fname', '$lname', '$usertype', '$email', '$pnumber', '$password')";
			  mysqli_query($conn, $sql);

			  // Redirect to the login page
			  header('Location: login.php');
			  exit();
		  }
		}

	//Log in
	if (isset($_POST['login'])) {
	  // Get the form data
	  $emailornumber = $_POST['emailornumber'];
	  $password = $_POST['password'];

	  // Retrieve the user information from the database
	  $password = md5($password);
	  $sql = "SELECT * FROM users WHERE (email = '$emailornumber' OR pnumber = '$emailornumber') AND password = '$password'";
	  $result = mysqli_query($conn, $sql);

	    // Check if the user exists and the password is correct
		if (mysqli_num_rows($result) == 1) {
			  header('Location: dashboard.php');
			  exit();
		} else {
		// User does not exist, show an error message
			echo "<script>alert('Invalid email/phone number or password.');</script>";

		}
	}
?>