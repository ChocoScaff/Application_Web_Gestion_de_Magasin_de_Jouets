<?php
include 'C:\\xampp\\htdocs\\tp-php\\backend\\jouets.php';
include 'C:\\xampp\\htdocs\\tp-php\\backend\\clients.php';
include 'C:\\xampp\\htdocs\\tp-php\\backend\\db.php';
include 'C:\\xampp\\htdocs\\tp-php\\backend\\commandes.php';
include 'C:\\xampp\\htdocs\\tp-php\\frontend\\includes\\header.php';

$clients = getClients(); // Récupérer la liste des clients
$jouets = getJouets();   // Récupérer la liste des jouets
$message = ""; // Message de feedback

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $client_id = $_POST['client_id'] ?? null;
    $jouets_commande = $_POST['jouets_commande'] ?? [];

    // Vérification si un jouet a été sélectionné
    $jouets_valides = [];
    foreach ($jouets_commande as $jouet) {
        if (!empty($jouet['id']) && !empty($jouet['quantite']) && intval($jouet['quantite']) > 0) {
            $jouets_valides[] = [
                'id' => intval($jouet['id']),
                'quantite' => intval($jouet['quantite']),
                'prix' => getJouetPrix($jouet['id']) // Récupère le prix du jouet depuis la BDD
            ];
        }
    }

    if (!$client_id) {
        $message = "<p style='color: red;'>Erreur : Sélectionnez un client.</p>";
    } elseif (count($jouets_valides) === 0) {
        $message = "<p style='color: red;'>Erreur : Sélectionnez au moins un jouet avec une quantité valide.</p>";
    } else {
        // Création de la commande avec des données validées
        creerCommande($client_id, $jouets_valides);
        $message = "<p style='color: green;'>Commande créée avec succès !</p>";
    }
}
?>

<h1>Créer une Commande</h1>

<?= $message ?>

<form method="post">
    <label for="client_id">Client :</label>
    <select name="client_id" id="client_id" required>
        <option value="">-- Sélectionnez un client --</option>
        <?php foreach ($clients as $client): ?>
            <option value="<?= $client['id'] ?>">
                <?= htmlspecialchars($client['nom'] . ' ' . $client['prenom']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <h3>Jouets :</h3>
    <?php foreach ($jouets as $jouet): ?>
        <div>
            <input type="checkbox" name="jouets_commande[<?= $jouet['id'] ?>][id]" value="<?= $jouet['id'] ?>" onchange="gererQuantite(<?= $jouet['id'] ?>)">
            <?= htmlspecialchars($jouet['nom']) ?> - <?= $jouet['prix'] ?>€
            <label>Quantité :</label>
            <input type="number" name="jouets_commande[<?= $jouet['id'] ?>][quantite]" id="quantite_<?= $jouet['id'] ?>" min="1" disabled>
        </div>
    <?php endforeach; ?>

    <button type="submit">Créer</button>
</form>

<script>
function gererQuantite(id) {
    let checkbox = document.querySelector("input[name='jouets_commande[" + id + "][id]']");
    let quantite = document.querySelector("input[name='jouets_commande[" + id + "][quantite]']");
    quantite.disabled = !checkbox.checked;
}
</script>

<?php include 'C:\\xampp\\htdocs\\tp-php\\frontend\\includes\\footer.php'; ?>
