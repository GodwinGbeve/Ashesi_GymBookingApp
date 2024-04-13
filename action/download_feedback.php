<?php
// Include database connection file
include '../settings/connection.php';

// Fetch feedback data from the database
$sql = "SELECT * FROM Feedback";
$result = mysqli_query($con, $sql);

// Check if any feedback records exist
if (mysqli_num_rows($result) > 0) {
    // Specify a directory for creating the temporary file
    $tempDir = '../temp';
    if (!is_dir($tempDir)) {
        mkdir($tempDir, 0777, true);
    }

    // Create a temporary file to store the feedback data
    $tempFile = tempnam($tempDir, 'feedback');
    $fileHandle = fopen($tempFile, 'w');

    while ($row = mysqli_fetch_assoc($result)) {
        // Write feedback data to the temporary file
        fwrite($fileHandle, $row['userID'] . ',' . $row['feedback_type'] . ',' . $row['star_rating'] . ',' . $row['message'] . ',' . $row['date'] . "\n");
    }

    fclose($fileHandle);

    // Set headers for file download
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="feedback.csv"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($tempFile));

    // Output the file content
    readfile($tempFile);

    // Delete the temporary file
    unlink($tempFile);
  
    exit();
} else {
    // If no feedback records found
    echo "<tr><td colspan='6'>No feedback available</td></tr>";
}
?>