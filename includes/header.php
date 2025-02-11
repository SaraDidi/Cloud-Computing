<?php
// Get the current page name
$current_page = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Header</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .sidebar {
            height: 100vh;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #2c3e50;
            padding-top: 20px;
            overflow-x: hidden;
        }

        .sidebar a {
            padding: 15px 20px;
            text-decoration: none;
            font-size: 18px;
            color: #ecf0f1;
            display: block;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background-color: #34495e;
        }

        .sidebar a.active {
            background-color: #2980b9; /* Active background color */
            color: #fff; /* Active text color */
            font-weight: bold; /* Optional: Make active item bold */
        }

        .main-content {
            margin-left: 260px; /* Matches the width of the sidebar */
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <a href="../views/home.php" class="<?= $current_page == 'index.php' ? 'active' : '' ?>">Home</a>
        <a href="../views/complaints.php" class="<?= $current_page == 'complaints.php' ? 'active' : '' ?>">Complaints</a>
        <a href="../views/profile.php" class="<?= $current_page == 'profile.php' ? 'active' : '' ?>">Profile</a>
    <script>
        function confirmLogout(event) {
            event.preventDefault();
            if (confirm("Are you sure you want to log out?")) {
                window.location.href = "../views/logout.php";
            }
        }
    </script>
    <a href="#" onclick="confirmLogout(event)">Logout</a>
    </div>
    <div class="main-content">
