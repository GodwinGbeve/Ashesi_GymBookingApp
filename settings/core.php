<?php

session_start();

// create a function to check for login using user id session created at login
function checkLogin()
{
    // check if user id session exists
    if (!isset($_SESSION['user_id'])) {
        // if it doesn't exist, redirect to login page
        header("Location: ../login/login.php");
        // stop further execution
        die();
    }
}

// Function to retrieve user's role ID from session
function getUserRole() {
    // Check if the role ID session variable is set
    if (isset($_SESSION['role_id'])) {
        // Return the user's role ID
        return $_SESSION['role_id'];
    } else {
        // Return null or handle the case where role ID is not set
        return null;
    }
}

// Check user's role and control access to pages
function checkAuthorization() {
    // Retrieve user's role ID
    $role_id = getUserRole();

    // Check the role and redirect accordingly
    switch ($role_id) {
        case 1: // Student
        case 2: // Faulty
            header("Location: ../view/dashboard.php");
            break;
        case 3: // Admin
        case 4: // Instructor
            header("Location: ../admin/dashboard_admin.php");
            break;
        default:
            // If the role is not recognized or not set, redirect to login page
            header("Location: ../login/login.php");
            break;
    }
}

?>