
<?php
session_start();
if (!isset($_SESSION['user_logged_in'])) {
    header("Location: user_login.html");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>User Choice</title>

  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Poppins', sans-serif;
      height: 100vh;
      overflow: hidden;
      position: relative;
      background: linear-gradient(to bottom right, #0f2027, #203a43, #2c5364);
      display: flex;
      justify-content: center;
      align-items: center;
      color: white;
    }

    
    
    .container {
      text-align: center;
      background-color: rgba(255, 255, 255, 0.1);
      padding: 40px 60px;
      border-radius: 20px;
      box-shadow: 0 12px 24px rgba(0, 0, 0, 0.3);
      backdrop-filter: blur(10px);
    }

    .container img {
      width: 70px;
      height: auto;
      margin-bottom: 20px;
    }

    .container h1 {
      font-size: 32px;
      margin-bottom: 10px;
    }

    .container p {
      font-size: 20px;
      margin-bottom: 30px;
    }

    .button-group {
      display: flex;
      justify-content: center;
      gap: 20px;
      margin-bottom: 30px;
      flex-wrap: wrap;
    }

    .button-group button {
      padding: 20px 40px;
      font-size: 18px;
      font-weight: 600;
      border: none;
      border-radius: 15px;
      background-color: #6ff56a;
      color: #000;
      cursor: pointer;
      transition: all 0.3s ease;
      min-width: 140px;
    }

    .button-group button:hover {
      background-color: #3ddf31;
      transform: translateY(-3px);
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .logout {
      display: inline-block;
      padding: 12px 25px;
      background-color: #ff4d4d;
      color: white;
      border-radius: 25px;
      text-decoration: none;
      font-weight: 600;
      transition: background-color 0.3s ease;
    }

    .logout:hover {
      background-color: #d73737;
    }
  </style>
</head>
<body>

  

  <div class="container">
    <img src="logo.png" alt="University Logo">
    <h1>Welcome, User!</h1>
    <p>Select your choice</p>

    <div class="button-group">
      <button onclick="window.location.href='itcenter.php'">IT Center</button>
      <button onclick="window.location.href='library.php'">Library</button>
    </div>

    <a class="logout" href="logout.php">Logout</a>
  </div>
</body>


 
</html>
