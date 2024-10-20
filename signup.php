<?php
// Database connection
$host = 'localhost';
$dbname = 'fitdairy';
$dbuser = 'root';
$dbpass = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $dbuser, $dbpass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password
    $phone = $_POST['phone'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];

    try {
        // Insert user into the database
        $stmt = $conn->prepare("INSERT INTO users (username, email, password, phone, age, gender) 
                                VALUES (:username, :email, :password, :phone, :age, :gender)");
        $stmt->execute([
            ':username' => $username,
            ':email' => $email,
            ':password' => $password,
            ':phone' => $phone,
            ':age' => $age,
            ':gender' => $gender
        ]);

        // Redirect to login page after successful signup
        header("Location: login.html");
        exit();
    } catch (Exception $e) {
        echo "<script>alert('Signup failed. Try again.'); window.history.back();</script>";
    }
}
?>
