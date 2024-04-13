<?php
// Include database connection file
include '../settings/connection.php';

// Check if action parameter is set and not empty
if (isset($_GET['id'])) {
    // Sanitize and validate input
    $feedbackID = mysqli_real_escape_string($con, $_GET['id']);

    // Prepare SQL statement
    $sql = "UPDATE Feedback SET resolved = 1 WHERE feedbackID = ?";

    // Prepare and bind parameters
    if ($stmt = mysqli_prepare($con, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $feedbackID);

        // Execute statement
        if (mysqli_stmt_execute($stmt)) {
            // Feedback marked as resolved
            echo "Feedback marked as resolved";
            // Show SweetAlert notification
            echo "<script>swal('Success!', 'Feedback has been marked as resolved.', 'success');</script>";
            // Redirect back to the feedback admin page
            header('Location: ../admin/feedback_admin.php');
            exit();
        } else {
            echo "Error: " . mysqli_error($con);
        }

        // Close statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing statement: " . mysqli_error($con);
    }
} else {
    // Action parameter not set
    echo "No action specified";
}
?>
