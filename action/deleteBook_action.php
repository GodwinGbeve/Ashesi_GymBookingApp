<?php
// Include the connection file
include '../settings/connection.php';

// Check if the booking ID is provided
if (isset($_GET['id'])) {
    $bookingID = $_GET['id'];

    // Delete the booking from the database
    $deleteQuery = "DELETE FROM Bookings WHERE bookingID='$bookingID'";
    $deleteResult = mysqli_query($con, $deleteQuery);

    if ($deleteResult) {
        // Booking deletion successful
        header('Location: ../view/booking.php');
        exit();
    } else {
        // Booking deletion failed
        echo "Failed to delete booking. Please try again.";
        exit();
    }
} else {
    // If the booking ID is not provided, redirect to the booking page
    header('Location: ../view/booking.php');
    exit();
}

// Close the database connection
mysqli_close($con);
?>
