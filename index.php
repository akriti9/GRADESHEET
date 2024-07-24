<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        body {
            background-image: url('bg.jpg'); /* Replace 'background.jpg' with your image file */
            background-size: cover; /* Cover the entire background */
            background-position: center; /* Center the background image */
            background-repeat: no-repeat; /* Do not repeat the background image */
            height: 100vh; /* Ensure the background covers the entire viewport height */
            margin: 0; /* Remove default margin */
            padding: 0; /* Remove default padding */
            font-family: Arial, sans-serif; /* Optional: Define a font family */
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        .icon {
            text-align: center;
            margin: 0 20px;
        }

        .icon img {
            width: 150px; /* Adjust image width as needed */
            height: auto; /* Maintain aspect ratio */
        }

        .icon p {
            margin: 10px 0 0;
            font-size: 18px;
            font-weight: bold;
        }

        .icon a {
            text-decoration: none;
            color: #333; /* Optional: Define link color */
        }
    </style>
</head>

<body>
    
    <div class="container">
        <div class="icon">
            <a href="teacher_login.php">
                <img src="teaching.png" alt="Teacher Icon">
                <p>Teacher</p>
            </a>
        </div>
        <div class="icon">
            <a href="student_login.php">
                <img src="student.png" alt="Student Icon">
                <p>Student</p>
            </a>
        </div>
    </div>

</body>
</html>
