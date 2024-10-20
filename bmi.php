<?php
$host = 'localhost';
$db = 'fitdairy';
$user = 'root';
$pass = ''; // Your MySQL password

// Database connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle BMI submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $height = $_POST['height'];
    $weight = $_POST['weight'];
    $bmi = $_POST['bmi'];

    $stmt = $conn->prepare("INSERT INTO bmi_records (name, height, weight, bmi) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sddd", $name, $height, $weight, $bmi);

    if ($stmt->execute()) {
        echo "BMI record added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    exit();
}

// Fetch all BMI records
$result = $conn->query("SELECT * FROM bmi_records ORDER BY created_at DESC");
$records = [];
while ($row = $result->fetch_assoc()) {
    $records[] = $row;
}
$conn->close();
header('Content-Type: application/json');
echo json_encode($records);
?>
