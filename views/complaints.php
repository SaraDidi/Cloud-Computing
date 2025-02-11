<?php
// Start session
session_start();

// Include the database configuration
require_once '../config/db.php'; 

// Check if the student is logged in
if (!isset($_SESSION['student_id'])) {
    die("You must be logged in to view complaints.");
}

// Get the logged-in student ID
$student_id = $_SESSION['student_id'];

// Fetch complaints for this student
$query = "SELECT c.id, c.complaint_date, c.status, c.title, c.complaint_type, c.body 
          FROM complaints c
          WHERE c.student_id = :student_id
          ORDER BY c.complaint_date DESC";

$stmt = $db->prepare($query);
$stmt->bindParam(':student_id', $student_id);
$stmt->execute();
$complaints = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Complaints</title>
    <style>
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }
        th {
            background-color: #f4f4f4;
        }
        .pending {
            color: orange;
            font-weight: bold;
        }
        .resolved {
            color: green;
            font-weight: bold;
        }
        .rejected {
            color: red;
            font-weight: bold;
        }
        .btn-container {
            text-align: center;
            margin: 20px;
        }
        .btn-add {
            padding: 10px 15px;
            font-size: 16px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        .btn-add:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <h2 style="text-align: center;">My Complaints</h2>

    <!-- Add Complaint Button -->
    <div class="btn-container">
        <a href="add_complaint.php">
            <button class="btn-add">Add New Complaint</button>
        </a>
    </div>

    <table>
        <thead>
            <tr>
                <th>Complaint Date</th>
                <th>Title</th>
                <th>Type</th>
                <th>Status</th>
                <th>Details</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($complaints)): ?>
                <?php foreach ($complaints as $complaint): ?>
                    <tr>
                        <td><?= htmlspecialchars($complaint['complaint_date']); ?></td>
                        <td><?= htmlspecialchars($complaint['title']); ?></td>
                        <td><?= htmlspecialchars($complaint['complaint_type']); ?></td>
                        <td class="<?= strtolower($complaint['status']); ?>">
                            <?= htmlspecialchars($complaint['status']); ?>
                        </td>
                        <td><?= htmlspecialchars($complaint['body']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">No complaints found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</body>
</html>
