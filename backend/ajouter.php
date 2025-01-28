<?php
header('Content-Type: application/json');

require_once 'db.php';

// Récupération des données envoyées
$data = json_decode(file_get_contents('php://input'), true);

// Validation des données
if (!isset($data['nom']) || !isset($data['prix']) || !isset($data['editeur']) || !isset($data['marque'])) {
    echo json_encode([
        'success' => false,
        'message' => 'Tous les champs sont obligatoires'
    ]);
    exit;
}

// Nettoyage et validation des données
$nom = htmlspecialchars(trim($data['nom']));
$prix = filter_var($data['prix'], FILTER_VALIDATE_FLOAT);
$editeur = htmlspecialchars(trim($data['editeur']));
$marque = htmlspecialchars(trim($data['marque']));

// Validation supplémentaire
if (empty($nom) || empty($editeur) || empty($marque)) {
    echo json_encode([
        'success' => false,
        'message' => 'Tous les champs doivent être remplis'
    ]);
    exit;
}

if ($prix === false || $prix < 0) {
    echo json_encode([
        'success' => false,
        'message' => 'Le prix doit être un nombre positif'
    ]);
    exit;
}

try {
    $conn = connectDB();
    
    $stmt = $conn->prepare("INSERT INTO Jouet (nom, prix, editeur, marque) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nom, $prix, $editeur, $marque]);
    
    echo json_encode([
        'success' => true,
        'message' => 'Jouet ajouté avec succès'
    ]);
} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Erreur lors de l\'ajout du jouet: ' . $e->getMessage()
    ]);
}