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
        <form method="post" action="#" id="grid-form">
            <label for="taille">Taille :</label>
            <input type="number" id="taille" name="taille" min="4" max="16" value="<?php echo isset($_POST['taille']) ? $_POST['taille'] : 5; ?>">
            <input type="submit" name="button1" class="button2" value="Créer la grille" />
        </form>
    </div>

    <?php
    $tailleGrille = 0;
    $submissionSuccess = false;

    if (array_key_exists('button1', $_POST)) {
        $tailleGrille = intval($_POST['taille']);
        echo '
        <form method="post" id="level-form">
            <div class="form-group">
                <label for="nom">Nom du niveau :</label>
                <input type="text" id="nom" name="nom">
                <input type="hidden" id="matrix" name="matrix" value="">
                
                <div class="input-group">
                    <label for="arrow-n">Flèches Nord :</label>
                    <input type="number" id="arrow-n" name="arrow_n" min="0" value="' . (isset($_POST['arrow_s']) ? $_POST['arrow_s'] : 0) . '" class="input-field">
                    <img src="../pixel_art_projet/32x32/arrow_n.png" alt="Flèches Nord" class="image-label">
                </div>
                <div class="input-group">
                    <label for="arrow-s">Flèches Sud :</label>
                    <input type="number" id="arrow-s" name="arrow_s" min="0" value="' . (isset($_POST['arrow_s']) ? $_POST['arrow_s'] : 0) . '" class="input-field">
                    <img src="../pixel_art_projet/32x32/arrow_s.png" alt="Flèches Sud" class="image-label">
                </div>
                <div class="input-group">
                    <label for="arrow-w">Flèches Ouest :</label>
                    <input type="number" id="arrow-w" name="arrow_w" min="0" value="' . (isset($_POST['arrow_w']) ? $_POST['arrow_w'] : 0) . '" class="input-field">
                    <img src="../pixel_art_projet/32x32/arrow_w.png" alt="Flèches Ouest" class="image-label">
                </div>
                <div class="input-group">
                    <label for="arrow-e">Flèches Est :</label>
                    <input type="number" id="arrow-e" name="arrow_e" min="0" value="' . (isset($_POST['arrow_e']) ? $_POST['arrow_e'] : 0) . '" class="input-field">
                    <img src="../pixel_art_projet/32x32/arrow_e.png" alt="Flèches Est" class="image-label">
                </div>
            </div>
            <div class="input-buttom1">
                <input type="submit" name="button2" id="finish-button" class="button" value="Terminer"/>
            </div>
        </form>';
    }

    if (array_key_exists('button2', $_POST)){
        if(isset($_POST["nom"]) && empty($_POST["nom"])){
            echo "Veuillez mettre un nom pour le niveau";
        } else {
            require("bdd.php");
            $nom_niveau = $_POST["nom"];
            $contenu = [
                "fleche_n" => $_POST['arrow_n'],
                "fleche_s" => $_POST['arrow_s'],
                "fleche_o" => $_POST['arrow_w'],
                "fleche_e" => $_POST['arrow_e'],
                "matrix" => $_POST['matrix'],
            ];
            $createur = $_SESSION['pseudo'];
            $type_niveau = 2;
            $sql1 = $conn->prepare("INSERT INTO niveaux (nom_niveau, contenu, createur, type_niveau) VALUES (:nom_niveau, :contenu, :createur, :type_niveau)");
            $sql1->execute(array(
                ':nom_niveau' => $nom_niveau,
                ':contenu' => json_encode($contenu),
                ':createur' => $createur,
                ':type_niveau' => $type_niveau,
            ));
            $submissionSuccess = true;
        }
    }

    function Grille($lignes, $colonnes) {
        echo '<div class="grid-container"><table>';
        for ($i = 0; $i < $lignes; $i++) {
            echo "<tr>";
            for ($j = 0; $j < $colonnes; $j++) {
                echo '<td><div class="drop-box" data-x="'.$i.'" data-y="'.$j.'" style="height: 100%; width: 100%;"></div></td>';
            }
            echo "</tr>";
        }
        echo "</table></div>";
    }

    Grille($tailleGrille, $tailleGrille);
    ?>

    <div id="matrix-display"></div> 
