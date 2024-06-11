<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Niveaux</title>
    <link rel="stylesheet" href="../css/community.css">
</head>
<body>
<img src="../img/communitymode.png" alt="Community" class="logo">
<a href="game.php" class="back-arrow"><img src="../img/bouton_retour.png" alt="Back"></a>
<div class="search-container">
    <input type="text" id="searchBox" placeholder="Search by ID or nickname...">
    <button onclick="searchLevel()">Search</button>
</div>
<div class="sort-container">
    <button onclick="sortLevels('date')">More recent</button>
    <button onclick="sortLevels('difficulty')">Difficulty</button>
</div>

<div id="levels-table">
    <?php
        require("bdd.php");

        $idFilter = isset($_GET['id']) ? intval($_GET['id']) : null;
        $nameFilter = isset($_GET['nom_niveau']) ? $_GET['nom_niveau'] : null;
        $sortMethod = isset($_GET['sort']) ? $_GET['sort'] : null;

        $query = "SELECT nom_niveau, createur, type_niveau, id_niveau FROM niveaux";
        $conditions = [];

        if ($idFilter !== null) {
            $conditions[] = "id_niveau = :id";
        }
        if ($nameFilter !== null) {
            $conditions[] = "nom_niveau LIKE :nom_niveau";
        }

        if (!empty($conditions)) {
            $query .= " WHERE " . implode(" AND ", $conditions);
        }

        if ($sortMethod !== null) {
            if ($sortMethod == 'date') {
                $query .= " ORDER BY date_creation DESC";
            } elseif ($sortMethod == 'difficulty') {
                $query .= " ORDER BY difficulty ASC";
            }
        }

        $stmt = $conn->prepare($query);

        if ($idFilter !== null) {
            $stmt->bindParam(':id', $idFilter, PDO::PARAM_INT);
        }
        if ($nameFilter !== null) {
            $likeNameFilter = "%".$nameFilter."%";
            $stmt->bindParam(':nom_niveau', $likeNameFilter, PDO::PARAM_STR);
        }

        $stmt->execute();
        $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo "<table>
                <tr>
                    <th>Name of level</th>
                    <th>Nickname</th>
                    <th>Type of level</th>
                    <th>ID</th>
                    <th>Select</th>
                </tr>";
        foreach($resultat as $val){
            if($val['type_niveau'] != 1){
                echo "<tr>
                        <td>".$val['nom_niveau']."</td>
                        <td>".$val['createur']."</td>";
                if($val['type_niveau'] == 2){
                    echo "<td>Created by a user</td>";
                }
                if($val['type_niveau'] == 3){
                    echo "<td>Created randomly</td>";
                }
                echo "<td>".$val['id_niveau']."</td>
                      <td><a href='level.php?id=".$val['id_niveau']."'>Play</a></td>
                    </tr>";
            }
        }
        echo "</table>";
    ?>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        fetchLevels();

        window.searchLevel = function() {
            const searchValue = document.getElementById('searchBox').value;
            if (isNaN(searchValue)) {
                fetchLevels(null, null, searchValue);
            } else {
                fetchLevels(searchValue);
            }
        }

        window.sortLevels = function(method) {
            fetchLevels(null, method);
        }
    });

    function fetchLevels(searchId = null, sortMethod = null, searchName = null) {
        const params = new URLSearchParams();
        if (searchId) params.append('id', searchId);
        if (searchName) params.append('nom_niveau', searchName);
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
