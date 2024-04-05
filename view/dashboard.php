<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ashesifit Booking</title>
    <link rel="stylesheet" href="../css/global.css" />
    <link rel="stylesheet" href="../css/dashboard-page.css" />
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
                <div class="menu-item active"><a href="feedback.php"><i class="fas fa-comment"></i> Feedback</a></div>
                <div class="menu-item"><a href="instructors.php"><i class="fas fa-chalkboard-teacher"></i>Instructors</a></div>
                <div class="menu-item"><a href="equipment.php"><i class="fas fa-dumbbell"></i>Equipment</a></div>
            </div>
            <a href="../login/login.php">
                <button class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</button>
            </a>
        </div>
        <div class="content">
            <header>
                <div class="welcome">
                    <h1>Welcome, Gym Rat</h1>
                    <p>Book your gym session, do this and that and stay stronger</p>
                </div>
            </header>

            <main>
                <div class="middle-row">
                    <div class="fitness-goals">
                        <h2>Fitness Goals</h2>
                        <ul>
                            <li>Run 5 miles every day</li>
                            <li>Do 50 push-ups daily</li>
                            <li>Attend yoga class twice a week</li>
                        </ul>
                    </div>
                </div>

                <div class="split-row">
                    <div class="session-booking">
                        <h2>Session Booking</h2>
                        <p>Book your gym sessions here:</p>
                        <ul>
                            <li>Monday, 9:00 AM - 10:00 AM</li>
                            <li>Wednesday, 6:00 PM - 7:00 PM</li>
                            <li>Friday, 7:00 AM - 8:00 AM</li>
                        </ul>
                    </div>

                    <div class="fitness-team">
                        <h2>Fitness Team</h2>
                        <p>Meet our fitness trainers:</p>
                        <ul>
                            <li>Chris Hem</li>
                            <li>Michael B.</li>
                            <li>Alex Lara</li>
                        </ul>
                    </div>
                </div>

                <div class="grid-row">
                    <div class="view-booking">
                        <h2>View Booking</h2>
                        <p>January 2023</p>
                        <table>
                            <tr>
                                <th class="weekday">M</th>
                                <th class="weekday">T</th>
                                <th class="weekday">W</th>
                                <th class="weekday">T</th>
                                <th class="weekday">F</th>
                                <th class="weekday">S</th>
                                <th class="weekday">S</th>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <!-- ... Repeat the above row for each week of the month -->
                        </table>
                    </div>

                    <div class="view-equipment">
                        <h2>View Equipment</h2>
                        <!-- Equipment list goes here -->
                    </div>

                    <div class="ashesifit-tips">
                        <h2>AshesiFit Tips</h2>
                        <p>Here are some tips to help you on your fitness journey:</p>
                        <ul>
                            <li>Stay consistent with your workouts</li>
                            <li>Listen to your body and rest when needed</li>
                            <li>Stay hydrated and eat a balanced diet</li>
                            <li>Set realistic goals and track your progress</li>
                            <li>Find a workout routine that you enjoy</li>
                        </ul>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

</html>