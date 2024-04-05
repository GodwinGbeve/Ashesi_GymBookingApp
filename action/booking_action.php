

<?php
// Include the connection file
include '../settings/connection.php';

// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if not logged in
    header('Location: ../login/login.php');
    exit();
}

// Check if the form is submitted for booking
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data and assign each to a variable
    $userID = $_SESSION['user_id'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $status = 'pending'; // Default status for new bookings

    // Insert the booking into the database
    $insertQuery = "INSERT INTO Bookings (userID, date, time_slot, status) VALUES ('$userID', '$date', '$time', '$status')";
    $insertResult = mysqli_query($con, $insertQuery);

    if ($insertResult) {
        // Booking insertion successful
        header('Location: ../view/booking.php');
        exit();
    } else {
        // Booking insertion failed
        echo json_encode(array('success' => false, 'message' => 'Failed to book session. Please try again.'));
        exit();
    }
} else {
    // If the form is not submitted, redirect to the booking page
    header('Location: ../view/booking.php');
    exit();
}

// Close the database connection
mysqli_close($con);
?>

