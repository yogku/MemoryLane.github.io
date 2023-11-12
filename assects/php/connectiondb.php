<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "memorylanedb";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  } else {
    echo
   
  "Connected successfully";
  }

// Receive and sanitize data from the form

$title = mysqli_real_escape_string($conn, $_POST['title']);
$content = mysqli_real_escape_string($conn, $_POST['content']);
$username = mysqli_real_escape_string($conn, $_POST['username']);

// Prepare and execute SQL query to insert data into the database

$sql = "INSERT INTO posts (title, content, username) VALUES ('$title', '$content', '$username')";

if ($conn->query($sql) === TRUE) {
  echo
 
"Post submitted successfully";
} else {
  echo
 
"Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
