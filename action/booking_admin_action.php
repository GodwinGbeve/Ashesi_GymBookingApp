<?php
// Include database connection file
include '../settings/connection.php';

// Check if action parameter is set and not empty
if (isset($_POST['action'])) {
    // Check which action to perform
    switch ($_POST['action']) {
        case 'delete':
            // Handle delete action
            if (isset($_POST['bookingID'])) {
                // Sanitize and validate input
                $bookingID = $_POST['bookingID'];

                // Prepare SQL statement
                $sql = "DELETE FROM Bookings WHERE bookingID = ?";

                // Prepare and bind parameters
                $stmt = mysqli_prepare($con, $sql);
                mysqli_stmt_bind_param($stmt, "i", $bookingID);

                // Execute statement
                if (mysqli_stmt_execute($stmt)) {
                    echo "Booking deleted successfully";
                } else {
                    echo "Error: " . mysqli_error($con);
                }

                // Close statement
                mysqli_stmt_close($stmt);
            } else {
                echo "Incomplete data provided for delete action";
            }
            break;
        case 'cancel':
            // Handle cancel action
            if (isset($_POST['bookingID'])) {
                // Sanitize and validate input
                $bookingID = $_POST['bookingID'];

                // Prepare SQL statement
                $sql = "UPDATE Bookings SET status = 'Cancelled' WHERE bookingID = ?";

                // Prepare and bind parameters
                $stmt = mysqli_prepare($con, $sql);
                mysqli_stmt_bind_param($stmt, "i", $bookingID);

                // Execute statement
                if (mysqli_stmt_execute($stmt)) {
                    echo "Booking cancelled successfully";
                } else {
                    echo "Error: " . mysqli_error($con);
                }

                // Close statement
                mysqli_stmt_close($stmt);
            } else {
                echo "Incomplete data provided for cancel action";
            }
            break;
        default:
            // Invalid action
            echo "Invalid action";
            break;
    }
} else {
    // Action parameter not set
    echo "No action specified";
}
?>
