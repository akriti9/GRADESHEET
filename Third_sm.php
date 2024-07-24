<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Marksheet</title>
    <style>
        table {
            width: 100%;
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
include 'db_config.php';

$roll_no = '0206CS211001'; // Replace with dynamic data as needed
$roll_no = '0206CS211002';
$roll_no = '0206CS211003';
$roll_no = '0206CS211004';
$roll_no = '0206CS211005';

$sql = "SELECT * FROM student_report WHERE Roll_no='$roll_no'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch the student data
    $row = $result->fetch_assoc();
    $student_name = $row['Userame'];
    
    echo "<h2>Student Name: $student_name</h2>";
    echo "<h3>Roll No: $roll_no</h3>";

    echo "<table>
            <thead>
                <tr>
                    <th rowspan='2'>Subject</th>
                    <th colspan='2'>Marks</th>
                    <th rowspan='2'>Grade</th>
                </tr>
                <tr>
                    <th>Theory</th>
                    <th>Practical</th>
                </tr>
            </thead>
            <tbody>";

    // Subjects and their respective columns in the database
    $subjects = [
        'Theory Of Computation' => ['CN_THEORY', 'CN_PRACTICAL'],
        'Database Management Systems' => ['ML', 'ML_PRACTICALS'],
        'Cybersecurity' => ['DA', 'DATA_ANALYSIS_PRACTICALS'],
        'Internet And web Technology' => ['CD', 'COMPILER_DESIGN'],
        'Linux' => ['LINUX_THEORY', 'LINUX_PRACTICAL'] // Add other subjects as needed
    ];

    foreach ($subjects as $subject => $marks_columns) {
        $theory_marks = $row[$marks_columns[0]];
        $practical_marks = $row[$marks_columns[1]];
        $grade = ""; // Calculate grade if needed

        echo "<tr>
                <td>$subject</td>
                <td>$theory_marks</td>
                <td>$practical_marks</td>
                <td>$grade</td>
              </tr>";
    }

    echo "</tbody></table>";

    // Assuming SGPA and CGPA columns exist in your table
    $sgpa = $row['SGPA'];
    $cgpa = $row['CGPA'];

    echo "<table>
            <tr>
                <th>SGPA</th>
                <th>CGPA</th>
            </tr>
            <tr>
                <td>$sgpa</td>
                <td>$cgpa</td>
            </tr>
          </table>";

} else {
    echo "No results found for Roll No: $roll_no";
}

$conn->close();
?>

</body>
</html>
