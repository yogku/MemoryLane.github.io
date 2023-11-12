<?php
$pusername = isset($_COOKIE['username']) ? htmlspecialchars($_COOKIE['username']) : '';
$title = $_POST['title'];
$content = $_POST['content'];

$servername = "localhost";
$username = "root";
$password = "";
$database = "memorylanedb";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO posts(username, title, content) VALUES(?, ?, ?)");
    $stmt->bind_param("sss", $pusername, $title, $content);

    if ($stmt->execute()) {
        // Post successful, redirect to the home page
        header("Location: /gitMemoryLane/index.html");
        exit();
    } else {
        // Post unsuccessful, show an alert and then redirect to the post-image.html page
        echo "<script>alert('Post unsuccessful'); window.location.href='/gitMemoryLane/post-image.html';</script>";
        exit();
    }
    

    $stmt->close();
    $conn->close();
}
?>
