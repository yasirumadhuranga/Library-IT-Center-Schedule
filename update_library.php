<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.html");
    exit;
}

$host = "localhost";
$user = "root";
$password = ""; // update if you have a password
$dbname = "itcenter_db";

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle updates
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($_POST['id'] as $index => $id) {
        $opening = $_POST['opening_time'][$index];
        $closing = $_POST['closing_time'][$index];
        $status = $_POST['status'][$index];

        $stmt = $conn->prepare("UPDATE library_schedule SET opening_time=?, closing_time=?, status=? WHERE id=?");
        $stmt->bind_param("sssi", $opening, $closing, $status, $id);
        $stmt->execute();
    }
    echo "<script>alert('Schedule Updated Successfully!');</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update IT Center Schedule</title>
    <style>
        table, th, td {
            border: 1px solid black; border-collapse: collapse;
        }
        input[type='text'] {
            width: 100px;
        }
    </style>
</head>
<body>
<h2>Update Library Schedule</h2>
<form method="POST">
    <table>
        <tr>
            <th>Day</th>
            <th>Opening Time</th>
            <th>Closing Time</th>
            <th>Status</th>
        </tr>
        <?php
        $result = $conn->query("SELECT * FROM library_schedule");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['day_of_week']}<input type='hidden' name='id[]' value='{$row['id']}'></td>";
            echo "<td><input type='text' name='opening_time[]' value='{$row['opening_time']}'></td>";
            echo "<td><input type='text' name='closing_time[]' value='{$row['closing_time']}'></td>";
            echo "<td>
                    <select name='status[]'>
                        <option value='Open' " . ($row['status'] == 'Open' ? "selected" : "") . ">Open</option>
                        <option value='Closed' " . ($row['status'] == 'Closed' ? "selected" : "") . ">Closed</option>
                    </select>
                  </td>";
            echo "</tr>";
        }
        ?>
    </table>
    <br>
    <input type="submit" value="Update Schedule">
</form>
</body>
</html>
