<?php
// Include database connection
include_once('../settings/connection.php');

// Check if user ID is provided in the query parameter
if (isset($_GET['userID'])) {
    // Validate and sanitize user ID
    $userID = mysqli_real_escape_string($con, $_GET['userID']);

    // Delete associated records from tables with foreign key relationships
    // Delete from Feedback table
    $sql_feedback = "DELETE FROM Feedback WHERE userID = '$userID'";
    mysqli_query($con, $sql_feedback);

    // Delete from Bookings table
    $sql_bookings = "DELETE FROM bookings WHERE userID = '$userID'";
    mysqli_query($con, $sql_bookings);

    // Now delete the user account from the Users table
    $sql_users = "DELETE FROM Users WHERE userID = '$userID'";
    if (mysqli_query($con, $sql_users)) {
        header('Location: ../admin/manageUsers_admin.php');
        exit();
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
