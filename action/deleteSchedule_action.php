<?php
// Check if the action parameter is set and not empty
include "../settings/connection.php";
    // Include the connection file (if not already included)

    if (isset($_GET['id'])) {
    // Handle the specified action

            // Handle delete action
            if (isset($_GET['id'])) {
                // Sanitize input
                $bookingID = $_GET['id'];

                // Prepare SQL statement
                $sql = "DELETE FROM bookings WHERE bookingID = ?";

                // Prepare and bind parameters
                $stmt = mysqli_prepare($con, $sql);
                mysqli_stmt_bind_param($stmt, "i", $bookingID);

                // Execute statement
                if (mysqli_stmt_execute($stmt)) {
                    header('Location: ../admin/schedule_instructor.php');
                    echo "Booking deleted successfully";
                } else {
                    echo "Error: " . mysqli_error($con);
                }

                // Close statement
                mysqli_stmt_close($stmt);
            } else {
                echo "Incomplete data provided for delete action";
            }}
          