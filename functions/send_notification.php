<?php
// Include database connection
include_once('../settings/connection.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate input
    $recipient = $_POST['recipient'];
    $message = $_POST['message'];

    // Perform necessary validations (e.g., check if recipient is valid)
    if ($recipient != 'user' && $recipient != 'instructor') {
        // Invalid recipient
        echo "Invalid recipient";
        exit; // Terminate script execution
    }

    // Insert notification into the database
    $query = "INSERT INTO Notification (userID, timestamp, senderID, receiverID, messageReceived) 
              VALUES (:userID, NOW(), :senderID, :receiverID, :messageReceived)";
    
    // Prepare statement
    $stmt = $conn->prepare($query);

    // Bind parameters
    $stmt->bindParam(':userID', $userID); // Assuming you have a variable for userID
    $stmt->bindParam(':senderID', $senderID); // Assuming you have a variable for senderID
    $stmt->bindParam(':receiverID', $recipient);
    $stmt->bindParam(':messageReceived', $message);

    // Execute statement
    if ($stmt->execute()) {
        // Notification sent successfully
        echo "Notification sent successfully";
    } else {
        // Failed to send notification
        echo "Failed to send notification";
    }
}
?>
