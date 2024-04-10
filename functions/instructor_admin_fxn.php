<?php
// Include database connection
include_once ('../settings/connection.php');

// Fetch instructor data from the database
$sql = "SELECT * FROM GymInstructors";
$result = mysqli_query($con, $sql);

// Check if there are any records
if (mysqli_num_rows($result) > 0) {
    // Output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="instructor-item">';
        echo '<img src="../img/' . $row['image'] . '" class="instructor-image">';
        echo '<h3 class="instructor-name">' . $row['instructorName'] . '</h3>';
        echo '<p class="time-available">Time Available: ' . $row['time_available'] . '</p>';


        // Edit and Delete buttons
        echo '<div class="edit-delete-buttons">';
        echo '<button class="edit-btn" onclick="editInstructor(' . $row['instructorID'] . ')"><i class="fas fa-edit"></i> Edit</button>';
        echo '<a class="delete-btn" href="../action/deleteInstructor_action.php?id=' . $row['instructorID'] . '" style="text-decoration: none;"><i class="fas fa-trash"></i> Delete</a>';
        echo '</div>';


        echo '</div>';
    }
} else {
    echo "0 results";
}

// Close database connection
mysqli_close($con);
?>
