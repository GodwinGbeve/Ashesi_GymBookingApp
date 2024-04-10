<?php
// Include database connection
include_once('../settings/connection.php');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize inputs
    $instructorName = mysqli_real_escape_string($con, $_POST['add-instructor-name']);
    $timeAvailable = mysqli_real_escape_string($con, $_POST['add-time-available']);
    
    // Check if image file is selected
    if(isset($_FILES['add-instructor-image']) && !empty($_FILES['add-instructor-image']['name'])){
        $image = $_FILES['add-instructor-image']['name'];
        $tempName = $_FILES['add-instructor-image']['tmp_name'];
        $imageType = $_FILES['add-instructor-image']['type'];
        $imageSize = $_FILES['add-instructor-image']['size'];
        
        // Check file type
        $validExtensions = array("image/jpeg", "image/jpg", "image/png");
        if(in_array($imageType, $validExtensions)){
            // Upload image to server
            // $query = mysqli_query ($con, "Insert into GymInstructors(image) values('$image') ");
            $uploadPath = "../img/" . $image;
            move_uploaded_file($tempName, $uploadPath);
            
            // Insert instructor data into database
            $sql = "INSERT INTO GymInstructors (instructorName, time_available, image) 
                    VALUES ('$instructorName', '$timeAvailable', '$image')";
            
            if(mysqli_query($con, $sql)){
                echo "Instructor added successfully!";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($con);
            }
        } else {
            echo "Invalid file format! Please upload an image file.";
        }
    } else {
        echo "Please select an image file.";
    }
}
?>
