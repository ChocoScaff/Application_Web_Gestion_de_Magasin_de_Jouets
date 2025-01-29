<?php
include '..\includes\header.php';
include '../..\backend\jouets.php';
?>
<link rel="stylesheet" href="../../assets/styles.css">

<section>
    <h2>Jouets disponibles :</h2>
    <?php
    $jouets = getJouets(); // Appel à la fonction pour récupérer les jouets disponibles
    if (!empty($jouets)): ?>
        <table border="1">
            <tr>
                <th>Nom</th>
                <th>Prix</th>
                <th>Quantité en Stock</th>
                <th>Description</th>
            </tr>
            <?php foreach ($jouets as $jouet): ?>
            <tr>
                <td><?= htmlspecialchars($jouet['nom']) ?></td>
                <td><?= htmlspecialchars($jouet['prix']) ?>€</td>
                <td><?= htmlspecialchars($jouet['quantite_stock']) ?></td>
                <td><?= htmlspecialchars($jouet['description']) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>Aucun jouet disponible pour le moment.</p>
    <?php endif; ?>
</section>

<?php
include '..\includes\footer.php';
?>