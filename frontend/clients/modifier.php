<?php
include '../../backend\clients.php';
include '../includes\header.php';

function getClientById($id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM Client WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

if (isset($_GET['id'])) {
    $client = getClientById($_GET['id']);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        modifierClient($_GET['id'], $_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['adresse'], $_POST['telephone']);
        echo "<p>Client modifié avec succès !</p>";
    }
}
?>

<h1>Modifier un Client</h1>
<?php if (isset($client)): ?>
<form method="post">
    <label>Nom :</label>
    <input type="text" name="nom" value="<?= htmlspecialchars($client['nom']) ?>" required>
    <label>Prénom :</label>
    <input type="text" name="prenom" value="<?= htmlspecialchars($client['prenom']) ?>" required>
    <label>Email :</label>
    <input type="email" name="email" value="<?= htmlspecialchars($client['email']) ?>" required>
    <label>Adresse :</label>
    <textarea name="adresse" required><?= htmlspecialchars($client['adresse']) ?></textarea>
    <label>Téléphone :</label>
    <input type="text" name="telephone" value="<?= htmlspecialchars($client['telephone']) ?>" required>
    <button type="submit">Modifier</button>
</form>
<?php else: ?>
<p>Client introuvable.</p>
<?php endif; ?>
<?php include '../includes\footer.php'; ?>