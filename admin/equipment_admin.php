<?php
// Include database connection
include_once ('../settings/connection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ashesifit Gym Equipment</title>
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/admin_css/equipment_admin.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        /* Add your custom CSS styles here */
    </style>
</head>
<body>
    <div class="equipment-page">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-header">
                <div class="notification-icon"><i class="fas fa-bell"></i></div>
                <div class="logo">Ashesifit</div>
            </div>
            <div class="sidebar-menu">
                <!-- Sidebar menu items -->
 <div class="menu-item"><a href="../admin/profile_admin.php"><i class="fas fa-user"></i> Profile</a></div>
                <div class="menu-item"><a href="../admin/dashboard_admin.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></div>
                <div class="menu-item"><a href="../admin/booking_admin.php"><i class="fas fa-calendar-alt"></i> Bookings</a></div>
                <div class="menu-item"><a href="../admin/notification_admin.php"><i class="fas fa-bell"></i> Notification</a></div>
                <div class="menu-item"><a href="../admin/feedback_admin.php"><i class="fas fa-comment"></i> Feedback</a></div>
                <div class="menu-item"><a href="../admin/instructors_admin.php"><i class="fas fa-chalkboard-teacher"></i> Instructors</a></div>
                <div class="menu-item"><a href="../admin/equipment_admin.php"><i class="fas fa-dumbbell"></i> Equipment</a></div>
                <div class="menu-item active"><a href="../admin/reports_admin.php"><i class="fas fa-chart-bar"></i> Generate Reports</a></div>
                <div class="menu-item active"><a href="../admin/schedule_instructor.php"> <i class="far fa-clock"></i> View Schedule</a></div>
                <div class="menu-item"><a href="../admin/manageUsers_admin.php"><i class="fas fa-users"></i> Manage Users</a></div>
                <!-- Add links to other admin pages here -->
            </div>
            <a href="../login/login.php" class="logout-link">
                <button class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</button>
            </a>
        </div>
        </div>
        <!-- Main content area for managing gym equipment -->
        <div class="manage-equipment-content">
            <!-- Page header -->
            <div class="page-header">
                <h1>Gym Equipment</h1>
                <button class="back-btn"><a href="dashboard.php"><i class="fas fa-arrow-left"></i> Back</a></button>
            </div>
            
            <!-- Button to add new equipment -->
            <div class="add-equipment-btn">
                <button class="add-btn"><i class="fas fa-plus"></i> Add Equipment</button>
            </div>
            
            <!-- Container to display existing equipment -->
            <div class="equipment-grid">
                <!-- Equipment items will be dynamically added here -->
                <?php include '../functions/equipment_admin_fxn.php'; ?>
            </div>

            <!-- Container for adding new equipment -->
            <div class="add-equipment-container">
                <form class="add-equipment-form" enctype="multipart/form-data" action="../action/equipment_admin_actions.php" method="POST">
                    <button type="button" class="close-btn">&times;</button>
                    <div class="form-group">
                        <label for="add-equipment-image">Equipment Image</label>
                        <input type="file" name= "image" id="add-equipment-image" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="add-equipment-name">Equipment Name</label>
                        <input type="text" name="equipment_name" id="add-equipment-name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="add-equipment-description">Equipment description</label>
                    <input type="text" name="description" id="add-equipment-description" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="add-quantity-available">Quantity Available</label>
                        <input type="number" name= "quantity" id="add-quantity-available" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="add-btn">Add Equipment</button>
                    </div>
                </form>
            </div>

            <!-- Container for editing existing equipment -->
            
    <!-- Edit form content will be dynamically added here -->
    <div id='editEquipment' class="edit-form-container">
        <form class="edit-form" enctype="multipart/form-data" action="../action/editAdmin_equipment_action.php" method="POST">
            <button type="button" class="close-btn">&times;</button>
            <input type="hidden" id="equipment-id4" name="equipmentID">
            <div class="form-group">
                <label for="edit-equipment-image">Equipment Image</label>
                <input type="file" id="edit-equipment-image" name="edit-equipment-image" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="equipment-name">Equipment Name</label>
                <input type="text" id="equipment-name" name="equipment-name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="equipment-description">Equipment description</label>
                <input type="text" id="description" name="description" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="quantity-available">Quantity Available</label>
                <input type="text" id="quantity-available" name="quantity-available" class="form-control" required>
            </div>
            <div class="form-group">
                <button type="submit" class="save-btn">Save</button>
            </div>
        </form>
    </div>
</div>

            <!-- Popup container for delete confirmation -->
            <div class="popup-container">
            <div id='deleteEquipment' class="popup-container">
    <div class="popup">
        <div class="popup-header">
            <button type="button" class="close-btn">&times;</button>
            <input type="hidden" id="equipment-id" name="equipment-id">
        </div>
        <div class="popup-content">
            Are you sure you want to delete this equipment?
        </div>
        <div class="popup-buttons">
            <!-- Delete button -->
            <button class="popup-delete-btn" id="popup-delete-btn">Delete</button>
        </div>
    </div>
    <div class="overlay"></div>
</div>

            </div>
        </div>
    </div>

    <!-- JavaScript file for handling AJAX requests -->
    <script src="../js/admin_js/equipment_admin.js"></script>
    <script>
    // Add event listener to the delete button
    document.getElementById('popup-delete-btn').addEventListener('click', function () {
        // Retrieve equipment ID from the hidden input field
        const equipmentId = document.getElementById('equipment-id').value;

        // Send AJAX request to deleteEquipment_action.php
        fetch('../action/deleteEquipment_action.php?equipment-id=' + equipmentId, {
            method: 'GET'
        })
        .then(response => {
            if (response.ok) {
                // Equipment deleted successfully, perform necessary actions
                document.getElementById('deleteEquipment').style.display = 'none';
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Equipment deleted successfully'
                });
                // Optionally, you can refresh the equipment list or perform other necessary actions here
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
    function editEquipment(equipmentID) {
        console.log('equipmentID', equipmentID);
        document.getElementById('editEquipment').style.display = 'block';
        event.preventDefault(); // Prevent default form submission
        document.getElementById('equipment-id4').value = equipmentID;
    }

    function submitEdit(e) {
        e.preventDefault();
        var myform = document.getElementById('editEquipment');
        // Collect form data
        var formData = new FormData(myform);

        // Make AJAX request
        fetch('../action/editAdmin_equipment_action.php', {
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
