<?php
include '../../backend/fournisseurs.php';
include '../includes/header.php';
?>
<link rel="stylesheet" href="../../assets/styles.css">

<?php
$fournisseurs = getFournisseurs();
?>

<h1>Liste des Fournisseurs</h1>
<table border="1">
    <tr>
        <th>Nom</th>
        <th>Email</th>
        <th>Téléphone</th>
        <th>Adresse</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($fournisseurs as $fournisseur): ?>
        <tr>
            <td><?= htmlspecialchars($fournisseur['nom']) ?></td>
            <td><?= htmlspecialchars($fournisseur['email']) ?></td>
            <td><?= htmlspecialchars($fournisseur['telephone']) ?></td>
            <td><?= htmlspecialchars($fournisseur['adresse']) ?></td>
            <td>
                <a href="modifier.php?id=<?= $fournisseur['id'] ?>">Modifier</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<?php include '../includes/footer.php'; ?>