<?php
// Include the database configuration
require_once '../config/db.php'; 

// Ensure database connection exists
if (!isset($db)) {
    die('Database connection not found. Check db.php.');
}

// Fetch complaints from the database
$query = "SELECT c.id, c.complaint_date, c.status, c.title, c.complaint_type, c.body, 
                 s.name AS student_name 
          FROM complaints c
          JOIN students s ON c.student_id = s.id
          ORDER BY c.complaint_date DESC";

$stmt = $db->prepare($query);
$stmt->execute();
$complaints = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaint List</title>
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
    </style>
</head>
<body>

    <h2 style="text-align: center;">Complaints List</h2>

    <table>
        <thead>
            <tr>
                <th>Complaint Date</th>
                <th>Student</th>
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
                        <td><?= htmlspecialchars($complaint['student_name']); ?></td>
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
                    <td colspan="6">No complaints found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</body>
</html>
