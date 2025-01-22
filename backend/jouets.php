
<?php
// jouets.php : Gestion des jouets
include 'config.php';

// Ajouter un jouet
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajouter_jouet'])) {
    $nom = $_POST['nom'];
    $prix = $_POST['prix'];
    $quantite = $_POST['quantite'];

    $stmt = $pdo->prepare("INSERT INTO jouets (nom, prix, quantite) VALUES (?, ?, ?)");
    $stmt->execute([$nom, $prix, $quantite]);
    echo "Jouet ajouté avec succès.";
}

// Afficher les jouets
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $stmt = $pdo->query("SELECT * FROM jouets");
    $jouets = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($jouets);
}

?>