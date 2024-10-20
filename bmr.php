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

// Handle BMR submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $bmr = $_POST['bmr'];
    $daily_calories = $_POST['daily_calories'];

    $stmt = $conn->prepare("INSERT INTO bmr_records (name, bmr, daily_calories) VALUES (?, ?, ?)");
    $stmt->bind_param("sdd", $name, $bmr, $daily_calories);

    if ($stmt->execute()) {
        echo "BMR record added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
$conn->close();
?>
