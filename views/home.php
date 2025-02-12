
<?php include '../includes/header.php'; ?>
<h1>Welcome to University Housing</h1>
<p>Manage your housing and complaints efficiently.</p>

<?php
// Include the database configuration
require_once '../config/db.php'; 

// Ensure database connection exists
if (!isset($db)) {
    die('Connexion à la base de données non trouvée. Vérifiez db.php.');
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
    <title>Liste des chambres</title>
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
        img { width: 100px; height: 100px; border-radius: 5px; object-fit: cover; }
    </style>
</head>
<body>
<h2 style="text-align: left; margin-left: 10%; padding-top: 20px;">Disponibilité des chambres</h2>

<table>
    <thead>
        <tr> 
            <th>Bloc</th>
            <th>Étage</th>
            <th>Numéro de chambre</th>
            <th>Photo de la chambre</th>
            <th>Disponibilité</th>
            <th>Inscription</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($rooms)): ?>
            <?php foreach ($rooms as $room): ?>
                <tr>
                    <td><?= htmlspecialchars($room['block_number']); ?></td>
                    <td><?= htmlspecialchars($room['floor_number']); ?></td>
                    <td><?= htmlspecialchars($room['room_number']); ?></td>
                    <td>
                            <?php if (!empty($room['room_photo'])): ?>
                                <img src="<?= htmlspecialchars($room['room_photo']); ?>" alt="Photo de la chambre">
                            <?php else: ?>
                                <span>Aucune image</span>
                            <?php endif; ?>
                        </td>
                    <td class="<?= $room['availability'] ? 'available' : 'unavailable'; ?>">
                        <?= $room['availability'] ? 'Disponible' : 'Occupé'; ?>
                    </td>
                    <td>
                        <?php if ($room['availability']): ?>
                            <form method="post">
                                <input type="hidden" name="room_id" value="<?= htmlspecialchars($room['id']); ?>">
                                <button type="submit">S'inscrire</button>
                            </form>
                        <?php else: ?>
                            <span>Impossible de s'inscrire</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6">Aucune chambre trouvée.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
</html>
<?php include('../includes/footer.php'); ?>