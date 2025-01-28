<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Clients</title>
    <link rel='stylesheet' href='../assets/css/style.css'>
    <style>
        table, th, td { 
            border: 1px solid black;
            border-collapse: collapse;
            padding: 8px;
        }
        .client-row:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>
    <h1>Liste des Clients</h1>
    <?php include 'nav.php'; ?>

    <table>
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Téléphone</th>
            <th>Actions</th>
        </tr>
        <tbody id="clients-list"></tbody>
    </table>

    <script>
        fetch('../backend/clients.php')
            .then(response => response.json())
            .then(clients => {
                const tbody = document.getElementById('clients-list');
                clients.forEach(client => {
                    tbody.innerHTML += `
                        <tr class="client-row">
                            <td>${client.nom}</td>
                            <td>${client.prenom}</td>
                            <td>${client.email}</td>
                            <td>${client.telephone || '-'}</td>
                            <td>
                                <button onclick="voirCommandes(${client.id_client})">Voir commandes</button>
                            </td>
                        </tr>
                    `;
                });
            })
            .catch(error => console.error('Erreur:', error));

        function voirCommandes(clientId) {
            window.location.href = `commandes.php?client=${clientId}`;
        }
    </script>
</body>
</html>