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
else if($_SESSION['role_id'] != 1 && $_SESSION['role_id'] != 2){
    header('Location: ../view/404.php');
    exit();
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ashesifit Equipment</title>
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/equipment.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

</head>

<body>
    <div class="notification-page">
        <!-- Sidebar -->
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

                <div class="notification-icon"><i ></i></div>
                <div class="logo">Ashesifit</div>
            </div>
            <div class="sidebar-menu">
            <a class="link_tab" href="profile.php"> <div class="menu-item" id="profile-menu"><a href="profile.php"><i class="fas fa-user"></i> Profile</div></a>
            <a class="link_tab" href="dashboard.php"><div class="menu-item" id="dashboard-menu"><i class="fas fa-tachometer-alt"></i>Dashboard</div></a>
            <a class="link_tab" href="booking.php"><div class="menu-item" id="booking-menu"><i class="fas fa-calendar-alt"></i>Bookings</div></a>
            <a class="link_tab" href="feedback.php"><div class="menu-item" id="feedback-menu"><i class="fas fa-comment"></i>Feedback</div></a>
            <a class="link_tab" href="instructors.php"><div class="menu-item" id="instructors-menu"><i class="fas fa-chalkboard-teacher"></i>Instructors</div></a>
            <a class="link_tab" href="equipment.php"><div class="menu-item active" id="equipment-menu"><a href="equipment.php"><i class="fas fa-dumbbell"></i>Equipment</div></a>
            <a class="link_tab" href="notification.php"><div class="menu-item" id="notification-menu"><i class="fas fa-bell"></i>Notification</div></a>
            </div>
            <a class="link_tab" href="../login/logout_view.php" class="logout-link">
                <button class="logout-btn"><i class="fas fa-sign-out-alt"></i>Logout</button>
            </a>
        </div>

        <!-- Page Header -->
        <div class="page-header">
        <h1>Equipments</h1>
        <button class="back-btn"><a href="../view/dashboard.php"><i class="fas fa-arrow-left"></i> Back</a></button>
        
        </div>

        <!-- Content -->
        <div class="content">
            <div class="equipment-grid">
                <?php include '../functions/equipment_fetch.php'; ?>
            </div>
        </div>

        <!-- Instructors Section -->
        <div class="instructors-section">
            <h1>Instructors</h1>
            <div class="summary-widgets">
                <?php
                // Fetch and display instructors here
                ?>
            </div>
        </div>

        <script src="../js/equipment.js"></script>
        <script src="../js/click_effect.js"></script>
    </div>
</body>

</html>
