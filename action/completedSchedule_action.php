<?php
// Include database connection file
include "../settings/connection.php";

// Check if the booking ID is set and not empty
if (isset($_GET['id'])) {
    // Sanitize input
    $bookingID = $_GET['id'];

    // Prepare SQL statement
    $sql = "UPDATE bookings SET status = 'Completed' WHERE bookingID = ?";

    // Prepare and bind parameters
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "i", $bookingID);

    // Execute statement
    if (mysqli_stmt_execute($stmt)) {
        header('Location: ../admin/schedule_instructor.php');
        echo "Booking marked as completed successfully";
    } else {
        echo "Error: " . mysqli_error($con);
    }

    // Close statement
    mysqli_stmt_close($stmt);
} else {
    echo "Incomplete data provided";
}

// Close database connection
mysqli_close($con);
?>
