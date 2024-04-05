<?php
include '../settings/core.php';

if (isset($_SESSION['user_id'])) {
    $userID = $_SESSION['user_id'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ashesifit feedback</title>
    <link rel="stylesheet" href="../css/global.css" />
    <link rel="stylesheet" href="../css/feedback.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<body>
    <div class="feedback-page">
        <div class="sidebar">
            <div class="sidebar-header">
                <div class="feedback-icon"><i class="fas fa-calendar-alt"></i></div>
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
        <div class="content">
            <div class="feedback-container">
                <h1>Share your experience</h1>
                <form id="feedbackForm" action="../action/feedback_action.php" method="post">
                    <input type="hidden" name="userID" value="<?php echo isset($userID) ? $userID : ''; ?>">
                    <label for="feedbackType">Feedback Type:</label>
                    <select name="feedbackType" id="feedbackType">
                        <option value="Complaint">Complaint</option>
                        <option value="Suggestion">Suggestion</option>
                        <option value="Praise">Praise</option>
                    </select><br>
                    <label for="comments">Add your comments:</label><br>
                    <textarea name="comments" id="comments" cols="30" rows="5"></textarea><br>
                    <label for="starRating">Rating:</label><br>
                    <input type="radio" name="starRating" value="1"> ☆
                    <input type="radio" name="starRating" value="2"> ☆☆
                    <input type="radio" name="starRating" value="3"> ☆☆☆
                    <input type="radio" name="starRating" value="4"> ☆☆☆☆
                    <input type="radio" name="starRating" value="5"> ☆☆☆☆☆<br>
                    <button type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="../js/feedback.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function () {
        $('#feedbackForm').submit(function (event) {
            // Prevent the form from submitting normally
            event.preventDefault();

            // Serialize form data
            var formData = $(this).serialize();

            // Perform AJAX request
            $.ajax({
                type: 'POST',
                url: '../action/feedback_action.php',
                data: formData,
                success: function (response) {
                    // Show SweetAlert for success
                    Swal.fire({
                        title: 'Success!',
                        text: 'Feedback submitted successfully!',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2000
                    }).then(() => {
                        // Redirect after closing the alert
                        window.location.href = '../view/feedback.php';
                    });
                },
                error: function () {
                    // Show SweetAlert for error
                    Swal.fire({
                        title: 'Error!',
                        text: 'Failed to submit feedback. Please try again.',
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 2000
                    });
                }
            });
        });
    });
</script>

</html>