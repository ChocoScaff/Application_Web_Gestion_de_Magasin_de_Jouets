<?php
header('Content-Type: application/json');
require_once 'db.php';

function getJouets() {
    $conn = connectDB();
    $stmt = $conn->query("SELECT nom, marque, prix FROM Jouet");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

echo json_encode(getJouets());