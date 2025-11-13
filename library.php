<?php
// Connect to database
$connection = mysqli_connect("localhost", "root", "", "itcenter_db");
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

$today = date('l');
$query = "SELECT * FROM library_schedule WHERE day_of_week = '$today'";
$result = mysqli_query($connection, $query);
$data = mysqli_fetch_assoc($result);
$status = $data['status'];

// Feedback form handler (Anonymous)
$feedbackMsg = "";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['feedback'])) {
    $message = htmlspecialchars($_POST['message']);

    $to = "admin@example.com"; // 🔁 REPLACE with your admin email
    $subject = "Anonymous Feedback - IT Center";
    $body = "New anonymous feedback received:\n\n" . $message;
    $headers = "From: no-reply@vavuniyauni.ac.lk";

    /*
    if (mail($to, $subject, $body, $headers)) {
        $feedbackMsg = "<p style='color:lightgreen;'>Thank you! Your anonymous feedback has been sent.</p>";
    } else {
        $feedbackMsg = "<p style='color:red;'>Failed to send feedback. Please try again later.</p>";
    }
    */
}

// Registration form handler
$registerMsg = "";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    $name = htmlspecialchars($_POST['reg_name']);
    $reg_no = htmlspecialchars($_POST['reg_no']);
    $faculty = htmlspecialchars($_POST['faculty']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);

    $to = "admin@example.com"; // 🔁 REPLACE with your admin email
    $subject = "New IT Center Registration";
    $body = "New IT Center Registration Received:\n\n"
          . "Name: $name\n"
          . "Registration No: $reg_no\n"
          . "Faculty: $faculty\n"
          . "Email: $email\n"
          . "Phone: $phone";
    $headers = "From: no-reply@vavuniyauni.ac.lk";

    /*
    if (mail($to, $subject, $body, $headers)) {
        $registerMsg = "<p style='color:lightgreen;'>Thank you! Your registration has been submitted.</p>";
    } else {
        $registerMsg = "<p style='color:red;'>Failed to send registration. Please try again later.</p>";
    }
    */
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Library Schedule - University of Vavuniya</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 50px;
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0,0,0,0.5)), url('Library1.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #fff;
        }

        h1, h2 {
            margin: 10px 0;
            text-shadow: 1px 1px 4px rgba(0,0,0,0.7);
        }

        .status {
            font-size: 24px;
            margin: 20px 0;
            padding: 12px 24px;
            border-radius: 10px;
            display: inline-block;
            font-weight: bold;
            box-shadow: 0 4px 10px rgba(0,0,0,0.3);
        }

        .Open {
            background-color: rgba(0, 128, 0, 0.85);
        }

        .Closed {
            background-color: rgba(255, 0, 0, 0.85);
        }

        .time {
            font-size: 20px;
            margin: 10px 0;
            background-color: rgba(255,255,255,0.1);
            padding: 10px;
            border-radius: 8px;
        }

        .back {
            margin-top: 30px;
            display: inline-block;
            padding: 10px 25px;
            background-color: #333;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .back:hover {
            background-color: #555;
        }

        img {
            width: 60px;
            height: 57px;
            filter: drop-shadow(0 0 4px #000);
        }

        .download-section {
            margin: 30px auto;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            padding: 25px;
            width: 60%;
            box-shadow: 0 4px 12px rgba(0,0,0,0.3);
        }

        .download-section p {
            font-size: 18px;
        }

        form textarea, 
        form input[type="text"], 
        form input[type="email"], 
        form input[type="tel"] {
            width: 80%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 8px;
            font-size: 16px;
        }

        form input[type="submit"], form button {
            background-color: #4CAF50;
            color: white;
            font-size: 16px;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 10px;
        }

        form input[type="submit"]:hover, form button:hover {
            background-color: #388E3C;
        }

        form button {
            background-color: #2196F3;
            margin-left: 10px;
        }

        form button:hover {
            background-color: #1E88E5;
        }
    </style>
</head>
<body>

    <img src="logo.png" alt="logo">
    <h1>University of Vavuniya - Library Schedule</h1>
    <h2><?php echo date("l, F j, Y"); ?></h2>

    <div class="status <?php echo $status; ?>">
    Library is <?php echo strtoupper($status); ?> Today
</div>

<?php if (strtolower($status) === 'open'): ?>
    <div class="time">Opening Time Today: <?php echo date("h:i A", strtotime($data['opening_time'])); ?></div>
    <div class="time">Closing Time Today: <?php echo date("h:i A", strtotime($data['closing_time'])); ?></div>
<?php endif; ?>

    <!-- Feedback Section -->
    <div class="download-section">
        <h2>---------- Anonymous Feedback Form ----------</h2>
        <p>If you have any issues or suggestions regarding the library, please leave your feedback anonymously:</p>

        <?php echo $feedbackMsg; ?>

        <form class="feedback-form" method="POST" action="">
            <textarea name="message" placeholder="Type your anonymous feedback here..." required></textarea><br>
            <input type="submit" name="feedback" value="Submit Feedback">
        </form>
    </div>

    <!-- Registration Section -->
    <div class="download-section">
        <h2>---------- Library Registration Form ----------</h2>
        <p>If you'd like to register for library services, please complete the form below:</p>
        
        <?php echo $registerMsg; ?>

        <form method="POST" action="" id="registration-form">
            <input type="text" name="reg_name" placeholder="Full Name" required><br>
            <input type="text" name="reg_no" placeholder="Registration Number" required><br>
            <input type="text" name="faculty" placeholder="Faculty" required><br>
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="tel" name="phone" placeholder="Phone Number" required><br>

            <input type="submit" name="register" value="Submit Registration">
            <button type="button" onclick="downloadPDF()">Download as PDF</button>
        </form>
    </div>

    <a href="index.php" class="back">Back to Dashboard</a>

    <!-- PDF Generator -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script>
        async function downloadPDF() {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();

            const name = document.querySelector('input[name="reg_name"]').value;
            const regNo = document.querySelector('input[name="reg_no"]').value;
            const faculty = document.querySelector('input[name="faculty"]').value;
            const email = document.querySelector('input[name="email"]').value;
            const phone = document.querySelector('input[name="phone"]').value;

            let content = `Library Registration Form\n\n`;
            content += `Name: ${name}\n`;
            content += `Registration No: ${regNo}\n`;
            content += `Faculty: ${faculty}\n`;
            content += `Email: ${email}\n`;
            content += `Phone: ${phone}\n`;

            doc.setFont("Helvetica");
            doc.setFontSize(14);
            doc.text(content, 20, 30);
            doc.save("Library_Registration.pdf");
        }
    </script>

</body>
</html>

<?php mysqli_close($connection); ?>
