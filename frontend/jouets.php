<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Liste des jouets</title>
    <link rel='stylesheet' href='../assets/css/style.css'>
    <style>
        table, th, td { border: 1px solid black; }
    </style>
</head>
<body>
    <h1>Liste des jouets</h1>
    <?php include 'nav.php'; ?>
    
    <table border="1">
        <tr>
            <th>Nom</th>
            <th>Marque</th>
            <th>Prix</th>
        </tr>
        <tbody id="jouets-list"></tbody>
    </table>

    <script>
        fetch('../backend/jouets.php')
            .then(response => response.json())
            .then(jouets => {
                const tbody = document.getElementById('jouets-list');
                jouets.forEach(jouet => {
                    tbody.innerHTML += `
                        <tr>
                            <td>${jouet.nom}</td>
                            <td>${jouet.marque}</td>
                            <td>${jouet.prix} €</td>
                        </tr>
                    `;
                });
            })
            .catch(error => console.error('Erreur:', error));
    </script>
</body>
</html>