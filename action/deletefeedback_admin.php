<?php
// Include database connection file
include '../settings/connection.php';

// Check if feedbackID is set in GET request
if (isset($_GET['id'])) {
    // Sanitize input
    $feedbackID = mysqli_real_escape_string($con, $_GET['id']);

    // Delete feedback record
    $sql = "DELETE FROM Feedback WHERE feedbackID = '$feedbackID'";
    if (mysqli_query($con, $sql)) {
        // Return success message
        header('Location: ../admin/feedback_admin.php');
        exit(); // Stop further execution
    } else {
        // Return error message
        echo json_encode(array("success" => false, "message" => "Error deleting feedback: " . mysqli_error($con)));
    }
} else {
    // FeedbackID parameter is missing
    echo json_encode(array("success" => false, "message" => "FeedbackID parameter is missing."));
}

// Close database connection
mysqli_close($con);
?>
