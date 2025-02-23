

<?php include '../includes/header.php'; ?>
<?php
// Start session
session_start();

// Include database configuration
require_once '../config/db.php';

// Ensure student is logged in
if (!isset($_SESSION['student_id'])) {
    die("Vous devez être connecté pour voir votre profil.");
}

$student_id = $_SESSION['student_id'];

// Fetch student information
$query = "SELECT name, matricul, email, created_at FROM students WHERE id = :student_id";
$stmt = $db->prepare($query);
$stmt->bindParam(':student_id', $student_id);
$stmt->execute();
$student = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$student) {
    die("Étudiant non trouvé.");
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
    <title>Profil</title>
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

    <h2>Profil de l'étudiant</h2>

    <div class="profile-container" style="text-align: left;">
        <p><strong>Nom :</strong> <?= htmlspecialchars($student['name']); ?></p>
        <p><strong>Matricul :</strong> <?= htmlspecialchars($student['matricul']); ?></p>
        <p><strong>E-mail :</strong> <?= htmlspecialchars($student['email']); ?></p>
        <p><strong>Compte créé :</strong> <?= htmlspecialchars($student['created_at']); ?></p>
    </div>  
    
    
    
    
    <h2 style="padding-top: 20px; text-align: left;">Historique d'enregistrement des chambres</h2>
    <table style="margin-left: auto; margin-right: auto;">
        <thead>
            <tr>
                <th>Numéro de chambre</th>
                <th>Étage</th>
                <th>Bloc</th>
                <th>Heure d'inscription</th>
                <th>Heure d'expiration</th>
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
                    <td colspan="5">Aucune inscription de chambre trouvée.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</body>
</html>

<?php include('../includes/footer.php'); ?>
