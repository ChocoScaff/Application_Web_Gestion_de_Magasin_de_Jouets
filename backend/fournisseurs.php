<?php
include 'db.php';

// Ajouter un fournisseur
function ajouterFournisseur($nom, $email, $telephone, $adresse) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO Fournisseur (nom, email, telephone, adresse) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nom, $email, $telephone, $adresse]);
}

// Modifier un fournisseur
function modifierFournisseur($id, $nom, $email, $telephone, $adresse) {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE Fournisseur SET nom = ?, email = ?, telephone = ?, adresse = ? WHERE id = ?");
    $stmt->execute([$nom, $email, $telephone, $adresse, $id]);
}

// Récupérer tous les fournisseurs
function getFournisseurs() {
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM Fournisseur");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>