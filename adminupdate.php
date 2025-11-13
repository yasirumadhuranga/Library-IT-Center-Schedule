<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.html");
    exit;
}

$host = "localhost";
$user = "root";
$password = "";
$dbname = "itcenter_db";

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$success = false; // Flag for success message

// Handle updates
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // IT Center
    if (isset($_POST['it_id'])) {
        foreach ($_POST['it_id'] as $index => $id) {
            $opening = $_POST['it_opening_time'][$index];
            $closing = $_POST['it_closing_time'][$index];
            $status = $_POST['it_status'][$index];

            if ($id && $opening && $closing && $status) {
                $stmt = $conn->prepare("UPDATE itcenter_schedule SET opening_time=?, closing_time=?, status=? WHERE id=?");
                $stmt->bind_param("sssi", $opening, $closing, $status, $id);
                $stmt->execute();
            }
        }
    }

    // Library
    if (isset($_POST['lib_id'])) {
        foreach ($_POST['lib_id'] as $index => $id) {
            $opening = $_POST['lib_opening_time'][$index];
            $closing = $_POST['lib_closing_time'][$index];
            $status = $_POST['lib_status'][$index];

            if ($id && $opening && $closing && $status) {
                $stmt = $conn->prepare("UPDATE library_schedule SET opening_time=?, closing_time=?, status=? WHERE id=?");
                $stmt->bind_param("sssi", $opening, $closing, $status, $id);
                $stmt->execute();
            }
        }
    }

    $success = true; // Trigger success message
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin Panel - Schedule Manager</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #d1e7dd, #fff3cd);
            margin: 0;
            padding: 40px;
        }

        .container {
            max-width: 1100px;
            margin: auto;
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.1);
            padding: 40px;
        }

        .logo {
            text-align: center;
        }

        .logo img {
            width: 70px;
        }

        h1 {
            text-align: center;
            margin-bottom: 10px;
            color: #333;
        }

        h2 {
            text-align: center;
            margin-top: 50px;
            margin-bottom: 15px;
            color: #444;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 0 auto 30px auto;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 14px;
            text-align: center;
            font-size: 15px;
        }

        th {
            background-color: #f0f0f0;
        }

        input[type="text"], select {
            width: 90%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        .update {
            text-align: center;
            margin-top: 20px;
        }

        .update input[type="submit"] {
            background-color: #00695c;
            color: white;
            font-weight: 600;
            padding: 12px 30px;
            border: none;
            border-radius: 30px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .update input[type="submit"]:hover {
            background-color: #004d40;
        }

        .logout {
            text-align: center;
            margin-top: 20px;
        }

        .logout a {
            text-decoration: none;
            padding: 10px 20px;
            background-color: #f44336;
            color: white;
            border-radius: 25px;
            transition: background-color 0.3s ease;
        }

        .logout a:hover {
            background-color: #c62828;
        }

        /* Success message */
        .success-msg {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            padding: 15px 20px;
            margin: 20px auto;
            width: 80%;
            text-align: center;
            border-radius: 8px;
            font-size: 18px;
            font-weight: 500;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            animation: fadein 0.7s ease-in-out;
        }

        @keyframes fadein {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="logo">
        <img src="Logo.png" alt="University Logo">
    </div>

    <h1>Admin Panel - Weekly Schedule Update</h1>

    <?php if ($success): ?>
        <div class="success-msg">
             Schedules updated successfully!
        </div>
    <?php endif; ?>

    <form method="POST">

        <!-- IT Center -->
        <h2>Update IT Center Schedule</h2>
        <table>
            <tr>
                <th>Day</th>
                <th>Opening Time</th>
                <th>Closing Time</th>
                <th>Status</th>
            </tr>
            <?php
            $result = $conn->query("SELECT * FROM itcenter_schedule ORDER BY id ASC");
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$row['day_of_week']}<input type='hidden' name='it_id[]' value='{$row['id']}'></td>";
                echo "<td><input type='text' name='it_opening_time[]' value='{$row['opening_time']}'></td>";
                echo "<td><input type='text' name='it_closing_time[]' value='{$row['closing_time']}'></td>";
                echo "<td>
                        <select name='it_status[]'>
                            <option value='Open' " . ($row['status'] === 'Open' ? 'selected' : '') . ">Open</option>
                            <option value='Closed' " . ($row['status'] === 'Closed' ? 'selected' : '') . ">Closed</option>
                        </select>
                      </td>";
                echo "</tr>";
            }
            ?>
        </table>

        <!-- Library -->
        <h2>Update Library Schedule</h2>
        <table>
            <tr>
                <th>Day</th>
                <th>Opening Time</th>
                <th>Closing Time</th>
                <th>Status</th>
            </tr>
            <?php
            $result = $conn->query("SELECT * FROM library_schedule ORDER BY id ASC");
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$row['day_of_week']}<input type='hidden' name='lib_id[]' value='{$row['id']}'></td>";
                echo "<td><input type='text' name='lib_opening_time[]' value='{$row['opening_time']}'></td>";
                echo "<td><input type='text' name='lib_closing_time[]' value='{$row['closing_time']}'></td>";
                echo "<td>
                        <select name='lib_status[]'>
                            <option value='Open' " . ($row['status'] === 'Open' ? 'selected' : '') . ">Open</option>
                            <option value='Closed' " . ($row['status'] === 'Closed' ? 'selected' : '') . ">Closed</option>
                        </select>
                      </td>";
                echo "</tr>";
            }
            ?>
        </table>

        <div class="update">
            <input type="submit" value="Update Schedules">
        </div>
    </form>

    <div class="logout">
        <a href="admin_login.html">Logout</a>
    </div>
</div>

</body>
</html>

<?php $conn->close(); ?>
