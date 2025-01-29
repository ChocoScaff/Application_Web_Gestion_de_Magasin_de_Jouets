<?php
// En-tête HTML commun
$base_url = '/Application_Web_Gestion_de_Magasin_de_Jouets/'; // Point de départ du projet
?>
<!DOCTYPE html>
<html lang="fr">

<link rel="stylesheet" href="../../assets/styles.css">  

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Magasin de Jouets</title>
    <link rel="stylesheet" href="<?= $base_url ?>assets/styles.css"> <!-- Chemin absolu vers le CSS -->
</head>

<body>
    <header>
        <h1>Magasin de Jouets</h1>
        <?php include $_SERVER['DOCUMENT_ROOT'] . $base_url . 'frontend/includes/menu.php'; ?>
    </header>
