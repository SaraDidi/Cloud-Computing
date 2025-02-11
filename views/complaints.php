
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
    <title>My Complaints</title>
    <style>
        table { width: 80%; margin: 20px auto; border-collapse: collapse; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: center; }
        th { background-color: #f4f4f4; }
        .pending { color: orange; font-weight: bold; }
        .resolved { color: green; font-weight: bold; }
        .rejected { color: red; font-weight: bold; }
        .btn-container { text-align: center; margin: 20px; }
        .btn-add { padding: 10px 15px; font-size: 16px; background-color: #007bff; color: white; border: none; cursor: pointer; border-radius: 5px; }
        .btn-add:hover { background-color: #0056b3; }
        .modal { display: none; position: fixed; z-index: 1; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); }
        .modal-content { background-color: white; margin: 15% auto; padding: 20px; border: 1px solid #ccc; width: 40%; text-align: left; border-radius: 8px; }
        .close { float: right; font-size: 28px; font-weight: bold; cursor: pointer; }
        .close:hover { color: red; }
        input, select, textarea { width: 90%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 5px; }
        button { padding: 10px 15px; font-size: 16px; background-color: #28a745; color: white; border: none; cursor: pointer; border-radius: 5px; }
        button:hover { background-color: #218838; }
    </style>
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
            <h3>Submit a Complaint</h3>
            <form id="complaintForm">
                <label for="title">Title:</label>
                <input type="text" name="title" id="title" required>

                <label for="complaint_type">Complaint Type:</label>
                <select name="complaint_type" id="complaint_type" required>
                    <option value="Maintenance">Maintenance</option>
                    <option value="Noise">Noise</option>
                    <option value="Cleanliness">Cleanliness</option>
                    <option value="Roommate Issues">Roommate Issues</option>
                    <option value="Other">Other</option>
                </select>

                <label for="body">Details:</label>
                <textarea name="body" id="body" rows="4" required></textarea>

                <button type="button" onclick="submitComplaint()">Submit Complaint</button>
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
            document.getElementById("complaintModal").style.display = "block";
        }

        function closeModal() {
            document.getElementById("complaintModal").style.display = "none";
        }

        function submitComplaint() {
            let formData = new FormData(document.getElementById("complaintForm"));
            formData.append("add_complaint", true);

            fetch("add_complaint_logic.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                if (data.status === "success") {
                    closeModal();
                    window.location.reload();
                }
            })
            .catch(error => console.error("Error:", error));
        }
    </script>

</body>
</html>
<?php include('../includes/footer.php'); ?>