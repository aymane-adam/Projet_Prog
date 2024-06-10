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

<div id="levels-table">
    <?php
        require("bdd.php");

        // Get parameters for filtering and sorting
        $idFilter = isset($_GET['id']) ? intval($_GET['id']) : null;
        $sortMethod = isset($_GET['sort']) ? $_GET['sort'] : null;

        // Build the query based on the parameters
        $query = "SELECT nom_niveau, createur, type_niveau, id_niveau FROM niveaux";
        if ($idFilter !== null) {
            $query .= " WHERE id_niveau = :id";
        }

        if ($sortMethod === 'date') {
            $query .= " ORDER BY date_creation DESC"; // Assurez-vous que la colonne date_creation existe
        } elseif ($sortMethod === 'difficulty') {
            $query .= " ORDER BY difficulte ASC"; // Assurez-vous que la colonne difficulte existe
        }

        $stmt = $conn->prepare($query);

        if ($idFilter !== null) {
            $stmt->bindParam(':id', $idFilter, PDO::PARAM_INT);
        }

        $stmt->execute();
        $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo "<table>
                <tr>
                    <th>Nom du Niveau</th>
                    <th>Pseudo</th>
                    <th>Type de niveau</th>
                    <th>ID</th>
                    <th>Sélectionner</th>
                </tr>";
        foreach($resultat as $val){
            echo "<tr>
                    <td>".$val['nom_niveau']."</td>
                    <td>".$val['createur']."</td>";
                    if($val['type_niveau'] == 2){
                        echo "<td>Créer par un utilisateur</td>";
                    }
                    if($val['type_niveau'] == 3){
                        echo "<td>Créer aléatoirement</td>";
                    }
                    echo "<td>".$val['id_niveau']."</td>
                          <td><a href='level.php?id=".$val['id_niveau']."'>Sélectionner</a></td>
                </tr>";
        }
        echo "</table>";
    ?>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        fetchLevels();

        window.searchLevel = function() {
            const id = document.getElementById('searchBox').value;
            fetchLevels(id);
        }

        window.sortLevels = function(method) {
            fetchLevels(null, method);
        }
    });

    function fetchLevels(searchId = null, sortMethod = null) {
        const params = new URLSearchParams();
        if (searchId) params.append('id', searchId);
        if (sortMethod) params.append('sort', sortMethod);

        fetch(window.location.pathname + '?' + params.toString())
            .then(response => response.text())
            .then(data => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(data, 'text/html');
                document.getElementById('levels-table').innerHTML = doc.getElementById('levels-table').innerHTML;
            })
            .catch(error => console.error('Error fetching levels:', error));
    }
</script>

</body>
</html>
