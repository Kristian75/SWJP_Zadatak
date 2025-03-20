<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "knjiga_dojmova";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Konekcija nije uspjela: " . $conn->connect_error);
}

$search = isset($_GET['str']) ? $_GET['str'] : "";

$sql = "SELECT * FROM dojmovi WHERE ime_prezime LIKE '%$search%' OR tekst LIKE '%$search%' ORDER BY datum DESC";
$result = $conn->query($sql);

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