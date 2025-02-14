<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $room_id = $_POST['room_id'];
    $checkin = $_POST['checkin'];
    $checkout = $_POST['checkout'];

    // Simpele validatie
    if (empty($room_id) || empty($checkin) || empty($checkout)) {
        echo "<script>alert('Vul alle velden in.'); window.history.back();</script>";
        exit;
    }

    // Databaseverbinding
    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "Starstruck"; // Juiste database-naam

    $conn = new mysqli($host, $user, $password, $database);

    if ($conn->connect_error) {
        die("Databaseverbinding mislukt: " . $conn->connect_error);
    }

    // Verkrijg de kamerinfo
    $stmt = $conn->prepare("SELECT name, price FROM rooms WHERE id = ?");
    $stmt->bind_param("i", $room_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $room = $result->fetch_assoc();

    if (!$room) {
        echo "<script>alert('Ongeldige kamer geselecteerd.'); window.history.back();</script>";
        exit;
    }

    // Reservering opslaan
    $stmt = $conn->prepare("INSERT INTO reservations (room_id, checkin, checkout) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $room_id, $checkin, $checkout);

    if ($stmt->execute()) {
        echo "<script>
            alert('Reservering succesvol! U heeft de " . $room['name'] . " geboekt van $checkin tot $checkout.');
            window.location.href = 'reserveren.php'; // Aangepast naar reserveren.php
        </script>";
    } else {
        echo "<script>alert('Er is iets misgegaan. Probeer opnieuw.'); window.history.back();</script>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<script>alert('Ongeldige aanvraag.'); window.history.back();</script>";
}
?>
