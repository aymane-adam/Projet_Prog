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
                    echo '<td><div class="drop-box" style="height: 100%; width: 100%;"></div></td>';
                }
                echo "</tr>";
            }
            echo "</table>";
        }

        if(array_key_exists('button1', $_POST)){
            $tailles = intval($_POST['taille']);
            Grille($tailles, $tailles);
        }
    ?>

    <div class="image-container">
        <img src="../pixel_art_projet/32x32/bateau.png" draggable="true" id="image1" alt="Boat">
        <img src="../pixel_art_projet/32x32/guardianclose.png" draggable="true" id="image2" alt="Guardian">
        <img src="../pixel_art_projet/32x32/krabby.png" draggable="true" id="image3" alt="Krabby">
        <img src="../pixel_art_projet/32x32/pieuvre.png" draggable="true" id="image4" alt="Krakken">
        <img src="../pixel_art_projet/32x32/rock.png" draggable="true" id="image5" alt="Rock">
        <img src="../pixel_art_projet/32x32/rock1.png" draggable="true" id="image6" alt="Rock1">
        <img src="../pixel_art_projet/32x32/vague.png" draggable="true" id="image7" alt="Vague">
        <img src="../pixel_art_projet/32x32/la_main.png" draggable="true" id="image8" alt="hand">
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const images = document.querySelectorAll(".image-container img");

            images.forEach(image => {
                image.addEventListener("dragstart", function(event) {
                    event.dataTransfer.setData("text/plain", event.target.id);
                });
            });

            const dropBoxes = document.querySelectorAll(".drop-box");

            dropBoxes.forEach(box => {
                box.addEventListener("dragover", function(event) {
                    event.preventDefault();
                });

                box.addEventListener("drop", function(event) {
                    event.preventDefault();
                    const imageId = event.dataTransfer.getData("text/plain");
                    const draggableElement = document.getElementById(imageId).cloneNode(true);
                    event.target.innerHTML = ''; // Clear any existing content
                    event.target.appendChild(draggableElement);
                });
            });
        });
    </script>
</body>
</html>