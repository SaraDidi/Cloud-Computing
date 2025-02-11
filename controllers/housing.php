<?php
session_start();
include '../includes/db.php'; // Include your database connection file

// Ensure the student is logged in
if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit;
}

// Fetch housing registration opening times
$stmt = $db->prepare("SELECT * FROM room WHERE NOW() <= closing_time");
$stmt->execute();
$open_housings = $stmt->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $housing_id = $_POST['housing_id'];
    $student_id = $_SESSION['student_id'];

    // Register student for housing
    $stmt = $db->prepare("INSERT INTO rooms (student_id, housing_id) VALUES (?, ?)");
    $stmt->execute([$student_id, $housing_id]);

    $message = "You have successfully registered for housing!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Housing Registration</title>
</head>
<body>
    <h1>Welcome, <?php echo $_SESSION['student_name']; ?></h1>
    <h2>Available Housing Registrations</h2>
    <?php if (isset($message)) echo "<p style='color:green;'>$message</p>"; ?>

    <?php if (!empty($open_housings)): ?>
        <form method="POST" action="">
            <label for="housing_id">Choose Housing:</label>
            <select id="housing_id" name="housing_id">
                <?php foreach ($open_housings as $housing): ?>
                    <option value="<?php echo $housing['id']; ?>">
                        <?php echo $housing['name'] . " (Opens: " . $housing['opening_time'] . " - Closes: " . $housing['closing_time'] . ")"; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button type="submit">Register</button>
        </form>
    <?php else: ?>
        <p>No housing registrations are currently open.</p>
    <?php endif; ?>
</body>
</html>
