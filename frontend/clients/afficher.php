<?php
include '../../backend/clients.php';
include '../includes\header.php';
$clients = getClients();
?>

<h1>Liste des Clients</h1>
<table border="1">
    <tr>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Email</th>
        <th>Adresse</th>
        <th>Téléphone</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($clients as $client): ?>
    <tr>
        <td><?= htmlspecialchars($client['nom']) ?></td>
        <td><?= htmlspecialchars($client['prenom']) ?></td>
        <td><?= htmlspecialchars($client['email']) ?></td>
        <td><?= htmlspecialchars($client['adresse']) ?></td>
        <td><?= htmlspecialchars($client['telephone']) ?></td>
        <td>
            <a href="modifier.php?id=<?= $client['id'] ?>">Modifier</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php include '../includes\footer.php'; ?>