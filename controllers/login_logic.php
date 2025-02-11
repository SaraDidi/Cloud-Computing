<?php
// login_logic.php
session_start();
require_once('../config/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $matricul = $_POST['matricul'];
    $password = $_POST['password'];

    // Validate inputs
    if (empty($matricul) || empty($password)) {
        echo "Please fill in both fields!";
    } else {
        // Check if the user exists
        $query = "SELECT * FROM students WHERE matricul = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$matricul]);
        $student = $stmt->fetch();

        if ($student && password_verify($password, $student['password'])) {
            $_SESSION['student_id'] = $student['id'];
            $_SESSION['name'] = $student['name'];
            header('Location: home.php');
        } else {
            echo "Invalid login credentials!";
        }
    }
}
?>
