<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Niveaux</title>
    <link rel="stylesheet" href="../css/community.css">
</head>
<body>
<a href="game.php" class="back-arrow"><img src="../img/bouton_retour.png" alt="Back"></a>
    <div class="search-container">
        <input type="text" id="searchBox" placeholder="Chercher par ID...">
        <button onclick="searchLevel()">Chercher</button>
    </div>
    <div class="sort-container">
        <button onclick="sortLevels('date')">Plus récent</button>
        <button onclick="sortLevels('difficulty')">Difficulté</button>
    </div>
    <!-- <table id="levelsTable">
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
        </tbody>
    </table> -->
    <?php
        require("bdd.php");
        $sql1 = $conn->prepare("SELECT nom_niveau, createur, type_niveau, id_niveau FROM niveaux");
        $sql1->execute();
        $resultat = $sql1->fetchAll(PDO::FETCH_ASSOC);

        echo "<table>
                <tr>
                    <th>Nom du Niveau</th>
                    <th>Pseudo</th>
                    <th>difficulté</th>
                    <th>id</th>
                </tr>";
        foreach($resultat as $val){
            echo "<tr>
                    <td>".$val['nom_niveau']."</td>
                    <td>".$val['createur']."</td>
                    <td>".$val['type_niveau']."</td>
                    <td>".$val['id_niveau']."</td>
                </tr>";
        }

    ?>
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
