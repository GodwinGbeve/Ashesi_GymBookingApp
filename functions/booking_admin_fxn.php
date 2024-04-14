<?php
// Include database connection file
include ('../settings/connection.php');

// Fetch bookings from the database
$query = "SELECT bookings.bookingID, bookings.userID, Users.username, bookings.instructorID, GymInstructors.instructorName, bookings.date, bookings.time_slot, bookings.status 
          FROM bookings 
          LEFT JOIN Users ON bookings.userID = Users.userID 
          LEFT JOIN GymInstructors ON bookings.instructorID = GymInstructors.instructorID";

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
        if (isset($_SESSION['role_id'])) {
            $rid = $_SESSION['role_id'];
        
            // Display delete and cancel buttons only for admin
            if ($rid == 3) { // If the user is an admin
                echo "<button class='delete-btn' data-booking-id='" . $row['bookingID'] . "' style='background-color: #9F4446; color: white; margin-right: 5px; padding: 8px 16px; border-radius: 5px; border: none; cursor: pointer;'>Delete</button>";
                echo "<button class='cancel-btn' data-booking-id='" . $row['bookingID'] . "' style='background-color: #9F4446; color: white; margin-right: 5px; padding: 8px 16px; border-radius: 5px; border: none; cursor: pointer;'>Cancel</button>";
            }
        }
        
        echo "</td>";
        echo "</tr>";
    }
} else {
    // If no bookings are found, display a message
    echo "<tr><td colspan='7'>No bookings found</td></tr>";
}
?>
