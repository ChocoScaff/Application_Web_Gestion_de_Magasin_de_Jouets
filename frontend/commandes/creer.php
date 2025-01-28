<?php
include 'C:\\xampp\\htdocs\\tp-php\\backend\\jouets.php';
include 'C:\\xampp\\htdocs\\tp-php\\backend\\clients.php';
include 'C:\\xampp\\htdocs\\tp-php\\backend\\db.php';
include 'C:\\xampp\\htdocs\\tp-php\\backend\\commandes.php';
include 'C:\\xampp\\htdocs\\tp-php\\frontend\\includes\\header.php';

$clients = getClients(); // Récupérer la liste des clients
$jouets = getJouets();   // Récupérer la liste des jouets

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $client_id = $_POST['client_id'];
    $jouets_commande = $_POST['jouets_commande']; // Array des jouets et quantités
    creerCommande($client_id, $jouets_commande); // Appelle la fonction pour créer la commande
    echo "<p>Commande créée avec succès !</p>";
}
?>

<h1>Créer une Commande</h1>
<form method="post">
    <label for="client_id">Client :</label>
    <select name="client_id" id="client_id" required>
        <?php foreach ($clients as $client): ?>
            <option value="<?= $client['id'] ?>">
                <?= htmlspecialchars($client['nom'] . ' ' . $client['prenom']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <h3>Jouets :</h3>
    <?php foreach ($jouets as $jouet): ?>
        <div>
            <input type="checkbox" name="jouets_commande[<?= $jouet['id'] ?>][id]" value="<?= $jouet['id'] ?>">
            <?= htmlspecialchars($jouet['nom']) ?> - <?= $jouet['prix'] ?>€
            <label>Quantité :</label>
            <input type="number" name="jouets_commande[<?= $jouet['id'] ?>][quantite]" min="1">
        </div>
    <?php endforeach; ?>

    <button type="submit">Créer</button>
</form>

<?php include 'C:\\xampp\\htdocs\\tp-php\\frontend\\includes\\footer.php'; ?>