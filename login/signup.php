
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ashesifit - Signup</title>
    <link rel="stylesheet" href="../css/signup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <div class="container">
  
        <h1>Signup</h1>
        <form class="user" action="../action/register_action.php" method="post"
                                name="registrationForm" id="registrationForm">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="dob">Date of Birth</label>
                <input type="date" id="dob" name="dob" required>
            </div>
            <div class="form-group">
                <label for="role">Role in School</label>
                <select id="role" name="role" required>
                    <option value="">Select</option>
                    <option value=1>Student</option>
                    <option value=2>Faculty</option>
                    <option value=3>Admin</option>
                </select>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="form-group">
                <label for="residence">Residence Status</label>
                <select id="residence" name="residence" required>
                    <option value="">Select</option>
                    <option value="resident">Resident</option>
                    <option value="non-resident">Non-Resident</option>
                </select>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="form-group">
                <label for="fitness-goals">Fitness Goals</label>
                <textarea id="fitness-goals" name="fitness-goals" rows="4" required></textarea>
            </div>
            <button type="submit">Signup</button>
        </form>
        <p><a href="../login/login.php"> Already have an account? Login</a></p>
    </div>
</body>
</html>
