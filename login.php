<?php

// Include the functions file
require_once 'common.php';

// Handle form submission
if (isset($_POST['username']) && isset($_POST['password'])) {
 $username = $_POST['username'];
 $password = $_POST['password'];

 if (login($username, $password)) {
 // Login successful
 header('Location: index.php');
 exit;
 } else {
 // Login failed
 $error = 'Invalid username or password';
 }
}

?>

<!DOCTYPE html>
<html>
<head>
 <title>Login</title>
 <link rel="stylesheet" href="style/login.css">
</head>
<body>
 <!-- Login form -->
 <div class="container">
 <form method="post">
 <label for="username">Username:</label>
 <input type="text" name="username" id="username" class="form-control">
 <br>
 <label for="password">Password:</label>
 <input type="password" name="password" id="password" class="form-control">
 <br>
 <input type="submit" value="Login" class="btn">
 </form>

 <!-- Link to registration page -->
 <p><a href="register.php">Register</a></p>

 <?php if (isset($error)): ?>
 <p class="error"><?= $error ?></p>
 <?php endif ?>
 </div>
</body>
</html>
