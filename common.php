<?php

// Database connection details
$db_host = 'localhost';
$db_user = 'root';
$db_password = '';
$db_name = 'blogsite';

// Connect to the database using MySQLi procedural
$conn = mysqli_connect($db_host, $db_user, $db_password, $db_name);

// Check if the connection was successful
if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}

// Start a session to store user data
session_start();

// Function to handle user login
function login($username, $password) {
    global $conn;

    // Check if the username and password are correct
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {
        // Login successful
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        // $_SESSION['user_id'] = $user['id'];
        
        return true;
    } else {
        // Login failed
        
        return false;
    }
}

// Function to check if the user is logged in
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Function to create a new post
function createPost($title, $content) {
    global $conn;

    // Check if the user is logged in
    if (!isLoggedIn()) {
        return false;
    }

    // Insert the new post into the database
    $sql = "INSERT INTO posts (user_id, title, content) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "iss", $_SESSION['user_id'], $title, $content);
    mysqli_stmt_execute($stmt);

    return true;
}

// Function to edit an existing post
function editPost($post_id, $title, $content) {
    global $conn;

    // Check if the user is logged in
    if (!isLoggedIn()) {
        return false;
    }

    // Update the post in the database
    $sql = "UPDATE posts SET title = ?, content = ? WHERE id = ? AND user_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssii", $title, $content, $post_id, $_SESSION['user_id']);
    mysqli_stmt_execute($stmt);

    return true;
}

// Function to delete an existing post
function deletePost($post_id) {
    global $conn;

    // Check if the user is logged in
    if (!isLoggedIn()) {
        return false;
    }

    // Delete the post from the database
    $sql = "DELETE FROM posts WHERE id = ? AND user_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $post_id, $_SESSION['user_id']);
    mysqli_stmt_execute($stmt);

    return true;
}

// Function to add a comment to a post
function addComment($post_id, $author, $content) {
    global $conn;

    // Insert the new comment into the database
    $sql = "INSERT INTO comments (post_id, author, content) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "iss", $post_id, $author, $content);
    mysqli_stmt_execute($stmt);

    return true;
}
