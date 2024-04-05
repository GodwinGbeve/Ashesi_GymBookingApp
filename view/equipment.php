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
            <div class="equipment-item">
                <img src="equipment1.jpg" alt="Equipment 1">
                <h3>Treadmill</h3>
            </div>
            <div class="equipment-item">
                <img src="equipment2.jpg" alt="Equipment 2">
                <h3>Stationary Bike</h3>
            </div>
            <div class="equipment-item">
                <img src="equipment3.jpg" alt="Equipment 3">
                <h3>Elliptical</h3>
            </div>
            <div class="equipment-item">
                <img src="equipment4.jpg" alt="Equipment 4">
                <h3>Rowing Machine</h3>
            </div>
            <div class="equipment-item">
                <img src="equipment5.jpg" alt="Equipment 5">
                <h3>StairMaster</h3>
            </div>
            <div class="equipment-item">
                <img src="equipment6.jpg" alt="Equipment 6">
                <h3>Free Weights</h3>
            </div>
            <div class="equipment-item">
                <img src="equipment7.jpg" alt="Equipment 7">
                <h3>Weight Machines</h3>
            </div>
            <div class="equipment-item">
                <img src="equipment8.jpg" alt="Equipment 8">
                <h3>Exercise Balls</h3>
            </div>
            <div class="equipment-item">
                <img src="equipment9.jpg" alt="Equipment 9">
                <h3>Yoga Mats</h3>
            </div>
            <div class="equipment-item">
                <img src="equipment10.jpg" alt="Equipment 10">
                <h3>Resistance Bands</h3>
            </div>
            <div class="equipment-item">
                <img src="equipment11.jpg" alt="Equipment 11">
                <h3>Kettlebells</h3>
            </div>
            <div class="equipment-item">
                <img src="equipment12.jpg" alt="Equipment 12">
                <h3>Medicine Balls</h3>
            </div>
            <div class="equipment-item">
                <img src="equipment13.jpg" alt="Equipment 13">
                <h3>Bosu Balls</h3>
            </div>
            <div class="equipment-item">
                <img src="equipment14.jpg" alt="Equipment 14">
                <h3>Plyo Boxes</h3>
            </div>
            <div class="equipment-item">
                <img src="equipment15.jpg" alt="Equipment 15">
                <h3>Battle Ropes</h3>
            </div>
            <!-- <div class="equipment-item">
        <img src="equipment16.jpg" alt="Equipment 16">
        <h3>TRX Suspension Trainers</h3>
    </div> -->
        </div>

        <script src="../js/notification.js"></script>
</body>

</html>