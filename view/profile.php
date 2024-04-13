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
    <title>Ashesifit Profile</title>
    <link rel="stylesheet" href="./global.css" />
    <link rel="stylesheet" href="../css/profile-page.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

</head>
<body>
    <div class="feedback-page">
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
                <div class="profile-icon"><i ></i></div>
                <div class="logo">Ashesifit</div>
            </div>
            <div class="sidebar-menu">
                <div class="menu-item"><a href="profile.php"><i class="fas fa-user"> </i> Profile</a></div>
                <div class="menu-item"><a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></div>
                <div class="menu-item"><a href="booking.php"><i class="fas fa-calendar-alt"></i> Bookings</a></div>
                <div class="menu-item"><a href="feedback.php"><i class="fas fa-comment"></i> Feedback</a></div>
                <div class="menu-item"><a href="instructors.php"><i class="fas fa-chalkboard-teacher"></i> Instructors</a></div>
                <div class="menu-item"><a href="equipment.php"><i class="fas fa-dumbbell"></i> Equipment</a></div>
            </div>
            <a href="../login/login.php">
                <button class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</button>
            </a>
        </div>
        <div class="content">
            <div class="profile-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            <h4 class="text-right"> Profile Settings</h4>
                <div class="p-3 py-5">
               
                    <form class="user" action="../action/profile_action.php" method="post" name="profileForm" id="profileForm">
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label class="labels">Username</label>
                                <span><?php echo $userData['username']; ?></span>
                            </div>
                            <div class="col-md-12">
                                <label class="labels">Email</label>
                                <span><?php echo $userData['email']; ?></span>
                            </div>
                            <div class="col-md-12">
                                <label class="labels">Date of Birth</label>
                                <span><?php echo $userData['date_of_birth']; ?></span>
                            </div>
                            <div class="col-md-12">
                            <label class="labels">Residence</label>
                                        <select class="form-control" name="residence">
                                            <option value="Off-campus" <?php if ($userData['residence'] === 'Off-campus')
                                                echo 'selected'; ?>>Off-campus</option>
                                            <option value="On-campus" <?php if ($userData['residence'] === 'On-campus')
                                                echo 'selected'; ?>>
                                               On-campus</option>
                                        </select>
                            </div>
                            <div class="col-md-12">
                            <label class="labels">Fitness goals</label>
                                        <input type="text" class="form-control" name="fitness_goal"
                                            value="<?php echo $userData['fitness_goal']; ?>">
                            </div>
                            <div class="col-md-12 mt-5 text-center">
                                <button class="btn btn-primary profile-button" id="saveProfileBtn" type="submit">Save Profile</button>
                            </div>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>

    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Include Bootstrap Bundle JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <!-- Include SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        $(document).ready(function () {
            // Save profile button click event
            $('#profileForm').submit(function (event) {
                event.preventDefault(); // Prevent the default form submission

                // Submit the form data using AJAX
                $.ajax({
                    type: 'POST',
                    url: '../action/profile_action.php',
                    data: $('#profileForm').serialize(), // Serialize form data
                    success: function (response) {
                        // Display a Sweet Alert for success
                        Swal.fire({
                            title: 'Success!',
                            text: 'Your profile has been updated.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(function () {
                            window.location.href = '../view/profile.php'; // Redirect to profile page
                        });
                    },
                    error: function () {
                        // Display a Sweet Alert for error
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
