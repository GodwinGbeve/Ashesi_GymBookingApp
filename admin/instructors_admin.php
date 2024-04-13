<?php
// Include database connection
include_once ('../settings/connection.php');
include_once ('../settings/core.php');
include ('../functions/username_fxn.php');
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />


</head>

<body>
    <div class="admin-reports-page">
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
                <h1>Gym Instructors</h1>
                <button class="back-btn"><a href="../admin/dashboard_admin.php"><i class="fas fa-arrow-left"></i>
                        Back</a></button>

            </div>

            <div class="add-instructor-btn">
                <?php
                if (isset($_SESSION['role_id'])) {
                    $rid = $_SESSION['role_id'];

                    // Display the "Add Instructor" button only for admin
                    if ($rid == 3) { // If the user is an admin
                        echo '<button class="add-btn"><i class="fas fa-plus"></i> Add Instructor</button>';
                    }
                }
                ?>
            </div>

            <div class="instructor-grid">
                <!-- Add more instructor items as needed -->
                <?php include '../functions/instructor_admin_fxn.php'; ?>
            </div>
        </div>

        <div class="add-instructor-container">
            <form class="add-instructor-form needs-validation" id="addInstructorForm" enctype="multipart/form-data"
                action="../action/instructor_admin_action.php" method="POST">
                <button type="button" class="close-btn">&times;</button>
                <div class="form-group">
                    <label for="add-instructor-image">Instructor Image</label>
                    <input type="file" id="add-instructor-image" name="add-instructor-image" class="form-control"
                        required>
                </div>
                <div class="form-group">
                    <label for="add-instructor-name">Instructor Name</label>
                    <input type="text" id="add-instructor-name" name="add-instructor-name" class="form-control"
                        pattern="[a-zA-Z\s]+" title="Only letters and spaces are allowed" required>
                    <!-- <div class="invalid-feedback">Please provide a valid name.</div> -->
                </div>
                <div class="form-group">
                    <label for="add-time-available">Time Available eg. (e.g., 3:00PM - 4:00PM)</label>
                    <input type="text" id="add-time-available" name="add-time-available" class="form-control"
                        pattern="^([0-9]|0[0-9]|1[0-2]):([0-5][0-9]) ?([AaPp][Mm])? ?- ?([0-9]|0[0-9]|1[0-2]):([0-5][0-9]) ?([AaPp][Mm])?$"
                        title="Please enter a valid time format (e.g., 3:00PM - 4:00PM)" required>
                    <!-- <div class="invalid-feedback">Please enter a valid time format (e.g., 3:00 PM or 3:00PM - 4:00PM).</div> -->
                </div>
                <div class="form-group">
                    <button type="submit" class="add-btn">Add Instructor</button>
                </div>
            </form>
        </div>

        <div id='editInstructor' class="edit-form-container">
            <form class="edit-form" enctype="multipart/form-data" action="../action/editAdmin_instructor_action.php"
                method="post">
                <button type="button" class="close-btn">&times;</button>
                <input type="hidden" id="instructor-id4" name="instructor-id">
                <div class="form-group">
                    <label for="edit-instructor-image">Instructor Image</label>
                    <input type="file" id="edit-instructor-image" name="edit-instructor-image" class="form-control"
                        required>
                </div>
                <div class="form-group">
                    <label for="instructor-name">Instructor Name</label>
                    <input type="text" id="instructor-name" name="instructor-name" class="form-control"
                        pattern="[a-zA-Z\s]+" title="Only letters and spaces are allowed" required>
                    <span class="error" id="edit-nameError"></span> <!-- Span for displaying error message -->
                </div>
                <div class="form-group">
                    <label for="time-available">Time Available eg. (e.g., 3:00PM - 4:00PM)</label>
                    <input type="text" id="time-available" name="time-available" class="form-control"
                        pattern="^([0-9]|0[0-9]|1[0-2]):([0-5][0-9]) ?([AaPp][Mm])? ?- ?([0-9]|0[0-9]|1[0-2]):([0-5][0-9]) ?([AaPp][Mm])?$"
                        title="Please enter a valid time format (e.g., 3:00PM - 4:00PM)" required>
                    <span class="error" id="edit-timeError"></span> <!-- Span for displaying error message -->
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

    </div>

    <!-- JavaScript -->
    <script src="../js/admin_js/instructor_admin.js"></script>
    <!-- Include SweetAlert library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Validate form on submission
        document.getElementById('addInstructorForm').addEventListener('submit', function (event) {
            if (!this.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }

            this.classList.add('was-validated');

            // Validate instructor name
            const instructorNameInput = document.getElementById('add-instructor-name');
            if (!instructorNameInput.checkValidity()) {
                instructorNameInput.classList.add('is-invalid');
            } else {
                instructorNameInput.classList.remove('is-invalid');
            }

            // Validate time available
            const timeAvailableInput = document.getElementById('add-time-available');
            if (!timeAvailableInput.checkValidity()) {
                timeAvailableInput.classList.add('is-invalid');
            } else {
                timeAvailableInput.classList.remove('is-invalid');
            }
        });
    </script>

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
                        // Immediately show success message
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
    </script>

</body>

</html>