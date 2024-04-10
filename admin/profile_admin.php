
<?php
// Include the core.php file
include '../settings/connection.php';
include '../settings/core.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if not logged in
    header('Location: ../login/login.php');
    exit();
}

// Fetch user profile data from the database
$userID = $_SESSION['user_id'];
$userQuery = "SELECT * FROM Users WHERE userID = $userID";
$userResult = mysqli_query($con, $userQuery);
$userData = mysqli_fetch_assoc($userResult);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/admin_css/profile_admin.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="admin-reports-page">
        <div class="sidebar">
            <div class="sidebar-header">
                <div class="reports-icon"><i class="fas fa-chart-bar"></i></div>
                <div class="logo">AshesiFit</div>
            </div>
            <div class="sidebar-menu">
            <div class="menu-item"><a href="../admin/profile_admin.php"><i class="fas fa-user"></i> Profile</a></div>
                <div class="menu-item"><a href="../admin/dashboard_admin.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></div>
                <div class="menu-item"><a href="../admin/booking_admin.php"><i class="fas fa-calendar-alt"></i> Bookings</a></div>
                <div class="menu-item"><a href="../admin/notification_admin.php"><i class="fas fa-bell"></i> Notification</a></div>
                <div class="menu-item"><a href="../admin/feedback_admin.php"><i class="fas fa-comment"></i> Feedback</a></div>
                <div class="menu-item"><a href="../admin/instructors_admin.php"><i class="fas fa-chalkboard-teacher"></i> Instructors</a></div>
                <div class="menu-item"><a href="../admin/equipment_admin.php"><i class="fas fa-dumbbell"></i> Equipment</a></div>
                <div class="menu-item active"><a href="../admin/reports_admin.php"><i class="fas fa-chart-bar"></i> Generate Reports</a></div>
                <div class="menu-item active"><a href="../admin/schedule_instructor.php"> <i class="far fa-clock"></i> View Schedule</a></div>
                <div class="menu-item"><a href="../admin/manageUsers_admin.php"><i class="fas fa-users"></i> Manage Users</a></div>
            </div>
            <a href="../login/login.php" class="logout-link">
                <button class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</button>
            </a>
        </div>
        <div class="content">
             <div class="profile-content">
                <div class="container rounded bg-white mt-5 mb-5">
                    <div class="row">
                        <!-- Profile picture section -->
                    </div>
                    <div class="row">
                        <div class="col-md-9">
                            <div class="p-3 py-5">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4 class="text-right">Admin Profile Settings</h4>
                                    <!-- Profile form goes here -->
                                </div>
                                <div class="row mt-2">
                                    <!-- Display admin profile information -->
                                    <div class="col-md-6">
                                        <label class="labels">Username</label>
                                        <span>
                                            <?php echo $adminData['username']; ?>
                                        </span>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="labels">Email</label>
                                        <span>
                                            <?php echo $adminData['email']; ?>
                                        </span>
                                    </div>
                                </div>
                                <!-- Additional fields can be added as needed -->
                                <div class="mt-5 text-center">
                                    <button class="btn btn-primary profile-button" id="saveProfileBtn"
                                        type="submit">Save Profile</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
