<?php
// Include database connection
include_once('../settings/connection.php');

// Query to get total bookings
$sqlTotalBookings = "SELECT COUNT(*) AS totalBookings FROM bookings";
$resultTotalBookings = mysqli_query($con, $sqlTotalBookings);
$rowTotalBookings = mysqli_fetch_assoc($resultTotalBookings);
$totalBookings = $rowTotalBookings['totalBookings'];

// Query to get total members
$sqlTotalMembers = "SELECT COUNT(*) AS totalMembers FROM Users ";
$resultTotalMembers = mysqli_query($con, $sqlTotalMembers);
$rowTotalMembers = mysqli_fetch_assoc($resultTotalMembers);
$totalMembers = $rowTotalMembers['totalMembers'];

// Query to get total equipment availability
$sqlEquipmentAvailability = "SELECT COUNT(*) AS equipmentAvailability FROM Equipment";
$resultEquipmentAvailability = mysqli_query($con, $sqlEquipmentAvailability);
$rowEquipmentAvailability = mysqli_fetch_assoc($resultEquipmentAvailability);
$equipmentAvailability = $rowEquipmentAvailability['equipmentAvailability'];

// Query to get total feedbacks
$sqlTotalFeedbacks = "SELECT COUNT(*) AS totalFeedbacks FROM Feedback";
$resultTotalFeedbacks = mysqli_query($con, $sqlTotalFeedbacks);
$rowTotalFeedbacks = mysqli_fetch_assoc($resultTotalFeedbacks);
$totalFeedbacks = $rowTotalFeedbacks['totalFeedbacks'];


// Query to get total gym instructors
$sqlTotalInstructors = "SELECT COUNT(*) AS totalInstructors FROM GymInstructors";
$resultTotalInstructors = mysqli_query($con, $sqlTotalInstructors);
$rowTotalInstructors = mysqli_fetch_assoc($resultTotalInstructors);
$totalInstructors = $rowTotalInstructors['totalInstructors'];

// Calculate statistics percentage based on total members and total bookings
$totalMetrics = 6; // Total number of metrics

$statisticsPercentage = round((($totalBookings + $totalMembers + $equipmentAvailability + $totalFeedbacks + $totalInstructors )/5) * 100);


// Render the information on the dashboard
?>