<?php
include 'C:\xampp\htdocs\tp-php\backend\fournisseurs.php';
include 'C:\xampp\htdocs\tp-php\frontend\includes\header.php';

function getFournisseurById($id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM Fournisseur WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

if (!isset($_GET['id'])) {
    echo "<p>Fournisseur introuvable.</p>";
    exit();
}

$fournisseur = getFournisseurById($_GET['id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    modifierFournisseur($_GET['id'], $_POST['nom'], $_POST['email'], $_POST['telephone'], $_POST['adresse']);
    echo "<p>Fournisseur modifié avec succès !</p>";
}
?>

<h1>Modifier un Fournisseur</h1>
<?php if ($fournisseur): ?>
<form method="post">
    <label>Nom :</label>
    <input type="text" name="nom" value="<?= htmlspecialchars($fournisseur['nom']) ?>" required>
    <label>Email :</label>
    <input type="email" name="email" value="<?= htmlspecialchars($fournisseur['email']) ?>" required>
    <label>Téléphone :</label>
    <input type="text" name="telephone" value="<?= htmlspecialchars($fournisseur['telephone']) ?>" required>
    <label>Adresse :</label>
    <textarea name="adresse" required><?= htmlspecialchars($fournisseur['adresse']) ?></textarea>
    <button type="submit">Modifier</button>
</form>
<?php else: ?>
<p>Fournisseur introuvable.</p>
<?php endif; ?>
<?php include 'C:\xampp\htdocs\tp-php\frontend\includes\footer.php'; ?>