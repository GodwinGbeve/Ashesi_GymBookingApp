<?php
// Include database connection
include_once ('../action/dashboard_admin_action.php');
include ('../settings/core.php');
include_once ('../settings/connection.php');
include ('../functions/username_fxn.php');
checkLogin();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/admin_css/dashboard_admin.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
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
                <div class="menu-item"><a href="../admin/profile_admin.php"><i class="fas fa-user"></i> Profile</a>
                </div>
                <div class="menu-item"><a href="../admin/dashboard_admin.php"><i class="fas fa-tachometer-alt"></i>
                        Dashboard</a></div>
                <div class="menu-item"><a href="../admin/booking_admin.php"><i class="fas fa-calendar-alt"></i>
                        Bookings</a></div>
                <div class="menu-item active"><a href="../admin/feedback_admin.php"><i class="fas fa-comment"></i>
                        Feedback</a></div>
                <div class="menu-item"><a href="../admin/instructors_admin.php"><i
                            class="fas fa-chalkboard-teacher"></i> Instructors</a></div>
                <div class="menu-item"><a href="../admin/equipment_admin.php"><i class="fas fa-dumbbell"></i>
                        Equipment</a></div>

                <?php
                if (isset($_SESSION['role_id'])) {
                    $rid = $_SESSION['role_id'];
                    if ($rid == 3) { // If the user is an admin
                        ?>
                        <div class="menu-item"><a href="../admin/reports_admin.php"><i class="fas fa-chart-bar"></i> Generate
                                Reports</a></div>
                        <div class="menu-item"><a href="../admin/manageUsers_admin.php"><i class="fas fa-users"></i> Manage
                                Users</a></div>
                        <?php
                    }
                }
                ?>
                <div class="menu-item"><a href="../admin/schedule_instructor.php"> <i class="far fa-clock"></i> View
                        Schedule</a></div>
            </div>
            <a href="../login/login.php" class="logout-link">
                <button class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</button>
            </a>
        </div>
        <div class="content">
            <h1>Dashboard Overview</h1>
            <div class="summary">
                <!-- Total Bookings -->
                <div class="metric">
                    <div class="icon"><i class="fas fa-calendar-alt"></i></div>
                    <div class="info">
                        <div class="value"><?php echo $totalBookings; ?></div>
                        <div class="label">Total Bookings</div>
                    </div>
                </div>
                <!-- New Members -->
                <div class="metric">
                    <div class="icon"><i class="fas fa-user-plus"></i></div>
                    <div class="info">
                        <div class="value"><?php echo $totalMembers; ?></div>
                        <div class="label">New Members</div>
                    </div>
                </div>
                <!-- Equipment Availability -->
                <div class="metric">
                    <div class="icon"><i class="fas fa-dumbbell"></i></div>
                    <div class="info">
                        <div class="value"><?php echo $equipmentAvailability; ?></div>
                        <div class="label">Equipment Availability</div>
                    </div>
                </div>
                <!-- Member Feedback -->
                <div class="metric">
                    <div class="icon"><i class="fas fa-comment"></i></div>
                    <div class="info">
                        <div class="value"><?php echo $totalFeedbacks; ?></div>
                        <div class="label">Member Feedback</div>
                    </div>
                </div>

                <!-- Statistics -->
                <div class="metric">
                    <div class="circle-icon">
                        <i class="fas fa-chart-pie fa-3x"></i>
                        <!-- Use a circular icon for statistics -->
                    </div>
                    <div class="info">
                        <div class="value"><?php echo $statisticsPercentage; ?>%</div>
                        <div class="label">Total Statistics</div>
                    </div>
                </div>
                <!-- Gym Instructors -->
                <div class="metric">
                    <div class="icon"><i class="fas fa-chalkboard-teacher"></i></div>
                    <div class="info">
                        <div class="value"><?php echo $totalInstructors; ?></div>
                        <div class="label">Gym Instructors</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../js/admin_js/dashboard_admin.js"></script>
</body>

</html>