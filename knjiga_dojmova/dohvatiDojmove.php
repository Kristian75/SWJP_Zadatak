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

// Preuzimanje pretrage ako postoji
$search = isset($_GET['str']) ? $_GET['str'] : "";

// SQL upit za dohvaćanje dojmova
$sql = "SELECT * FROM dojmovi WHERE ime_prezime LIKE '%$search%' OR tekst LIKE '%$search%' ORDER BY datum DESC";
$result = $conn->query($sql);

// Prikaz dojmova
if ($result->num_rows > 0) {
    echo "<ul>";
    while ($row = $result->fetch_assoc()) {
        echo "<li><b>" . htmlspecialchars($row["ime_prezime"]) . ":</b> " . $row["tekst"] . "</li>";
    }
    echo "</ul>";
} else {
    echo "Nema dojmova.";
}

$conn->close();
?>