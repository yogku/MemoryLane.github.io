<?php
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "your_database";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT Images.image_path, Comments.comment FROM Images INNER JOIN Comments ON Images.image_id = Comments.image_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    echo '<div class="image-comment-container">';
    echo '<img src="' . $row['image_path'] . '" alt="Image">';
    echo '<p>' . $row['comment'] . '</p>';
    echo '</div>';
  }
} else {
  echo "0 results";
}

$conn->close();
?>
