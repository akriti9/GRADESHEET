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

// Check if Roll_no is provided in the URL
if (!isset($_GET['Roll_no'])) {
    die("Roll_no parameter not provided.");
}

$roll_no = $_GET['Roll_no'];

// Query to fetch current marks
$sql = "SELECT Roll_no, Username, ML_PRACTICALS, ML FROM student_report WHERE Roll_no = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $roll_no);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    // Student found, fetch data
    $row = $result->fetch_assoc();
    $roll_no = $row['Roll_no'];
    $username = $row['Username'];
    $ml_practicals = $row['ML_PRACTICALS'];
    $ml = $row['ML'];
} else {
    // No student found with given Roll_no
    die("Student not found.");
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Marks Form</title>
    <style>
        table {
            margin: 20px auto;
            border-collapse: collapse;
        }
        td, th {
            padding: 10px;
            border: 1px solid #ddd;
        }
        input[type="text"], input[type="number"] {
            width: 100%;
            box-sizing: border-box;
        }
        .submit-btn {
            text-align: center;
        }
    </style>
</head>
<body>
<form action="process_update.php" method="post">
    <input type="hidden" name="Roll_no" value="<?php echo htmlspecialchars($roll_no); ?>">
    
    <table>
        <tr>
            <th>Roll No</th>
            <td><?php echo htmlspecialchars($roll_no); ?></td>
        </tr>
        <tr>
            <th>Username</th>
            <td><?php echo htmlspecialchars($username); ?></td>
        </tr>
        <tr>
            <th>Updated ML Theory Marks</th>
            <td><input type="number" id="ML" name="ML" value="<?php echo htmlspecialchars($ml); ?>" required></td>
        </tr>
        <tr>
            <th>Updated ML Practical Marks</th>
            <td><input type="number" id="ML_PRACTICALS" name="ML_PRACTICALS" value="<?php echo htmlspecialchars($ml_practicals); ?>" required></td>
        </tr>
        <tr>
            <td colspan="2" class="submit-btn">
                <input type="submit" value="Update Marks">
            </td>
        </tr>
    </table>
</form>
</body>
</html>
