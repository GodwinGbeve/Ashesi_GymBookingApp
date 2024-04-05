




<?php
// Include the core.php file
include '../settings/connection.php';
include '../settings/core.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ashesifit Booking</title>
    <link rel="stylesheet" href="../css/global.css" />
    <link rel="stylesheet" href="../css/admin_css/adminbookingPage.css" />
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
                <div class="menu-item active"><a href="profile.php"><i class="fas fa-user"></i> Profile</a></div>
                <div class="menu-item"><a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></div>
                <div class="menu-item"><a href="booking.php"><i class="fas fa-calendar-alt"></i> Bookings</a></div>
                <div class="menu-item"><a href="notification.php"><i class="fas fa-bell"></i> Notification</a></div>
                <div class="menu-item"><a href="feedback.php"><i class="fas fa-comment"></i> Feedback</a></div>
                <div class="menu-item"><a href="instructors.php"><i
                            class="fas fa-chalkboard-teacher"></i>Instructors</a></div>
                <div class="menu-item"><a href="equipment.php"><i class="fas fa-dumbbell"></i>Equipment</a></div>
            </div>
            <a href="../login/login.php">
                <button class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</button>
            </a>
        </div>
        <body>
  <h1>Admin Booking Page</h1>
  
  <div id="bookings-container">
    <table id="bookings-table">
      <thead>
        <tr>
          <th>User ID</th>
          <th>User Name</th>
          <th>Instructor ID</th>
          <th>Instructor Name</th>
          <th>Date</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody id="bookings-body">
        <!-- Booking data will be dynamically inserted here -->
      </tbody>
    </table>
  </div>


                    <!-- PHP code to fetch bookings -->
<!--                     <?php
                    // Fetch bookings from the database
                    $query = "SELECT * FROM Bookings";
                    $result = mysqli_query($con, $query);

                    // Check if there are any bookings
                    if (mysqli_num_rows($result) > 0) {
                        // Loop through each row and display the booking information
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td class='date-column'>" . $row['date'] . "</td>";
                            echo "<td class='time-column'>" . $row['time_slot'] . "</td>";
                            echo "<td><a href='#' class='edit-icon' data-id='" . $row['bookingID'] . "'><i class='fas fa-edit'></i></a></td>";
                            echo "<td><a href='#' class='delete-icon' onclick='confirmDelete(" . $row['bookingID'] . ")'><i class='fas fa-trash-alt'></i></a></td>";
                            echo "</tr>";
                        }
                    } else {
                        // If no bookings are found, display a message
                        echo "<tr><td colspan='4'>No bookings found</td></tr>";
                    }
                    ?>
 -->
                </tbody>
            </table>
        </div>
    </div>

   
    <script src="../js/admin_js/booking_admin.js"></script>
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