<?php
$pusername = $_POST['pusername']
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
  $stmt = "INSERT INTO text_posts(username, title, content) VALUES('$pusername',$title', '$content')";
  $stmt_run = mysqli_query($conn, $stmt);

  if (!$stmt_run) {
    echo "<script>alert('Post unsuccessful')</script>";
  } else {
    echo "<script>alert('Post successful')</script>";
  }
}
?>
