<?php
// Include database connection file
include '../settings/connection.php';

// Fetch bookings from the database
$query = "SELECT Bookings.bookingID, Bookings.userID, Users.username, Bookings.instructorID, GymInstructors.instructorName, Bookings.date, Bookings.time_slot, Bookings.status 
          FROM Bookings 
          LEFT JOIN Users ON Bookings.userID = Users.userID 
          LEFT JOIN GymInstructors ON Bookings.instructorID = GymInstructors.instructorID";

$result = mysqli_query($con, $query);

// Check if there are any bookings
if (mysqli_num_rows($result) > 0) {
    // Loop through each row and create table rows
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['userID'] . "</td>";
        echo "<td>" . $row['username'] . "</td>";
        echo "<td>" . $row['instructorID'] . "</td>";
        echo "<td>" . $row['instructorName'] . "</td>";
        echo "<td>" . $row['date'] . "</td>";
        echo "<td>" . $row['time_slot'] . "</td>";
        echo "<td>" . $row['status'] . "</td>";
        // Add buttons for actions (delete and cancel)
        echo "<td>";
        echo "<button class='delete-btn' data-booking-id='" . $row['bookingID'] . "' style='background-color: #9F4446; color: white; margin-right: 5px; padding: 8px 16px; border-radius: 5px; border: none; cursor: pointer;'>Delete</button>";
        echo "<button class='cancel-btn' data-booking-id='" . $row['bookingID'] . "' style='background-color: #9F4446; color: white; margin-right: 5px; padding: 8px 16px; border-radius: 5px; border: none; cursor: pointer;'>Cancel</button>";
        echo "</td>";
        echo "</tr>";
    }
} else {
    // If no bookings are found, display a message
    echo "<tr><td colspan='7'>No bookings found</td></tr>";
}
?>
