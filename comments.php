<?php

// Include the functions file
require_once 'common.php';

// Get the post ID from the URL
if (isset($_GET['id'])) {
    $post_id = $_GET['id'];
} else {
    header('Location: index.php');
    exit;
}

// Handle form submission
if (isset($_POST['author']) && isset($_POST['content'])) {
    $author = $_POST['author'];
    $content = $_POST['content'];

    if (addComment($post_id, $author, $content)) {
        // Comment added successfully
        header('Location: index.php');
        exit;
    } else {
        // Comment addition failed
        $error = 'An error occurred while adding the comment';
    }
}

?>

<!-- Add comment form -->
<form method="post">
    <label for="author">Name:</label>
    <input type="text" name="author" id="author">
    <br>
    <label for="content">Comment:</label>
    <textarea name="content" id="content"></textarea>
    <br>
    <input type="submit" value="Add comment">
</form>

<?php if (isset($error)): ?>
<p><?= $error ?></p>
<?php endif ?>
