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
    <title>Admin Feedback</title>
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/admin_css/feedback_admin.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>

<body>
    <div class="admin-feedback-page">
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
                <div class="feedback-icon"><i></i></div>
                <div class="logo">Ashesifit</div>
            </div>
            <div class="sidebar-menu">
            <a class="link_tab" href="../admin/profile_admin.php"><div class="menu-item "><i class="fas fa-user"></i> Profile
                </div></a>
                <a class="link_tab" href="../admin/dashboard_admin.php"><div class="menu-item"><i class="fas fa-tachometer-alt"></i>
                        Dashboard</div></a>
                <a class="link_tab" href="../admin/booking_admin.php"><div class="menu-item"><i class="fas fa-calendar-alt"></i>
                        Bookings</div></a>
                <a class="link_tab" href="../admin/feedback_admin.php"><div class="menu-item active"><i class="fas fa-comment"></i>
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
        </div>

        <div class="content">
            <div class="feedback-container">
                <?php
                if (isset($_SESSION['role_id'])) {
                    $rid = $_SESSION['role_id'];

                    // Display the "Download All Feedback" button only for admin
                    if ($rid == 3) { // If the user is an admin
                        echo '<a href="../action/download_feedback.php" class="download-btn"><i class="fas fa-download"></i> Download All Feedback</a>';
                    }
                }
                ?>

                <h1>Admin Feedback Page</h1>
                <div class="feedback-display" name=feedbackID>
                    <table>
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Feedback Type</th>
                                <th>Rating</th>
                                <th>Message</th>
                                <th>Date</th>

                                <?php
                                if (isset($_SESSION['role_id'])) {
                                    $rid = $_SESSION['role_id'];

                                    // Display the "Action" header only for admin
                                    if ($rid == 3) { // If the user is an admin
                                        echo '<th>Action</th>';




                                    }
                                }
                                ?>
                            </tr>
                        </thead>


                        <tbody>
                            <?php include '../functions/feedback_admin_fxn.php'; ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>


    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
    <script src="../js/admin_js/feedback_admin.js"></script>
    <script src="../js/click_effect.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</body>

</html>