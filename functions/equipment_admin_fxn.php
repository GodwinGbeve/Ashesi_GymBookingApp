<?php
// Include database connection
include_once('../settings/connection.php');
include_once('../settings/core.php');

// Fetch equipment data from the database
$sql = "SELECT * FROM Equipment";
$result = mysqli_query($con, $sql);

// Check if there are any records
if (mysqli_num_rows($result) > 0) {
    // Output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo '<div class="equipment-item">';
        echo '<img src="../img/' . $row['image'] .'" class="equipment-image">';
        echo '<h3 class="equipment-name">' . $row['equipment_name'] . '</h3>';
        echo '<p class="equipment-description">' . $row['description'] . '</p>';
        echo '<p class="quantity-available">Quantity Available: ' . $row['quantity'] . '</p>';
        
        // Check if youtube_link exists and display it
        if (!empty($row['youtube_link'])) {
            echo '<p class="youtube-link"><a href="' . $row['youtube_link'] . '" target="_blank">How to use
            </a></p>';
        }
        
        // Edit and Delete buttons
        echo '<div class="edit-delete-buttons">';
        if (isset($_SESSION['role_id'])) {
            $rid = $_SESSION['role_id'];
        
            // Display delete and cancel buttons only for admin
            if ($rid == 3) { // If the user is an admin
                echo '<button class="edit-btn" onclick="editEquipment(' . $row['equipmentID'] . ')"><i class="fas fa-edit"></i> Edit</button>';
                echo '<a class="delete-btn" href="../action/deleteEquipment_action.php?id=' . $row['equipmentID'] . '" style="text-decoration: none;"><i class="fas fa-trash"></i> Delete</a>';
            }
        }
        echo '</div>';
        
        echo '</div>';
    }
} else {
    echo "No equipment";
}

// Close database connection
mysqli_close($con);
?>
