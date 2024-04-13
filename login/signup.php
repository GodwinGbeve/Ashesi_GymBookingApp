<?php
include '../settings/connection.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ashesifit - Signup</title>
    <link rel="stylesheet" href="../css/signup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>

<body>
    <div class="container">

        <h1>Signup</h1>
        <form class="user" action="../action/register_action.php" method="post" name="registrationForm"
            id="registrationForm">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required pattern="[a-zA-Z\s]+"
                    title="Name should contain only letters and spaces">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required
                    pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" title="Enter a valid email address">
                <small class="form-text text-muted">Please use your @ashesi.edu.gh email address.</small>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required
                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                    title="Password must contain at least one number, one uppercase and lowercase letter, and at least 8 or more characters">
            </div>
            <div class="form-group">
                <label for="dob">Date of Birth</label>
                <input type="date" id="dob" name="dob" required>
                <small id="dob-error" class="form-text text-danger"></small>
            </div>
            <div class="form-group">
                <label for="role">Role in School</label>
                <select id="role" name="role" required>
                    <option value="">Select</option>
                    <option value=1>Student</option>
                    <option value=2>Faculty</option>
                    <option value=3>Admin</option>
                    <option value=4>Instructor</option>
                </select>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="form-group">
                <label for="residence">Residence Status</label>
                <select id="residence" name="residence" required>
                    <option value="">Select</option>
                    <option value="On-campus">On-campus</option>
                    <option value="Off-campus">Off-campus</option>
                </select>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="form-group">
                <label for="fitness-goals">Fitness Goals</label>
                <textarea id="fitness-goals" name="fitness-goals" rows="4" required pattern="[a-zA-Z0-9\s]+"
                    title="Fitness goals should contain letters, numbers, and spaces only"></textarea>
            </div>
            <button type="submit" id="signupButton">Signup</button>
        </form>
        <p><a href="../login/login.php"> Already have an account? Login</a></p>
    </div>

    <!-- SweetAlert2 JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('registrationForm').addEventListener('submit', function (event) {
            event.preventDefault(); // Prevent form submission
            var email = document.getElementById('email').value;
            var dob = document.getElementById('dob').value;
            var today = new Date();
            var birthDate = new Date(dob);
            var age = today.getFullYear() - birthDate.getFullYear();
            var m = today.getMonth() - birthDate.getMonth();
            if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }

            if (!email.endsWith('@ashesi.edu.gh')) {
                // Display SweetAlert2 alert for invalid email
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid Email Address',
                    text: 'Please use your @ashesi.edu.gh email address.'
                });
            } else if (age < 16) {
                // Display SweetAlert2 alert for age restriction
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid Date of Birth',
                    text: 'You must be at least 16 years old to register.'
                });
            } else {
                // Proceed with form submission
                this.submit();
            }
        });

        // Check if URL contains success parameter
        const urlParams = new URLSearchParams(window.location.search);
        const successParam = urlParams.get('success');
        if (successParam === 'true') {
            // Display SweetAlert2 success message if success parameter is true
            Swal.fire({
                icon: 'success',
                title: 'Registration Successful',
                text: 'You have successfully created an account!'
            }).then(() => {
                // Redirect to login page after 4 seconds
                setTimeout(() => {
                    window.location.href = '../login/login.php';
                }, 4000);
            });
        }
    </script>

</body>

</html>
