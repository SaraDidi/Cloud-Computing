<?php
// Start session
session_start();

// Include database configuration
require_once '../config/db.php';

// Ensure the student is logged in
if (!isset($_SESSION['student_id'])) {
    die(json_encode(["status" => "error", "message" => "Vous devez être connecté pour déposer une plainte."]));
}

$student_id = $_SESSION['student_id'];

// Handle complaint submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = htmlspecialchars(trim($_POST['title']));
    $complaint_type = htmlspecialchars(trim($_POST['complaint_type']));
    $body = htmlspecialchars(trim($_POST['body']));

    // Validate fields
    if (empty($title) || empty($complaint_type) || empty($body)) {
        die(json_encode(["status" => "error", "message" => "All fields are required."]));
    }

    // Insert into database
    $query = "INSERT INTO complaints (student_id, complaint_date, status, title, complaint_type, body) 
              VALUES (:student_id, NOW(), 'Pending', :title, :complaint_type, :body)";
    
    $stmt = $db->prepare($query);
    $stmt->bindParam(':student_id', $student_id);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':complaint_type', $complaint_type);
    $stmt->bindParam(':body', $body);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Réclamation soumise avec succès."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Échec de la soumission de la réclamation."]);
    }
}
?>
