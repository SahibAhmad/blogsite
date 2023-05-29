<?php

// Include the functions file
require_once 'common.php';


// Check if the user is logged in
if (!isLoggedIn()) {
    header('Location: login.php');
    exit;
}

// Handle form submission
if (isset($_POST['title']) && isset($_POST['content'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];

    if (createPost($title, $content)) {
        // Post created successfully
        header('Location: index.php');
        exit;
    } else {
        // Post creation failed
        $error = 'An error occurred while creating the post';
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Post</title>
    <link rel="stylesheet" href="style/post.css">
</head>
<body>
    <!-- Create post form -->
    <form method="post">
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" required>
        <br>
        <label for="content">Content:</label>
        <textarea name="content" id="content" rows="10" cols="20" required></textarea>
        <br>
        <input type="submit" value="Create post">
    </form>

    <?php if (isset($error)): ?>
    <p class="error"><?= $error ?></p>
    <?php endif ?>
</body>
</html>