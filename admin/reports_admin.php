<?php
// Include database connection
include_once ('../settings/connection.php');
include_once ('../settings/core.php');
include ('../functions/username_fxn.php');
?>

<?php
// Start session

if (!isset($_SESSION['role_id'])) {
    header('Location: ../login/logout_view.php?error=unauthorized_user');
    exit();
}
else if($_SESSION['role_id'] != 3 ){
    header('Location: ../view/404.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Reports</title>
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/admin_css/reports_admin.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

</head>

<body>
    
    <div class="admin-reports-page">
        <div class="sidebar">
            <div class="sidebar-header">
                <span class="material-symbols-outlined">
                    exercise</span>
                <?php
                if (isset($_SESSION['user_id'])) {
                    $userId = $_SESSION['user_id'];
                    $userName = getUserName($userId, $con);
                    echo '<div class="user-info">';

                    echo '  <strong>' . $userName . '</strong>'; // Enclose user name in <strong> tag
                    echo '</div>';
                } else {
                    echo "Error: User ID not set in session";
                }
                ?>

                <div class="reports-icon"><i></i></div>
                <div class="logo">AshesiFit</div>
            </div>
            <div class="sidebar-menu">
            <a class="link_tab" href="../admin/profile_admin.php"><div class="menu-item "><i class="fas fa-user"></i> Profile
                </div></a>
                <a class="link_tab" href="../admin/dashboard_admin.php"><div class="menu-item"><i class="fas fa-tachometer-alt"></i>
                        Dashboard</div></a>
                <a class="link_tab" href="../admin/booking_admin.php"><div class="menu-item"><i class="fas fa-calendar-alt"></i>
                        Bookings</div></a>
                <a class="link_tab" href="../admin/feedback_admin.php"><div class="menu-item"><i class="fas fa-comment"></i>
                        Feedback</div></a>
                <a class="link_tab" href="../admin/instructors_admin.php"><div class="menu-item"><i class="fas fa-chalkboard-teacher"></i>
                 Instructors</div></a>
                <a class="link_tab" href="../admin/equipment_admin.php"><div class="menu-item"><i class="fas fa-dumbbell"></i>
                        Equipment</div></a>
                <a class="link_tab" href="../admin/notification_admin.php"><div class="menu-item"><i class="fas fa-bell"></i>
                        Notification</div></a>

                <?php
                if (isset($_SESSION['role_id'])) {
                    $rid = $_SESSION['role_id'];
                    if ($rid == 3) { // If the user is an admin
                        ?>
                        <a class="link_tab" href="../admin/reports_admin.php"><div class="menu-item active"><i class="fas fa-chart-bar"></i> Generate
                                Reports</div></a>
                        <a class="link_tab" href="../admin/manageUsers_admin.php"><div class="menu-item"><i class="fas fa-users"></i> Manage
                                Users</div></a>
                        <?php
                    }
                }
                ?>
                <a class="link_tab" href="../admin/schedule_instructor.php"> <div class="menu-item"><i class="far fa-clock"></i> View
                        Schedule</div></a>

            </div>
            <a href="../login/logout_view.php" class="logout-link">
                <button class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</button>
            </a>
        </div>
        <div class="content">
            <h1>Generate Reports</h1>
            <!-- Report selection options -->
            <div class="report-options">
                <label for="report-type">Select Report Type:</label>
                <select name="report-type" id="report-type">
                    <option value="booking-stats">Booking Statistics Report</option>
                    <option value="active-members">Active Members Report</option>
                    <option value="instructor">Gym Instructor Report</option>
                    <option value="feedback">Feedback Report</option>
                </select>
                <!-- Additional options based on report type (e.g., date range, filters) -->
                <div id="additional-options">
                    <!-- Additional options go here -->
                </div>
                <!-- Generate report button -->
                <button id="generate-report-btn">Generate Report</button>
            </div>
            <!-- Report statistics display -->
            <div class="report-statistics">
                <?php
                if (isset($_GET['report-type'])) {
                    $reportType = $_GET['report-type'];
                    $reportData = generateReport($reportType);

                    // Display the report data
                    foreach ($reportData as $key => $value) {
                        echo "<div><strong>$key:</strong> $value</div>";
                    }
                }
                ?>
            </div>
            <!-- Download report button -->
            <button id="download-report-btn">Download Report</button>
        </div>
    </div>
    <script src="../js/admin_js/reports_admin.js"></script>
    <script src="../js/click_effect.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Function to fetch and display report statistics based on selected report type
            function displayReportStatistics(reportType) {
                // AJAX request to fetch report data from the server
                const xhr = new XMLHttpRequest();
                xhr.open('GET', `../action/report_admin_actions.php?report-type=${reportType}`, true);
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            // Parse response JSON data
                            const reportData = JSON.parse(xhr.responseText);
                            // Display the statistics in the report-statistics div
                            const reportStatisticsDiv = document.querySelector('.report-statistics');
                            reportStatisticsDiv.innerHTML = ''; // Clear previous statistics
                            for (const [key, value] of Object.entries(reportData)) {
                                const statItem = document.createElement('div');
                                statItem.innerHTML = `<strong>${key}:</strong> ${value}`;
                                reportStatisticsDiv.appendChild(statItem);
                            }
                        } else {
                            console.error('Failed to fetch report data');
                        }
                    }
                };
                xhr.send();
            }

            // Event listener for the report type selection
            const reportTypeSelect = document.getElementById('report-type');
            reportTypeSelect.addEventListener('change', function () {
                const selectedReportType = reportTypeSelect.value;
                displayReportStatistics(selectedReportType);
            });

            // Event listener for the generate report button
            const generateReportBtn = document.getElementById('generate-report-btn');
            generateReportBtn.addEventListener('click', function () {
                // Get the selected report type
                const selectedReportType = reportTypeSelect.value;
                // Call the function to fetch and display report statistics
                displayReportStatistics(selectedReportType);
            });

            // Event listener for the download report button
            const downloadReportBtn = document.getElementById('download-report-btn');
            downloadReportBtn.addEventListener('click', function () {
                // Get the selected report type
                const selectedReportType = reportTypeSelect.value;
                // AJAX request to download report
                const xhr = new XMLHttpRequest();
                xhr.open('GET', `../action/report_admin_actions.php?report-type=${selectedReportType}&download=true`, true);
                xhr.responseType = 'blob';
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            // Create a blob URL from the response data
                            const blob = new Blob([xhr.response], { type: 'application/octet-stream' });
                            const url = window.URL.createObjectURL(blob);
                            // Create a link element to trigger download
                            const link = document.createElement('a');
                            link.href = url;
                            link.download = `${selectedReportType}_report.xlsx`; // Set the filename
                            // Simulate click on the link to trigger download
                            link.click();
                            // Release the object URL
                            window.URL.revokeObjectURL(url);
                        } else {
                            console.error('Failed to download report');
                        }
                    }
                };
                xhr.send();
            });
        });
    </script>
</body>

</html>