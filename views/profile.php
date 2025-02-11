

<?php include '../includes/header.php'; ?>
<?php
// Start session
session_start();

// Include database configuration
require_once '../config/db.php';

// Ensure student is logged in
if (!isset($_SESSION['student_id'])) {
    die("You must be logged in to view your profile.");
}

$student_id = $_SESSION['student_id'];

// Fetch student information
$query = "SELECT name, matricul, email, created_at FROM students WHERE id = :student_id";
$stmt = $db->prepare($query);
$stmt->bindParam(':student_id', $student_id);
$stmt->execute();
$student = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$student) {
    die("Student not found.");
}

// Fetch room registration history
$query = "SELECT r.room_number, r.floor_number, r.block_number, rc.registration_time, rc.expiry_time 
          FROM registration_confirmation rc
          JOIN room r ON rc.room_id = r.id
          WHERE rc.student_id = :student_id
          ORDER BY rc.registration_time DESC";

$stmt = $db->prepare($query);
$stmt->bindParam(':student_id', $student_id);
$stmt->execute();
$room_history = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .profile-container {
            width: 50%;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            background: #f9f9f9;
            border-radius: 8px;
            text-align: left;
        }
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
    </style>
</head>
<body>

    <h2>Student Profile</h2>

    <div class="profile-container">
        <p><strong>Name:</strong> <?= htmlspecialchars($student['name']); ?></p>
        <p><strong>Matricul:</strong> <?= htmlspecialchars($student['matricul']); ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($student['email']); ?></p>
        <p><strong>Account Created:</strong> <?= htmlspecialchars($student['created_at']); ?></p>
    </div>

    <h2 style="padding-top: 20px;">Room Registration History</h2>  <table>
        <thead>
            <tr>
                <th>Room Number</th>
                <th>Floor</th>
                <th>Block</th>
                <th>Registration Time</th>
                <th>Expiry Time</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($room_history)): ?>
                <?php foreach ($room_history as $room): ?>
                    <tr>
                        <td><?= htmlspecialchars($room['room_number']); ?></td>
                        <td><?= htmlspecialchars($room['floor_number']); ?></td>
                        <td><?= htmlspecialchars($room['block_number']); ?></td>
                        <td><?= htmlspecialchars($room['registration_time']); ?></td>
                        <td><?= htmlspecialchars($room['expiry_time']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">No room registrations found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</body>
</html>

<?php include('../includes/footer.php'); ?>
