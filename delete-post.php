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
if (isset($_POST['confirm'])) {
    if (deletePost($post_id)) {
        // Post deleted successfully
        header('Location: index.php');
        exit;
    } else {
        // Post deletion failed
        $error = 'An error occurred while deleting the post';
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Delete Post</title>
    <link rel="stylesheet" href="style/delete-post.css">
</head>

<body>
    <div class="container">
        <h1>Delete Post</h1>

        <!-- Delete post form -->
        <form method="post">
            <p>Are you sure you want to delete this post?</p>
            <input type="submit" name="confirm" value="Yes, delete this post">
        </form>

        <?php if (isset($error)) : ?>
            <p class="error"><?= $error ?></p>
        <?php endif ?>
    </div>
</body>

</html>