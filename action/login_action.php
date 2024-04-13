<?php
session_start();

// Include the connection file
require_once '../settings/connection.php';
include('../settings/core.php');

// Initialize flag for form validation
$formValid = true;

// Check if form data is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data and store in variables after escaping
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    // Validate form data
    if (empty($email) || empty($password)) {
        $_SESSION['error'] = "Please enter both email and password";
        $formValid = false; // Set form validation flag to false
    }

    // If form is valid, proceed with further validation
    if ($formValid) {
        // Prepare the query to select a record from the Users table using the email
        $query = "SELECT * FROM Users WHERE email = '$email'";

        // Execute the query
        $result = mysqli_query($con, $query);

        // Check if any row was returned
        if (mysqli_num_rows($result) == 0) {
            // No record found, provide appropriate response
            $_SESSION['error'] = "User not registered";
            $formValid = false; // Set form validation flag to false
        } else {
            // Fetch the record
            $user = mysqli_fetch_assoc($result);

            // Verify password user provided against database record using the PHP method password_verify()
            if (!password_verify($password, $user['passwd'])) {
                // Password does not match, provide appropriate response
                $_SESSION['error'] = "Incorrect password";
                $formValid = false; // Set form validation flag to false
            }
        }

        // If form is still valid after further validation, proceed with login
        if ($formValid) {
            // Password verified, create a session for user id and role id
            $_SESSION['user_id'] = $user['userID'];
            $_SESSION['role_id'] = $user['roleID'];

            // Redirect based on the user's role
            switch ($_SESSION['role_id']) {
                case 1: // Student
                case 2: // Faculty
                    header("Location: ../view/dashboard.php");
                    break;
                case 3: // Admin
                case 4: // Instructor
                    header("Location: ../admin/dashboard_admin.php");
                    break;
                default:
                    header("Location: ../login/login.php"); // Redirect to login page if role is unknown
            }
            exit(); // Exit after redirection
        }
    }
}

// If form validation fails or role is unknown, redirect to login page and display SweetAlert2 alert
echo '<script>
        Swal.fire({
            icon: "error",
            title: "Login Failed",
            text: "' . $_SESSION['error'] . '"
        });
      </script>';
header('Location: ../login/login.php');
exit();
?>
