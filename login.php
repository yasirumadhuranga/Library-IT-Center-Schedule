<?php
session_start();

// Default credentials
$valid_username = "user";
$valid_password = "user123";

// Get POST data
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

// Validate credentials
if ($username === $valid_username && $password === $valid_password) {
    $_SESSION['user_logged_in'] = true;
    $_SESSION['username'] = $username;
    header("Location: index.php"); // Login success
    exit();
} else {
    // Login failed - redirect back with error
    header("Location: user_login.html?error=1");
    exit();
}
?>
