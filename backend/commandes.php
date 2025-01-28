<?php
include 'db.php';

// Créer une commande
function creerCommande($client_id, $jouets) {
    global $pdo;

    // Insérer une nouvelle commande
    $stmt = $pdo->prepare("INSERT INTO Commande (client_id, montant_total) VALUES (?, 0)");
    $stmt->execute([$client_id]);
    $commande_id = $pdo->lastInsertId();

    // Insérer les lignes de commande
    foreach ($jouets as $jouet) {
        $stmt = $pdo->prepare("INSERT INTO LigneCommande (commande_id, jouet_id, quantite, prix_unitaire) VALUES (?, ?, ?, ?)");
        $stmt->execute([$commande_id, $jouet['id'], $jouet['quantite'], $jouet['prix']]);
    }

    // Mettre à jour le montant total de la commande
    $stmt = $pdo->prepare("
        UPDATE Commande 
        SET montant_total = (
            SELECT SUM(quantite * prix_unitaire)
            FROM LigneCommande
            WHERE commande_id = ?
        )
        WHERE id = ?
    ");
    $stmt->execute([$commande_id, $commande_id]);
}

// Lister les commandes
function getCommandes() {
    global $pdo;

    // Ajouter des alias explicites pour éviter les conflits et avertissements
    $stmt = $pdo->query("
        SELECT 
            Commande.id AS commande_id, 
            Client.nom AS client_nom, 
            Client.prenom AS client_prenom, 
            Commande.date_commande, 
            Commande.montant_total, 
            Commande.statut 
        FROM Commande
        JOIN Client ON Commande.client_id = Client.id
    ");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
