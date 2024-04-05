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

?>