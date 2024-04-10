<?php
// Include database connection file
include '../settings/connection.php';

// Check if action parameter is set and not empty
if (isset($_GET['id'])) {
    // Check which action t
    // Sanitize and validate input
    $feedbackID = $_GET['id'];

    // Prepare SQL statement
    $sql = "UPDATE Feedback SET resolved = 1 WHERE feedbackID = ?";

    // Prepare and bind parameters
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "i", $feedbackID);

    // Execute statement
    if (mysqli_stmt_execute($stmt)) {
        echo "Feedback marked as resolved";
        header('Location: ../admin/feedback_admin.php');
    } else {
        echo "Error: " . mysqli_error($con);
    }

    // Close statement
    mysqli_stmt_close($stmt);
} else {
    // Action parameter not set
    echo "No action specified";
}
?>