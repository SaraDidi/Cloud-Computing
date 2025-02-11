<?php
// complaints_logic.php
require_once('../config/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $complaint_type = $_POST['complaint_type'];
    $description = $_POST['description'];
    $user_id = $_SESSION['user_id'];

    // Validate complaint form
    if (empty($complaint_type) || empty($description)) {
        echo "Please fill in all fields!";
    } else {
        // Insert complaint into the database
        $query = "INSERT INTO complaints (user_id, complaint_type, description, status) VALUES (?, ?, ?, 'Open')";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$user_id, $complaint_type, $description]);

        echo "Complaint submitted successfully! You will be notified about updates.";
    }
}
?>
