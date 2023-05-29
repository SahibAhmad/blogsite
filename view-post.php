<?php

// Include the functions file
require_once 'common.php';

// Get the post ID from the URL
$post_id = isset($_GET['id']) ? $_GET['id'] : null;

// Get the post from the database
$sql = "SELECT * FROM posts WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $post_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$post = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html>
<head>
 <title><?= htmlspecialchars($post['title']) ?></title>
 <link rel="stylesheet" href="style/view-post.css">
</head>
<body>
 <div class="container">
 <div class="post">
 <h1><?= htmlspecialchars($post['title']) ?></h1>
 <p><?= nl2br(htmlspecialchars($post['content'])) ?></p>
 </div>
 </div>
</body>
</html>
