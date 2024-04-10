<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ashesifit Notifications</title>
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/instructors.css">
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



        <div class="notification-content">
            <div class="page-header">
                <h1>Gym Instructors</h1>
                <button class="back-btn"><a href="dashboard.php"><i class="fas fa-arrow-left"></i> Back</a></button>
            </div>
            <div class="instructor-grid">
            <?php include '../functions/instructors_fetch.php'; ?>

                <!-- Add more instructor items as needed -->
            </div>
        </div>

    </div>


    <script>
    // JavaScript function to open booking form modal
    function openBookingForm(instructorID) {
        var modal = document.getElementById('bookingForm' + instructorID);
        modal.style.display = 'block';
    }

    // JavaScript function to close booking form modal
    function closeBookingForm(instructorID) {
        var modal = document.getElementById('bookingForm' + instructorID);
        modal.style.display = 'none';
    }

    // Attach event listener to the book buttons
    var bookButtons = document.querySelectorAll('.book-btn');
    bookButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var instructorID = this.getAttribute('data-instructor-id');
            openBookingForm(instructorID);
        });
    });
    </script>
</div>
</body>
</html>