</div>

   
   
    <div class="gogogo">
        <div>
            <img src="../img/bottom-coffre.png" class="bottomc">
        </div>
        <div>
            <img src="../img/top-coffre.png" class="bottomt">
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
                <img src="../pixel_art_projet/32x32/arrow_n.png" draggable="true" id="image9" alt="Nord" data-value="8">
                <img src="../pixel_art_projet/32x32/arrow_s.png" draggable="true" id="image8" alt="Sud" data-value="9">
                <img src="../pixel_art_projet/32x32/arrow_w.png" draggable="true" id="image10" alt="Ouest" data-value="10">
                <img src="../pixel_art_projet/32x32/arrow_e.png" draggable="true" id="image11" alt="Est" data-value="11">
            </div>
            <!-- Section de corbeille -->
            <div class="trash-container">
                <img src="../pixel_art_projet/32x32/trash.png">
            </div>
        </div>
    </div>

    <button>
  <svg
    xmlns="http://www.w3.org/2000/svg"
    viewBox="0 0 36 36"
    width="36px"
    height="36px"
  >
    <rect width="36" height="36" x="0" y="0" fill="#fdd835"></rect>
    <path
      fill="#e53935"
      d="M38.67,42H11.52C11.27,40.62,11,38.57,11,36c0-5,0-11,0-11s1.44-7.39,3.22-9.59 c1.67-2.06,2.76-3.48,6.78-4.41c3-0.7,7.13-0.23,9,1c2.15,1.42,3.37,6.67,3.81,11.29c1.49-0.3,5.21,0.2,5.5,1.28 C40.89,30.29,39.48,38.31,38.67,42z"
    ></path>
    <path
      fill="#b71c1c"
      d="M39.02,42H11.99c-0.22-2.67-0.48-7.05-0.49-12.72c0.83,4.18,1.63,9.59,6.98,9.79 c3.48,0.12,8.27,0.55,9.83-2.45c1.57-3,3.72-8.95,3.51-15.62c-0.19-5.84-1.75-8.2-2.13-8.7c0.59,0.66,3.74,4.49,4.01,11.7 c0.03,0.83,0.06,1.72,0.08,2.66c4.21-0.15,5.93,1.5,6.07,2.35C40.68,33.85,39.8,38.9,39.02,42z"
    ></path>
    <path
      fill="#212121"
      d="M35,27.17c0,3.67-0.28,11.2-0.42,14.83h-2C32.72,38.42,33,30.83,33,27.17 c0-5.54-1.46-12.65-3.55-14.02c-1.65-1.08-5.49-1.48-8.23-0.85c-3.62,0.83-4.57,1.99-6.14,3.92L15,16.32 c-1.31,1.6-2.59,6.92-3,8.96v10.8c0,2.58,0.28,4.61,0.54,5.92H10.5c-0.25-1.41-0.5-3.42-0.5-5.92l0.02-11.09 c0.15-0.77,1.55-7.63,3.43-9.94l0.08-0.09c1.65-2.03,2.96-3.63,7.25-4.61c3.28-0.76,7.67-0.25,9.77,1.13 C33.79,13.6,35,22.23,35,27.17z"
    ></path>
    <path
      fill="#01579b"
      d="M17.165,17.283c5.217-0.055,9.391,0.283,9,6.011c-0.391,5.728-8.478,5.533-9.391,5.337 c-0.913-0.196-7.826-0.043-7.696-5.337C9.209,18,13.645,17.32,17.165,17.283z"
    ></path>
    <path
      fill="#212121"
      d="M40.739,37.38c-0.28,1.99-0.69,3.53-1.22,4.62h-2.43c0.25-0.19,1.13-1.11,1.67-4.9 c0.57-4-0.23-11.79-0.93-12.78c-0.4-0.4-2.63-0.8-4.37-0.89l0.1-1.99c1.04,0.05,4.53,0.31,5.71,1.49 C40.689,24.36,41.289,33.53,40.739,37.38z"
    ></path>
    <path
      fill="#81d4fa"
      d="M10.154,20.201c0.261,2.059-0.196,3.351,2.543,3.546s8.076,1.022,9.402-0.554 c1.326-1.576,1.75-4.365-0.891-5.267C19.336,17.287,12.959,16.251,10.154,20.201z"
    ></path>
    <path
      fill="#212121"
      d="M17.615,29.677c-0.502,0-0.873-0.03-1.052-0.069c-0.086-0.019-0.236-0.035-0.434-0.06 c-5.344-0.679-8.053-2.784-8.052-6.255c0.001-2.698,1.17-7.238,8.986-7.32l0.181-0.002c3.444-0.038,6.414-0.068,8.272,1.818 c1.173,1.191,1.712,3,1.647,5.53c-0.044,1.688-0.785,3.147-2.144,4.217C22.785,29.296,19.388,29.677,17.615,29.677z M17.086,17.973 c-7.006,0.074-7.008,4.023-7.008,5.321c-0.001,3.109,3.598,3.926,6.305,4.27c0.273,0.035,0.48,0.063,0.601,0.089 c0.563,0.101,4.68,0.035,6.855-1.732c0.865-0.702,1.299-1.57,1.326-2.653c0.051-1.958-0.301-3.291-1.073-4.075 c-1.262-1.281-3.834-1.255-6.825-1.222L17.086,17.973z"
    ></path>
    <path
      fill="#e1f5fe"
      d="M15.078,19.043c1.957-0.326,5.122-0.529,4.435,1.304c-0.489,1.304-7.185,2.185-7.185,0.652 C12.328,19.467,15.078,19.043,15.078,19.043z"
    ></path>
  </svg>
  <span class="now">now!</span>
  <span class="play">play</span>
