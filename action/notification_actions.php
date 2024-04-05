<?php
// Include the connection file
include '../settings/connection.php';

// Fetch feedback messages
$sql = "SELECT * FROM Feedback";
$result = $con->query($sql);

$feedback_messages = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $feedback_messages[] = $row;
    }
}

// Fetch missed messages
$sql = "SELECT * FROM Notification WHERE timestamp < DATE_SUB(NOW(), INTERVAL 10 DAY)";
$result = $con->query($sql);

$missed_messages = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $missed_messages[] = $row;
    }
}

// Step 4: Logic to move messages to "missed messages" if they are older than 10 days
$sql = "DELETE FROM Notification WHERE timestamp < DATE_SUB(NOW(), INTERVAL 10 DAY)";
$con->query($sql);

// Close the database connection
$con->close();
?>
