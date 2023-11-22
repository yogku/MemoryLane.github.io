<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "memorylanedb";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the 'post_id' and 'comment_content' parameters are set
    if (isset($_POST['post_id'], $_POST['comment_content'])) {
        $post_id = $_POST['post_id'];
        $new_comment_content = $_POST['comment_content'];
        $current_username = isset($_COOKIE['username']) ? htmlspecialchars($_COOKIE['username']) : '';

        // Validate and insert comment into comments table
        if (!empty($new_comment_content)) {
            $insert_comment_query = "INSERT INTO comments (post_id, username, content) VALUES ('$post_id', '$current_username', '$new_comment_content')";
            
            if ($conn->query($insert_comment_query)) {
                echo "Comment submitted successfully!";
            } else {
                echo "Error: " . $conn->error;
            }
        } else {
            echo "Comment content is empty.";
        }
    } else {
        echo "Invalid parameters in the request.";
    }
} else {
    // Display existing post data and comments
    if (isset($_GET['post_id'])) {
        $post_id = $_GET['post_id'];

        // Fetch and display post details
        $post_query = "SELECT * FROM posts WHERE id = $post_id";
        $post_result = $conn->query($post_query);

        if ($post_result->num_rows > 0) {
            $post_row = $post_result->fetch_assoc();

            echo "<div class='postdata'>";
            echo "<br>";
            echo "  <img id='post-user-icon' src='assects/images/profile.png'>";
            echo "  <b id='uname'>{$post_row['username']}</b><br>";
            echo "  <div class='inpostdata' style='margin-left: 90px;'>";
            echo "    <p><b class='title'>{$post_row['title']}</b></p>";
            echo "    <p class='content'>{$post_row['content']}</p>";

            if (!empty($post_row['image_path'])) {
                echo "    <div class='image-container'>";
                echo "      <img class='post-image' src='assects/php/{$post_row['image_path']}' alt='Post Image'>";
                echo "    </div>";
            }

            echo "  </div>";
            echo "<br><br><hr><br>";
            echo "</div>";

            // Display comment form
            echo "<form id='comment-form' method='post'>";
            echo "  <input type='hidden' name='post_id' value='$post_id'>";
            echo "<div id='comment-section'>";
            echo "  <textarea id='comment_content' name='comment_content' rows='4' cols='50' placeholder='Post your comment now~'></textarea>";
            echo "</div>";
            echo "  <input type='submit' id='view-comment-button' value='Submit Comment'>";
            
            
            echo "</form>";
        } else {
            echo "<p>No post found.</p>";
        }

        // Fetch and display comments
        $comments_query = "SELECT * FROM comments WHERE post_id = $post_id";
        $comments_result = $conn->query($comments_query);

        if ($comments_result->num_rows > 0) {
            while ($comment_row = $comments_result->fetch_assoc()) {
                echo "<div class='comment'>";
                echo "<br>";
                echo "  <img id='post-user-icon' src='assects/images/profile.png'>";
                echo "  <b id='uname'>{$comment_row['username']}</b><br>";
                echo "  <div class='inpostdata' style='margin-left: 90px;'>";
                echo "    <p class='content'>{$comment_row['content']}</p>";
                echo "  </div>";
                echo "<br><br><hr>";
                echo "</div>";
            }
        } else {
            echo "<p>No comments yet, Be The First To Comment.</p>";
        }
    } else {
        echo "Invalid post_id parameter.";
    }
}

$conn->close();
?>
