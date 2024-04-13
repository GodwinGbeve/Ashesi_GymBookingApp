<?php
// functions/manage_admin_fxn.php

// Function to fetch users based on search query
function fetchUsers($searchQuery) {
    // Include database connection
    include_once('../settings/connection.php');

    // Prepare SQL query to select users based on the search query
    $sql = "SELECT * FROM Users WHERE username LIKE ?";
    $stmt = $con->prepare($sql);

    // Bind parameters and execute query
    $searchParam = "%{$searchQuery}%"; // Add wildcards to search for partial matches
    $stmt->bind_param("s", $searchParam);
    $stmt->execute();

    // Get result set
    $result = $stmt->get_result();

    // Check if there are any users
    if ($result->num_rows > 0) {
        // Output data of each user as JSON
        $users = $result->fetch_all(MYSQLI_ASSOC);
        echo json_encode($users);
    } else {
        // No users found
        echo json_encode([]);
    }

    // Close statement and database connection
    $stmt->close();
    $con->close();
}
?>
