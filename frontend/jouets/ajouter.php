<?php
include 'C:\xampp\htdocs\tp-php\frontend\includes\header.php';
include 'C:\xampp\htdocs\tp-php\backend\jouets.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    ajouterJouet($_POST['nom'], $_POST['prix'], $_POST['quantite_stock'], $_POST['description'], $_POST['age_min'], $_POST['age_max'], $_POST['marque'], $_POST['categorie']);
    echo "<p>Jouet ajouté avec succès !</p>";
}
?>

<link rel="stylesheet" href="../../assets/styles.css">

<h1>Ajouter un Jouet</h1>
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
<?php include '../includes/footer.php'; ?>