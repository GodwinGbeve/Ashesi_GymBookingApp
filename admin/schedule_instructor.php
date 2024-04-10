<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/admin_css/schedule_instructor.css">
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
                <a href="../login/login.php" class="logout-link">
                    <button class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</button>
                </a>
            </div>
        </div>
        <div class="content">
            <div class="container">
                <h1>View Schedule</h1>
                <div class="schedule">
                    <table>
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Time Slot</th>
                                <th>User Name</th>
                                <th>Booking Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Schedule data will be dynamically populated here -->
                            <tr>
                                <td>2024-04-10</td>
                                <td>09:00 AM - 10:00 AM</td>
                                <td>John Doe</td>
                                <td>Confirmed</td>
                                <td></td>
                            </tr>
                            <!-- Additional rows will be added as needed -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
   
    <script src="../js/admin_js/schedule_instructor.js"></script>
    <!-- Include SweetAlert library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- JavaScript function for delete confirmation -->
    <script>
        function confirmDelete(bookingID) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'You will not be able to recover this booking!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If user confirms, redirect to delete action page with bookingID
                    window.location.href = '../action/deleteBook_action.php?id=' + bookingID;
                }
            });
        }
    </script>
</body>
</html>
