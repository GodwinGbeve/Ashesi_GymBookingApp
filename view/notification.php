<?php
// Include the core.php file
include '../settings/connection.php';
include '../settings/core.php';

// Include the notification action file
include '../action/notification_actions.php';
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
            <div class="menu-item"><a href="profile.php"><i class="fas fa-user"> </i> Profile</a></div>
                <div class="menu-item"><a href="dashboard.php"><i class="fas fa-tachometer-alt"></i>Dashboard</a></div>
                <div class="menu-item"><a href="booking.php"><i class="fas fa-calendar-alt"></i>Bookings</a></div>
                <div class="menu-item"><a href="feedback.php"><i class="fas fa-comment"></i>Feedback</a></div>
                <div class="menu-item"><a href="instructors.php"><i class="fas fa-chalkboard-teacher"></i>Instructors</a></div>
                <div class="menu-item"><a href="equipment.php"><i class="fas fa-dumbbell"></i>Equipment</a></div>
            </div>
            <a href="../login/login.php">
                <button class="logout-btn"><i class="fas fa-sign-out-alt"></i>Logout</button>
            </a>

        </div>

        <!-- Notification content -->
        <div class="notification-content">
            <!-- New Messages -->
            <div class="new-messages message-box">
                <h2>New Messages</h2>
                <div class="message-list" id="new-messages-list"></div>
                <?php
                $lastDate = null;
                foreach ($feedback_messages as $message):
                    // Check if the current message's date is different from the last displayed date
                    if ($message['date'] != $lastDate) {
                        echo '<p>Date: ' . $message['date'] . '</p>';
                        $lastDate = $message['date'];
                    }
                    ?>
                    <div class="message-item">
                        <p><strong>Name:
                                <?php echo $message['senderID']; ?>
                            </strong></p>
                        <p>Message:
                            <?php echo $message['message']; ?>
                        </p>

                        <p>Time:
                            <?php echo date('H:i', strtotime($message['date'])); ?>
                        </p>
                        <button class="reply-button">Reply</button>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Missed Messages -->
            <div class="missed-messages message-box">
                <h2>Missed Messages</h2>
                <div class="message-list" id="missed-messages-list"></div>
                <?php
                $lastDate = null;
                foreach ($missed_messages as $message):
                    // Check if the current message's date is different from the last displayed date
                    if ($message['timestamp'] != $lastDate) {
                        echo '<p>Date: ' . $message['timestamp'] . '</p>';
                        $lastDate = $message['timestamp'];
                    }
                    ?>
                    <div class="message-item">
                        <p><strong>Name:
                                <?php echo $message['senderID']; ?>
                            </strong></p>
                        <p>Message:
                            <?php echo $message['messageReceived']; ?>
                        </p>

                        <p>Time:
                            <?php echo date('H:i', strtotime($message['timestamp'])); ?>
                        </p>
                        <button class="reply-button">Reply</button>
                    </div>
                <?php endforeach; ?>
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


    <script src="../js/notification.js"></script>
</body>

</html>