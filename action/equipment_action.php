<?php
// Function to retrieve equipment availability from the database
function getEquipmentAvailability($conn) {
    // Query to select equipment availability
    $sql = "SELECT equipmentID, equipment_name, status FROM equipment";

    // Execute the query
    $result = mysqli_query($conn, $sql);

    // Check if query executed successfully
    if ($result) {
        // Fetch data from the result set
        $equipmentAvailability = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $equipmentAvailability[] = $row;
        }
        return $equipmentAvailability;
    } else {
        // Handle query execution error
        return null;
    }
}

// Example database connection
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "gym_booking";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get equipment availability
$equipmentAvailability = getEquipmentAvailability($conn);

// Display equipment availability
if ($equipmentAvailability) {
    echo "<h2>Equipment Availability</h2>";
    echo "<table border='1'>";
    echo "<tr><th>Equipment ID</th><th>Equipment Name</th><th>Status</th></tr>";
    foreach ($equipmentAvailability as $equipment) {
        echo "<tr>";
        echo "<td>" . $equipment['equipmentID'] . "</td>";
        echo "<td>" . $equipment['equipment_name'] . "</td>";
        echo "<td>" . $equipment['status'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Failed to retrieve equipment availability.";
}

// Close the database connection
mysqli_close($conn);
?>
