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
    <title>Ashesifit Notifications</title>
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/notification-page.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>
<body>
<div class="admin-feedback-page">
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
                <a href="profile.php" class="menu-item"><i class="fas fa-user"></i> Profile</a>
                <a href="dashboard.php" class="menu-item"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                <a href="booking.php" class="menu-item"><i class="fas fa-calendar-alt"></i> Bookings</a>
                <a href="feedback.php" class="menu-item"><i class="fas fa-comment"></i> Feedback</a>
                <a href="instructors.php" class="menu-item"><i class="fas fa-chalkboard-teacher"></i> Instructors</a>
                <a href="equipment.php" class="menu-item"><i class="fas fa-dumbbell"></i> Equipment</a>
                <a href="notification.php" class="menu-item active"><i class="fas fa-bell"></i> Notification</a>
            </div>
            <a href="../login/logout_view.php" class="logout-link">
                <button class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</button>
            </a>
        </div>
       
    <!-- Button to send notification -->
    <button id="send-notification-btn"><i class="fas fa-bell"></i> Send Notification</button>

    <!-- Notification content -->
    <div class="notification-content">
        <h1>Notification</h1>
        <!-- Message box -->
        <div class="message-box">
            <!-- Sample message item -->
            <div class="message-item">
                <div class="message-content">
                    <h3>Sample Message</h3>
                    <p>This is a sample message content.</p>
                </div>
                <button class="reply-button">Reply</button>
            </div>
        </div>

        <!-- Send Notification Form -->
        <div class="send-notification-form-container">

            <div class="send-notification-popup" id="send-notification-popup">
                <div class="send-notification-form">
                    <h2>Send Notification</h2>
                    <form id="send-notification-form" action="../action/sendMessage.php">
                        <label for="recipient">Recipient:</label>
                        <input type="text" id="reply-name" placeholder="Name" required>
                        <label for="message">Message:</label>
                        <textarea name="message" id="message" cols="30" rows="5"></textarea>
                        <button type="submit">Send</button>
                        <button type="button" id="close-send-notification-popup">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Reply form container -->
    <div class="reply-form-container" id="reply-popup">
        <div class="reply-form">
            <h2>Reply</h2>
            <form id="reply-form">
                <input type="text" id="reply-name" placeholder="Name" required>
                <textarea id="reply-message" placeholder="Message" required></textarea>
                <button type="submit">Send</button>
                <button type="button" id="close-popup">Close</button>
            </form>
        </div>
    </div>
    <!-- Reply form container -->
    <div class="reply-form-container">
        <h2>Reply</h2>
        <form id="reply-form">
            <input type="text" id="reply-name" placeholder="Name" required>
            <textarea id="reply-message" placeholder="Message" required></textarea>
            <button type="submit">Send</button>
            <button type="button" id="close-popup">Close</button>
        </form>
    </div>
    </div>



    <script src="../js/admin_js/notification_admin.js"></script>

     <script src="../js/click_effect.js"></script>

</html>