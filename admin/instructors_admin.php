<?php
// Include database connection
include_once ('../settings/connection.php');


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/admin_css/instructors_admin.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<body>
    <div class="admin-reports-page">
        <div class="sidebar">
            <div class="sidebar-header">
                <div class="reports-icon"><i class="fas fa-chart-bar"></i></div>
                <div class="logo">AshesiFit</div>
            </div>
            <div class="sidebar-menu">
                <div class="menu-item"><a href="../admin/profile_admin.php"><i class="fas fa-user"></i> Profile</a>
                </div>
                <div class="menu-item"><a href="../admin/dashboard_admin.php"><i class="fas fa-tachometer-alt"></i>
                        Dashboard</a></div>
                <div class="menu-item"><a href="../admin/booking_admin.php"><i class="fas fa-calendar-alt"></i>
                        Bookings</a></div>
                <div class="menu-item"><a href="../admin/notification_admin.php"><i class="fas fa-bell"></i>
                        Notification</a></div>
                <div class="menu-item"><a href="../admin/feedback_admin.php"><i class="fas fa-comment"></i> Feedback</a>
                </div>
                <div class="menu-item"><a href="../admin/instructors_admin.php"><i
                            class="fas fa-chalkboard-teacher"></i> Instructors</a></div>
                <div class="menu-item"><a href="../admin/equipment_admin.php"><i class="fas fa-dumbbell"></i>
                        Equipment</a></div>
                <div class="menu-item active"><a href="../admin/reports_admin.php"><i class="fas fa-chart-bar"></i>
                        Generate Reports</a></div>
                <div class="menu-item active"><a href="../admin/schedule_instructor.php"> <i class="far fa-clock"></i>
                        View Schedule</a></div>
                <div class="menu-item"><a href="../admin/manageUsers_admin.php"><i class="fas fa-users"></i> Manage
                        Users</a></div>
            </div>
            <a href="../login/login.php" class="logout-link">
                <button class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</button>
            </a>
        </div>
        <div class="content">

            <body>
                <div class="container">
                    <h1>Gym Instructors</h1>
                    <a href="dashboard.php"> <button class="back-btn"><i class="fas fa-arrow-left"></i>
                            Back</button></a>
                </div>

                <div class="add-instructor-btn">
                    <button class="add-btn"><i class="fas fa-plus"></i> Add Instructor</button>
                </div>
                <div class="instructor-grid">

                    <!-- Add more instructor items as needed -->
                    <?php include '../functions/instructor_admin_fxn.php'; ?>
                </div>


                <div class="add-instructor-container">
                    <form class="add-instructor-form" id="addInstructorForm" enctype="multipart/form-data"
                        action="../action/instructor_admin_action.php" method="POST">
                        <button type="button" class="close-btn">&times;</button>
                        <div class="form-group">
                            <label for="add-instructor-image">Instructor Image</label>
                            <input type="file" id="add-instructor-image" name="add-instructor-image"
                                class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="add-instructor-name">Instructor Name</label>
                            <input type="text" id="add-instructor-name" name="add-instructor-name" class="form-control"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="add-time-available">Time Available</label>
                            <input type="text" id="add-time-available" name="add-time-available" class="form-control"
                                required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="add-btn">Add Instructor</button>
                        </div>
                    </form>
                </div>
                <div id='editInstructor' class="edit-form-container">
                    <form class="edit-form" enctype="multipart/form-data"
                        action="../action/editAdmin_instructor_action.php" method="post">
                        <button type="button" class="close-btn">&times;</button>
                        <input type="hidden" id="instructor-id4" name="instructor-id">
                        <div class="form-group">
                            <label for="edit-instructor-image">Instructor Image</label>
                            <input type="file" id="edit-instructor-image" name="edit-instructor-image"
                                class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="instructor-name">Instructor Name</label>
                            <input type="text" id="instructor-name" name="instructor-name" class="form-control"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="time-available">Time Available</label>
                            <input type="text" id="time-available" name="time-available" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="save-btn">Save</button>
                        </div>
                    </form>
                </div>

                <div id='deleteInstructor' class="popup-container">
                    <div class="popup">
                        <div class="popup-header">
                        <button type="button" class="close-btn">&times;</button>
                        <input type="hidden" id="instructor-id" name="instructor-id">
                        </div>
                        <div class="popup-content">
                            Are you sure you want to delete this instructor?
                        </div>
                        <div class="popup-buttons">
                            <!-- Delete button -->
                            <button class="popup-delete-btn" id="popup-delete-btn">Delete</button>
                            
                        </div>
                    </div>
                    <div class="overlay"></div>
                </div>


                <script src="../js/admin_js/instructor_admin.js"></script>
                <!-- Include SweetAlert library -->
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                <!-- JavaScript function for delete confirmation -->

                <!-- <script>
                    // Correct the function to use the correct popup container ID and pass instructor ID as a parameter
                    function deleteInstructor(instructorID) {
                        console.log('instructorID', instructorID);
                        document.getElementById('deleteInstructor').style.display = 'block'; // Use 'deleteInstructor' ID
                        event.preventDefault(); // Prevent default form submission
                        document.getElementById('instructor-id').value = instructorID;
                    }

                    function submitEdit(e) {
                        e.preventDefault();
                        var myform = document.getElementById('deleteInstructor');
                        var formData = new FormData(myform);
                        // Retrieve instructor ID from the hidden input field
                        var instructorID = document.getElementById('instructor-id').value;

                        fetch('../action/deleteInstructor_action.php.php?id=' + instructorID, {
                            method: 'GET',
                            body: formData
                        })
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error('Network response was not ok');
                                }
                                return response.json(); // Parse response body as JSON
                            })
                            .then(data => {
                                // Handle success response
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success!',
                                    text: data.message
                                });
                                console.log('Instructor deleted successfully');
                                // Optionally, you can refresh the instructor list or perform other necessary actions here
                            })
                            .catch(error => {
                                // Handle error
                                console.error('There was an error!', error);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Something went wrong!'
                                });
                            });
                    }



                    
                </script> -->

