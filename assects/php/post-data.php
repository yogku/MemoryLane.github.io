<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "memorylanedb";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    exit
    
}

$result = $conn->query("SELECT * FROM posts ORDER BY id DESC");

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='postdata'>";
        echo "<br>";
        echo "  <img id='post-user-icon' src='assects/images/profile.png'>";
        echo "  <b id='uname'>{$row['username']}</b><br>";
        echo "  <div class='inpostdata' style='margin-left: 90px;'>";
    
        echo "    <p><b class='title'>{$row['title']}</b></p>";
        echo "    <p class='content'>{$row['content']}</p>";

        if (!empty($row['image_path'])) {
            echo "    <div class='image-container'>";
            echo "      <img class='post-image' src='assects/php/{$row['image_path']}' alt='Post Image'>";
            echo "    </div>";
        }
    
        echo "<form action='post-detail.html' method='get'>";
        echo "  <input type='hidden' name='post_id' value='{$row['id']}'>";
        echo "  <input type='submit' id='view-comment-button' value='Comments'>";
        echo "</form>";
        
        
        
    
        echo "  </div>";
    
        echo "<br><br><hr>";
        echo "</div>";
    }
} else {
    echo "<p>No posts found.</p>";
}

$conn->close();
?>
