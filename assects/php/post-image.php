<?php
$pusername = isset($_COOKIE['username']) ? htmlspecialchars($_COOKIE['username']) : '';
$title = $_POST['title'];

$targetDir = "upload/"; 
$targetFile = $targetDir . basename($_FILES["image"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

// Check if image file is an actual image or fake image
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

// Check file size
if ($_FILES["image"]["size"] > 5000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow certain file formats
$allowedFileTypes = ["jpg", "jpeg", "png", "gif"];
if (!in_array($imageFileType, $allowedFileTypes)) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is OK, try to upload file
} else {
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
        echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file. Check permissions and destination directory.";
        // Additional debugging information
        echo "Error: " . $_FILES["image"]["error"];
    }
}

// Store image path in the database
$imagePath = $targetFile; // This is the relative path

$servername = "localhost";
$username = "root";
$password = "";
$database = "memorylanedb";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    $stmt = $conn->prepare("INSERT INTO posts(username, title, image_path) VALUES(?, ?, ?)");
    $stmt->bind_param("sss", $pusername, $title, $imagePath);

    if ($stmt->execute()) {
        header("Location: /gitMemoryLane/index.html");
        exit();
    } else {
        echo "<script>alert('Post unsuccessful'); window.location.href='/gitMemoryLane/post-image.html';</script>";
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>
