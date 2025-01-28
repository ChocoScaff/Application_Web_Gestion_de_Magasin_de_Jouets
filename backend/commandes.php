<?php
header('Content-Type: application/json');
require_once 'db.php';

try {
    $conn = connectDB();
    
    $clientId = isset($_GET['client']) ? intval($_GET['client']) : null;
    
    $sql = "SELECT c.id_commande, c.date_commande, c.total, 
            cl.nom as nom_client, cl.prenom as prenom_client
            FROM Commande c
            JOIN Client cl ON c.id_client = cl.id_client";
    
    if ($clientId) {
        $sql .= " WHERE c.id_client = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$clientId]);
    } else {
        $stmt = $conn->query($sql);
    }
    
    $commandes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($commandes);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Erreur lors de la récupération des commandes']);
}