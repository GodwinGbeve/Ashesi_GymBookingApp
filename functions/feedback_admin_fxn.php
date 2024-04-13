<?php
// Include database connection file
include '../settings/connection.php';

// Fetch feedback data from the database
$sql = "SELECT * FROM Feedback";
$result = mysqli_query($con, $sql);

// Check if any feedback records exist
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Display feedback data in HTML table rows
        echo "<tr>";
        echo "<td>" . $row['userID'] . "</td>";
        echo "<td>" . $row['feedback_type'] . "</td>";
        echo "<td>" . $row['star_rating'] . "</td>";
        echo "<td>" . $row['message'] . "</td>";
        echo "<td>" . $row['date'] . "</td>";
        // Add action buttons for reply, delete, and mark as resolved
        echo "<td>";

       if (isset($_SESSION['role_id'])) {
            $rid = $_SESSION['role_id'];

            // Display delete and mark as resolved buttons only for admin
            if ($rid == 3) { // If the user is an admin
                // Use Bootstrap SweetAlert for confirmation before deleting
                echo "<a class='delete-btn' href='../action/deletefeedback_admin.php?id=" . $row['feedbackID'] . "' style='background-color: #9F4446; color: white; margin-right: 5px;
                        padding: 8px 16px; border-radius: 5px; border: none; cursor: pointer;'>Delete</a>";

                if ($row['resolved'] == 1) {
                    echo "<a class='resolve-btn' href='../action/feedback_admin_actions.php?id=" . $row['feedbackID'] . "' style='background-color: green; color: white; padding: 8px 16px;
                            border-radius: 5px; border: none; cursor: pointer;'>Resolved</a>";
                } else {
                    echo "<a class='resolve-btn' href='../action/feedback_admin_actions.php?id=" . $row['feedbackID'] . "' style='background-color: #9F4446; color: white; padding: 8px 16px;
                            border-radius: 5px; border: none; cursor: pointer;'>Mark as Resolved</a>";
                }
            }
        }
        echo "</td>";
        echo "</tr>";
    }
} else {
    // If no feedback records found
    echo "<tr><td colspan='6'>No feedback available</td></tr>";
}
?>
