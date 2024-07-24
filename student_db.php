

<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "school";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture form inputs
    $loginid = $_POST['username'];
    $password = $_POST['password'];
    
    // Prepare and bind 
    $stmt = $conn->prepare("SELECT passwords, st_name FROM pass_student WHERE loginid=?");

    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind parameters
    if (!$stmt->bind_param('s', $loginid)) {
        die("Bind param failed: " . $stmt->error);
    }

    // Execute the query
    if (!$stmt->execute()) {
        die("Execute failed: " . $stmt->error);
    }

    // Bind result variables
    if (!$stmt->bind_result($db_password, $name)) {
        die("Bind result failed: " . $stmt->error);
    }

    // Fetch the result
    $stmt->fetch();

    // Verify password
    if ($password == $db_password) {
        // Start session
        $_SESSION['username'] = $loginid;
        $_SESSION['name'] = $name;
        $_SESSION['Roll_no'] = $loginid;
    } else {
        echo "Invalid username or password";
    }

    $stmt->close();
}

$conn->close();
?>
  <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Dashboard</title>
    <style>
        body {
            background-image: url('st1.jpg'); /* Replace 'background.jpg' with your image file */
            background-size: cover; /* Cover the entire background */
            background-position: center; /* Center the background image */
            background-repeat: no-repeat; /* Do not repeat the background image */
            height: 100vh; /* Ensure the background covers the entire viewport height */
            margin: 0; /* Remove default margin */
            padding: 0; /* Remove default padding */
            font-family: Arial, sans-serif;
            background-color: #f0f0f0; /* Light gray background */
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Full viewport height */
        }
        .buttons-wrapper {
            text-align: center;
        }
        .buttons-wrapper a {
            text-decoration: none;
            color: #fff;
            padding: 15px 30px;
            background-color: #007bff;
            border-radius: 5px;
            display: inline-block;
            margin: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            transition: background-color 0.3s ease;
        }
        .buttons-wrapper a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="buttons-wrapper">
        
            
            <?php if(isset($_SESSION['username'])): ?>
                <p1>Login successful</p1>
                <p>Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?></p>
                <p>Your Roll Number is: <?php echo htmlspecialchars($_SESSION['Roll_no']); ?></p>
                
                <a href="First_sm.php">First Semester</a>
                <a href="Second_sm.php">Second Semester</a>
                <a href="Third_sm.php">Third Semester</a>
                <br>
                <a href="Fourth_sm.php">Fourth Semester</a>
                <a href="Fifth_sm.php">Fifth Semester</a>
                <a href="Sixth_sem.php">Sixth Semester</a>
                <br>
                <a href="c.php">Consolidated report</a>
            <?php else: ?>
                <p>Please <a href="login.php">login</a> to access this page.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
