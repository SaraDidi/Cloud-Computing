
<?php include '../includes/header.php'; ?>
<h1>Welcome to University Housing</h1>
<p>Manage your housing and complaints efficiently.</p>

<?php
// Include the database configuration
require_once '../config/db.php'; 

// Ensure database connection exists
if (!isset($db)) {
    die('Database connection not found. Check db.php.');
}

// Fetch rooms from the database
$query = "SELECT id, room_number, floor_number, block_number, availability
          FROM room ORDER BY floor_number, room_number";

$stmt = $db->prepare($query);
$stmt->execute();
$rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room List</title>
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
        .available {
            color: green;
            font-weight: bold;
        }
        .unavailable {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
<h2 style="text-align: right; margin-right: 10%;">Room Availability</h2>

    <table>
        <thead>
            <tr> 
                <th>Block</th>
                <th>Floor</th>
                <th>Room Number</th>
                <th>Availability</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($rooms)): ?>
                <?php foreach ($rooms as $room): ?>
                    <tr>
                         <td><?= htmlspecialchars($room['block_number']); ?></td>
                         <td><?= htmlspecialchars($room['floor_number']); ?></td>
                         <td><?= htmlspecialchars($room['room_number']); ?></td>
                
                        <td class="<?= $room['availability'] ? 'available' : 'unavailable'; ?>">
                            <?= $room['availability'] ? 'Available' : 'Occupied'; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">No rooms found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</body>
</html>
<?php include('../includes/footer.php'); ?>