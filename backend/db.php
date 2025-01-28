<?php
// db.php

// Configuration des paramètres de connexion
$host = 'localhost';        // Adresse du serveur
$dbname = 'magasin_jouets'; // Nom de la base de données
$username = 'root';         // Nom d'utilisateur
$password = '';             // Mot de passe (vide par défaut sur XAMPP)

// Connexion avec PDO (recommandé pour une meilleure sécurité et flexibilité)
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Enregistre l'erreur dans les logs et affiche un message utilisateur
    error_log("Erreur de connexion PDO : " . $e->getMessage());
    die("Erreur : Impossible de se connecter à la base de données.");
}

// Connexion avec MySQLi (optionnelle, seulement si nécessaire)
$conn = mysqli_connect($host, $username, $password, $dbname);

// Vérification de la connexion MySQLi
if (!$conn) {
    error_log("Erreur de connexion MySQLi : " . mysqli_connect_error());
    die("Erreur : Impossible de se connecter à la base de données.");
}
?>
