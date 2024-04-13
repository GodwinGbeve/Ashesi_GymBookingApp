

# Ashesi Gym Booking App

Welcome to the Ashesi Gym Booking App! This application is designed to streamline the gym booking process for members of the Ashesi community. 
The application allows users to book gym sessions, view equipment availability, provide feedback, and more. Administrators have access to 
additional features for managing bookings, equipment, instructors, and user accounts.



## Features

### User Side
- **View Equipment**: Users can browse through the available gym equipment and their details.
- **Bookings**: Users can view their own bookings and manage their gym session reservations.
- **Feedback**: Users can submit feedback about their gym experience, which will be reviewed by the administration.
- **Instructors**: Users can view information about gym instructors, including their schedule and specialization.
- **Equipment Management**: Users can view details about gym equipment and their availability.

### Admin Side
- **Bookings**: Admins have access to view all gym bookings made by users and manage them as needed.
- **Feedback**: Admins can view and manage all feedback submitted by users, responding to or taking action on feedback as necessary.
- **Instructors**: Admins can add, delete, and edit information about gym instructors, ensuring accurate and up-to-date records.
- **Equipment Management**: Admins can add, delete, and edit information about gym equipment, maintaining an updated inventory.
- **Generate Reports**: Admins can generate reports on gym usage, bookings, feedback trends, and other relevant metrics.
- **Manage Users**: Admins have the ability to manage user accounts, including creating, updating, or deactivating accounts as needed.
- **View Schedule**: Admins can view the schedule of gym instructors, helping to coordinate gym activities and appointments.


## Technologies Used

- **Frontend**: HTML, CSS, JavaScript (including libraries like jQuery)
- **Backend**: PHP (with MySQL database)
- **External Libraries**: Bootstrap, Font Awesome
- **Development Tools**: Visual Studio Code, Git

## Installation

1. Clone the repository to your local machine:
   ```
   git clone https://github.com/your-username/ashesi-gym-booking.git
   ```
2. Set up a local development environment with PHP and MySQL.
3. Import the provided SQL database dump (`database.sql`) into your MySQL server.
4. Configure the database connection settings in `settings/connection.php`.
5. Launch the application by opening `index.php` in your web browser.

## Usage

- **User Registration/Login**: Users can register for a new account or log in with their existing credentials.
- **Booking Gym Sessions**: Users can browse available gym sessions and make bookings according to their preferences.
- **Providing Feedback**: Users can submit feedback about their gym experience to help improve the service.
- **Viewing Instructor Schedule**: Users can check the schedule of gym instructors to plan their workout sessions accordingly.

For administrators:
- **Managing Bookings**: Admins can view, modify, or cancel gym session bookings made by users.
- **Monitoring Feedback**: Admins can review and respond to user feedback, taking appropriate actions as needed.
- **Managing Instructors**: Admins can add new instructors, edit existing records, or remove instructors from the system.
- **Managing Equipment**: Admins have control over gym equipment, including adding new items, updating details, or removing outdated equipment.
- **Generating Reports**: Admins can generate various reports to analyze gym usage, booking trends, feedback insights, and more.
- **Managing Users**: Admins have the authority to manage user accounts, including creating, updating, or deactivating accounts as necessary.


## Contributing

Contributions are welcome! If you'd like to contribute to the development of this application, please follow these steps:

1. Fork the repository.
2. Create a new branch (`git checkout -b feature/new-feature`).
3. Make your changes and commit them (`git commit -am 'Add new feature'`).
4. Push to the branch (`git push origin feature/new-feature`).
5. Create a new pull request.


---

Feel free to customize this README with additional details specific to your project, such as deployment instructions, troubleshooting tips, or additional features. Good luck with your project!
