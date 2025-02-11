<?php include '../includes/header.php'; ?>

<?php
// Assuming you have a $student variable with the student's details
$student = [
    'name' => 'John Doe',
    'email' => 'john.doe@example.com',
    'matric' => 'A123456'
];
?>

<div class="profile">
    <h2>Student Profile</h2>
    <div class="student-card" style="border: 1px solid #ccc; padding: 20px; border-radius: 10px; width: 300px; margin-right: auto; text-align: center;">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSQDyS_Qs-2z69vZdklHZiwi9SMIJKTeEXc1g&s" alt="Student Image" style="border-radius: 50%; width: 150px; height: 150px; border: 2px solid #3498db; margin-bottom: 20px;">
        <h3><?php echo htmlspecialchars($student['name']); ?></h3>
        <p>Email: <?php echo htmlspecialchars($student['email']); ?></p>
        <p>Matric: <?php echo htmlspecialchars($student['matric']); ?></p>
    </div>
</div>
<div class="booked-rooms">
    <h3>Booked Rooms</h3>
    <ul>
        <?php
        // Assuming you have a $bookedRooms variable with the list of booked rooms
        $bookedRooms = [
            ['number' => '201', 'building' => 'B', 'image' => 'https://www.thespruce.com/thmb/2_Q52GK3rayV1wnqm6vyBvgI3Ew=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/put-together-a-perfect-guest-room-1976987-hero-223e3e8f697e4b13b62ad4fe898d492d.jpg'],
            ['number' => '201', 'building' => 'B', 'image' => 'https://www.thespruce.com/thmb/2_Q52GK3rayV1wnqm6vyBvgI3Ew=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/put-together-a-perfect-guest-room-1976987-hero-223e3e8f697e4b13b62ad4fe898d492d.jpg'],
        ];

        echo '<div style="display: flex; flex-wrap: wrap; gap: 10px;">';
        foreach ($bookedRooms as $room) {
            echo '<div class="room-card" style="border: 1px solid #ccc; padding: 10px; margin: 10px; width: calc(20% - 20px); text-align: center; border-radius: 10px; overflow: hidden; box-sizing: border-box;">';
            echo '<img src="' . $room['image'] . '" alt="Room ' . $room['number'] . '" style="width: 100%; height: 150px; object-fit: cover;">';
            echo '<p>Room Number: ' . $room['number'] . '</p>';
            echo '<p>Building: ' . $room['building'] . '</p>';
            echo '<button style="padding: 5px 10px; background-color: #2c3e50; color: white; border: none; cursor: pointer; border-radius: 5px;">Book Now</button>';
            echo '</div>';
        }
        ?>
    </ul>
</div>



<?php include('../includes/footer.php'); ?>