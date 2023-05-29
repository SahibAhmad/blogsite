<?php

// Include the functions file
require_once 'common.php';

// Handle form submission
if (isset($_POST['username']) && isset($_POST['password'])) {
 $username = $_POST['username'];
 $password = $_POST['password'];

 // Validate the entered username and password
 // ...

 // Hash the password before storing it in the database
 $hashed_password = password_hash($password, PASSWORD_DEFAULT);

 // Store the new user in the database
 $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
 $stmt = mysqli_prepare($conn, $sql);
 mysqli_stmt_bind_param($stmt, "ss", $username, $hashed_password);
 mysqli_stmt_execute($stmt);

 // Registration successful
 header('Location: index.php');
 exit;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
    <link rel="stylesheet" href="style/register.css">
</head>
<body>
    <div class="container">
        <h1>User Registration</h1>

        <!-- Registration form -->
        <form method="post">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username">
            <br>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password">
            <br>
            <input type="submit" value="Register">
        </form>
    </div>
</body>
</html>