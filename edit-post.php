<?php

// Include the functions file
require_once 'common.php';


// Check if the user is logged in
if (!isLoggedIn()) {
    header('Location: login.php');
    exit;
}

// Get the post ID from the URL
if (isset($_GET['id'])) {
    $post_id = $_GET['id'];
} else {
    header('Location: index.php');
    exit;
}

// Handle form submission
if (isset($_POST['title']) && isset($_POST['content'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];

    if (editPost($post_id, $title, $content)) {
        // Post updated successfully
        header('Location: index.php');
        exit;
    } else {
        // Post update failed
        $error = 'An error occurred while updating the post';
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Post</title>
    <link rel="stylesheet" href="style/post.css">
</head>
<body>
    <!-- Create post form -->
    <form method="post">
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" required>
        <br>
        <label for="content">Content:</label>
        <textarea name="content" id="content" rows="10" cols="20" required ></textarea>
        <br>
        <input type="submit" value="Update post">
    </form>

    <?php if (isset($error)): ?>
    <p class="error"><?= $error ?></p>
    <?php endif ?>
</body>
</html>
