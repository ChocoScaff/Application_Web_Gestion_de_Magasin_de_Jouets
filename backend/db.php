<?php
$servername = 'localhost';
$userrname = 'root';
$password = '';
$dbname = 'MagasinJouet';  // Correction : suppression de l'espace et respect de la casse

$conn = new mysqli($servername, $userrname, $password, $dbname);

if ($conn->connect_error) {
    die('Erreur de connexion a la base de donnee : ' . $conn->connect_error );
}

function connectDB() {
    $host = "localhost";
    $dbname = "MagasinJouet";  // Correction : suppression de l'espace et respect de la casse
    $username = "root";
    $password = "";

    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        die("Erreur de connexion à la base de données : " . $e->getMessage());
    }
}
?>