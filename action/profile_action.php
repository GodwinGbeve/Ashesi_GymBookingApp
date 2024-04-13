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

// Check if the form is submitted for profile update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data and assign each to a variable
    $userID = $_SESSION['user_id'];
    $fitnessGoal = $_POST['fitness_goal'];
    $residence = $_POST['residence'];

    // Update the user's fitness goal and residence in the database
    $updateQuery = "UPDATE Users SET fitness_goal='$fitnessGoal', residence='$residence' WHERE userID='$userID'";
    $updateResult = mysqli_query($con, $updateQuery);

    if ($updateResult) {
        // Profile update successful
        $_SESSION['success'] = "Profile updated successfully.";
    } else {
        // Profile update failed
        $_SESSION['error'] = "Failed to update profile. Please try again.";
    }
} else {
    // If the form is not submitted, redirect to the profile page
    $_SESSION['error'] = "Invalid request. Please try again.";
}

// Close the database connection
mysqli_close($con);

// Redirect back to the profile page
header('Location: ../view/profile.php');
exit();
?>
