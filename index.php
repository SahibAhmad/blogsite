<?php

// Include the functions file
require_once 'common.php';

// Get the current user's ID
$user_id = $_SESSION['user_id'];

// Get the list of posts from the database
$sql = "SELECT * FROM posts WHERE user_id = ? ORDER BY created_at DESC";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html>

<head>
    <title>List of Posts</title>
    <link rel="stylesheet" href="style/index.css">
</head>

<body>
    <!-- List of posts -->


    <div class="container">
        <ul>
            <?php foreach ($posts as $post) : ?>
                <li class="post">

                    <div class="post-content">
                        <h2><?= $post['title'] ?></h2>
                        <p><?= $post['content'] ?></p>
                        <p><a href="view-post.php?id=<?= $post['id'] ?>">View post</a></p>
                        <?php if (isLoggedIn()) : ?>
                            <p class="edit"><a href="edit-post.php?id=<?= $post['id'] ?>">Edit post</a></p>
                            <p class="delete"><a href="delete-post.php?id=<?= $post['id'] ?>">Delete post</a></p>
                        <?php endif ?>
                    </div>
                </li>
            <?php endforeach ?>
        </ul>
    </div>
    <?php if (isLoggedIn()) : ?>
        <div class="create-post"><a href="post.php">Create new post</a></div>
    <?php endif ?>

</body>

</html>