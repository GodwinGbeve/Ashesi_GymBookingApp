<?php
// Include the connection file
include '../settings/connection.php';

// Check if equipment ID is provided in the URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Retrieve the equipment ID from the URL
    $equipment_id = $_GET['id'];

    // Write the DELETE query
    $delete_query = "DELETE FROM Equipment WHERE equipmentID = $equipment_id";

    // Execute the query
    $result = mysqli_query($con, $delete_query);

    // Check if execution worked
    if ($result) {
        // Equipment successfully deleted, redirect back to the page where you want to display the list of equipment
        header('Location: ../admin/equipment_admin.php');
        exit();
    } else {
        // If execution failed, display error message
        echo "Error: " . mysqli_error($con);
        // You can also redirect back with an error message if needed
    }
} else {
    // Equipment ID not provided in the URL, redirect back to the page where you want to display the list of equipment
    header('Location: ../admin/equipment_admin.php');
    exit();
}
?>
