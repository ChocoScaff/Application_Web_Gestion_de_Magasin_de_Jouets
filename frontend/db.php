<?php
$servername = 'localhost';
$userrname = 'root';
$password = '';
$dbname = 'Magasinjouet ';

$conn = new mysqli($servername, $userrname, $password, $dbname);

if ($conn->connect_error) {
    die('Erreur de connexion a la base de donnee : ' . $conn->connect_error );
}


function connectDB() {
    $host = "localhost"; // Adresse du serveur
    $dbname = "magasinjouet "; // Nom de la base de données
    $username = "root"; // Nom d'utilisateur
    $password = ""; // Mot de passe

    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        // Configurer PDO pour afficher les erreurs
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        die("Erreur de connexion à la base de données : " . $e->getMessage());
    }
}


?>