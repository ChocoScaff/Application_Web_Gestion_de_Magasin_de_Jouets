
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Table</title>
    <link rel='stylesheet' href='../assets/css/style.css'>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
        }
    </style>
    <meta name="viewport" content="with=device-width, initial-scale=1.0">
    <title>Liste</title>
</head>

<body>
<h1> liste des jouets </h1>

<nav>
    <ul>
        <li><a href='clients.php'>Client</a></li>
        <li><a href='commandes.php'>Commande</a></li>
        <li><a href='config.php'>config</a></li>
        <li><a href='fournisseurs.php'>Fournisseur</a></li>
        <li><a href='jouets.php'>jouet</a></li>
   
    </ul>
</nav>

</nav>

<table border="1">
    <tr>
        <th>Nom</th>
        <th>Marque</th>
        <th>Prix</th>
    </tr>

    <?php
    include 'db.php';

    $conn = connectDB();
    if ($conn) {
        $stmt = $conn->query("SELECT nom, marque, prix FROM Jouet");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['nom']) . "</td>";
            echo "<td>" . htmlspecialchars($row['marque']) . "</td>";
            echo "<td>" . htmlspecialchars($row['prix']) . " €</td>";
            echo "</tr>";
        }
    }
    ?>

</table>

</body>
