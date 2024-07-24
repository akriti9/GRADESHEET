<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Marksheet</title>
    <style>
        table {
            width: 70%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<?php
session_start();

// Check if user is not logged in, redirect to login page
if (!isset($_SESSION['username'])) {
    header("Location: student_login.php");
    exit;
}

// Database configuration file (adjust as per your setup)
include 'db_config.php';

// Fetch semester results for the logged-in student
$roll_no = $_SESSION['Roll_no'];

// Example query to fetch results for the sixth semester (adjust as per your database structure)
$sql = "SELECT * FROM student_report WHERE Roll_no = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $roll_no);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Display student name and roll number
    $student_name = $row['Username']; // Adjust column name as per your database
    echo "<h2>Welcome, $student_name!</h2>";
    echo "<h3>Your Roll No: $roll_no</h3>";

    // Initialize total variables
    $total_theory_marks = 0;
    $total_practical_marks = 0;

    echo "<table border='1'>
            <thead>
                <tr>
                    <th>Subject</th>
                    <th>Theory Marks</th>
                    <th>Practical Marks</th>
                    <th>Grade</th>
                </tr>
            </thead>
            <tbody>";

    // Subjects and their respective columns in the database
    $subjects = [
        ['name' => 'Computer Networks', 'theory' => 'CN_THEORY', 'practical' => 'CN_PRACTICAL'],
        ['name' => 'Machine Learning', 'theory' => 'ML', 'practical' => 'ML_PRACTICALS'],
        ['name' => 'Data Analysis', 'theory' => 'DA', 'practical' => 'DATA_ANALYSIS_PRACTICALS'],
        ['name' => 'Compiler Design', 'theory' => 'CD', 'practical' => 'COMPILER_DESIGN'],
    ];

    // Function to calculate grade based on marks
    function calculate_grade($marks) {
        if ($marks >= 90) {
            return 'A+';
        } elseif ($marks >= 80) {
            return 'A';
        } elseif ($marks >= 70) {
            return 'B+';
        } elseif ($marks >= 60) {
            return 'B';
        } elseif ($marks >= 50) {
            return 'C+';
        } elseif ($marks >= 40) {
            return 'C';
        } else {
            return 'FAIL';
        }
    }

    foreach ($subjects as $subject) {
        $subject_name = $subject['name'];
        $theory_column = $subject['theory'];
        $practical_column = $subject['practical'];

        if (isset($row[$theory_column], $row[$practical_column])) {
            $theory_marks = $row[$theory_column];
            $practical_marks = $row[$practical_column];

            // Calculate grade
            $theory_grade = calculate_grade($theory_marks);
            $practical_grade = calculate_grade($practical_marks);

            // Add to total marks
            $total_theory_marks += $theory_marks;
            $total_practical_marks += $practical_marks;

            echo "<tr>
                    <td>$subject_name</td>
                    <td>$theory_marks</td>
                    <td>$practical_marks</td>
                    <td>$theory_grade</td>
                  </tr>";
        } else {
            echo "<tr>
                    <td colspan='4'>No data available for $subject_name</td>
                  </tr>";
        }
    }

    echo "</tbody></table>";
    

    // Calculate SGPA and display
    if (isset($row['SGPA'])) {
        $sgpa = $row['SGPA'];
        echo "<h3>SGPA: $sgpa</h3>";
    } else {
        echo "<h3>SGPA not available</h3>";
    }

    // Calculate CGPA and display
    /*if (isset($row['CGPA'])) {
        $cgpa = $row['CGPA'];
        echo "<h3>CGPA: $cgpa</h3>";
    } else {
        echo "<h3>CGPA not available</h3>";
    }*/

} else {
    echo "No results found for Sixth Semester.";
}

$stmt->close();
$conn->close();
?>

</body>
</html>
