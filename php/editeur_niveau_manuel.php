<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Grille PHP</title>
    <link rel="stylesheet" href="../css/editeur.css">
</head>
<body>
    <form method="post" action="#">
        <label for="taille">Taille :</label>
        <input type="number" id="taille" name="taille" min="4" max="16" value="16">
        <input type="submit" name="button1" class="button" value="Créer la grille" />
    </form>

    <?php
        function Grille($lignes, $colonnes) {
            echo "<table>";
            for ($i = 0; $i < $lignes; $i++) {
                echo "<tr>";
                for ($j = 0; $j < $colonnes; $j++) {
                    echo "<td></td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        }
        if(array_key_exists('button1', $_POST)){
            $lignes = intval($_POST['taille']);
            Grille($lignes, $lignes);
        }
    ?>
    <button type="submit" class="image-button">
        <img src="../pixel_art_projet/32x32/bateau.png" alt="Bateau">
    </button>

    <script>
        //drag and drops
    </script>
</body>
</html>
