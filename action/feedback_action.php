<?php
// Include the connection file
include '../settings/connection.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data
    $userID = isset($_POST['userID']) ? $_POST['userID'] : ''; // Check if userID is set
    $feedbackType = $_POST['feedbackType'];
    $comments = $_POST['comments'];
    $starRating = $_POST['starRating'];
    $date = date('Y-m-d H:i:s'); // Current date and time

    // Sanitize the user input to prevent SQL injection
    $userID = mysqli_real_escape_string($con, $userID);
    $feedbackType = mysqli_real_escape_string($con, $feedbackType);
    $comments = mysqli_real_escape_string($con, $comments);
    $starRating = mysqli_real_escape_string($con, $starRating);

    // Insert feedback into the database
    $insertQuery = "INSERT INTO Feedback (userID, feedback_type, message,  date,star_rating) VALUES ('$userID', '$feedbackType', '$comments', '$date',  '$starRating')";
    $insertResult = mysqli_query($con, $insertQuery);

    if ($insertResult) {
        // Feedback submission successful
        echo "Feedback submitted successfully!";
    } else {
        // Feedback submission failed
        echo "Failed to submit feedback. Please try again.";
    }
} else {
    // If the form is not submitted, redirect back to the feedback page
    header('Location: ../view/feedback.php');
    exit();
}

// Close the database connection
mysqli_close($con);
?>
