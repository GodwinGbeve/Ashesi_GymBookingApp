<?php
// Include database connection
include_once('../settings/connection.php');

// Fetch gym instructors data from the database
$sql = "SELECT * FROM GymInstructors";
$result = mysqli_query($con, $sql);

// Check if query was successful
if ($result) {
    // Check if there are rows returned
    if (mysqli_num_rows($result) > 0) {
        // Output data of each row
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='instructor-item'>";
            echo "<img src='../img/" . $row['image'] . "' alt='" . $row['instructorName'] . "' class='instructor-image'>";
            echo "<h3 class='instructor-name'>" . $row['instructorName'] . "</h3>";
            echo '<p class="time-available">Time Available: ' . $row['time_available'] . '</p>';
            // Button to open the booking form modal
            echo '<button class="book-btn" onclick="openBookingForm(' . $row['instructorID'] . ')"><i class="fas fa-calendar-plus"></i> Book</button>';
            // You can display additional information such as time availability here

            // Booking form modal
            echo '<div id="bookingForm' . $row['instructorID'] . '" class="booking-form-modal">';
            echo '  <div class="booking-form-content">';
            echo '      <span class="close" onclick="closeBookingForm(' . $row['instructorID'] . ')">&times;</span>';
            echo '      <form action="../action/booking_action.php" method="post">';
            echo '          <input type="hidden" name="instructor" value="' . $row['instructorID'] . '">';
            echo '          <label for="booking_date">Select Date:</label>';
            echo '          <input type="date" id="booking_date" name="date" required>';
            echo '          <label for="booking_time">Select Time:</label>';
            echo '          <input type="time" id="booking_time" name="time" required>';
            echo '          <button type="submit" class="book-now-btn">Book Now</button>';
            echo '          <button type="button" onclick="closeBookingForm(' . $row['instructorID'] . ')" class="cancel-btn">Cancel</button>';
            echo '      </form>';
            echo '  </div>';
            echo '</div>'; // Close booking form modal

            echo "</div>"; // Close instructor item div
        }
    } else {
        echo "<p>No gym instructors available.</p>";
    }
} else {
    echo "<p>Error fetching gym instructors data.</p>";
}

// Close database connection
mysqli_close($con);
?>
