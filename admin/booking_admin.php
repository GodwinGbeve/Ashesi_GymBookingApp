<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/admin_css/adminbookingPage.css">
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
          <th>Action</th>
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


</html>
