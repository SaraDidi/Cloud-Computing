<?php include '../includes/header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track Complaints</title>
    <style>
        .complaint-list {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 20px;
        }
        .complaint-item {
            flex: 1 1 calc(33.333% - 20px);
            border: 1px solid #ccc;
            padding: 10px;
            box-sizing: border-box;
            background-color: #f9f9f9;
            border-radius: 5px;
        }
        .complaint-item h3 {
            margin: 10px 0;
        }
        .add-complaint-button {
            display: flex;
            justify-content: flex-end;
            margin-top: 20px;
        }
        #complaintForm {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 20px;
            border: 1px solid black;
            border-radius: 5px;
        }
    </style>
  
</head>
<body>
    <h2>Track Complaints</h2>
  <script>
        function openComplaintForm() {
            document.getElementById('complaintForm').style.display = 'block';
        }

        function closeComplaintForm() {
            document.getElementById('complaintForm').style.display = 'none';
        }
    </script>
    <div class="add-complaint-button">
        <button onclick="openComplaintForm()">Add New Complaint</button>
    </div>

    <div class="complaint-list">
        <?php
        // Hardcoded examples of complaints
        $complaints = [
            [
                'title' => 'Air Conditioning Not Working',
                'complaint_type' => 'Maintenance',
                'status' => 'Pending',
                'body' => 'The air conditioning in my room has not been working for the last 3 days.',
                'created_at' => '2025-01-30',
            ],
            [
                'title' => 'Roommate Playing Loud Music',
                'complaint_type' => 'Roommate Issue',
                'status' => 'Resolved',
                'body' => 'My roommate often plays loud music at night, disrupting my sleep.',
                'created_at' => '2025-01-28',
            ],
            [
                'title' => 'Trash Not Collected',
                'complaint_type' => 'Cleanliness',
                'status' => 'In Progress',
                'body' => 'The trash in our corridor has not been collected for two weeks.',
                'created_at' => '2025-01-25',
            ],
        ];

        if (count($complaints) > 0) {
            foreach ($complaints as $complaint) {
                echo "<div class='complaint-item'>";
                echo "<h3>" . htmlspecialchars($complaint['title']) . "</h3>";
                echo "<p><strong>Type:</strong> " . htmlspecialchars($complaint['complaint_type']) . "</p>";
                echo "<p><strong>Status:</strong> " . htmlspecialchars($complaint['status']) . "</p>";
                echo "<p>" . htmlspecialchars($complaint['body']) . "</p>";
                echo "<p><strong>Submitted on:</strong> " . htmlspecialchars($complaint['created_at']) . "</p>";
                echo "</div>";
            }
        } else {
            echo "<p>No complaints found.</p>";
        }
        ?>
    </div>

    <div id="complaintForm" style="width: 50%;">
        <h2>Submit a Complaint</h2>
        <form method="POST" action="#" style="display: flex; flex-direction: column; max-width: 100%; gap: 10px;">
            <label for="complaint_type">Complaint Type:</label>
            <select id="complaint_type" name="complaint_type" required style="padding: 5px; border-radius: 5px; border: 1px solid #ccc;">
                <option value="Maintenance">Maintenance</option>
                <option value="Cleanliness">Cleanliness</option>
                <option value="Roommate Issue">Roommate Issue</option>
            </select>

            <label for="title">Title:</label>
            <textarea id="title" name="title" required style="padding: 5px; border-radius: 5px; border: 1px solid #ccc;"></textarea>

            <label for="body">Description:</label>
            <textarea id="body" name="body" required style="padding: 5px; border-radius: 5px; border: 1px solid #ccc;"></textarea>

            <div style="display: flex; gap: 10px;">
                <button type="submit" style="padding: 10px; border-radius: 5px; background-color: #4CAF50; color: white; border: none; cursor: pointer;">Submit Complaint</button>
                <button type="button" onclick="closeComplaintForm()" style="padding: 10px; border-radius: 5px; background-color: #f44336; color: white; border: none; cursor: pointer;">Close</button>
            </div>
        </form>
    </div>
</body>
</html>

<?php include('../includes/footer.php'); ?>
