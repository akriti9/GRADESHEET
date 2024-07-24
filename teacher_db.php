<?php
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
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and bind 
    $stmt = $conn->prepare("SELECT * FROM teacher_db WHERE Username = ? AND Password = ?");
    $stmt->bind_param("ss", $username, $password);

    // Execute the query
    $stmt->execute();
    $stmt->store_result();

    // Check if user exists
    if ($stmt->num_rows > 0) {
        //echo "Login successful";
        // Redirect or start session, etc.
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
            background-image: url('t12.jpg'); /* Replace 'as.jpg' with your image file */
            background-size: cover; /* Cover the entire background */
            background-position: center; /* Center the background image */
            background-repeat: no-repeat; /* Do not repeat the background image */
            height: 90vh; /* Ensure the background covers the entire viewport height */
            margin: 0; /* Remove default margin */
            padding: 0; /* Remove default padding */
            font-family: Arial, sans-serif;
            background-color: #f0f0f0; /* Light gray background */
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            text-align: center;
        }
        .welcome-message {
            margin-bottom: 20px;
            color: #333; /* Text color for the welcome message */
        }
        .buttons-wrapper {
            margin-top: 20px;
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
        <h2 class="welcome-message">Welcome, <?php echo htmlspecialchars($username); ?>!</h2>
        <div class="buttons-wrapper">
            <a href="CN.php">Computer Networks</a>
            <a href="ML.php">Machine Learning</a>
        </div>
    </div>
</body>
</html>