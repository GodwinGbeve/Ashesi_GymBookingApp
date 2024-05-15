<?php
// Include the core.php file
include '../settings/connection.php';
include '../settings/core.php';
include ('../functions/username_fxn.php');

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
    <title>AshesiFit Profile</title>
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/admin_css/profile_admin.css">
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
            <a class="link_tab" href="../admin/profile_admin.php"><div class="menu-item active"><i class="fas fa-user"></i> Profile
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
                                    <form id="profileForm" method="post" action="../functions/profile_admin_fxn.php">
                                        <div class="col-md-6">
                                            <label class="labels">Username</label>
                                            <span><?php echo $userData['username']; ?></span>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="labels">Email</label>
                                            <span><?php echo $userData['email']; ?></span>
                                        </div>
                                </div>
                                <!-- Additional fields can be added as needed -->
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <label class="labels">Date of Birth</label>
                                        <span><?php echo $userData['date_of_birth']; ?></span>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="labels">Residence</label>
                                        <select class="form-control" name="residence">
                                            <option value="Off-campus" <?php if ($userData['residence'] === 'Off-campus')
                                                echo 'selected'; ?>>Off-campus</option>
                                            <option value="On-campus" <?php if ($userData['residence'] === 'On-campus')
                                                echo 'selected'; ?>>On-campus</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="labels">Fitness goals</label>
                                        <input type="text" class="form-control" name="fitness_goal"
                                            value="<?php echo $userData['fitness_goal']; ?>">
                                        <input type="hidden" class="form-control" name="userID"
                                            value="<?php echo $userData['userID']; ?>">

                                    </div>
                                </div>
                                <div class="mt-5 text-center">

                                    <button class="btn btn-primary profile-button" id="saveProfileBtn"
                                        type="button">Save Profile</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../js/click_effect.js"></script>
    <!-- Include Bootstrap Bundle JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <!-- Include SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        $(document).ready(function () {
            // Save profile button click event
            $('#saveProfileBtn').click(function () {
                // Submit the profile form
                $('#profileForm').submit();
            });

            // Submit profile form
            $('#profileForm').submit(function (event) {
                event.preventDefault(); // Prevent default form submission

                // AJAX request to update profile
                $.ajax({
                    type: 'POST',
                    url: '../functions/profile_admin_fxn.php',
                    data: $('#profileForm').serialize(), // Serialize form data
                    success: function (response) {
                        // Display success message
                        Swal.fire({
                            title: 'Success!',
                            text: 'Your profile has been updated.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(function () {
                            window.location.href = '../admin/profile_admin.php'; // Redirect after success
                        });
                    },
                    error: function () {
                        // Display error message
                        Swal.fire({
                            title: 'Error!',
                            text: 'Failed to update profile. Please try again.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            });
        });
    </script>
</body>

</html>