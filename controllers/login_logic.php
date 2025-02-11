<?php
// Start a session
session_start();

// Include the database configuration
require_once '../config/db.php'; 

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize input
    $matricul = htmlspecialchars(trim($_POST['matricul']));
    $password = htmlspecialchars(trim($_POST['password']));

    // Check if both fields are filled
    if (empty($matricul) || empty($password)) {
        die('Matricul and password are required.');
    }

    // Ensure $db (Database Connection) is correctly loaded
    if (!isset($db)) {
        die('Database connection not found. Check db.php.');
    }

    // Prepare the SQL statement
    $query = "SELECT * FROM students WHERE matricul = :matricul";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':matricul', $matricul);
    $stmt->execute();

    // Fetch user data
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verify password
    if ($user && password_verify($password, $user['password'])) {
        // Store student ID in session
        $_SESSION['student_id'] = $user['id'];
        $_SESSION['student_name'] = $user['name']; // Optional: Store name for display

        echo "Login successful!";
        
        // Redirect to home or dashboard
        header("Location: ../views/home.php");
        exit;
    } else {
        echo "Invalid matricul or password.";
    }
} else {
    // Redirect if accessed directly
    header("Location: ../views/login.php");
    exit;
}
?>
