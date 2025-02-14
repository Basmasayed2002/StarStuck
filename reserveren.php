<?php
// Databaseverbinding
$host = "localhost";
$user = "root";
$password = "";
$database = "Starstruck"; // Juiste database-naam

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Databaseverbinding mislukt: " . $conn->connect_error);
}

// Verkrijg kamers uit de database
$result = $conn->query("SELECT * FROM rooms");
$rooms = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $rooms[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Starstruck Hotel - Reserveren</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>Welkom bij Starstruck Hotel</h1>
    <p>Geniet van luxe en comfort</p>
</header>

<main>
    <section class="rooms">
        <?php foreach ($rooms as $room): ?>
            <div class="room-card" onclick="showDetails(<?= $room['id'] ?>)">
                <h2><?= $room['name'] ?></h2>
                <p>€<?= $room['price'] ?> per nacht</p>
            </div>
        <?php endforeach; ?>
    </section>

    <section id="room-details" class="hidden">
        <h2 id="room-title"></h2>
        <p id="room-desc"></p>
        <p><strong>Prijs: </strong>€<span id="room-price"></span> per nacht</p>

        <form action="reserve.php" method="POST">
            <input type="hidden" id="room-id" name="room_id">
            <label for="checkin">Check-in:</label>
            <input type="date" name="checkin" required>
            
            <label for="checkout">Check-out:</label>
            <input type="date" name="checkout" required>
            
            <button type="submit">Reserveer Nu</button>
        </form>
    </section>
</main>

<script>
    const rooms = <?= json_encode($rooms) ?>;

    function showDetails(id) {
        const room = rooms.find(r => r.id == id);
        document.getElementById('room-title').innerText = room.name;
        document.getElementById('room-desc').innerText = room.description;
        document.getElementById('room-price').innerText = room.price;
        document.getElementById('room-id').value = room.id;

        document.getElementById('room-details').classList.remove('hidden');
    }
</script>

</body>
</html>
