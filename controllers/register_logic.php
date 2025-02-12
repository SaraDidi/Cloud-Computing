<?php
// Include the database configuration
require_once '../config/db.php';

// Function to sanitize input data
function sanitize_input($data) {
    return htmlspecialchars(trim($data));
}

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and validate input fields
    $name = sanitize_input($_POST['name']);
    $matricul = sanitize_input($_POST['matricul']);
    $email = sanitize_input($_POST['email']);
    $password = sanitize_input($_POST['password']);
    $confirm_password = sanitize_input($_POST['confirm_password']);

    // Check for required fields
    if (empty($name) || empty($matricul) || empty($password) || empty($confirm_password)) {
        die("Tous les champs marqués d'un * sont obligatoires.");
    }

    // Check password confirmation
    if ($password !== $confirm_password) {
        die('Les mots de passe ne correspondent pas.');
    }

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if the matricul already exists in the database
    $query = "SELECT * FROM students WHERE matricul = :matricul";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':matricul', $matricul);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        die('Le matricule est déjà enregistré.');
    }

    // Insert the user into the database
    $insert_query = "INSERT INTO students (name, matricul, email, password) VALUES (:name, :matricul, :email, :password)";
    $insert_stmt = $db->prepare($insert_query);
    $insert_stmt->bindParam(':name', $name);
    $insert_stmt->bindParam(':matricul', $matricul);
    $insert_stmt->bindParam(':email', $email);
    $insert_stmt->bindParam(':password', $hashed_password);

    if ($insert_stmt->execute()) {
        // Redirect to login page on success
        header("Location: ../index.php?registration=success");
        exit;
    } else {
        die("L'inscription a échoué. Veuillez réessayer.");
    }
} else {
    // Redirect to the registration page if accessed directly
    header("Location: ../views/register.php");
    exit;
}