</button>


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
    const inventory = document.querySelector('.gogogo');

    if (gridSize >= 10 && gridSize <= 16) {
        inventory.classList.add('lowered');
    } else {
        inventory.classList.remove('lowered');
    }

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
            draggableElement.setAttribute("data-grid-id", `grid-${x}-${y}-${Date.now()}`);
            draggableElement.addEventListener("dragstart", function(event) {
                event.dataTransfer.setData("text/plain", draggableElement.getAttribute("data-grid-id"));
            });
            event.target.innerHTML = '';
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
        const gridId = event.dataTransfer.getData("text/plain");
        const draggableElement = document.querySelector(`[data-grid-id="${gridId}"]`);

        if (draggableElement && draggableElement.parentElement.classList.contains("drop-box")) {
            const box = draggableElement.parentElement;
            const x = parseInt(box.getAttribute("data-x"));
            const y = parseInt(box.getAttribute("data-y"));

            box.innerHTML = '';
            gridMatrix[x][y] = 0;
            updateMatrixDisplay();

            const imageId = draggableElement.id;
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
            case "image8":
                return (x === boatPosition.x + 1 && y === boatPosition.y);
            case "image9":
                return (x === boatPosition.x - 1 && y === boatPosition.y);
            case "image11":
                return (x === boatPosition.x && y === boatPosition.y + 1);
            case "image10":
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

        document.getElementById('matrix').value = JSON.stringify(gridMatrix);
    }

    updateMatrixDisplay();
});

document.addEventListener("DOMContentLoaded", function() {
    const finishButton = document.getElementById("finish-button");
    finishButton.addEventListener("click", function(event) {
        const nomNiveau = document.getElementById("nom").value.trim();
        if (!nomNiveau) {
            event.preventDefault();
            alert("Veuillez entrer un nom pour le niveau.");
        }
    });

    <?php if ($submissionSuccess): ?>
        alert("Votre niveau a bien été sauvegardé.");
    <?php endif; ?>
});

    </script>
</body>
</html>
