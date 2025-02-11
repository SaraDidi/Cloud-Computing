
<?php include '../includes/header.php'; ?>
<?php
// Start session
session_start();

// Ensure student is logged in
if (!isset($_SESSION['student_id'])) {
    die("You must be logged in to view complaints.");
}

$student_id = $_SESSION['student_id'];

// Include database configuration
require_once '../config/db.php';

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
    <link rel="stylesheet" href="../assets/css/styles.css">
    <title>My Complaints</title>
</head>
<body>
<div style="display: flex; justify-content: space-between; align-items: center; margin: 20px;">
    <h2>My Complaints</h2>
    <!-- Add Complaint Button -->
    <button class="btn-add" onclick="openModal()">Add New Complaint</button>
</div>

<!-- Modal for Adding Complaints -->
<div id="complaintModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2>Submit a Complaint</h2>
        <form id="complaintForm">
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" placeholder="Enter a short title" required>

            <label for="complaint_type">Complaint Type:</label>
            <select name="complaint_type" id="complaint_type" required>
                <option value="" disabled selected>Select Complaint Type</option>
                <option value="Maintenance">Maintenance</option>
                <option value="Noise">Noise</option>
                <option value="Cleanliness">Cleanliness</option>
                <option value="Roommate Issues">Roommate Issues</option>
                <option value="Other">Other</option>
            </select>

            <label for="body">Details:</label>
            <textarea name="body" id="body" rows="4" placeholder="Describe your complaint in detail..." required></textarea>
            <div class="modal-footer" style="text-align: center;">
                <button type="button" class="submit-btn" style="font-size: 1.2em; padding: 10px 20px;" onclick="submitComplaint()">Submit</button>
            </div>
        </form>
    </div>
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

    <script>
    function openModal() {
        document.getElementById("complaintModal").style.display = "flex";
    }

    function closeModal() {
        document.getElementById("complaintModal").style.display = "none";
    }

    // Ensure the modal is closed on page load
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("complaintModal").style.display = "none";
    });
</script>


</body>
</html>
<?php include('../includes/footer.php'); ?>