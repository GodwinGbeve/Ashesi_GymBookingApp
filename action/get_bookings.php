// get_bookings.php

<?php
// Include the connection file
include '../settings/connection.php';

// Fetch bookings data from the database
$selectQuery = "SELECT date, time_slot FROM Bookings";
$result = mysqli_query($con, $selectQuery);

$bookings = array();
while ($row = mysqli_fetch_assoc($result)) {
    $bookings[] = $row;
}

// Send bookings data as JSON response
echo json_encode($bookings);

// Close the database connection
mysqli_close($con);
?>
