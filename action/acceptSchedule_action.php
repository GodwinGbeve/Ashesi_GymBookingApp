<?php
include "../settings/connection.php";

if (isset($_GET['id'])) {
    $bookingID = $_GET['id'];

    // Prepare SQL statement
    $sql = "UPDATE bookings SET status = 'Accepted' WHERE bookingID = ?";

    // Prepare and bind parameters
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "i", $bookingID);

    // Execute statement
    if (mysqli_stmt_execute($stmt)) {
        header('Location: ../admin/schedule_instructor.php');
        echo "Booking accepted successfully";
    } else {
        echo "Error: " . mysqli_error($con);
    }

    // Close statement
    mysqli_stmt_close($stmt);
} else {
    echo "Incomplete data provided for accept action";
}
?>
