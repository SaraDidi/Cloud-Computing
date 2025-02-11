<?php
// Start a session
session_start();

// Include the database configuration
require_once '../config/db.php'; 

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize input
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));

    // Check if both fields are filled
    if (empty($email) || empty($password)) {
        die('Email and password are required.');
    }

    // Ensure $db (Database Connection) is correctly loaded
    if (!isset($db)) {
        die('Database connection not found. Check db.php.');
    }

    // Prepare the SQL statement
    $query = "SELECT * FROM students WHERE email = :email";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':email', $email);
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
        header("Location: ../complaints.php");
        exit;
    } else {
        echo "Invalid email or password.";
    }
} else {
    // Redirect if accessed directly
    header("Location: ../views/login.php");
    exit;
}
?>
