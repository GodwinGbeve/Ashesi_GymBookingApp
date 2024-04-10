<?php
// Include database connection
include_once('../settings/connection.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate input
    $notificationID = $_POST['notificationID'];
    $replyMessage = $_POST['replyMessage'];

    // Perform necessary validations (e.g., check if notificationID exists)
    $query = "SELECT * FROM Notification WHERE notificationID = :notificationID";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':notificationID', $notificationID);
    $stmt->execute();
    $notification = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$notification) {
        // Notification not found
        echo "Notification not found";
        exit; // Terminate script execution
    }

    // Update notification in the database to include the reply
    $query = "UPDATE Notification SET messageReplied = :replyMessage WHERE notificationID = :notificationID";
    
    // Prepare statement
    $stmt = $conn->prepare($query);

    // Bind parameters
    $stmt->bindParam(':notificationID', $notificationID);
    $stmt->bindParam(':replyMessage', $replyMessage);

    // Execute statement
    if ($stmt->execute()) {
        // Reply sent successfully
        echo "Reply sent successfully";
    } else {
        // Failed to send reply
        echo "Failed to send reply";
    }
}
?>
