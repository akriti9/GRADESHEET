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

// Query to fetch data
$sql = "SELECT student_report.Roll_no, student_report.Username, student_report.CN_PRACTICAL, student_report.CN_THEORY  
        FROM student_report
        LEFT JOIN pass_student ON pass_student.loginid = student_report.Roll_no";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Computer Networks Report</title>
    <style>
        body {
            background-image: url('t9.jpg'); /* Replace 't9.jpg' with your image file */
            background-size: cover; /* Cover the entire background */
            background-position: center; /* Center the background image */
            background-repeat: no-repeat; /* Do not repeat the background image */
            height: 100vh; /* Ensure the background covers the entire viewport height */
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
        .report-table {
            width: 80%;
            margin-top: 30px;
            border-collapse: collapse;
        }
        .report-table th, .report-table td {
            padding: 10px;
            border: 1px solid #ddd;
        }
        .report-table th {
            background-color: #007bff;
            color: white;
        }
        .report-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .report-table tr:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Computer Networks Report</h2>
        <table class="report-table">
            <tr>
                <th>Roll No</th>
                <th>Username</th>
                <th>CN Practical</th>
                <th>CN Theory</th>
            </tr>
            
            <?php
            if ($result) {
                // Check if there are results
                if ($result->num_rows > 0) {
                    // Output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row["Roll_no"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["Username"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["CN_PRACTICAL"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["CN_THEORY"]) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No data found</td></tr>";
                }
            } else {
                echo "<tr><td colspan='4'>Error: " . htmlspecialchars($conn->error) . "</td></tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>

<?php
// Close connection
$conn->close();
?>
