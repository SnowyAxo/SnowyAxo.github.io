<?php
// Start session
session_start();

// Check if the form is submitted
if($_SERVER['REQUEST_METHOD'] == 'POST') {

	// Retrieve the username and password from the form
	$username = $_POST['username'];
	$password = $_POST['password'];

	// Connect to the database
	$conn = mysqli_connect('localhost', 'username', 'password', 'database_name');

	// Check if the connection is successful
	if(!$conn) {
		die('Connection failed: ' . mysqli_connect_error());
	}

	// Prepare the SQL query to retrieve the user information from the database
	$sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";

	// Execute the query
	$result = mysqli_query($conn, $sql);

	// Check if there is a row returned
	if(mysqli_num_rows($result) == 1) {

		// User is authenticated, start a session and redirect to the dashboard
		$_SESSION['username'] = $username;
		header('Location: dashboard.php');
		exit();

	} else {

		// User is not authenticated, display an error message
		echo "Invalid username or password. Please try again.";
	}

	// Close the database connection
	mysqli_close($conn);
}
?>
