<?php
include 'C:\xampp\htdocs\tp-php\backend\jouets.php'; // Inclusion correcte du backend
include 'C:\xampp\htdocs\tp-php\frontend\includes\header.php';

$message = ""; // Variable pour afficher un message à l'utilisateur

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération et validation des données
    $nom = trim($_POST['nom']);
    $prix = $_POST['prix'];
    $quantite_stock = $_POST['quantite_stock'];
    $description = trim($_POST['description']);
    $age_min = $_POST['age_min'];
    $age_max = $_POST['age_max'];
    $marque = trim($_POST['marque']);
    $categorie = trim($_POST['categorie']);

    if (!empty($nom) && is_numeric($prix) && is_numeric($quantite_stock) && !empty($description) &&
        is_numeric($age_min) && is_numeric($age_max) && !empty($marque) && !empty($categorie)) {
        
        $success = ajouterJouet($nom, $prix, $quantite_stock, $description, $age_min, $age_max, $marque, $categorie);

        if ($success) {
            $message = "<p style='color:green;'>Jouet ajouté avec succès !</p>";
        } else {
            $message = "<p style='color:red;'>Erreur lors de l'ajout du jouet.</p>";
        }
    } else {
        $message = "<p style='color:red;'>Veuillez remplir tous les champs correctement.</p>";
    }
}
?>

<h1>Ajouter un Jouet</h1>
<?= $message ?>

<form method="post">
    <label>Nom :</label>
    <input type="text" name="nom" required>

    <label>Prix :</label>
    <input type="number" step="0.01" name="prix" required>

    <label>Quantité :</label>
    <input type="number" name="quantite_stock" required>

    <label>Description :</label>
    <textarea name="description" required></textarea>

    <label>Âge min :</label>
    <input type="number" name="age_min" required>

    <label>Âge max :</label>
    <input type="number" name="age_max" required>

    <label>Marque :</label>
    <input type="text" name="marque" required>

    <label>Catégorie :</label>
    <input type="text" name="categorie" required>

    <button type="submit">Ajouter</button>
</form>

<?php include 'C:\xampp\htdocs\tp-php\frontend\includes\footer.php'; ?>
