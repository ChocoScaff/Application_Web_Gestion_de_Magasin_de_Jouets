<?php
include 'db.php';

// Récupérer un jouet par ID
function getJouetById($id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT Produit.id, Produit.nom, Produit.prix, Produit.quantite_stock, Produit.description,
                                  Jouet.age_min, Jouet.age_max, Jouet.marque, Jouet.categorie 
                           FROM Produit 
                           JOIN Jouet ON Produit.id = Jouet.id 
                           WHERE Produit.id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Ajouter un jouet
function ajouterJouet($nom, $prix, $quantite_stock, $description, $age_min, $age_max, $marque, $categorie) {
    global $pdo;

    try {
        // Insérer d'abord dans Produit
        $stmt = $pdo->prepare("INSERT INTO Produit (nom, prix, quantite_stock, description) VALUES (?, ?, ?, ?)");
        $stmt->execute([$nom, $prix, $quantite_stock, $description]);
        $produitId = $pdo->lastInsertId();

        // Insérer ensuite dans Jouet
        $stmt = $pdo->prepare("INSERT INTO Jouet (id, age_min, age_max, marque, categorie) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$produitId, $age_min, $age_max, $marque, $categorie]);

        return true;
    } catch (PDOException $e) {
        error_log("Erreur lors de l'ajout du jouet : " . $e->getMessage());
        return false;
    }
}

// Modifier un jouet
function modifierJouet($id, $nom, $prix, $quantite_stock, $description, $age_min, $age_max, $marque, $categorie) {
    global $pdo;

    try {
        // Modifier le produit
        $stmt = $pdo->prepare("UPDATE Produit SET nom = ?, prix = ?, quantite_stock = ?, description = ? WHERE id = ?");
        $stmt->execute([$nom, $prix, $quantite_stock, $description, $id]);

        // Modifier les infos du jouet
        $stmt = $pdo->prepare("UPDATE Jouet SET age_min = ?, age_max = ?, marque = ?, categorie = ? WHERE id = ?");
        $stmt->execute([$age_min, $age_max, $marque, $categorie, $id]);

        return true;
    } catch (PDOException $e) {
        error_log("Erreur lors de la modification du jouet : " . $e->getMessage());
        return false;
    }
}

// Supprimer un jouet
function supprimerJouet($id) {
    global $pdo;

    try {
        $stmt = $pdo->prepare("DELETE FROM Produit WHERE id = ?");
        $stmt->execute([$id]);
        return true;
    } catch (PDOException $e) {
        error_log("Erreur lors de la suppression du jouet : " . $e->getMessage());
        return false;
    }
}

// Récupérer tous les jouets
function getJouets() {
    global $pdo;
    try {
        $stmt = $pdo->query("SELECT Produit.id, Produit.nom, Produit.prix, Produit.description, Produit.quantite_stock, 
                                    Jouet.age_min, Jouet.age_max, Jouet.marque, Jouet.categorie 
                             FROM Produit 
                             JOIN Jouet ON Produit.id = Jouet.id");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Erreur lors de la récupération des jouets : " . $e->getMessage());
        return [];
    }
}

// Récupérer le prix d'un jouet via son ID
function getJouetPrix($id_jouet) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("SELECT prix FROM Produit WHERE id = ?");
        $stmt->execute([$id_jouet]);
        return $stmt->fetchColumn() ?: 0;
    } catch (PDOException $e) {
        error_log("Erreur lors de la récupération du prix du jouet : " . $e->getMessage());
        return 0;
    }
}
?>
