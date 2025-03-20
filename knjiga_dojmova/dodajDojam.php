<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "knjiga_dojmova";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Konekcija nije uspjela: " . $conn->connect_error);
}

$imePrezime = isset($_GET['imePrezime']) ? $_GET['imePrezime'] : "";
$email = isset($_GET['eMail']) ? $_GET['eMail'] : "";
$tekst = isset($_GET['tekst']) ? $_GET['tekst'] : "";

if (empty($imePrezime) || empty($email) || empty($tekst)) {
    echo "Sva polja su obavezna!";
    exit();
}

$sql = "INSERT INTO dojmovi (ime_prezime, email, tekst) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $imePrezime, $email, $tekst);

if ($stmt->execute()) {
    echo "Dojam uspješno dodan!";
} else {
    echo "Greška pri dodavanju dojma!";
}

$stmt->close();
$conn->close();
?>
