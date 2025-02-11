

<?php include '../includes/header.php'; ?>
<h1>Welcome to University Housing</h1>
<p>Manage your housing and complaints efficiently.</p>


<?php
$rooms = [
    ['number' => '101', 'building' => 'A', 'image' => 'https://www.thespruce.com/thmb/2_Q52GK3rayV1wnqm6vyBvgI3Ew=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/put-together-a-perfect-guest-room-1976987-hero-223e3e8f697e4b13b62ad4fe898d492d.jpg'],
    ['number' => '102', 'building' => 'A', 'image' => 'https://www.thespruce.com/thmb/2_Q52GK3rayV1wnqm6vyBvgI3Ew=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/put-together-a-perfect-guest-room-1976987-hero-223e3e8f697e4b13b62ad4fe898d492d.jpg'],
    ['number' => '201', 'building' => 'B', 'image' => 'https://www.thespruce.com/thmb/2_Q52GK3rayV1wnqm6vyBvgI3Ew=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/put-together-a-perfect-guest-room-1976987-hero-223e3e8f697e4b13b62ad4fe898d492d.jpg'],
    // Add more rooms as needed
];

echo '<div style="display: flex; flex-wrap: wrap; gap: 10px;">';
foreach ($rooms as $room) {
    echo '<div class="room-card" style="border: 1px solid #ccc; padding: 10px; margin: 10px; width: calc(20% - 20px); text-align: center; border-radius: 10px; overflow: hidden; box-sizing: border-box;">';
    echo '<img src="' . $room['image'] . '" alt="Room ' . $room['number'] . '" style="width: 100%; height: 150px; object-fit: cover;">';
    echo '<p>Room Number: ' . $room['number'] . '</p>';
    echo '<p>Building: ' . $room['building'] . '</p>';
    echo '<button style="padding: 5px 10px; background-color: #2c3e50; color: white; border: none; cursor: pointer; border-radius: 5px;">Book Now</button>';
    echo '</div>';
}
echo '</div>';
?>

<?php include('../includes/footer.php'); ?>
