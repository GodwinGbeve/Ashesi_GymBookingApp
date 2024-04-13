<?php
include "../settings/connection.php"; 
include_once "../settings/core.php"; 
function getUserName($userId, $con) {
    $query = "SELECT username FROM Users WHERE userID = $userId";
    $result = mysqli_query($con, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['username']; // Return user's username
    } else {
        return "User not found";
    }
}


?>