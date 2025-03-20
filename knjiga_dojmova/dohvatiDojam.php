<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "knjiga_dojmova";

// Kreiranje konekcije
$conn = new mysqli($servername, $username, $password, $dbname);

// Provjera konekcije
if ($conn->connect_error) {
    die("Konekcija nije uspjela: " . $conn->connect_error);
}

// Preuzimanje ID dojma
$id = isset($_GET['id']) ? $_GET['id'] : 0;

// Dohvaćanje detalja dojma
$sql = "SELECT * FROM dojmovi WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

// Prikaz detalja
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "<h3>" . htmlspecialchars($row["ime_prezime"]) . "</h3>";
    echo "<p><b>Email:</b> " . htmlspecialchars($row["email"]) . "</p>";
    echo "<p><b>Tekst dojma:</b> " . htmlspecialchars($row["tekst"]) . "</p>";
    echo "<p><b>Datum:</b> " . $row["datum"] . "</p>";
} else {
    echo "Dojam nije pronađen.";
}

$stmt->close();
$conn->close();
?>
