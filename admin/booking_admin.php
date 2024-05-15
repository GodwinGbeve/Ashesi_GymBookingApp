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
    <title>AshesiFit Booking</title>
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/admin_css/adminbookingPage.css">
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
            <a class="link_tab" href="../admin/profile_admin.php"><div class="menu-item "><i class="fas fa-user"></i> Profile
                </div></a>
                <a class="link_tab" href="../admin/dashboard_admin.php"><div class="menu-item"><i class="fas fa-tachometer-alt"></i>
                        Dashboard</div></a>
                <a class="link_tab" href="../admin/booking_admin.php"><div class="menu-item active"><i class="fas fa-calendar-alt"></i>
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

            <body>
                <div class="container">
                    <h1>View Bookings</h1>
                    <div class="bookings">
                        <!-- Booking cards will be dynamically populated here -->
                        <div id="bookings-container">
                            <table id="bookings-table">
                                <thead>
                                    <tr>
                                        <th>User ID</th>
                                        <th>User Name</th>
                                        <th>Instructor ID</th>
                                        <th>Instructor Name</th>
                                        <th>Date</th>
                                        <th>time</th>
                                        <th>Status</th>
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
                                <tbody id="bookings-body">
                                    <!-- Booking data will be dynamically inserted here -->
                                    <?php include '../functions/booking_admin_fxn.php'; ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
            </body>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                // Select all delete buttons
                const deleteButtons = document.querySelectorAll('.delete-btn');

                // Add event listener to each delete button
                deleteButtons.forEach(button => {
                    button.addEventListener('click', function () {
                        // Retrieve booking ID from data attribute
                        const bookingID = this.getAttribute('data-booking-id');

                        // Confirm deletion with user
                        Swal.fire({
                            title: 'Are you sure?',
                            text: "You won't be able to revert this!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, delete it!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Send AJAX request to delete booking
                                fetch('../action/booking_admin_action.php', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/x-www-form-urlencoded',
                                    },
                                    body: 'action=delete&bookingID=' + bookingID
                                })
                                    .then(response => response.text())
                                    .then(data => {
                                        // Display result to user
                                        Swal.fire(
                                            'Deleted!',
                                            data,
                                            'success'
                                        );
                                        // Optionally, you can reload the page or update the booking list
                                        location.reload();
                                    })
                                    .catch(error => console.error('Error:', error));
                            }
                        });
                    });
                });
            </script>

            <script>
                // Select all cancel buttons
                const cancelButtons = document.querySelectorAll('.cancel-btn');

                // Add event listener to each cancel button
                cancelButtons.forEach(button => {
                    button.addEventListener('click', function () {
                        // Retrieve booking ID from data attribute
                        const bookingID = this.getAttribute('data-booking-id');

                        // Confirm cancellation with user
                        Swal.fire({
                            title: 'Are you sure?',
                            text: "You want to cancel this booking?",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, cancel it!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Send AJAX request to cancel booking
                                fetch('../action/booking_admin_action.php', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/x-www-form-urlencoded',
                                    },
                                    body: 'action=cancel&bookingID=' + bookingID
                                })
                                    .then(response => response.text())
                                    .then(data => {
                                        // Display result to user
                                        Swal.fire(
                                            'Cancelled!',
                                            data,
                                            'success'
                                        );
                                        // Optionally, you can reload the page or update the booking list
                                        location.reload();
                                    })
                                    .catch(error => console.error('Error:', error));
                            }
                        });
                    });
                });
            </script>
            <script src="../js/click_effect.js"></script>


</html>