<?php
// Include database connection
include_once('../settings/connection.php');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize inputs
    $instructorID = mysqli_real_escape_string($con, $_POST['instructor-id']);
    $instructorName = mysqli_real_escape_string($con, $_POST['instructor-name']);
    $timeAvailable = mysqli_real_escape_string($con, $_POST['time-available']);
    
    echo $instructorID, $instructorName, $timeAvailable;
    
    // Check if image file is selected
    if(isset($_FILES['edit-instructor-image']) && !empty($_FILES['edit-instructor-image']['name'])){
        $image = $_FILES['edit-instructor-image']['name'];
        $tempName = $_FILES['edit-instructor-image']['tmp_name'];
        $imageType = $_FILES['edit-instructor-image']['type'];
        $imageSize = $_FILES['edit-instructor-image']['size'];
        
        // Check file type
        $validExtensions = array("image/jpeg", "image/jpg", "image/png");
        if(in_array($imageType, $validExtensions)){
            // Upload image to server
            // $query = mysqli_query ($con, "Insert into GymInstructors(image) values('$image') ");
            $uploadPath = "../img/" . $image;
            move_uploaded_file($tempName, $uploadPath);
            
            // Update instructor data in database
            $sql = "UPDATE GymInstructors 
                    SET instructorName = '$instructorName', time_available = '$timeAvailable', image = '$image'
                    WHERE instructorID = '$instructorID'";
            
            if(mysqli_query($con, $sql)){
                echo "Instructor updated successfully!";
                header('Location: ../admin/instructors_admin.php');
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($con);
            }
        } else {
            echo "Invalid file format! Please upload an image file.";
        }
    } else {
        // If no new image is selected, update instructor data without changing the image
        $sql = "UPDATE GymInstructors 
                SET instructorName = '$instructorName', time_available = '$timeAvailable'
                WHERE instructorID = '$instructorID'";
        
        if(mysqli_query($con, $sql)){
            echo "Instructor updated successfullyjgxrkdjrdjt!";
            header('Location: ../admin/instructors_admin.php');
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }
    }
}
?>
