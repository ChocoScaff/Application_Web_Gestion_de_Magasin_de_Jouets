<?php
include 'C:\\xampp\\htdocs\\tp-php\\backend\\jouets.php';
include 'C:\\xampp\\htdocs\\tp-php\\backend\\db.php';
include 'C:\\xampp\\htdocs\\tp-php\\frontend\\includes\\header.php';

// Vérifier si un ID est fourni
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Erreur : Aucun jouet spécifié.");
}

$id = intval($_GET['id']);
$jouet = getJouetById($id);

if (!$jouet) {
    die("Erreur : Jouet non trouvé.");
}

// Vérification et mise à jour des données
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'] ?? '';
    $prix = $_POST['prix'] ?? '';
    $quantite_stock = $_POST['quantite_stock'] ?? '';
    $age_min = $_POST['age_min'] ?? '';
    $age_max = $_POST['age_max'] ?? '';
    $marque = $_POST['marque'] ?? '';
    $categorie = $_POST['categorie'] ?? '';

    if (!empty($nom) && is_numeric($prix) && is_numeric($quantite_stock) && is_numeric($age_min) && is_numeric($age_max)) {
        modifierJouet($id, $nom, $prix, $quantite_stock, $age_min, $age_max, $marque, $categorie);
        echo "<p style='color:green;'>Jouet mis à jour avec succès !</p>";
        $jouet = getJouetById($id); // Rafraîchir les données
    } else {
        echo "<p style='color:red;'>Veuillez remplir tous les champs correctement.</p>";
    }
}
?>

<h1>Modifier un Jouet</h1>

<form method="post">
    <label>Nom :</label>
    <input type="text" name="nom" value="<?= htmlspecialchars($jouet['nom']) ?>" required>

    <label>Prix :</label>
    <input type="number" step="0.01" name="prix" value="<?= htmlspecialchars($jouet['prix']) ?>" required>

    <label>Quantité en Stock :</label>
    <input type="number" name="quantite_stock" value="<?= htmlspecialchars($jouet['quantite_stock']) ?>" required>

    <label>Âge Minimum :</label>
    <input type="number" name="age_min" value="<?= htmlspecialchars($jouet['age_min']) ?>" required>

    <label>Âge Maximum :</label>
    <input type="number" name="age_max" value="<?= htmlspecialchars($jouet['age_max']) ?>" required>

    <label>Marque :</label>
    <input type="text" name="marque" value="<?= htmlspecialchars($jouet['marque']) ?>" required>

    <label>Catégorie :</label>
    <input type="text" name="categorie" value="<?= htmlspecialchars($jouet['categorie']) ?>" required>

    <button type="submit">Modifier</button>
</form>

<?php include 'C:\\xampp\\htdocs\\tp-php\\frontend\\includes\\footer.php'; ?>
