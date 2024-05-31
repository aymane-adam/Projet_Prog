<!DOCTYPE html>
<html>
<head>
    <title>Génération de matrice</title>
    <style>
        table {
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
        }
    </style>
</head>
<body>
    <form method="post" action="">
        <label for="size">Choisissez la taille de la grille (entre 5 et 16) :</label>
        <input type="number" id="size" name="size" min="5" max="16" required>
        <button type="submit">Générer</button>
    </form>
    <?php 
    // Initialisation de la variable $size
    $size = isset($_POST["size"]) ? $_POST["size"] : null;

    // Exécution du code de génération de matrice si la taille est valide
    if ($_SERVER["REQUEST_METHOD"] == "POST" && $size >= 5 && $size <= 16) {
        // Initialisation de la graine pour la génération de nombres aléatoires
        srand(time());

        // Initialisation de la matrice
        $matrix = array_fill(0, $size, array_fill(0, $size, 0));

        // Placer le 1 à une position aléatoire
        $row1 = rand() % $size;
        $col1 = rand() % $size;
        $matrix[$row1][$col1] = 1;

        // Placer 8, 9, 10, 11 adjacents à 1
        placerAdjacents($matrix, $size, $row1, $col1);

        // Placer le 12 à une position aléatoire non adjacente
        do {
            $row2 = rand() % $size;
            $col2 = rand() % $size;
        } while (sontAdjacents($row1, $col1, $row2, $col2) || ($row2 == $row1 && $col2 == $col1) || $matrix[$row2][$col2] != 0);
        $matrix[$row2][$col2] = 12;

        // Calculer le nombre de zéros à remplacer (40-45% des zéros restants)
        $totalZeros = $size * $size - 7; // 7 positions déjà occupées (1, 8, 9, 10, 11, 12)
        $minZerosToReplace = (int)($totalZeros * 0.40);
        $maxZerosToReplace = (int)($totalZeros * 0.45);
        $numZerosToReplace = $minZerosToReplace + rand(0, $maxZerosToReplace - $minZerosToReplace);

        // Remplacer les zéros par des nombres entre 2 et 7
        $replaced = 0;
        while ($replaced < $numZerosToReplace) {
            $i = rand(0, $size - 1);
            $j = rand(0, $size - 1);
            if ($matrix[$i][$j] == 0) {
                $newValue = rand(2, 7); // Nombres entre 2 et 7
                $matrix[$i][$j] = $newValue;
                $replaced++;
            }
        }

        // Affichage de la matrice
        echo "<table>";
        foreach ($matrix as $row) {
            echo "<tr>";
            foreach ($row as $value) {
                echo "<td>$value</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }

    // Fonction pour vérifier si deux positions sont adjacentes
    function sontAdjacents($row1, $col1, $row2, $col2) {
        return abs($row1 - $row2) <= 1 && abs($col1 - $col2) <= 1;
    }

    // Fonction pour placer une seule valeur parmi 8, 9, 10, 11 adjacentes à la position (row1, col1) du chiffre 1
    function placerAdjacents(&$matrix, $size, $row1, $col1) {
        $valeursAdjacentes = array(8, 9, 10, 11);
        shuffle($valeursAdjacentes); // Mélanger les valeurs pour les placer de manière aléatoire
    
        $directions = array(
            array(-1, 0), // Haut
            array(1, 0),  // Bas
            array(0, -1), // Gauche
            array(0, 1)   // Droite
        );
    
        // Associer chaque valeur avec sa direction respective
        $valeurs_directions = array(
            8 => 0, // Haut
            9 => 1, // Bas
            10 => 2, // Gauche
            11 => 3  // Droite
        );
    
        foreach ($valeursAdjacentes as $valeur) {
            $dirIndex = $valeurs_directions[$valeur];
            $newRow = $row1 + $directions[$dirIndex][0];
            $newCol = $col1 + $directions[$dirIndex][1];
    
            if ($newRow >= 0 && $newRow < $size && $newCol >= 0 && $newCol < $size && $matrix[$newRow][$newCol] == 0) {
                $matrix[$newRow][$newCol] = $valeur;
                break;
            }
        }
    }

?>
</body>
</html>
