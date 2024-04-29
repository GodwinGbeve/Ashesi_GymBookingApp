<?php
// Include the core.php file
include '../settings/connection.php';
include '../settings/core.php';
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
    <title>Ashesifit Booking</title>
    <link rel="stylesheet" href="../css/global.css" />
    <link rel="stylesheet" href="../css/bookingPage.css" />
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
                <div class="menu-item"><a href="profile.php"><i class="fas fa-user"> </i> Profile</a></div>
                <div class="menu-item"><a href="dashboard.php"><i class="fas fa-tachometer-alt"></i>Dashboard</a></div>
                <div class="menu-item"><a href="booking.php"><i class="fas fa-calendar-alt"></i>Bookings</a></div>
                <div class="menu-item"><a href="feedback.php"><i class="fas fa-comment"></i>Feedback</a></div>
                <div class="menu-item"><a href="instructors.php"><i
                            class="fas fa-chalkboard-teacher"></i>Instructors</a></div>
                <div class="menu-item"><a href="equipment.php"><i class="fas fa-dumbbell"></i>Equipment</a></div>
                <div class="menu-item"><a href="notification.php"><i class="fas fa-bell"></i>Notification</a></div>
            </div>
            <a href="../login/logout_view.php" class="logout-link">
                <button class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</button>
            </a>
        </div>
        <div class="content">
            <div class="booking-content">
                <h1>Book your Gym Session</h1>
                <button class="toggle-form-btn">Open Booking Form</button>
                <div class="booking-form-wrapper" style="display: none;">
                    <div class="booking-form">
                        <div class="close-button">
                            <span class="close-icon">&#10005;</span>
                        </div>
                        <form id="bookingForm" class="user" action="../action/booking_action.php" method="post"
                            name="bookingForm">
                            <label for="date">Select Date:</label>
                            <input type="date" id="date" name="date" min="<?php echo date('Y-m-d'); ?>" required>

                            <label for="time">Select Time:</label>
                            <input type="time" id="time" name="time" required>

                            <label for="instructor">Select Gym Instructor:</label>
                            <select id="instructor" name="instructor" required>
                                <option value="">Select an instructor</option>
                                <?php
                                $query = "SELECT * FROM GymInstructors";
                                $result = mysqli_query($con, $query);
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='" . $row['instructorID'] . "'>" . $row['instructorName'] . "</option>";
                                    }
                                }
                                ?>
                            </select>

                            <button type="submit" class="book-now-btn">Book Now</button>
                        </form>
                    </div>
                </div>

            </div>
            <table class="booking-table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Instructor</th> <!-- Changed to singular form -->
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $query = "SELECT b.*, i.instructorName FROM bookings b JOIN GymInstructors i ON b.instructorID = i.instructorID";
                    $result = mysqli_query($con, $query);

                    // Check if there are any bookings
                    if (mysqli_num_rows($result) > 0) {

                        // Loop through each row and display the booking information
                        while ($row = mysqli_fetch_assoc($result)) {
                            if ($row['userID'] == $_SESSION['user_id']) {
                                echo "<tr>";
                                echo "<td class='date-column'>" . $row['date'] . "</td>";
                                echo "<td class='time-column'>" . $row['time_slot'] . "</td>";
                                echo "<td class='instructor-column'>" . $row['instructorName'] . "</td>"; // Display instructor name
                                echo "<td><a href='#' class='edit-icon' data-id='" . $row['bookingID'] . "'><i class='fas fa-edit'></i></a></td>";
                                echo "<td><a href='#' class='delete-icon' onclick='confirmDelete(" . $row['bookingID'] . ")'><i class='fas fa-trash-alt'></i></a></td>";
                                echo "</tr>";
                            }
                        }
                    } else {
                        // If no bookings are found, display a message
                        echo "<tr><td colspan='5'>No bookings found</td></tr>";
                    } ?>
                </tbody>
            </table>

            <div id="editPopup" class="edit-popup">
                <div class="edit-popup-content">
                    <span class="close-edit-popup">&times;</span>
                    <h2>Edit Booking</h2>
                    <form id="editBookingForm" action="../action/editBook_action.php" method="post">
                        <input type="hidden" id="editBookingID" name="booking_id">
                        <label for="editDate">Select Date:</label>
                        <input type="date" id="editDate" name="date" min="<?php echo date('Y-m-d'); ?>" required>
                        <label for="editTime">Select Time:</label>
                        <input type="time" id="editTime" name="time" required>
                        <label for="editInstructor">Select Gym Instructor:</label>
                        <select id="editInstructor" name="instructor" required>
                            <option value="">Select an instructor</option>
                            <!-- PHP code to fetch gym instructors from the database and populate the dropdown -->
                            <?php
                            $query = "SELECT * FROM GymInstructors";
                            $result = mysqli_query($con, $query);
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='" . $row['instructorID'] . "'>" . $row['instructorName'] . "</option>";
                                }
                            }
                            ?>
                        </select>

                        <button type="submit" class="book-now-btn">Update</button>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggleFormBtn = document.querySelector('.toggle-form-btn');
            const bookingFormWrapper = document.querySelector('.booking-form-wrapper');

            toggleFormBtn.addEventListener('click', () => {
                bookingFormWrapper.style.display = bookingFormWrapper.style.display === 'none' ? 'block' : 'none';
            });

            const closeButton = document.querySelector('.close-button');
            const formWrapper = document.querySelector('.booking-form-wrapper');

            closeButton.addEventListener('click', function () {
                formWrapper.style.display = 'none';
            });

            const toggleFormButton = document.querySelector('.toggle-form-btn');

            toggleFormButton.addEventListener('click', function () {
                formWrapper.style.display = 'block';
            });

            const bookingForm = document.getElementById('bookingForm');

            bookingForm.addEventListener('submit', function (event) {
                event.preventDefault();

                fetch('../action/booking_action.php', {
                    method: 'POST',
                    body: new FormData(bookingForm),
                })
                    .then(response => {
                        if (response.ok) {
                            Swal.fire({
                                title: 'Success!',
                                text: 'Your booking has been confirmed.',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = '../view/booking.php';
                                }
                            });
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Failed to submit the booking. Please try again later.',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            title: 'Error!',
                            text: 'An unexpected error occurred. Please try again later.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    });
            });
        });
    </script>


