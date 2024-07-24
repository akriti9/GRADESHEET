<?php
session_start(); // Start session to access $_SESSION variables

// Check if teacher is logged in
if (!isset($_SESSION['username']) || !isset($_SESSION['teacher_name'])) {
    header("Location: teacher_login.php"); // Redirect to login page if not logged in
    exit();
}

$teacher_name = $_SESSION['teacher_name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome, <?php echo $teacher_name; ?>!</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-image: url('as.jpg'); /* Replace 'as.jpg' with your background image path */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-container {
            position: relative;
            width: 100%;
            max-width: 400px;
            background-color: rgba(255, 255, 255, 0.8); /* Optional: Adds a semi-transparent overlay */
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .welcome-message {
            margin-bottom: 20px;
            color: #333; /* Text color for the welcome message */
        }

        .subject-buttons {
            margin-top: 20px;
        }

        .subject-buttons button {
            display: block;
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            background-color: #008CBA;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .subject-buttons button:last-child {
            margin-bottom: 0;
        }

        .subject-buttons button:hover {
            background-color: #005f6b;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2 class="welcome-message">WELCOME, <?php echo $teacher_name; ?>!</h2>
        <div class="subject-buttons">
            <button>Subject 1</button>
            <button>Subject 2</button>
        </div>
    </div>
</body>
</html>
