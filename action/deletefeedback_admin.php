<?php
// Include database connection file
include '../settings/connection.php';

// Check if feedbackID is set in POST request
if (isset($_GET['id'])) {
    // Sanitize input
    echo $_GET['id'];
    $feedbackID = mysqli_real_escape_string($con, $_GET['id']);

    // Delete feedback record
    $sql = "DELETE FROM Feedback WHERE feedbackID = '$feedbackID'";
    if (mysqli_query($con, $sql)) {
        // Return success message
        header('Location: ../admin/feedback_admin.php');
        //echo json_encode(array("success" => true, "message" => "Feedback deleted successfully."));
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