<script>
    // Function to open the edit popup
function openEditPopup() {
    document.getElementById('editPopup').style.display = 'block';
}

// Function to close the edit popup
function closeEditPopup() {
    document.getElementById('editPopup').style.display = 'none';
}

// Attach event listener to edit button icons
document.querySelectorAll('.edit-icon').forEach(item => {
    item.addEventListener('click', event => {
        event.preventDefault();
        const bookingID = item.getAttribute('data-id');
        const date = item.closest('tr').querySelector('.date-column').textContent;
        const time = item.closest('tr').querySelector('.time-column').textContent;
        document.getElementById('editBookingID').value = bookingID;
        document.getElementById('editDate').value = date;
        document.getElementById('editTime').value = time;
        openEditPopup();
    });
});

// Close edit popup when the close button is clicked
document.querySelector('.close-edit-popup').addEventListener('click', () => {
    closeEditPopup();
});

</script>

<script src="../js/booking.js"></script>
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

<script>
    document.getElementById('bookingForm').addEventListener('submit', function (event) {
        // Get the selected date and time from the form
        var selectedDate = new Date(document.getElementById('date').value);
        var selectedTime = document.getElementById('time').value;
        var selectedDateTime = new Date(selectedDate.toDateString() + ' ' + selectedTime);

        // Get the current date and time
        var today = new Date();
        var currentTime = new Date(today.toDateString() + ' ' + today.toLocaleTimeString());

        // Compare the selected date and time with the current date and time
        if (selectedDateTime < currentTime) {
            // Prevent form submission
            event.preventDefault();
            // Display an error message using SweetAlert2
            Swal.fire({
                icon: 'error',
                title: 'Invalid Date/Time',
                text: 'Please select a date/time that is today or later.'
            });
        }
    });
</script>
<script>
    // JavaScript function to dynamically set min attribute of time input field
    function setMinTime() {
        var currentDate = new Date();
        var currentHour = currentDate.getHours();
        var currentMinute = currentDate.getMinutes();
        var currentTime = currentHour.toString().padStart(2, '0') + ':' + currentMinute.toString().padStart(2, '0');

        // Set the min attribute for the editTime input field
        var editTimeInput = document.getElementById('editTime');
        editTimeInput.min = currentTime;
    }

    // Call the function when the page is loaded
    window.addEventListener('load', setMinTime);

</script>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script> $(document).ready(function () { // Booking confirmation
        $("#bookingForm").submit(function (event) {
            event.preventDefault();
            Swal.fire({
                title: 'Success!', text: 'Your booking has been confirmed.',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => { if (result.isConfirmed) { window.location.href = '../view/booking.php'; } });
        }); // Editing confirmation 
        $("#editBookingForm").submit(function (event) {
            event.preventDefault(); Swal.fire({
                title: 'Success!', text: 'Your booking has been updated.',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => { if (result.isConfirmed) { window.location.href = '../view/booking.php'; } });
        });
    }); </script>
</body>

</html>