<?php
$conn = new mysqli("localhost", "root", "", "itcenter_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $old_username = $_POST['old_username'];
    $old_password = $_POST['old_password'];
    $new_username = $_POST['new_username'];
    $new_password = $_POST['new_password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username=? AND password=?");
    $stmt->bind_param("ss", $old_username, $old_password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $update = $conn->prepare("UPDATE users SET username=?, password=? WHERE username=?");
        $update->bind_param("sss", $new_username, $new_password, $old_username);
        $update->execute();
        $message = "<p class='success'> Credentials updated successfully. <a href='user_login.html'>Login here</a></p>";
    } else {
        $message = "<p class='error'> Old credentials are incorrect.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Change Credentials</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, #5f5f5fff, #525252ff);
            font-family: 'Poppins', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .card {
            background: #fff;
            padding: 80px 50px;
            border-radius: 15px;
            box-shadow: 0 12px 25px rgba(0,0,0,0.2);
            width: 400px;
            text-align: center;
        }

        h2 {
            margin-bottom: 25px;
            color: #333;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px 15px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: #667eea;
            outline: none;
        }

        input[type="submit"] {
            background-color: #667eea;
            color: white;
            border: none;
            padding: 12px 20px;
            font-size: 16px;
            border-radius: 8px;
            margin-top: 15px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #5a67d8;
        }

        .success, .error {
            margin-top: 15px;
            padding: 10px;
            border-radius: 8px;
            font-size: 15px;
        }

        .success {
            background-color: #d4edda;
            color: #155724;
        }

        .error {
            background-color: #f8d7da;
            color: #721c24;
        }

        a {
            text-decoration: none;
            color: #667eea;
            font-weight: bold;
        }
        .logout{
            position:absolute;
            margin-top:460px;
        }
        .logout a{
            text-align:center;
            font-size:20px;
        }
    </style>
</head>
<body>
    <div class="card">
        <h2>Change Credentials</h2>
        <?= $message ?>
        <form method="POST">
            <input type="text" name="old_username" placeholder="Old Username" required>
            <input type="password" name="old_password" placeholder="Old Password" required>
            <input type="text" name="new_username" placeholder="New Username" required>
            <input type="password" name="new_password" placeholder="New Password" required>
            <input type="submit" value="Update">
        </form>
    </div>
    <div class="logout">
        <a href="user_login.html">Logout</a>
    </div>
</body>
</html>
