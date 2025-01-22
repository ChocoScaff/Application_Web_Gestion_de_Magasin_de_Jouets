<?php
// commandes.php : Gestion des commandes
include 'config.php';

// Ajouter une commande
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajouter_commande'])) {
    $client_id = $_POST['client_id'];
    $date = $_POST['date'];

    $stmt = $pdo->prepare("INSERT INTO commandes (client_id, date) VALUES (?, ?)");
    $stmt->execute([$client_id, $date]);
    echo "Commande ajoutée avec succès.";
}

// Afficher les commandes
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $stmt = $pdo->query("SELECT * FROM commandes");
    $commandes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($commandes);
}

?>