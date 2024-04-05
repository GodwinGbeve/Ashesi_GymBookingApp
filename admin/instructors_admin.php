<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ashesifit Notifications</title>
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/admin_css/instructors_admin.css">
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

    <div class="manage-instructors-content">
        <div class="page-header">
            <h1>Gym Instructors</h1>
            <button class="back-btn"><a href="dashboard.php"><i class="fas fa-arrow-left"></i> Back</a></button>
        </div>
        <div class="instructor-grid">
            <div class="instructor-item">
                <div class="instructor-image">
                    <img src="instructor1.jpg" alt="Instructor 1">
                </div>
                <div class="instructor-info">
                    <h3 class="instructor-name">John Doe</h3>
                    <p class="time-available">Available: 6:00 AM - 8:00 PM</p>
                </div>
                <div class="edit-delete-buttons">
                    <button class="edit-btn"><i class="fas fa-edit"></i> Edit</button>
                    <button class="delete-btn"><i class="fas fa-trash"></i> Delete</button>
                </div>
            </div>
            <div class="instructor-item">
                <div class="instructor-image">
                    <img src="instructor2.jpg" alt="Instructor 2">
                </div>
                <div class="instructor-info">
                    <h3 class="instructor-name">Jane Smith</h3>
                    <p class="time-available">Available: 8:00 AM - 10:00 PM</p>
                </div>
                <div class="edit-delete-buttons">
                    <button class="edit-btn"><i class="fas fa-edit"></i> Edit</button>
                    <button class="delete-btn"><i class="fas fa-trash"></i> Delete</button>
                </div>
            </div>
            <!-- Add more instructor items as needed -->
        </div>
        <div class="add-instructor-btn">
            <button class="add-btn"><i class="fas fa-plus"></i> Add Instructor</button>
        </div>

      <div class="add-instructor-container">

    <form class="add-instructor-form">
      <button type="button" class="close-btn">&times;</button>
        <div class="form-group">
            <label for="add-instructor-image">Instructor Image</label>
            <input type="file" id="add-instructor-image" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="add-instructor-name">Instructor Name</label>
            <input type="text" id="add-instructor-name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="add-time-available">Time Available</label>
            <input type="text" id="add-time-available" class="form-control" required>
        </div>
        <div class="form-group">
            <button type="submit" class="add-btn">Add Instructor</button>
        </div>
    </form>
</div>
      
<div class="edit-form-container">
    <form class="edit-form">
        <input type="hidden" id="instructor-id" value="">
        <div class="form-group">
            <label for="instructor-name">Instructor Name</label>
            <input type="text" id="instructor-name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="time-available">Time Available</label>
            <input type="text" id="time-available" class="form-control" required>
        </div>
        <div class="form-group">
            <button type="submit" class="save-btn">Save</button>
            <button type="button" class="cancel-btn">Cancel</button>
        </div>
    </form>
</div>
    </div>
      <div class="popup-container">
    <div class="popup">
        <div class="popup-header">
         
            <button class="popup-close-btn">&times;</button>
        </div>
        <div class="popup-content">
            Are you sure you want to delete this instructor?
        </div>
        <div class="popup-buttons">
            <button class="popup-delete-btn">Delete</button>
            <button class="popup-cancel-btn">Cancel</button>
        </div>
    </div>
    <div class="overlay"></div>
        
        
</div>
</div>
<script src="../js/admin_js/instructor_admin.js"></script>
