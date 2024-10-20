<?php
$host = 'localhost';
$db = 'fitdairy';
$user = 'root';
$pass = '';  // Use your MySQL password

// Connect to the database
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission for adding a workout
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $workoutType = $_POST['workoutType'];
    $duration = $_POST['duration'];
    $calories = $_POST['calories'];
    $workoutDate = $_POST['date'];

    $stmt = $conn->prepare("INSERT INTO workouts (workout_type, duration, calories, workout_date) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("siis", $workoutType, $duration, $calories, $workoutDate);

    if ($stmt->execute()) {
        echo "Workout added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Retrieve all workouts from the database
$result = $conn->query("SELECT * FROM workouts ORDER BY workout_date DESC");

$workouts = [];
while ($row = $result->fetch_assoc()) {
    $workouts[] = $row;
}

// Close connection
$conn->close();

header('Content-Type: application/json');
echo json_encode($workouts);
?>
