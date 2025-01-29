<?php
include '../../backend\\commandes.php';
include '../includes\\header.php';

$commandes = getCommandes(); // Récupérer toutes les commandes
?>

<h1>Liste des Commandes</h1>
<table border="1">
    <tr>
        <th>Client</th>
        <th>Date</th>
        <th>Montant Total</th>
        <th>Statut</th>
    </tr>
    <?php foreach ($commandes as $commande): ?>
        <tr>
            <td><?= htmlspecialchars($commande['client_nom'] . ' ' . $commande['client_prenom']) ?></td>
            <td><?= htmlspecialchars($commande['date_commande']) ?></td>
            <td><?= htmlspecialchars($commande['montant_total']) ?>€</td>
            <td><?= htmlspecialchars($commande['statut']) ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<?php include 'C:\\xampp\\htdocs\\tp-php\\frontend\\includes\\footer.php'; ?>
