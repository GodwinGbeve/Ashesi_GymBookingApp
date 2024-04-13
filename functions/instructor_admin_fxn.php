<?php
// Include database connection
include_once ('../settings/connection.php');
include_once('../settings/core.php');

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
        if (isset($_SESSION['role_id'])) {
            $rid = $_SESSION['role_id'];
        
            // Display delete and cancel buttons only for admin
            if ($rid == 3) { // If the user is an admin
        echo '<button class="edit-btn" onclick="editInstructor(' . $row['instructorID'] . ')"><i class="fas fa-edit"></i> Edit</button>';
        echo '<a class="delete-btn" href="../action/deleteInstructor_action.php?id=' . $row['instructorID'] . '" style="text-decoration: none;"><i class="fas fa-trash"></i> Delete</a>';
            }}
        echo '</div>';


        echo '</div>';
    }
} else {
    echo "No instructor";
}

// Close database connection
mysqli_close($con);
?>
