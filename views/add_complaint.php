<?php
// Start session
session_start();

// Include database configuration
require_once '../config/db.php';

// Ensure the student is logged in
if (!isset($_SESSION['student_id'])) {
    die("You must be logged in to submit a complaint.");
}

$student_id = $_SESSION['student_id']; // Get logged-in student ID

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = htmlspecialchars(trim($_POST['title']));
    $complaint_type = htmlspecialchars(trim($_POST['complaint_type']));
    $body = htmlspecialchars(trim($_POST['body']));

    // Validate fields
    if (empty($title) || empty($complaint_type) || empty($body)) {
        die("All fields are required.");
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
        header("Location: complaints.php?message=Complaint+submitted+successfully");
        exit;
    } else {
        die("Failed to submit complaint.");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Complaint</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }
        form {
            width: 50%;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            background: #f9f9f9;
            border-radius: 8px;
        }
        input, select, textarea {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            padding: 10px 15px;
            font-size: 16px;
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

    <h2>Submit a Complaint</h2>

    <form method="POST">
        <label>Title:</label>
        <input type="text" name="title" required>

        <label>Complaint Type:</label>
        <select name="complaint_type" required>
            <option value="Academic">Academic</option>
            <option value="Administrative">Administrative</option>
            <option value="Facilities">Facilities</option>
            <option value="Other">Other</option>
        </select>

        <label>Details:</label>
        <textarea name="body" rows="4" required></textarea>

        <button type="submit">Submit Complaint</button>
    </form>

</body>
</html>
