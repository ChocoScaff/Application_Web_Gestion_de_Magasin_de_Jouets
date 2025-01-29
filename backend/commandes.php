<?php
include 'db.php';

// Créer une commande
function creerCommande($client_id, $jouets) {
    global $pdo;

    // Vérification : au moins un jouet doit être sélectionné avec une quantité > 0
    $jouets_valides = [];
    foreach ($jouets as $jouet) {
        if (!isset($jouet['id']) || !isset($jouet['prix']) || !isset($jouet['quantite']) || empty($jouet['id']) || $jouet['quantite'] <= 0) {
            continue; // On ignore les jouets mal remplis
        }
        $jouets_valides[] = $jouet;
    }

    // Si aucun jouet valide, bloquer la commande
    if (count($jouets_valides) === 0) {
        return "Erreur : Vous devez sélectionner au moins un jouet avec une quantité valide.";
    }

    // Insérer une nouvelle commande avec montant_total à 0 (sera mis à jour après)
    $stmt = $pdo->prepare("INSERT INTO Commande (client_id, montant_total) VALUES (?, 0)");
    $stmt->execute([$client_id]);
    $commande_id = $pdo->lastInsertId();

    $montant_total = 0; // Initialisation du montant total

    // Insérer les lignes de commande et calculer le montant total
    foreach ($jouets_valides as $jouet) {
        $jouet_id = intval($jouet['id']);
        $quantite = intval($jouet['quantite']);
        $prix = floatval($jouet['prix']);

        // Insérer la ligne de commande
        $stmt = $pdo->prepare("INSERT INTO LigneCommande (commande_id, jouet_id, quantite, prix_unitaire) VALUES (?, ?, ?, ?)");
        $stmt->execute([$commande_id, $jouet_id, $quantite, $prix]);

        // Calculer le montant total
        $montant_total += $quantite * $prix;
    }

    // Mettre à jour le montant total de la commande
    $stmt = $pdo->prepare("UPDATE Commande SET montant_total = ? WHERE id = ?");
    $stmt->execute([$montant_total, $commande_id]);

    return "Commande créée avec succès. Montant total : " . number_format($montant_total, 2) . "€";
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
