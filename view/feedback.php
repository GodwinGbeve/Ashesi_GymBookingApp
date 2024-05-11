<?php
include '../settings/core.php';
include '../settings/connection.php';
include ('../functions/username_fxn.php');
if (isset($_SESSION['user_id'])) {
    $userID = $_SESSION['user_id'];
}
?>

<?php
// Start session

if (!isset($_SESSION['role_id'])) {
    header('Location: ../login/logout_view.php?error=unauthorized_user');
    exit();
}
else if($_SESSION['role_id'] != 1 && $_SESSION['role_id'] != 2){
    header('Location: ../view/404.php');
    exit();
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
                <div class="feedback-icon"><i></i></div>
                <div class="logo">Ashesifit</div>
                </div>
                <div class="sidebar-menu">
                <a class="link_tab" href="profile.php"><div class="menu-item"><i class="fas fa-user"></i> Profile</div></a>
                <a class="link_tab" href="dashboard.php"><div class="menu-item"><i class="fas fa-tachometer-alt"></i> Dashboard</div></a>
                <a class="link_tab" href="booking.php" ><div class="menu-item"><i class="fas fa-calendar-alt"></i> Bookings</div></a>
                <a class="link_tab" href="feedback.php " ><div class="menu-item active"><i class="fas fa-comment"></i> Feedback</div></a>
                <a class="link_tab" href="instructors.php"><div class="menu-item"><i class="fas fa-chalkboard-teacher"></i> Instructors</div></a>
                <a class="link_tab" href="equipment.php"><div class="menu-item"><i class="fas fa-dumbbell"></i> Equipment</div></a>
                <a class="link_tab" href="notification.php"><div class="menu-item"><i class="fas fa-bell"></i> Notification</div></a>
            </div>
            <a href="../login/logout_view.php" class="logout-link">
                <button class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</button>
            </a>
        </div>
        <div class="content">
            <div class="feedback-container">
                <h1>Share your experience</h1>
                <form id="feedbackForm" action="../action/feedback_action.php" method="post">
                    <input type="hidden" name="userID" value="<?php echo isset($userID) ? $userID : ''; ?>">
                    <label for="feedbackType">Feedback Type:</label>
                    <select name="feedbackType" id="feedbackType" required>
                        <option value="">Select</option>
                        <option value="Complaint">Complaint</option>
                        <option value="Suggestion">Suggestion</option>
                        <option value="Praise">Praise</option>
                    </select><br>
                    <label for="comments">Add your comments:</label><br>
                    <textarea name="comments" id="comments" cols="30" rows="5" required></textarea><br>
                    <label for="starRating">Rating:</label><br>
                    <input type="radio" name="starRating" value="1" required> ☆
                    <input type="radio" name="starRating" value="2"> ☆☆
                    <input type="radio" name="starRating" value="3"> ☆☆☆
                    <input type="radio" name="starRating" value="4"> ☆☆☆☆
                    <input type="radio" name="starRating" value="5"> ☆☆☆☆☆<br>
                    <button type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <!-- Include jQuery and SweetAlert -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Your existing JavaScript code -->
    <script src="../js/feedback.js"></script>
    <script src="../js/click_effect.js"></script>
    <script>
        $(document).ready(function () {
            $('#feedbackForm').submit(function (event) {
                // Prevent the form from submitting normally
                event.preventDefault();

                // Check if all fields are entered
                if (!this.checkValidity()) {
                    // If not all fields are entered, display an error message
                    Swal.fire({
                        title: 'Error!',
                        text: 'Please fill out all fields correctly.',
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 2000
                    });
                    return; // Exit the function
                }

                // Check if comments contain only words
                var comments = $('#comments').val();
                if (!/^[a-zA-Z\s]*$/.test(comments)) {
                    // If comments contain non-word characters, display an error message
                    Swal.fire({
                        title: 'Error!',
                        text: 'Please enter only words in the comments.',
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 2000
                    });
                    return; // Exit the function
                }

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
</body>
</html>