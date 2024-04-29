<?php
include ('../settings/core.php');
include('../settings/connection.php');
include ('../functions/username_fxn.php');


// Assuming you have already established a database connection
$sql = "SELECT content FROM Tips ORDER BY RAND() LIMIT 5"; // Limiting to 5 tips for variety
$result = mysqli_query($con, $sql);

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
    <title>Ashesifit Dashboard</title>
    <link rel="stylesheet" href="../css/global.css" />
    <link rel="stylesheet" href="../css/dashboard-page.css" />
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
                <div class="feedback-icon"><i ></i></div>
                <div class="logo">Ashesifit</div>
            </div>
            <div class="sidebar-menu">
                <div class="menu-item"><a href="profile.php"><i class="fas fa-user"> </i> Profile</a></div>
                <div class="menu-item"><a href="dashboard.php"><i class="fas fa-tachometer-alt"></i>Dashboard</a></div>
                <div class="menu-item"><a href="booking.php"><i class="fas fa-calendar-alt"></i>Bookings</a></div>
                <div class="menu-item"><a href="feedback.php"><i class="fas fa-comment"></i>Feedback</a></div>
                <div class="menu-item"><a href="instructors.php"><i class="fas fa-chalkboard-teacher"></i>Instructors</a></div>
                <div class="menu-item"><a href="equipment.php"><i class="fas fa-dumbbell"></i>Equipment</a></div>
                <div class="menu-item"><a href="notification.php"><i class="fas fa-bell"></i>Notification</a></div>
            </div>
            <a href="../login/logout_view.php" class="logout-link">
                <button class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</button>
            </a>
        </div>
        <div class="content">
            <header>
                <div class="welcome">
                    <h1>Welcome, <?php
                    if (isset($_SESSION['user_id'])) {
                        $userId = $_SESSION['user_id'];
                        $userName = getUserName($userId, $con);
                        echo '<div class="user-name">' . $userName . '</div>';
                    } else {
                        echo "Error: User ID not set in session";
                    }
                    ?></h1>
                    <p>Book your gym session, do this and that and stay stronger</p>
                </div>
            </header>

            <main>
                <div class="summary-widgets">
                    <div class="fitness-goals widget">
                        <h2>Fitness Goals</h2>
                        <ul>
                        <?php
                                $sql_goals = "SELECT content FROM Goals ORDER BY RAND() LIMIT 5";
                                $result_goals = mysqli_query($con, $sql_goals);

                                if ($result_goals && mysqli_num_rows($result_goals) > 0) {
                                    while ($row_goal = mysqli_fetch_assoc($result_goals)) {
                                        echo '<li>' . $row_goal['content'] . '</li>';
                                    }
                                } else {
                                    echo '<li>No goals available</li>';
                                }
                                ?>
                            </ul>
                        </ul>
                    </div>

                    <div class="session-booking widget">
                        <h2>Session Booking</h2>
                        <p>Book your gym sessions here:</p>
                        <ul>
                            <li>Monday, 9:00 AM - 10:00 AM</li>
                            <li>Wednesday, 6:00 PM - 7:00 PM</li>
                            <li>Friday, 7:00 AM - 8:00 AM</li>
                        </ul>
                    </div>

                    <div class="fitness-team widget">
                        <h2>Fitness Team</h2>
                        <p>Meet our fitness trainers:</p>
                        <ul>
                        <?php
                                $sql_instructors = "SELECT instructorName FROM GymInstructors ORDER BY RAND() LIMIT 5";
                                $result_instructors = mysqli_query($con, $sql_instructors);

                                if ($result_instructors && mysqli_num_rows($result_instructors) > 0) {
                                    while ($row_instructor = mysqli_fetch_assoc($result_instructors)) {
                                        echo '<li>' . $row_instructor['instructorName'] . '</li>';
                                    }
                                } else {
                                    echo '<li>No instructors available</li>';
                                }
                                ?>
                        </ul>
                    </div>
                </div>

                <div class="grid-row">
                    <div class="view-booking widget">
                        <h2>View Booking</h2>
                        <table>
                            <tr>
                                <th>Instructor</th>
                                <th>Date</th>
                                <th>Time Slot</th>
                            </tr>
                            <?php
                            $userId = $_SESSION['user_id'];
                            $sql_bookings = "SELECT instructorName, date, time_slot FROM bookings 
                                             INNER JOIN GymInstructors ON bookings.instructorID = GymInstructors.instructorID 
                                             WHERE userID = $userId";
                            $result_bookings = mysqli_query($con, $sql_bookings);

                            if ($result_bookings && mysqli_num_rows($result_bookings) > 0) {
                                while ($row_booking = mysqli_fetch_assoc($result_bookings)) {
                                    echo '<tr>';
                                    echo '<td>' . $row_booking['instructorName'] . '</td>';
                                    echo '<td>' . $row_booking['date'] . '</td>';
                                    echo '<td>' . $row_booking['time_slot'] . '</td>';
                                    echo '</tr>';
                                }
                            } else {
                                echo '<tr><td colspan="3">No bookings available</td></tr>';
                            }
                            ?>
                        </table>
                    </div>

                    <div class="view-equipment widget">
                        <h2>View Equipment</h2>
                        <table class="equipment-table">
                            <tr>
                                <th>Equipment Name</th>
                                <th>Description</th>
                                <th>Quantity</th>
                            </tr>
                            <?php
                            $sql_equipment = "SELECT equipment_name, description, quantity FROM Equipment LIMIT 5";
                            $result_equipment = mysqli_query($con, $sql_equipment);

                            if ($result_equipment && mysqli_num_rows($result_equipment) > 0) {
                                while ($row_equipment = mysqli_fetch_assoc($result_equipment)) {
                                    echo '<tr>';
                                    echo '<td>' . $row_equipment['equipment_name'] . '</td>';
                                    echo '<td>' . $row_equipment['description'] . '</td>';
                                    echo '<td>' . $row_equipment['quantity'] . '</td>';
                                    echo '</tr>';
                                }
                            } else {
                                echo '<tr><td colspan="3">No equipment available</td></tr>';
                            }
                            ?>
                        </table>
                    </div>

                    <div class="ashesifit-tips widget">
                        <h2>AshesiFit Tips</h2>
                        <p>Here are some tips to help you on your fitness journey:</p>
                        <ul>
                        <?php
                            if ($result && mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<li>' . $row['content'] . '</li>';
                                }
                            } else {
                                echo '<li>No tips available</li>';
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

</html>
