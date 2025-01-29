<?php
// Menu de navigation commun
?>
<nav>
    <ul>
        <li><a href="/Application_Web_Gestion_de_Magasin_de_Jouets/frontend/index.php" class="dropbtn" >Accueil</a></li>

        <li class="dropdown">
            <a href="/Application_Web_Gestion_de_Magasin_de_Jouets/frontend/jouets/afficher.php" class="dropbtn">Jouets</a>
            <div class="dropdown-content">
                <a href="/Application_Web_Gestion_de_Magasin_de_Jouets/frontend/jouets/ajouter.php">Ajouter un Jouet</a>
                <a href="/Application_Web_Gestion_de_Magasin_de_Jouets/frontend/jouets/afficher.php">Voir tous les Jouets</a>
            </div>
        </li>

        <li class="dropdown">
            <a href="/Application_Web_Gestion_de_Magasin_de_Jouets/frontend/clients/afficher.php" class="dropbtn">Clients</a>
            <div class="dropdown-content">
                <a href="/Application_Web_Gestion_de_Magasin_de_Jouets/frontend/clients/ajouter.php">Ajouter un Client</a>
                <a href="/Application_Web_Gestion_de_Magasin_de_Jouets/frontend/clients/afficher.php">Voir tous les Clients</a>
            </div>
        </li>

        <li class="dropdown">
            <a href="/Application_Web_Gestion_de_Magasin_de_Jouets/frontend/commandes/afficher.php" class="dropbtn">Commandes</a>
            <div class="dropdown-content">
                <a href="/Application_Web_Gestion_de_Magasin_de_Jouets/frontend/commandes/creer.php">Créer une Commande</a>
                <a href="/Application_Web_Gestion_de_Magasin_de_Jouets/frontend/commandes/afficher.php">Voir les Commandes</a>
            </div>
        </li>

        <li class="dropdown">
            <a href="/Application_Web_Gestion_de_Magasin_de_Jouets/frontend/fournisseurs/afficher.php" class="dropbtn">Fournisseurs</a>
            <div class="dropdown-content">
                <a href="/Application_Web_Gestion_de_Magasin_de_Jouets/frontend/fournisseurs/ajouter.php">Ajouter un Fournisseur</a>
                <a href="/Application_Web_Gestion_de_Magasin_de_Jouets/frontend/fournisseurs/afficher.php">Voir tous les Fournisseurs</a>
            </div>
        </li>
    </ul>
</nav>
