<?php
// Include the connection file
include '../settings/connection.php';

// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if not logged in
    header('Location: ../login/login.php');
    exit();
}

// Fetch user details from the database based on the user ID stored in the session
$userID = $_SESSION['user_id'];
$query = "SELECT * FROM Users WHERE userID = $userID";
$result = mysqli_query($con, $query);

// Check if the query was successful
if ($result) {
    // Fetch user data
    $userData = mysqli_fetch_assoc($result);
    // Extract relevant information
    $username = $userData['username'];
    $dob = $userData['dob'];
    $residence = $userData['residence'];
    $fitness_goal = $userData['fitness_goal'];

    // You can fetch additional data or perform other operations here
} else {
    // Handle errors if the query fails
    $error = "Failed to fetch user data.";
    // You can log the error or display an appropriate message to the user
}

// Close the database connection
mysqli_close($con);
?>
