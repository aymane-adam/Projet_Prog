<!DOCTYPE html>
<html>
<head>
    <title>Génération de matrice</title>
    <link rel="stylesheet" href="../css/test_editeur2.css">
</head>
<body>
    <form method="post" action="">
        <label for="size">Choisissez la taille de la grille (entre 4 et 16) :</label>
        <input type="number" id="size" name="size" min="4" max="16" required>
        <button type="submit" name="button1">Générer</button>
    </form>

    <?php
    // Démarrer la session
    session_start();

    // Initialisation de la variable $size
    $size = isset($_POST["size"]) ? $_POST["size"] : null;

    // Exécution du code de génération de matrice si la taille est valide
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["button1"]) && $size >= 4 && $size <= 16) {
        // Initialisation de la graine pour la génération de nombres aléatoires
        srand(time());
        echo '<form method="post" action="">
        <label for="nom_niveau">Nom du niveau</label>
        <input type="text" id="nom_niveau" name="nom_niveau" required>
        <button type="submit" name="button2">Save</button>
        </form>';
        
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

        // Définition des images
        $images = [
            1 => "bateau.png",
            2 => "guardianclose.png",
            3 => "krabby.png",
            4 => "pieuvre.png",
            5 => "rock.png",
            6 => "rock1.png",
            7 => "vague.png",
            8 => "arrow_n.png",
            9 => "arrow_s.png",
            10 => "arrow_w.png",
            11 => "arrow_e.png",
            12 => "chest5.png"
        ];

        function afficherGrille($matrice, $images) {
            echo "<table id='grid'>";
            foreach ($matrice as $ligneIdx => $ligne) {
                echo "<tr>";
                foreach ($ligne as $celluleIdx => $cellule) {
                    echo "<td data-row='$ligneIdx' data-col='$celluleIdx'>";
                    if ($cellule !== 0 && isset($images[$cellule])) {
                        echo '<img src="../pixel_art_projet/32x32/' . $images[$cellule] . '" alt="Image" class="drop-box" data-value="'.$cellule.'">';
                    } else {
                        echo '<div class="drop-box" data-value="0"></div>';
                    }
                    echo "</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        }

        // Afficher la grille générée
        afficherGrille($matrix, $images);

        // Stocker la matrice dans la session
        $_SESSION['matrix'] = $matrix;
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

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["button2"])) {
        if (empty($_POST["nom_niveau"])) {
            echo "Veuillez mettre un nom pour le niveau";
        } else {
            require("bdd.php");
            $nom_niveau = $_POST["nom_niveau"];
            $contenu = [
                "fleche_n" => 0,
                "fleche_s" => 0,
                "fleche_o" => 0,
                "fleche_e" => 0,
                "matrix" => json_encode(isset($_SESSION["matrix"]) ? $_SESSION["matrix"] : null),
            ];
            if ($contenu) {
                // Assurez-vous que la variable de session 'pseudo' est définie
                $createur = isset($_SESSION['pseudo']) ? $_SESSION['pseudo'] : 'inconnu';
                $type_niveau = 3;
                $sql1 = $conn->prepare("INSERT INTO niveaux (nom_niveau, contenu, createur, type_niveau) VALUES (:nom_niveau, :contenu, :createur, :type_niveau)");
                $sql1->execute(array(
                    ':nom_niveau' => $nom_niveau,
                    ':contenu' => json_encode($contenu),
                    ':createur' => $createur,
                    ':type_niveau' => $type_niveau,
                ));
                echo "Le niveau a été enregistré avec succès";
            } else {
                echo "Erreur : La matrice n'a pas été générée correctement.";
            }
        }
    }
    ?>
</body>
</html>