<script>
    // Add event listener to the delete button
    document.getElementById('popup-delete-btn').addEventListener('click', function () {
        // Retrieve instructor ID from the hidden input field
        const instructorId = document.getElementById('instructor-id').value;

        // Send AJAX request to deleteInstructor_action.php
        fetch('../action/deleteInstructor_action.php?instructor-id=' + instructorId, {
            method: 'GET'
        })
        .then(response => {
            if (response.ok) {
                // Instructor deleted successfully, perform necessary actions
                document.getElementById('deleteInstructor').style.display = 'none';
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Instructor deleted successfully'
                });
                // Optionally, you can refresh the instructor list or perform other necessary actions here
            } else {
                // Error handling
                console.error('Error:', response.statusText);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!'
                });
            }
        })
        .catch(error => console.error('Error:', error));
    });
</script>


                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <!-- <script> $(document).ready(function () { // Booking confirmation
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
                    }); </script> -->


                <script>

                    function editInstructor(instructorID) {
                        console.log('instructorID', instructorID)
                        document.getElementById('editInstructor').style.display = 'block';
                        event.preventDefault(); // Prevent default form submission
                        document.getElementById('instructor-id4').value = instructorID;

                    }

                    function submitEdit(e) {
                        e.preventDefault()
                        var myform = document.getElementById('editInstructor')
                        // Collect form data
                        var formData = new FormData(myform);

                        // Make AJAX request
                        fetch('../action/editAdmin_instructor_action.php', {
                            method: 'POST',
                            body: formData
                        })
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error('Network response was not ok');
                                }
                                return response.json(); // Parse response body as JSON
                            })
                            .then(data => {
                                // Handle success response
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success!',
                                    text: data.message
                                });
                                console.log('I am here');
                            })
                            .catch(error => {
                                // Handle error
                                console.error('There was an error!', error);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Something went wrong!'
                                });
                            });
                    }
// Add event listeners to edit buttons
// const editButtons = document.querySelectorAll('.edit-btn');
// editButtons.forEach(button => {
//     button.addEventListener('click', function () {
//         // Retrieve instructor ID from the corresponding instructor item
//         const instructorID = this.closest('.instructor-item').dataset.instructorId;
//         // Set the value of the hidden input field
//         document.getElementById('instructor-id').value = instructorID;
//         console.log()
//         // Optionally, you can also pre-fill other form fields based on the instructor ID here
//         // For example, you can make an AJAX request to fetch instructor details and fill the form fields
//     });
// });
                </script>

            </body>

</html>
</div>
</body>

</html>