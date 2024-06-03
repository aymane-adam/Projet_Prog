<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Niveaux</title>
    <link rel="stylesheet" href="../css/community.css">
</head>
<body>
<a href="game.php" class="back-arrow"><img src="../img/bouton_retour.png" alt="Back"></a>
    <!-- <img src=../img/communitymode.png class="logo" alt="community"> -->
    <br><br><br>
    <h1>Community levels</h1>
    <div class="search-container">
        <input type="text" id="searchBox" placeholder="Chercher par ID...">
        <button onclick="searchLevel()">Chercher</button>
    </div>
    <div class="sort-container">
        <button onclick="sortLevels('date')">Plus récent</button>
        <button onclick="sortLevels('difficulty')">Difficulté</button>
    </div>
    <table id="levelsTable">
        <thead>
            <tr>
                <th>Nom du Niveau</th>
                <th>Pseudo du Créateur</th>
                <th>Difficulté</th>
                <th>Nombre d'Étoiles</th>
                <th>ID</th>
            </tr>
        </thead>
        <tbody>
            <!-- Les données seront injectées ici via JavaScript -->
        </tbody>
    </table>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
    fetchLevels();

    // Simuler une fonction de recherche par ID
    window.searchLevel = function() {
        const id = document.getElementById('searchBox').value;
        fetchLevels(id);
    }

    // Simuler une fonction de tri
    window.sortLevels = function(method) {
        fetchLevels(null, method);
    }
});

function fetchLevels(searchId = null, sortMethod = null) {
    // Ici vous intégreriez l'appel AJAX/Fetch à votre API backend
    console.log("Recherche ID:", searchId, "Méthode de tri:", sortMethod);
    // Mettez à jour le DOM en fonction des données récupérées
}


    </script>

</body>
</html>
