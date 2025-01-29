<?php
include 'C:\\xampp\\htdocs\\tp-php\\backend\\jouets.php';
include 'C:\\xampp\\htdocs\\tp-php\\backend\\db.php';
include 'C:\\xampp\\htdocs\\tp-php\\frontend\\includes\\header.php';

// Vérifier si un ID est fourni
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Erreur : Aucun jouet spécifié.");
}

$id = intval($_GET['id']);
$jouet = getJouetById($id);

if (!$jouet) {
    die("Erreur : Jouet non trouvé.");
}

// Suppression après confirmation
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm'])) {
    supprimerJouet($id);
    echo "<p style='color:green;'>Jouet supprimé avec succès !</p>";
    echo "<a href='/tp-php/frontend/jouets/afficher.php'>Retour à la liste des jouets</a>";
    exit;
}
?>

<h1>Supprimer un Jouet</h1>
<p>Voulez-vous vraiment supprimer le jouet <strong><?= htmlspecialchars($jouet['nom']) ?></strong> ?</p>

<form method="post">
    <button type="submit" name="confirm" value="1">Oui, Supprimer</button>
    <a href="/tp-php/frontend/jouets/afficher.php">Annuler</a>
</form>

<?php include 'C:\\xampp\\htdocs\\tp-php\\frontend\\includes\\footer.php'; ?>
