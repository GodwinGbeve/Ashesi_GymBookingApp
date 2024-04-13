<?php
// Include database connection
include_once('../settings/connection.php');

// Fetch equipment data from the database
$sql = "SELECT * FROM Equipment";
$result = mysqli_query($con, $sql);

// Check if query was successful
if ($result) {
    // Check if there are rows returned
    if (mysqli_num_rows($result) > 0) {
        // Output data of each row
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='equipment-item'>";
            echo "<img src='../img/" . $row['image'] . "' alt='" . $row['equipment_name'] . "'>";
            echo "<h3>" . $row['equipment_name'] . "</h3>";
            echo "<h3>" . $row['description'] . "</h3>";
            echo "<h3>" . $row['quantity'] . "</h3>";
            // You can display additional information such as description and quantity here
            echo "</div>";
        }
    } else {
        echo "No equipment";
    }
} else {
    echo "Error: " . mysqli_error($con);
}

// Close database connection
mysqli_close($con);
?>
