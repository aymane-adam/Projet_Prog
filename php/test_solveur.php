<!DOCTYPE html>
<html>
<head>
    <title>Test solveur</title>
    <link rel="stylesheet" href="../css/test_editeur2.css">
</head>
<body>
<?php
session_start();
echo '<form method="post" class="nom" action="">
            <label for="nom_niveau">Nom du niveau</label>
            <input type="text" id="nom_niveau" name="nom_niveau" required>
            <button type="submit" name="button2">Save</button>
            </form>';
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
            afficherGrille($_SESSION['matrix'], $images);
?>
</body>
</html>