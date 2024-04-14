<?php
// Include database connection file
include "../settings/connection.php";
include_once ('../settings/core.php');
include ('../functions/username_fxn.php');

global $con;

// Fetch schedule data from the database
$sql = "SELECT bookings.bookingID, bookings.date, bookings.time_slot, Users.username AS user_name, 
               Gyminstructors.instructorName AS instructor_name, bookings.status
        FROM bookings
        INNER JOIN Users ON bookings.userID = Users.userID
        INNER JOIN Gyminstructors ON bookings.instructorID = Gyminstructors.instructorID";

$result = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Schedule</title>
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/admin_css/schedule_instructor.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

</head>

<body>
    <div class="admin-reports-page">
        <!-- Sidebar content -->
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
                <div class="reports-icon"><i></i></div>
                <div class="logo">AshesiFit</div>
            </div>
            <div class="sidebar-menu">
                <div class="menu-item"><a href="../admin/profile_admin.php"><i class="fas fa-user"></i> Profile</a>
                </div>
                <div class="menu-item"><a href="../admin/dashboard_admin.php"><i class="fas fa-tachometer-alt"></i>
                        Dashboard</a></div>
                <div class="menu-item"><a href="../admin/booking_admin.php"><i class="fas fa-calendar-alt"></i>
                        Bookings</a></div>
                <div class="menu-item active"><a href="../admin/feedback_admin.php"><i class="fas fa-comment"></i>
                        Feedback</a></div>
                <div class="menu-item"><a href="../admin/instructors_admin.php"><i
                            class="fas fa-chalkboard-teacher"></i> Instructors</a></div>
                <div class="menu-item"><a href="../admin/equipment_admin.php"><i class="fas fa-dumbbell"></i>
                        Equipment</a></div>

                <?php
                if (isset($_SESSION['role_id'])) {
                    $rid = $_SESSION['role_id'];
                    if ($rid == 3) { // If the user is an admin
                        ?>
                        <div class="menu-item"><a href="../admin/reports_admin.php"><i class="fas fa-chart-bar"></i> Generate
                                Reports</a></div>
                        <div class="menu-item"><a href="../admin/manageUsers_admin.php"><i class="fas fa-users"></i> Manage
                                Users</a></div>
                        <?php
                    }
                }
                ?>
                <div class="menu-item"><a href="../admin/schedule_instructor.php"> <i class="far fa-clock"></i> View
                        Schedule</a></div>

            </div>
            <a href="../login/login.php" class="logout-link">
                <button class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</button>
            </a>
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
                                <th>Instructor</th>
                                <th>Booking Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Check if there are any rows returned
                            if (mysqli_num_rows($result) > 0) {
                                // Loop through each row
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>" . $row['date'] . "</td>";
                                    echo "<td>" . $row['time_slot'] . "</td>";
                                    echo "<td>" . $row['user_name'] . "</td>";
                                    echo "<td>" . $row['instructor_name'] . "</td>";
                                    echo "<td>" . $row['status'] . "</td>";
                                    echo "<td>";
                                    echo "<a class='delete-btn' href='../action/deleteSchedule_action.php?id=" . $row['bookingID'] . "' style='background-color: #9F4446; color: white; margin-right: 5px; padding: 8px 16px; border-radius: 5px; border: none; cursor: pointer;'>Delete</button>";
                                    echo "<a class='cancel-btn' href='../action/cancelSchedule_action.php?id=" . $row['bookingID'] . "' style='background-color: #9F4446; color: white; margin-right: 5px; padding: 8px 16px; border-radius: 5px; border: none; cursor: pointer;'>Cancel</button>";
                                    echo "<a class='completed-btn' href='../action/completedSchedule_action.php?id=" . $row['bookingID'] . "' style='background-color: #9F4446; color: white; margin-right: 5px; padding: 8px 16px; border-radius: 5px; border: none; cursor: pointer;'>Completed</a>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                // If no rows returned, display message
                                echo "<tr><td colspan='6'>No bookings found</td></tr>";
                            }
                            ?>
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
        const deleteButtons = document.querySelectorAll('.delete-btn');

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
                        fetch('../action/deleteSchedule_action.php', {
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
                                // Reload the page or update the booking list
                                location.reload();
                            });
                .catch (error => console.error('Error:', error));
            }
        });
    });
});


        // Cancel button click event
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
                        fetch('../action/deletelSchedule_action.php', {
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
                                // Reload the page or update the booking list
                                location.reload();
                            });
                .catch (error => console.error('Error:', error));
            }
        });
    });
});

    </script>
</body>

</html>