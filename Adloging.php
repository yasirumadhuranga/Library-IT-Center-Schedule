<?php
session_start();
//session_start();
$_SESSION['admin_logged_in'] = true;
header("Location: update_itcenter.php");


// Database connection
$connection = mysqli_connect("localhost", "root", "", "itcenter_db");

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Sanitize inputs
$username = mysqli_real_escape_string($connection, $_POST['username']);
$password = mysqli_real_escape_string($connection, $_POST['password']);

// Query to check admin credentials
$sql = "SELECT * FROM admins WHERE username='$username' AND password='$password'";
$result = mysqli_query($connection, $sql);

if (mysqli_num_rows($result) == 1) {
    // Successful login
    header("Location: adminupdate.php");
    exit();
} else {
    // Failed login
    echo "<script>alert('Incorrect admin username or password!'); window.location.href='admin_login.html';</script>";
}

mysqli_close($connection);
?>
