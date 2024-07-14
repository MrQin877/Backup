<?php

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../Login System/LogInUser.php");
    exit();
}

$username = $_SESSION['username'];

if (isset($_FILES["profile_image"]) && $_FILES["profile_image"]["error"] == 0) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["profile_image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["profile_image"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["profile_image"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if directory is writable
    if (!is_writable($target_dir)) {
        echo "The uploads directory is not writable.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file)) {
            // File uploaded successfully, now update database
            $image_path = $target_file;

            // Database connection
            $servername = "localhost";
            $db_username = "root";
            $password = "";
            $dbname = "sunnysmile";

            $conn = new mysqli($servername, $db_username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Update profile image path in the database
            $sql = "UPDATE users SET profile_image=? WHERE username=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $image_path, $username);

            if ($stmt->execute()) {
                echo "Profile image uploaded successfully. <a href='UserProfile.php'>Go back to UserProfile.php page</a>";
            } else {
                echo "Error updating profile image: " . $stmt->error;
            }

            $stmt->close();
            $conn->close();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
} else {
    echo "No file uploaded or error in file upload.";
}

?>
