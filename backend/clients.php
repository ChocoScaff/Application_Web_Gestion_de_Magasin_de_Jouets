<?php
include 'db.php';
// Ajouter un client
function ajouterClient($nom, $prenom, $email, $adresse, $telephone)
{
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO Client (nom, prenom, email, adresse, telephone) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$nom, $prenom, $email, $adresse, $telephone]);
}

// Modifier un client
function modifierClient($id, $nom, $prenom, $email, $adresse, $telephone)
{
    global $pdo;
    $stmt = $pdo->prepare("UPDATE Client SET nom = ?, prenom = ?, email = ?, adresse = ?, telephone = ? WHERE id = ?");
    $stmt->execute([$nom, $prenom, $email, $adresse, $telephone, $id]);
}

// Récupérer tous les clients
function getClients()
{
    global $pdo;
    try {
        $stmt = $pdo->query("SELECT * FROM Client"); // Vérifie la casse correcte
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Erreur SQL : " . $e->getMessage()); // Affiche l'erreur SQL
    }
}
?>