<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un jouet</title>
    <link rel='stylesheet' href='../assets/css/style.css'>
    <style>
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input {
            padding: 8px;
            width: 300px;
        }
        .error {
            color: red;
            margin-top: 5px;
        }
        .success {
            color: green;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <h1>Ajouter un nouveau jouet</h1>
    <?php include 'nav.php'; ?>

    <form id="ajoutJouetForm">
        <div class="form-group">
            <label for="nom">Nom du jouet:</label>
            <input type="text" id="nom" name="nom" required>
        </div>

        <div class="form-group">
            <label for="prix">Prix:</label>
            <input type="number" id="prix" name="prix" step="0.01" min="0" required>
        </div>

        <div class="form-group">
            <label for="editeur">Éditeur:</label>
            <input type="text" id="editeur" name="editeur" required>
        </div>

        <div class="form-group">
            <label for="marque">Marque:</label>
            <input type="text" id="marque" name="marque" required>
        </div>

        <button type="submit">Ajouter le jouet</button>
    </form>

    <div id="message"></div>

    <script>
        document.getElementById('ajoutJouetForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = {
                nom: document.getElementById('nom').value,
                prix: document.getElementById('prix').value,
                editeur: document.getElementById('editeur').value,
                marque: document.getElementById('marque').value
            };

            fetch('../backend/ajouter.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(formData)
            })
            .then(response => response.json())
            .then(data => {
                const messageDiv = document.getElementById('message');
                if (data.success) {
                    messageDiv.className = 'success';
                    messageDiv.textContent = 'Jouet ajouté avec succès!';
                    document.getElementById('ajoutJouetForm').reset();
                } else {
                    messageDiv.className = 'error';
                    messageDiv.textContent = 'Erreur: ' + data.message;
                }
            })
            .catch(error => {
                document.getElementById('message').className = 'error';
                document.getElementById('message').textContent = 'Erreur lors de l\'ajout du jouet';
                console.error('Erreur:', error);
            });
        });
    </script>
</body>
</html>