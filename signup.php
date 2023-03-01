<?php
// Start session
session_start();

// Check if the form is submitted
if($_SERVER['REQUEST_METHOD'] == 'POST') {

	// Retrieve the username and password from the form
	$username = $_POST['username'];
	$password = $_POST['password'];
	$confirm_password = $_POST['confirm_password'];

	// Check if the password matches the confirm password field
	if($password != $confirm_password) {
		echo "Passwords do not match. Please try again.";
		exit();
	}

	// Connect to the database
	$conn = mysqli_connect('localhost', 'username', 'password', 'database_name');

	// Check if the connection is successful
	if(!$conn) {
		die('Connection failed: ' . mysqli_connect_error());
	}

	// Prepare the SQL query to check if the username already exists in the database
	$sql = "SELECT * FROM users WHERE username='$username'";

	// Execute the query
	$result = mysqli_query($conn, $sql);

	// Check if there is a row returned
	if(mysqli_num_rows($result) == 1) {
		echo "Username already exists. Please choose another username.";
		exit();
	}

	// Prepare the SQL query to insert the new user credentials into the database
	$sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

	// Execute the query
	if(mysqli_query($conn, $sql)) {

		// User is successfully registered, start a session and redirect to the dashboard
		$_SESSION['username'] = $username;
		header('Location: dashboard.php');
		exit();

	} else {

		// User registration failed, display an error message
		echo "User registration failed. Please try again.";
	}

	// Close the database connection
	mysqli_close($conn);
}
?>
