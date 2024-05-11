<?php
// Include database connection
include_once('../settings/connection.php');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize inputs
    $equipmentID = mysqli_real_escape_string($con, $_POST['equipmentID']);
    $equipmentName = mysqli_real_escape_string($con, $_POST['equipment-name']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $quantity = mysqli_real_escape_string($con, $_POST['quantity-available']);
    $youtubeLink = mysqli_real_escape_string($con, $_POST['youtube-link']); // Add YouTube link
    
    // Check if image file is selected
    if(isset($_FILES['edit-equipment-image']) && !empty($_FILES['edit-equipment-image']['name'])){
        $image = $_FILES['edit-equipment-image']['name'];
        $tempName = $_FILES['edit-equipment-image']['tmp_name'];
        $imageType = $_FILES['edit-equipment-image']['type'];
        $imageSize = $_FILES['edit-equipment-image']['size'];
        
        // Check file type
        $validExtensions = array("image/jpeg", "image/jpg", "image/png");
        if(in_array($imageType, $validExtensions)){
            // Upload image to server
            $uploadPath = "../img/" . $image;
            move_uploaded_file($tempName, $uploadPath);
            
            // Update equipment data in database including YouTube link
            $sql = "UPDATE Equipment 
                    SET equipment_name = '$equipmentName', description = '$description', quantity = '$quantity', image = '$image', youtube_link = '$youtubeLink'
                    WHERE equipmentID = '$equipmentID'";
            
            if(mysqli_query($con, $sql)){
                echo "Equipment updated successfully!";
                header('Location: ../admin/equipment_admin.php');
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($con);
            }
        } else {
            echo "Invalid file format! Please upload an image file.";
        }
    } else {
        // If no new image is selected, update equipment data without changing the image
        $sql = "UPDATE Equipment 
                SET equipment_name = '$equipmentName', description = '$description', quantity = '$quantity', youtube_link = '$youtubeLink'
                WHERE equipmentID = '$equipmentID'";
        
        if(mysqli_query($con, $sql)){
            echo "Equipment updated successfully!";
            header('Location: ../admin/equipment_admin.php');
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }
    }
}
?>
