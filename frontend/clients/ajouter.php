<?php
include '..\..\backend\clients.php';
include '../includes\header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    ajouterClient($_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['adresse'], $_POST['telephone']);
    echo "<p>Client ajouté avec succès !</p>";
}
?>

<h1>Ajouter un Client</h1>
<form method="post">
    <label>Nom :</label>
    <input type="text" name="nom" required>
    <label>Prénom :</label>
    <input type="text" name="prenom" required>
    <label>Email :</label>
    <input type="email" name="email" required>
    <label>Adresse :</label>
    <textarea name="adresse" required></textarea>
    <label>Téléphone :</label>
    <input type="text" name="telephone" required>
    <button type="submit">Ajouter</button>
</form>
<?php include '..\includes\footer.php'; ?>

