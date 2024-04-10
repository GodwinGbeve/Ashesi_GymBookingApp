<?php
// Include the connection file
include '../settings/connection.php';

// Check if instructor ID is provided in the URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Retrieve the instructor ID from the URL
    $instructor_id = $_GET['id'];

    // Write the DELETE query
    $delete_query = "DELETE FROM GymInstructors WHERE instructorID = $instructor_id";

    // Execute the query
    $result = mysqli_query($con, $delete_query);

    // Check if execution worked
    if ($result) {
        // Instructor successfully deleted, redirect back to the page where you want to display the list of instructors
        header('Location: ../admin/instructors_admin.php');
        exit();
    } else {
        // If execution failed, display error message
        echo "Error: " . mysqli_error($con);
        // You can also redirect back with an error message if needed
    }
} else {
    // Instructor ID not provided in the URL, redirect back to the page where you want to display the list of instructors
    header('Location: ../admin/instructors_admin.php');
    exit();
}
?>
