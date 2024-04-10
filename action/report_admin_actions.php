<?php
// Include database connection
include_once('../settings/connection.php');

// Function to fetch and format report data based on report type
function generateReport($reportType) {
    global $con;

    // Initialize an empty array to store report data
    $reportData = [];

    // Logic to fetch data from the database based on the report type
    switch($reportType) {
        case "booking-stats":
            // Query to fetch booking statistics
            $sql = "SELECT 
                        COUNT(*) AS totalBookings,
                        SUM(CASE WHEN status = 'pending' THEN 1 ELSE 0 END) AS pendingBookings,
                        SUM(CASE WHEN status = 'successful' THEN 1 ELSE 0 END) AS successfulBookings,
                        SUM(CASE WHEN status = 'cancelled' THEN 1 ELSE 0 END) AS cancelledBookings
                    FROM bookings";
            $result = mysqli_query($con, $sql);
            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $reportData = [
                    'Total Bookings' => $row['totalBookings'],
                    'Pending Bookings' => $row['pendingBookings'],
                    'Successful Bookings' => $row['successfulBookings'],
                    'Cancelled Bookings' => $row['cancelledBookings']
                ];
            }
            break;
                    case "active-members":
                        // Query to fetch total users count
                        $sqlTotalUsers = "SELECT COUNT(*) AS totalUsers FROM Users";
                        $resultTotalUsers = mysqli_query($con, $sqlTotalUsers);
                        if ($resultTotalUsers) {
                            $rowTotalUsers = mysqli_fetch_assoc($resultTotalUsers);
                            $reportData = [
                                'Active Users' => $rowTotalUsers['totalUsers']
                            ];
                        }
                    
                break;
            
        case "instructor":
            // Query to fetch instructor count
            $sql = "SELECT COUNT(*) AS totalInstructors FROM GymInstructors";
            $result = mysqli_query($con, $sql);
            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $reportData = [
                    'Total Instructors' => $row['totalInstructors']
                ];
            }
            break;
        case "feedback":
            // Query to fetch feedback count
            $sql = "SELECT COUNT(*) AS totalFeedbacks FROM Feedback";
            $result = mysqli_query($con, $sql);
            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $reportData = [
                    'Total Feedbacks' => $row['totalFeedbacks']
                ];
            }
            break;
        default:
            // Handle invalid report type
            $reportData = ['error' => 'Invalid report type'];
    }

    return $reportData;
}

// Function to generate and download the report in Excel format
function downloadReport($reportType, $reportData) {
    // Generate Excel file content based on the report data
    $content = '';
    foreach ($reportData as $key => $value) {
        $content .= "$key: $value\n";
    }

    // Set appropriate headers for download
    header("Content-type: application/octet-stream");
    header("Content-Disposition: attachment; filename={$reportType}_report.xlsx");
    header("Pragma: no-cache");
    header("Expires: 0");

    // Output the content for download
    echo $content;
}

// Check if report type and report data are provided in the URL
if (isset($_GET['report-type'])) {
    $reportType = $_GET['report-type'];
    $reportData = generateReport($reportType);

    // If download parameter is set, download the report
    if (isset($_GET['download']) && $_GET['download'] == 'true') {
        downloadReport($reportType, $reportData);
        exit(); // Terminate script after download
    }

    // If not downloading, output the report data as JSON
    echo json_encode($reportData);
}
?>
