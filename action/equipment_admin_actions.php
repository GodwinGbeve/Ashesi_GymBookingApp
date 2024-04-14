<?php
// Include database connection
include_once('../settings/connection.php');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize inputs
    $equipmentName = mysqli_real_escape_string($con, $_POST['equipment_name']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $quantity = mysqli_real_escape_string($con, $_POST['quantity']);
    
    // Check if image file is selected
    if(isset($_FILES['add-equipment-image']) && !empty($_FILES['add-equipment-image']['name'])){
        $image = $_FILES['add-equipment-image']['name'];
        $tempName = $_FILES['add-equipment-image']['tmp_name'];
        $imageType = $_FILES['add-equipment-image']['type'];
        $imageSize = $_FILES['add-equipment-image']['size'];
        
        // Check file type
        $validExtensions = array("image/jpeg", "image/jpg", "image/png");
        if(in_array($imageType, $validExtensions)){
            // Upload image to server
            $uploadPath = "../img/" . $image;
            move_uploaded_file($tempName, $uploadPath);
            
            // Insert equipment data into database
            $sql = "INSERT INTO Equipment (equipment_name, description, quantity, image) 
                    VALUES ('$equipmentName', '$description', '$quantity', '$image')";
            
            if(mysqli_query($con, $sql)){
                echo "Equipment added successfully!";
            } else {
                echo "Error: " . $sql . ":-" . mysqli_error($con);
            }
        } else {
            echo "Invalid file format! Please upload an image file.";
        }
    } else {
        echo "Please select an image file.";
    }

    // Close the database connection
    mysqli_close($con);
}
?>