<?php
// Include database connection
include_once('../settings/connection.php');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize inputs
    $userID = mysqli_real_escape_string($con, $_POST['userID']);
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $roleID = mysqli_real_escape_string($con, $_POST['roleID']);
    print_r($_POST);
    echo $userID , $username ,$email ,  $roleID ;

    // Update user information in the database
    $sql = "UPDATE Users SET username = '$username', email = '$email', roleID = '$roleID' WHERE userID = '$userID'";
    if (mysqli_query($con, $sql)) {
        // Return success message 
        header('Location: ../admin/manageUsers_admin.php');
        echo json_encode(array("success" => true, "message" => "User information updated successfully."));
    } else {
        // Return error message
        echo json_encode(array("success" => false, "message" => "Error updating user information: " . mysqli_error($con)));
    }
} else {
    // Invalid request method
    echo json_encode(array("success" => false, "message" => "Invalid request method!"));
}

// Close database connection
mysqli_close($con);
?>
