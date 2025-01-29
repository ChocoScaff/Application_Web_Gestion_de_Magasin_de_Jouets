<?php
include '..\backend\db.php';
include './includes/header.php';
?>

<!DOCTYPE html>
<html lang="fr">

<link rel="stylesheet" href="../assets/styles.css">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Magasin de Jouets</title>
    <script src="../assets/script.js"></script>
</head>


<body>
    <main>
        <section>
            <h2>Gestion des Jouets</h2>
            <p><a href="jouets/ajouter.php">Ajouter un Jouet</a> | <a href="jouets/afficher.php">Voir tous les
                    Jouets</a></p>
        </section>

        <section>
            <h2>Gestion des Clients</h2>
            <p><a href="clients/ajouter.php">Ajouter un Client</a> | <a href="clients/afficher.php">Voir tous les
                    Clients</a></p>
        </section>

        <section>
            <h2>Gestion des Commandes</h2>
            <p><a href="commandes/creer.php">Créer une Commande</a> | <a href="commandes/afficher.php">Voir les
                    Commandes</a></p>
        </section>

        <section>
            <h2>Gestion des Fournisseurs</h2>
            <p><a href="fournisseurs/ajouter.php">Ajouter un Fournisseur</a> | <a href="fournisseurs/afficher.php">Voir
                    tous les Fournisseurs</a></p>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Magasin de Jouets. Tous droits réservés.</p>
    </footer>
</body>

</html>