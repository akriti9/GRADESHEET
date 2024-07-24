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
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $roll_no = $_POST['Roll_no']; // Ensure this is correct
    $ML = $_POST['ML'];
    $ML_PRACTICALS = $_POST['ML_PRACTICALS'];

    // Prepare and bind


    $stmt = $conn->prepare("UPDATE student_report SET ML = $ML, ML_PRACTICALS = $ML_PRACTICALS WHERE Roll_no = '$roll_no'");
   // $stmt->bind_param( $ML, $ML_PRACTICALS, $roll_no);

    // Execute the statement
    if ($stmt->execute()) {
        echo "<p>Records updated successfully for Roll No: " . htmlspecialchars($roll_no) . "</p>";
    } else {
        echo "<p>Error updating record: " . htmlspecialchars($stmt->error) . "</p>";
    }

    // Close the statement
    $stmt->close();
}
