<!DOCTYPE html>
<?php session_start(); ?>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Grille PHP</title>
    <link rel="stylesheet" href="../css/editeur.css">
   
</head>
<body>
    <div class="container">
        <div class="form-container">
            <form method="post" action="#">
                <label for="taille">Taille :</label>
                <input type="number" id="taille" name="taille" min="4" max="16" value="<?php echo isset($_POST['taille']) ? $_POST['taille'] : 5; ?>">
                <input type="submit" name="button1" class="button" value="Créer la grille" />
                <!-- Champ caché pour stocker la matrice -->
            </form>

            <form method="post">
                <label for="nom">Nom du niveau :</label>
                <input type="text" id="nom" name="nom">
                <input type="hidden" id="matrix" name="matrix" value="">
                <input type="submit" name="button2" id="finish-button" class="button" value="Terminer"/>
            </form>
        </div>

        <?php
        $tailleGrille = 0;
        if (array_key_exists('button1', $_POST)) {
            $tailleGrille = intval($_POST['taille']);
        }
        if (array_key_exists('button2', $_POST)){
            if(isset($_POST["nom"]) && empty($_POST["nom"])){
                echo "Veuillez mettre un nom pour le niveau";
            }
            else{
                require("bdd.php");
                $nom = $_POST["nom"];
                $nom_niveau = $nom;
                $matrix = $_POST['matrix'];
                $createur = $_SESSION["pseudo"];
                $sql1 = $conn->prepare("INSERT INTO niveaux (nom_niveau, contenu, createur) VALUES (:nom_niveau, :contenu, :createur)");
                $sql1->execute(
                    array(
                        ':nom_niveau' => $nom_niveau,
                        ':contenu' => $matrix,
                        ':createur' => $createur,
                    ));
            }
        }
        function Grille($lignes, $colonnes) {
            echo "<table>";
            for ($i = 0; $i < $lignes; $i++) {
                echo "<tr>";
                for ($j = 0; $j < $colonnes; $j++) {
                    echo '<td><div class="drop-box" data-x="'.$i.'" data-y="'.$j.'" style="height: 100%; width: 100%;"></div></td>';
                }
                echo "</tr>";
            }
            echo "</table>";
        }

        Grille($tailleGrille, $tailleGrille);
        ?>

        <div id="matrix-display"></div> 
    </div>
   
    <div>
        <img src="../img/top-coffre.png"  class="bottomt">
    </div>
    <div class="gogogo">
    <div>
        <img src="../img/bottom-coffre.png"  class="bottomc">
    </div>
    <div class="inventory-container">
        <div class="inventory-title">inventory</div>
        <div class="image-container">
            <img src="../pixel_art_projet/32x32/bateau.png" draggable="true" id="image1" alt="Boat" data-value="1">
            <img src="../pixel_art_projet/32x32/chest5.png" draggable="true" id="image12" alt="tresor" data-value="12">
            <img src="../pixel_art_projet/32x32/guardianclose.png" draggable="true" id="image2" alt="Guardian" data-value="2">
            <img src="../pixel_art_projet/32x32/krabby.png" draggable="true" id="image3" alt="Krabby" data-value="3">
            <img src="../pixel_art_projet/32x32/pieuvre.png" draggable="true" id="image4" alt="Krakken" data-value="4">
            <img src="../pixel_art_projet/32x32/rock.png" draggable="true" id="image5" alt="Rock" data-value="5">
            <img src="../pixel_art_projet/32x32/rock1.png" draggable="true" id="image6" alt="Rock1" data-value="6">
            <img src="../pixel_art_projet/32x32/vague.png" draggable="true" id="image7" alt="Vague" data-value="7">
            <img src="../pixel_art_projet/32x32/nord.png" draggable="true" id="image9" alt="Nord" data-value="8">
            <img src="../pixel_art_projet/32x32/sud.png" draggable="true" id="image8" alt="Sud" data-value="9">
            <img src="../pixel_art_projet/32x32/ouest.png" draggable="true" id="image10" alt="Ouest" data-value="10">
            <img src="../pixel_art_projet/32x32/est.png" draggable="true" id="image11" alt="Est" data-value="11">
        </div>
        <!-- Section de corbeille -->
        <div class="trash-container">
            <img src="../pixel_art_projet/32x32/trash.png">
        </div>
    </div>

    </div>
    

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const images = document.querySelectorAll(".image-container img");
            let isBoatPlaced = false;
            let boatPosition = null;
            let isDirectionPlaced = false;
            const directionImages = ["image8", "image9", "image10", "image11"];
            let isChestPlaced = false;
            let gridMatrix = [];

            const gridSize = <?php echo $tailleGrille; ?>;
            for (let i = 0; i < gridSize; i++) {
                gridMatrix[i] = new Array(gridSize).fill(0);
            }

            images.forEach(image => {
                image.addEventListener("dragstart", function(event) {
                    event.dataTransfer.setData("text/plain", event.target.id);
                });
            });

            const dropBoxes = document.querySelectorAll(".drop-box");

            dropBoxes.forEach((box, index) => {
                box.addEventListener("dragover", function(event) {
                    event.preventDefault();
                });

                box.addEventListener("drop", function(event) {
                    event.preventDefault();
                    const imageId = event.dataTransfer.getData("text/plain");
                    const value = parseInt(document.getElementById(imageId).getAttribute("data-value"));
                    const x = parseInt(box.getAttribute("data-x"));
                    const y = parseInt(box.getAttribute("data-y"));

                    if (imageId === "image1" && isBoatPlaced) {
                        alert("Le bateau ne peut être placé qu'une seule fois dans la grille.");
                        return;
                    }

                    if (directionImages.includes(imageId) && !isBoatPlaced) {
                        alert("Placez d'abord le bateau avant de placer une direction.");
                        return;
                    }

                    if (directionImages.includes(imageId) && isDirectionPlaced) {
                        alert("Une seule image parmi nord, sud, est, ouest peut être placée dans la grille.");
                        return;
                    }

                    if (directionImages.includes(imageId) && isBoatPlaced) {
                        const validPlacement = checkValidPlacement(imageId, x, y, boatPosition);
                        if (!validPlacement) {
                            alert("Placement invalide par rapport au bateau.");
                            return;
                        }
                    }

                    if (imageId === "image12" && isChestPlaced) {
                        alert("Le trésor ne peut être placé qu'une seule fois dans la grille.");
                        return;
                    }

                    const draggableElement = document.getElementById(imageId).cloneNode(true);
                    draggableElement.addEventListener("dragstart", function(event) {
                        event.dataTransfer.setData("text/plain", event.target.id);
                    });
                    event.target.innerHTML = ''; // Clear any existing content
                    event.target.appendChild(draggableElement);

                    gridMatrix[x][y] = value;
                    updateMatrixDisplay();

                    if (imageId === "image1") {
                        isBoatPlaced = true;
                        boatPosition = { x: x, y: y };
                    } else if (directionImages.includes(imageId)) {
                        isDirectionPlaced = true;
                    } else if (imageId === "image12") {
                        isChestPlaced = true;
                    }
                });
            });

            const trashContainer = document.querySelector(".trash-container");

            trashContainer.addEventListener("dragover", function(event) {
                event.preventDefault();
            });

            trashContainer.addEventListener("drop", function(event) {
                event.preventDefault();
                const imageId = event.dataTransfer.getData("text/plain");
                const draggableElement = document.getElementById(imageId);
                if (draggableElement.parentElement.classList.contains("drop-box")) {
                    const box = draggableElement.parentElement;
                    const x = parseInt(box.getAttribute("data-x"));
                    const y = parseInt(box.getAttribute("data-y"));

                    box.innerHTML = ''; // Remove the image from the drop box
                    gridMatrix[x][y] = 0;  // STOCKAGE DE LA MATRICE
                    updateMatrixDisplay();

                    if (imageId === "image1") {
                        isBoatPlaced = false;
                        boatPosition = null;
                    } else if (directionImages.includes(imageId)) {
                        isDirectionPlaced = false;
                    } else if (imageId === "image12") {
                        isChestPlaced = false;
                    }
                }
            });

            function checkValidPlacement(imageId, x, y, boatPosition) {
                switch (imageId) {
                    case "image8": // nord
                        return (x === boatPosition.x + 1 && y === boatPosition.y);
                    case "image9": // sud
                        return (x === boatPosition.x - 1 && y === boatPosition.y);
                    case "image11": // est
                        return (x === boatPosition.x && y === boatPosition.y + 1);
                    case "image10": // ouest
                        return (x === boatPosition.x && y === boatPosition.y - 1);
                    default:
                        return false;
                }
            }

            function updateMatrixDisplay() {
                const matrixDisplay = document.getElementById("matrix-display");
                matrixDisplay.innerHTML = "";
                gridMatrix.forEach(row => {
                    const rowDiv = document.createElement("div");
                    rowDiv.textContent = row.join(" ");
                    matrixDisplay.appendChild(rowDiv);
                });

                // Mettre à jour la valeur du champ de la matrice cachée
                document.getElementById('matrix').value = JSON.stringify(gridMatrix);
            }

            updateMatrixDisplay(); // Initial display
        });
        document.addEventListener("DOMContentLoaded", function() {
            const finishButton = document.getElementById("finish-button");
            finishButton.addEventListener("click", function() {
                const nomNiveau = document.getElementById("nom").value.trim();
                if (!nomNiveau) {
                    alert("Veuillez entrer un nom pour le niveau.");
                } else {
                    alert("Votre niveau a bien été sauvegardé.");
                }
            });
        });
    </script>
</body>
</html>
