<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Commandes</title>
    <link rel='stylesheet' href='../assets/css/style.css'>
    <style>
        table, th, td { 
            border: 1px solid black;
            border-collapse: collapse;
            padding: 8px;
        }
        .commande-details {
            margin-top: 20px;
            padding: 10px;
            background-color: #f9f9f9;
        }
        .total {
            font-weight: bold;
            color: #2c3e50;
        }
    </style>
</head>
<body>
    <h1>Liste des Commandes</h1>
    <?php include 'nav.php'; ?>

    <div id="filtres">
        <label for="client">Filtrer par client :</label>
        <select id="client" onchange="filtrerCommandes()">
            <option value="">Tous les clients</option>
        </select>
    </div>

    <table>
        <tr>
            <th>N° Commande</th>
            <th>Client</th>
            <th>Date</th>
            <th>Total</th>
            <th>Détails</th>
        </tr>
        <tbody id="commandes-list"></tbody>
    </table>

    <div id="details-commande" class="commande-details" style="display: none;">
        <h3>Détails de la commande</h3>
        <div id="details-content"></div>
    </div>

    <script>
        const urlParams = new URLSearchParams(window.location.search);
        const clientFilter = urlParams.get('client');

        function chargerCommandes() {
            const url = clientFilter ? 
                `../backend/commandes.php?client=${clientFilter}` :
                '../backend/commandes.php';

            fetch(url)
                .then(response => response.json())
                .then(commandes => {
                    const tbody = document.getElementById('commandes-list');
                    tbody.innerHTML = '';
                    commandes.forEach(commande => {
                        tbody.innerHTML += `
                            <tr>
                                <td>${commande.id_commande}</td>
                                <td>${commande.nom_client} ${commande.prenom_client}</td>
                                <td>${new Date(commande.date_commande).toLocaleDateString()}</td>
                                <td class="total">${commande.total} €</td>
                                <td>
                                    <button onclick="voirDetails(${commande.id_commande})">Voir détails</button>
                                </td>
                            </tr>
                        `;
                    });
                })
                .catch(error => console.error('Erreur:', error));
        }

        function voirDetails(commandeId) {
            fetch(`../backend/commande.php?id=${commandeId}`)
                .then(response => response.json())
                .then(details => {
                    const detailsDiv = document.getElementById('details-content');
                    let html = '<table><tr><th>Jouet</th><th>Quantité</th><th>Prix unitaire</th><th>Sous-total</th></tr>';
                    
                    details.produits.forEach(prod => {
                        html += `
                            <tr>
                                <td>${prod.nom_jouet}</td>
                                <td>${prod.quantite}</td>
                                <td>${prod.prix} €</td>
                                <td>${(prod.prix * prod.quantite).toFixed(2)} €</td>
                            </tr>
                        `;
                    });
                    
                    html += `<tr class="total"><td colspan="3">Total</td><td>${details.total} €</td></tr></table>`;
                    detailsDiv.innerHTML = html;
                    document.getElementById('details-commande').style.display = 'block';
                })
                .catch(error => console.error('Erreur:', error));
        }

        // Chargement initial
        chargerCommandes();
    </script>
</body>
</html>