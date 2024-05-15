<?php
// Include database connection
include_once ('../action/dashboard_admin_action.php');
include ('../settings/core.php');
include_once ('../settings/connection.php');
include ('../functions/username_fxn.php');

?>

<?php
// Start session

if (!isset($_SESSION['role_id'])) {
    header('Location: ../login/logout_view.php?error=unauthorized_user');
    exit();
}
else if($_SESSION['role_id'] != 4 && $_SESSION['role_id'] != 3){
    header('Location: ../view/404.php');
    exit();
}

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
            <a class="link_tab" href="../admin/profile_admin.php"><div class="menu-item "><i class="fas fa-user"></i> Profile
                </div></a>
                <a class="link_tab" href="../admin/dashboard_admin.php"><div class="menu-item active"><i class="fas fa-tachometer-alt"></i>
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
                        <a class="link_tab" href="../admin/reports_admin.php"><div class="menu-item"><i class="fas fa-chart-bar"></i> Generate
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
    <script src="../js/click_effect.js"></script>
</body>

</html>