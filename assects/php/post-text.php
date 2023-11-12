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
        echo "<script>alert('Post successful')</script>";
    } else {
        echo "<script>alert('Post unsuccessful')</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
