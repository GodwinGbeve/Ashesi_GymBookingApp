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
    <title>Admin Manage User</title>
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/admin_css/manageUsers_admin.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

</head>

<body>
    <div class="admin-manage-user-page">
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
                <div class="manage-users-icon"><i></i></div>
                <div class="logo">Ashesifit</div>
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
    </div>

    <div class="content">
        <h1>Manage Users</h1>

        <!-- Table to display user information -->

        <table id="userTable">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role ID</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php include '../functions/manage_admin_fxn.php'; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal popup for editing user information -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <!-- Form for editing user information -->
            <form id="editForm" action="../action/manageUser_edit.php" method="POST">
                <div class="input-group">
                    <label for="editUsername">Username:</label>
                    <input type="text" id="editUsername" name="username" readonly>
                </div>
                <div class="input-group">
                    <label for="editEmail">Email:</label>
                    <input type="email" id="editEmail" name="email" readonly>
                </div>
                <div class="input-group">
                    <label for="editRoleID">Role ID:</label>
                    <input type="text" id="editRoleID" name="roleID">
                </div>
                <!-- Hidden input field to store user ID -->
                <input type="hidden" id="editUserID" name="userID">
                <button type="submit">Save Changes</button>
            </form>
        </div>
    </div>


    <script src="../js/admin_js/manageUsers_admin.js"></script>
    <script>

        // Function to display the edit modal for a user
        function editUser(userID) {
            // Display the edit modal
            document.getElementById('editModal').style.display = 'block';

            // Populate the form fields with user data
            var row = document.querySelector('tr[data-userID="' + userID + '"]');
            document.getElementById('editUserID').value = userID; // Set UserID value
            document.getElementById('editUsername').value = row.cells[1].innerText;
            document.getElementById('editEmail').value = row.cells[2].innerText;
            document.getElementById('editRoleID').value = row.cells[3].innerText;
        }

    // Function to handle form submission for editing user
    ffunction submitEditUser(event) {
            event.preventDefault(); // Prevent default form submission

            // Collect form data
            var formData = new FormData(document.getElementById('editForm'));

            // Make AJAX request
            fetch('../action/manageUser_edit.php', {
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
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: data.message
                        });
                        // Optionally, you can update the user information in the table without refreshing the page
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: data.message
                        });
                    }
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