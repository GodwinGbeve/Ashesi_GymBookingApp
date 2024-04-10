<?php
// Include the connection file
include '../settings/connection.php';
require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../vendor/phpmailer/phpmailer/src/SMTP.php';
require '../vendor/phpmailer/phpmailer/src/Exception.php';



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require_once '../vendor/autoload.php';

// // Configuration settings for PHPMailer
// $phpmailer = new PHPMailer();
// $phpmailer->isSMTP();
// $phpmailer->Host = 'live.smtp.mailtrap.io';
// $phpmailer->SMTPAuth = true;
// $phpmailer->Username = 'api';
// $phpmailer->Password = '247edfdeea701f8bb0ce377d66c44d57'; 
// $phpmailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  
// $phpmailer->Port = 587;
//         // SMTP password
// // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption; PHPMailer::ENCRYPTION_SMTPS also accepted
// // $mail->Port = 587;                 // TCP port to connect to

// // Compose and send email
// $phpmailer->setFrom('demomailtrap.com', 'Your Name'); // Sender's email address and name
// $phpmailer->addAddress('ycliffofficial@gmail.com', 'Recipient Name'); // Recipient's email address and name
// $phpmailer->Subject = 'Subject of the Email'; // Email subject
// $phpmailer->isHTML(TRUE);
// $phpmailer->Body = '<html>Hi there, we are happy to <br>confirm your booking.</br> Please check the document in the attachment.</html>';
// // $phpmailer->AltBody = 'Hi there, we are happy to confirm your booking. Please check the document in the attachment.';
// $phpmailer->SMTPDebug = SMTP::DEBUG_CONNECTION;

// $phpmailer->SMTPOptions = array(
//     'ssl' => array(
//         'verify_peer' => false,
//         'verify_peer_name' => false,
//         'allow_self_signed' => true
//     )
// );

// if(!$phpmailer->send()){
//     echo 'Message could not be sent.';
//     echo 'Mailer Error: ' . $phpmailer->ErrorInfo;
//     $phpmailer->SMTPDebug = SMTP::DEBUG_CONNECTION;

// } else {
//     echo 'Message has been sent';
// }
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data and assign each to a variable
    $notification_message = $_POST['not_message'];

    // Write the insert query using the variables
    $insert_query = "INSERT INTO not_table (not_message) 
                    VALUES ('$notification_message')";

    // Execute the query using the connection
    $result = mysqli_query($con, $insert_query);

    // Check if execution worked
    if ($result) {
        // Get the email addresses of users from the database
        $email_query = "SELECT email FROM users";
        $email_result = mysqli_query($con, $email_query);

        // Check if there are any users
        if (mysqli_num_rows($email_result) > 0) {
            // Loop through each user and send an email notification
            while ($row = mysqli_fetch_assoc($email_result)) {
                $to = $row['email'];
                $subject = 'New Notification';
                $message = 'A new notification has been posted: ' . $notification_message;
                $headers = 'From: ycliffofficial@gmail.com'; // Change this to your email address
                // Send email
                mail($to, $subject, $message, $headers);
            }
        }

        // Redirect to notification page if execution is successful
        echo $notification_message;
        // header('Location: ../admin/notification_admin.php');
        exit();
    } else {
        // Take appropriate action if execution fails (display error on notification page)
        // $_SESSION['error'] = "Error: " . mysqli_error($con);
        // header('Location: ../admin/notification_admin.php');
        echo "Not";
        exit();
    }
} else {
    // If the form is not submitted, redirect to the notification page
    // header('Location: ../admin/notification_admin.php');
    echo "error";
    exit();
}
?>