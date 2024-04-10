<?php
// Include database connection
include_once('../settings/connection.php');

// Check if user ID is provided in the query parameter
if (isset($_GET['userID'])) {
    // Validate and sanitize user ID
    $userID = mysqli_real_escape_string($con, $_GET['userID']);

    // Delete user account from the database
    $sql = "DELETE FROM Users WHERE userID = '$userID'";
    if (mysqli_query($con, $sql)) {
        header('Location: ../admin/manageUsers_admin.php');
        echo "User account deleted successfully!";
    } else {
        echo "Error deleting user account: " . mysqli_error($con);
    }
} else {
    // User ID not provided in the query parameter
    echo "User ID not provided!";
}

// Close database connection
mysqli_close($con);
?>
