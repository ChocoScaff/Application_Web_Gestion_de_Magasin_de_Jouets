<?php
// clients.php : Gestion des clients
include 'config.php';

// Ajouter un client
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajouter_client'])) {
    $nom = $_POST['nom'];
    $email = $_POST['email'];

    $stmt = $pdo->prepare("INSERT INTO clients (nom, email) VALUES (?, ?)");
    $stmt->execute([$nom, $email]);
    echo "Client ajouté avec succès.";
}

// Afficher les clients
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $stmt = $pdo->query("SELECT * FROM clients");
    $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($clients);
}

?>
