<?php
include 'db.php';

// Ajouter un jouet
function ajouterJouet($nom, $prix, $quantite_stock, $description, $age_min, $age_max, $marque, $categorie) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO Produit (nom, prix, quantite_stock, description) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nom, $prix, $quantite_stock, $description]);
    $produitId = $pdo->lastInsertId();

    $stmt = $pdo->prepare("INSERT INTO Jouet (id, age_min, age_max, marque, categorie) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$produitId, $age_min, $age_max, $marque, $categorie]);
}

// Supprimer un jouet
function supprimerJouet($id) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM Produit WHERE id = ?");
    $stmt->execute([$id]);
}

// Récupérer tous les jouets
function getJouets() {
    global $pdo;
    $stmt = $pdo->query("SELECT Produit.id, Produit.nom, Produit.prix, Produit.description, Produit.quantite_stock, Jouet.age_min, Jouet.age_max, Jouet.marque, Jouet.categorie FROM Produit JOIN Jouet ON Produit.id = Jouet.id");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>