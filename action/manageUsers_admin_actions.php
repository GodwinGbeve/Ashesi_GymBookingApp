<?php
// action/manageUsers_admin_actions.php

// Include database connection
include_once('../settings/connection.php');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if action is specified
    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        // Perform actions based on the request
        switch ($action) {
            case 'edit':
                handleEditUser();
                break;
            case 'delete':
                handleDeleteUser();
                break;
            // Add more cases for other actions as needed
            default:
                // Handle invalid action
                echo "Invalid action!";
                break;
        }
    } else {
        // No action specified
        echo "No action specified!";
    }
}

// Function to handle editing user information
function handleEditUser() {
    global $con;

    // Validate and sanitize inputs
    $userID = mysqli_real_escape_string($con, $_POST['userID']);
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $roleID = mysqli_real_escape_string($con, $_POST['roleID']);

    // Update user information in the database
    $sql = "UPDATE Users SET username = '$username', email = '$email', roleID = '$roleID' WHERE userID = '$userID'";
    if (mysqli_query($con, $sql)) {
        echo "User information updated successfully!";
    } else {
        echo "Error updating user information: " . mysqli_error($con);
    }
}

// Function to handle deleting a user account
function handleDeleteUser() {
    global $con;

    // Validate and sanitize inputs
    $userID = mysqli_real_escape_string($con, $_POST['userID']);

    // Delete user account from the database
    $sql = "DELETE FROM Users WHERE userID = '$userID'";
    if (mysqli_query($con, $sql)) {
        echo "User account deleted successfully!";
    } else {
        echo "Error deleting user account: " . mysqli_error($con);
    }
}

// Close database connection
mysqli_close($con);
?>
