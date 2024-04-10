<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ashesifit Notifications</title>
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/equipment.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<body>
    <div class="notification-page">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-header">
                <div class="notification-icon"><i class="fas fa-bell"></i></div>
                <div class="logo">Ashesifit</div>
            </div>
            <div class="sidebar-menu">
                <div class="menu-item active"><a href="profile.php"><i class="fas fa-user"> </i> Profile</a></div>
                <div class="menu-item"><a href="dashboard.php"><i class="fas fa-tachometer-alt"></i>Dashboard</a></div>
                <div class="menu-item"><a href="booking.php"><i class="fas fa-calendar-alt"></i>Bookings</a></div>
                <div class="menu-item"><a href="notification.php"><i class="fas fa-bell"></i>Notification</a></div>
                <div class="menu-item active"><a href="feedback.php"><i class="fas fa-comment"></i>Feedback</a></div>
                <div class="menu-item"><a href="instructors.php"><i class="fas fa-chalkboard-teacher"></i>Instructors</a></div>
                <div class="menu-item"><a href="equipment.php"><i class="fas fa-dumbbell"></i>Equipment</a></div>
            </div>
            <a href="../login/login.php">
                <button class="logout-btn"><i class="fas fa-sign-out-alt"></i>Logout</button>
            </a>

        </div>

        <div class="page-header">
            <h1>Equipments</h1>
            <button class="back-btn"><i class="fas fa-arrow-left"></i> Back</button>
        </div>
        <div class="equipment-grid">
            
        <?php 
        include '../functions/equipment_fetch.php';
        ?>

            <!-- <div class="equipment-item">
        <img src="equipment16.jpg" alt="Equipment 16">
        <h3>TRX Suspension Trainers</h3>
    </div> -->
        </div>

        <script src="../js/equipment.js"></script>
</body>

</html>