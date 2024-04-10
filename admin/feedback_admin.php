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
</head>

<body>
    <div class="admin-feedback-page">
        <div class="sidebar">
            <div class="sidebar-header">
                <div class="feedback-icon"><i class="fas fa-calendar-alt"></i></div>
                <div class="logo">Ashesifit</div>
            </div>
            <div class="sidebar-menu">
                <div class="menu-item"><a href="../admin/profile_admin.php"><i class="fas fa-user"></i> Profile</a></div>
                <div class="menu-item"><a href="../admin/dashboard_admin.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></div>
                <div class="menu-item"><a href="../admin/booking_admin.php"><i class="fas fa-calendar-alt"></i> Bookings</a></div>
                <div class="menu-item"><a href="../admin/notification_admin.php"><i class="fas fa-bell"></i> Notification</a></div>
                <div class="menu-item active"><a href="../admin/feedback_admin.php"><i class="fas fa-comment"></i> Feedback</a></div>
                <div class="menu-item"><a href="../admin/instructors_admin.php"><i class="fas fa-chalkboard-teacher"></i> Instructors</a></div>
                <div class="menu-item"><a href="../admin/equipment_admin.php"><i class="fas fa-dumbbell"></i> Equipment</a></div>
                <div class="menu-item"><a href="../admin/reports_admin.php"><i class="fas fa-chart-bar"></i> Generate Reports</a></div>
                <div class="menu-item"><a href="../admin/schedule_instructor.php"> <i class="far fa-clock"></i> View Schedule</a></div>
                <div class="menu-item"><a href="../admin/manageUsers_admin.php"><i class="fas fa-users"></i> Manage Users</a></div>
                <a href="../login/login.php" class="logout-link">
                    <button class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</button>
                </a>
            </div>
        </div>

        <div class="content">
            <div class="feedback-container">
                <button class="download-btn"><i class="fas fa-download"></i> Download All Feedback</button>
                <h1>Admin Feedback Page</h1>
                <div class="feedback-display" name = feedbackID>
                    <table>
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Feedback Type</th>
                                <th>Rating</th>
                                <th>Message</th>
                                <th>Date</th>
                                <th>Action</th>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../js/admin_js/feedback_admin.js"></script>


    <script>
      // Function to handle deleting feedback
function deleteFeedback(feedbackID) {
    // Confirm with the user before deleting
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            // Send AJAX request to delete feedback
            $.ajax({
                type: 'POST',
                url: '../action/deletefeedback_admin.php',
                data: { action: 'delete', feedbackID: feedbackID },
                success: function (response) {
                    // Show success message
                    Swal.fire({
                        icon: 'success',
                        title: 'Feedback Deleted',
                        text: response,
                        confirmButtonColor: '#3085d6'
                    }).then((result) => {
                        // Reload the page after deletion
                        location.reload();
                    });
                },
                error: function (xhr, status, error) {
                    // Show error message
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong! Please try again later.',
                        confirmButtonColor: '#3085d6'
                    });
                }
            });
        }
    });
}

// Function to handle marking feedback as resolved
function resolveFeedback(feedbackID) {
    // Send AJAX request to mark feedback as resolved
    $.ajax({
        type: 'POST',
        url: '../action/feedback_admin_actions.php',
        data: { action: 'resolve', feedbackID: feedbackID },
        success: function (response) {
            // Show success message
            Swal.fire({
                icon: 'success',
                title: 'Feedback Resolved',
                text: response,
                confirmButtonColor: '#3085d6'
            }).then((result) => {
                // Reload the page after resolving
                location.reload();
            });
        },
        error: function (xhr, status, error) {
            // Show error message
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong! Please try again later.',
                confirmButtonColor: '#3085d6'
            });
        }
    });
}
  
    </script>
</body>

</html>
