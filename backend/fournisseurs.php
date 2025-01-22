<?php
// fournisseurs.php : Gestion des fournisseurs
include 'config.php';

// Ajouter un fournisseur
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajouter_fournisseur'])) {
    $nom = $_POST['nom'];
    $contact = $_POST['contact'];

    $stmt = $pdo->prepare("INSERT INTO fournisseurs (nom, contact) VALUES (?, ?)");
    $stmt->execute([$nom, $contact]);
    echo "Fournisseur ajouté avec succès.";
}

// Afficher les fournisseurs
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $stmt = $pdo->query("SELECT * FROM fournisseurs");
    $fournisseurs = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($fournisseurs);
}

?>