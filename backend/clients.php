<?php
header('Content-Type: application/json');
require_once 'db.php';

try {
    $conn = connectDB();
    $stmt = $conn->query("SELECT id_client, nom, prenom, email, telephone FROM Client ORDER BY nom, prenom");
    $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($clients);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Erreur lors de la récupération des clients']);
}