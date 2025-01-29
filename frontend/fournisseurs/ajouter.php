<?php
include '..\..\backend\fournisseurs.php';
include '..\includes\header.php';
?>
<link rel="stylesheet" href="../../assets\styles.css">

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    ajouterFournisseur($_POST['nom'], $_POST['email'], $_POST['telephone'], $_POST['adresse']);
    echo "<p>Fournisseur ajouté avec succès !</p>";
}
?>

<h1>Ajouter un Fournisseur</h1>
<form method="post">
    <label>Nom :</label>
    <input type="text" name="nom" required>
    <label>Email :</label>
    <input type="email" name="email" required>
    <label>Téléphone :</label>
    <input type="text" name="telephone" required>
    <label>Adresse :</label>
    <textarea name="adresse" required></textarea>
    <button type="submit">Ajouter</button>
</form>
<?php include '..\includes\footer.php'; ?>