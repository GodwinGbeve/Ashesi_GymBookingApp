<?php
// Include the connection file
include '../settings/connection.php';

// Check if the form is submitted for booking update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data and assign each to a variable
    $bookingID = $_POST['booking_id'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $instructorID = $_POST['instructor']; // Add instructor ID from the form

    // Update the booking in the database
    $updateQuery = "UPDATE Bookings SET date='$date', time_slot='$time', instructorID='$instructorID' WHERE bookingID='$bookingID'";
    $updateResult = mysqli_query($con, $updateQuery);

    if ($updateResult) {
        // Booking update successful
        header('Location: ../view/booking.php');
        exit();
    } else {
        // Booking update failed
        echo "Failed to update booking. Please try again.";
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
