<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "memorylanedb";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the "posts" table
$result = $conn->query("SELECT * FROM posts");

// Check if there are any rows in the result set
if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        // Display data on the webpage (you can customize this part)
        echo "<p>{$row['title']} - {$row['content']}</p>";
    }
} else {
    echo "<p>No posts found.</p>";
}

$conn->close();
?>
