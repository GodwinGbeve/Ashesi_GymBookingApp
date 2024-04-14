<?php
// Include the core.php file
include '../settings/connection.php';


// Fetch bookings along with the corresponding instructor information
$query = "SELECT b.*, i.instructorName FROM Bookings b JOIN GymInstructors i ON b.instructorID = i.instructorID";
$result = mysqli_query($con, $query);

// Check if there are any bookings
if (mysqli_num_rows($result) > 0) {

    // Loop through each row and display the booking information
    while ($row = mysqli_fetch_assoc($result)) {
        if ($row['userID'] == $_SESSION['user_id']) {
            echo "<tr>";
            echo "<td class='date-column'>" . $row['date'] . "</td>";
            echo "<td class='time-column'>" . $row['time_slot'] . "</td>";
            echo "<td class='instructor-column'>" . $row['instructorName'] . "</td>"; // Display instructor name
            echo "<td><a href='#' class='edit-icon' data-id='" . $row['bookingID'] . "'><i class='fas fa-edit'></i></a></td>";
            echo "<td><a href='#' class='delete-icon' onclick='confirmDelete(" . $row['bookingID'] . ")'><i class='fas fa-trash-alt'></i></a></td>";
            echo "</tr>";
        }
    }
} else {
    // If no bookings are found, display a message
    echo "<tr><td colspan='5'>No bookings found</td></tr>";
}

?>