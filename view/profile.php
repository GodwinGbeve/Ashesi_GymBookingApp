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
    <title>Ashesifit Profile</title>
    <link rel="stylesheet" href="./global.css" />
    <link rel="stylesheet" href="../css/profile-page.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<body>
    <div class="feedback-page">
        <div class="sidebar">
            <div class="sidebar-header">
                <!-- Sidebar header content -->
                <div class="profile-icon"><i class="fas fa-user-alt"></i></div>
                <div class="logo">Ashesifit</div>
            </div>
            <div class="sidebar-menu">
                <!-- Sidebar menu items -->
                <div class="menu-item"><a href="profile.php"><i class="fas fa-user"> </i> Profile</a></div>
                <div class="menu-item"><a href="dashboard.php"><i class="fas fa-tachometer-alt"></i>Dashboard</a></div>
                <div class="menu-item"><a href="booking.php"><i class="fas fa-calendar-alt"></i>Bookings</a></div>
                <div class="menu-item"><a href="notification.php"><i class="fas fa-bell"></i>Notification</a></div>
                <div class="menu-item"><a href="feedback.php"><i class="fas fa-comment"></i>Feedback</a></div>
                <div class="menu-item"><a href="instructors.php"><i class="fas fa-chalkboard-teacher"></i>Instructors</a></div>
                <div class="menu-item"><a href="equipment.php"><i class="fas fa-dumbbell"></i>Equipment</a></div>
            </div>
            <a href="../login/login.php">
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
                                    <h4 class="text-right">Profile Settings</h4>
                                    <form class="user" action="../action/profile_action.php" method="post"
                                        name="profileForm" id="profileForm">
                                </div>
                                <div class="row mt-2">
                                    <!-- Display user profile information -->
                                    <div class="col-md-6">
                                        <label class="labels">Username</label>
                                        <span>
                                            <?php echo $userData['username']; ?>
                                        </span>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="labels">Email</label>
                                        <span>
                                            <?php echo $userData['email']; ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <label class="labels">Date of Birth</label>
                                        <span>
                                            <?php echo $userData['date_of_birth']; ?>
                                        </span>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="labels">Residence</label>
                                        <select class="form-control" name="residence">
                                            <option value="resident" <?php if ($userData['residence'] === 'resident')
                                                echo 'selected'; ?>>Resident</option>
                                            <option value="non-resident" <?php if ($userData['residence'] === 'non-resident')
                                                echo 'selected'; ?>>
                                                Non-Resident</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="labels">Fitness goals</label>
                                        <input type="text" class="form-control" name="fitness_goal"
                                            value="<?php echo $userData['fitness_goal']; ?>">
                                    </div>

                                </div>
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

    <!-- Include jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            // Save profile button click event
            $('#saveProfileBtn').click(function () {
                // Submit the profile form
                $('#profileForm').submit();
            });
        });
    </script>
</body>

</html>