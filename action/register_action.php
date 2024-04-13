<?php
// Include the connection file
include '../settings/connection.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data and assign each to a variable
    $name = $_POST['name'];
    $email = $_POST['email'];
    $raw_password = $_POST['password'];
    $dob = $_POST['dob'];
    $residence = $_POST['residence'];
    $fitness_goal = $_POST['fitness-goals'];
    $role = $_POST['role'];

    // Encrypt the password using password_hash()
    $hashed_password = password_hash($raw_password, PASSWORD_DEFAULT);

    // Write the insert query using the variables
    $insert_query = "INSERT INTO Users (username, passwd, email, roleID, date_of_birth, residence, fitness_goal) 
                    VALUES ('$name', '$hashed_password', '$email', '$role', '$dob', '$residence', '$fitness_goal')";

    // Execute the query using the connection
    $result = mysqli_query($con, $insert_query);

    // Check if execution worked
    if ($result) {
        // Redirect to login page with success parameter
        header('Location: ../login/login.php?success=true');
        exit();
    } else {
        // Take appropriate action if execution fails (display error on signup page)
        $_SESSION['error'] = "Error: " . mysqli_error($con);
        header('Location: ../login/signup.php');
        exit();
    }
} else {
    // If the form is not submitted, redirect to the signup page
    header('Location: ../login/signup.php');
    exit();
}
?>
