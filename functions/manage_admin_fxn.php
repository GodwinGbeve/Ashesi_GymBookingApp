<?php
// functions/manage_admin_fxn.php

// Function to fetch and display user table

    // Include database connection
    include_once('../settings/connection.php');

    // SQL query to select all users
    $sql = "SELECT * FROM Users";

    // Execute query
    $result = mysqli_query($con, $sql);

    // Check if there are any users
    if (mysqli_num_rows($result) > 0) {
        // Output table header
       

        // Output data of each user
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr data-userID="' . $row['userID'] . '">';
            echo '<td>' . $row['userID'] . '</td>';
            echo '<td>' . $row['username'] . '</td>';
            echo '<td>' . $row['email'] . '</td>';
            echo '<td>' . $row['roleID'] . '</td>';
            echo '<td>';
            echo '<button class="edit-btn" data-userID="' . $row['userID'] . '">Edit</button>';
            echo '<a class="delete-btn" href="../action/manageUser_delete.php?userID=' . $row['userID'] . '" style="background-color: #9F4446; color: white; padding: 8px 16px; border: none; border-radius: 4px; text-decoration: none; display: inline-block;">Delete</a>';
            echo '</td>';
            echo '</tr>';
        }
        
        // Close table
        echo '</tbody>';
        echo '</table>';
    } else {
        // No users found
        echo 'No users found.';
    }

    // Close database connection
    mysqli_close($con);


// Call the function to display user table

?>
