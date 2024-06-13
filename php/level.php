<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/level.css">
    <title>Level Page</title>
</head>
<body>
    <div class="back">
        <a href="compaign.php" class="back-arrow">
            <img src="../img/bouton_retour.png" alt="Back" class="link-image">
        </a>
    </div>
    <?php
    session_start();
    // Définition des images
    $images = [
        1 => "bateau.png",
        2 => "guardianclose.png",
        3 => "krabby.png",
        4 => "pieuvre.png",
        5 => "rock.png",
        6 => "rock1.png",
        7 => "vague.png",
        8 => "nord.png",
        9 => "sud.png",
        10 => "ouest.png",
        11 => "est.png",
        12 => "chest5.png"
    ];

    require("bdd.php");
    if (isset($_GET['id'])) {
        $levelNumber = intval($_GET['id']);
        $recup = $conn->prepare("SELECT contenu FROM niveaux WHERE id_niveau = :id_niveau");
        $recup->execute(
            array(
            ':id_niveau' => $levelNumber,
        ));
        $resultat = $recup->fetchAll(PDO::FETCH_ASSOC);

        if($levelNumber > 0 && $levelNumber < 19 && $_SESSION['progression'] < $levelNumber){
            header("Location:compaign.php");
        }
        if (!empty($recup)) {
            // Matrice
            $json_data = $resultat[0]['contenu'];

            // Décoder le JSON
            $data = json_decode($json_data, true);

            // Récupérer la matrice et la transformer en tableau PHP
            $matrice = json_decode($data['matrix'], true);
            $fleche_n = json_decode($data['fleche_n'], true);
            $fleche_s = json_decode($data['fleche_s'], true);
            $fleche_o = json_decode($data['fleche_o'], true);
            $fleche_e = json_decode($data['fleche_e'], true);

            $directBoat = "est";

            foreach ($matrice as $i => $row) {
                foreach ($row as $j => $value) {
                    switch ($value) {
                        case 8:
                            $directBoat = "nord";
                            $matrice[$i][$j] = 0;
                            break;
                        case 9:
                            $directBoat = "sud";
                            $matrice[$i][$j] = 0;
                            break;
                        case 10:
                            $directBoat = "ouest";
                            $matrice[$i][$j] = 0;
                            break;
                        case 11:
                            $directBoat = "est";
                            $matrice[$i][$j] = 0;
                            break;
                    }
                }
            }
            function afficherGrille($matrice, $images) {
                echo "<table id='grid'>";
                if (!empty($matrice)) {
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
                }
                echo "</table>";
            }
            function afficherMatrice($matrice) {
                echo "<pre id='matrice-display'>";
                if (!empty($matrice)) {
                    foreach ($matrice as $ligne) {
                        echo implode(" ", $ligne) . "\n";
                    }
                }
                echo "</pre>";
            }
        } 
    } else {
        echo "<h1>No level specified.</h1>";
    }
    ?>

    <div class="left-container">
        <h1>You are on level: <?php echo $levelNumber; ?></h1>
        <div>Direction du bateau : <span id="directionBoat"><?php echo $directBoat; ?></span></div>
        <?php afficherMatrice($matrice); ?>
        <button id="commencer">Commencer</button>
        <button id="retry" class="hidden">Retry</button>
        <button id="recommencer" class="hidden">Recommencer le niveau</button>
        <button id="suivant" class="hidden">Niveau suivant</button>
        <div id="message" class="hidden"></div>
    </div>
    <div class="table-container">
        <?php afficherGrille($matrice, $images); ?>
    </div>
    <div class="inventory-container">
        <h2>Inventory</h2>
        <div class="image-container">
            <div style="position: relative; display: inline-block;">
                <img src="../pixel_art_projet/32x32/nord.png" draggable="true" id="image8" alt="Nord" data-value="8">
                <div class="counter" id="counter8"><?php echo $fleche_n; ?></div>
            </div>
            <div style="position: relative; display: inline-block;">
                <img src="../pixel_art_projet/32x32/sud.png" draggable="true" id="image9" alt="Sud" data-value="9">
                <div class="counter" id="counter9"><?php echo $fleche_s; ?></div>
            </div>
            <div style="position: relative; display: inline-block;">
                <img src="../pixel_art_projet/32x32/ouest.png" draggable="true" id="image10" alt="Ouest" data-value="10">
                <div class="counter" id="counter10"><?php echo $fleche_o; ?></div>
            </div>
            <div style="position: relative; display: inline-block;">
                <img src="../pixel_art_projet/32x32/est.png" draggable="true" id="image11" alt="Est" data-value="11">
                <div class="counter" id="counter11"><?php echo $fleche_e; ?></div>
            </div>
        </div>
        <div class="trash-container">
            <img src="../pixel_art_projet/32x32/trash.png">
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const images = document.querySelectorAll(".image-container img");
            const imageCount = {};
            const maxImages = 2;
            let matrice = <?php echo json_encode($matrice); ?>;
            let directBoat = "<?php echo $directBoat; ?>";
            let interval;

            images.forEach(image => {
                const value = image.getAttribute("data-value");
                imageCount[value] = maxImages;
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
                    const value = parseInt(document.getElementById(imageId).getAttribute("data-value"));
                    const row = box.parentElement.getAttribute('data-row');
                    const col = box.parentElement.getAttribute('data-col');

                    if (box.getAttribute("data-value") === "0" && imageCount[value] > 0) {
                        const draggableElement = document.getElementById(imageId).cloneNode(true);
                        draggableElement.addEventListener("dragstart", function(event) {
                            event.dataTransfer.setData("text/plain", event.target.id);
                        });
                        box.innerHTML = ''; // Clear any existing content
                        box.appendChild(draggableElement);
                        box.setAttribute("data-value", value);
                        imageCount[value]--;
                        matrice[row][col] = value;
                        updateMatriceDisplay();
                        updateCounter(value);
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
                const value = parseInt(draggableElement.getAttribute("data-value"));
                const dropBox = draggableElement.parentElement;
                const row = dropBox.parentElement.getAttribute('data-row');
                const col = dropBox.parentElement.getAttribute('data-col');

                if (dropBox.classList.contains("drop-box")) {
                    dropBox.innerHTML = ''; // Remove the image from the drop box
                    dropBox.setAttribute("data-value", "0");
                    imageCount[value]++;
                    matrice[row][col] = 0;
                    updateMatriceDisplay();
                    updateCounter(value);
                }
            });

            function updateCounter(value) {
                const counter = document.getElementById('counter' + value);
                counter.textContent = imageCount[value];
            }

            function updateMatriceDisplay() {
                const matriceDisplay = document.getElementById('matrice-display');
                matriceDisplay.innerHTML = '';
                matrice.forEach(ligne => {
                    matriceDisplay.innerHTML += ligne.join(" ") + "\n";
                });
            }

            function moveBoat() {
                let boatPosition = findBoatPosition();
                if (!boatPosition) {
                    return;
                }

                let [row, col] = boatPosition;
                matrice[row][col] = 0;
                let nextRow = row, nextCol = col;

                switch (directBoat) {
                    case "nord":
                        nextRow--;
                        break;
                    case "sud":
                        nextRow++;
                        break;
                    case "ouest":
                        nextCol--;
                        break;
                    case "est":
                        nextCol++;
                        break;
                }

                if (nextRow >= 0 && nextRow < matrice.length && nextCol >= 0 && nextCol < matrice[0].length) {
                    let nextCell = matrice[nextRow][nextCol];
                    if (nextCell === 0) {
                        matrice[nextRow][nextCol] = 1;
                    } else if (nextCell === 8) {
                        directBoat = "nord";
                        matrice[nextRow][nextCol] = 1;
                    } else if (nextCell === 9) {
                        directBoat = "sud";
                        matrice[nextRow][nextCol] = 1;
                    } else if (nextCell === 10) {
                        directBoat = "ouest";
                        matrice[nextRow][nextCol] = 1;
                    } else if (nextCell === 11) {
                        directBoat = "est";
                        matrice[nextRow][nextCol] = 1;
                    } else if (nextCell === 12) {
                        clearInterval(interval);                 
                        document.getElementById('message').textContent = "Partie gagnée!";
                        document.getElementById('message').classList.remove('hidden');
                        document.getElementById('recommencer').classList.remove('hidden');
                        document.getElementById('suivant').classList.remove('hidden');
                    } else {
                        matrice[nextRow][nextCol] = 13; // Code pour "boom"
                        clearInterval(interval);
                        document.getElementById('message').textContent = "Game Over";
                        document.getElementById('message').classList.remove('hidden');
                        document.getElementById('commencer').classList.add('hidden');
                        document.getElementById('retry').classList.remove('hidden');
                    }
                } else {
                    clearInterval(interval);
                    document.getElementById('message').textContent = "Game Over";
                    document.getElementById('message').classList.remove('hidden');
                    document.getElementById('commencer').classList.add('hidden');
                    document.getElementById('retry').classList.remove('hidden');
                }

                updateGridDisplay();
                updateMatriceDisplay();
                document.getElementById('directionBoat').textContent = directBoat;
            }

            function findBoatPosition() {
                for (let i = 0; i < matrice.length; i++) {
                    for (let j = 0; j < matrice[i].length; j++) {
                        if (matrice[i][j] === 1) {
                            return [i, j];
                        }
                    }
                }
                return null;
            }

            function updateGridDisplay() {
                const grid = document.getElementById('grid');
                grid.innerHTML = '';
                matrice.forEach((ligne, ligneIdx) => {
                    let tr = document.createElement('tr');
                    ligne.forEach((cellule, celluleIdx) => {
                        let td = document.createElement('td');
                        td.setAttribute('data-row', ligneIdx);
                        td.setAttribute('data-col', celluleIdx);
                        if (cellule !== 0) {
                            let img = document.createElement('img');
                            if (cellule === 13) {
                                img.src = "../pixel_art_projet/32x32/boom.png";
                            } else {
                                img.src = "../pixel_art_projet/32x32/" + <?php echo json_encode($images); ?>[cellule];
                            }
                            img.classList.add('drop-box');
                            img.setAttribute('data-value', cellule);
                            td.appendChild(img);
                        } else {
                            let div = document.createElement('div');
                            div.classList.add('drop-box');
                            div.setAttribute('data-value', '0');
                            td.appendChild(div);
                        }
                        tr.appendChild(td);
                    });
                    grid.appendChild(tr);
                });
            }

            document.getElementById('commencer').addEventListener('click', function() {
                interval = setInterval(moveBoat, 1000); // Utiliser directBoat initialisé dans PHP
            });

            document.getElementById('retry').addEventListener('click', function() {
                location.reload();
            });

            document.getElementById('recommencer').addEventListener('click', function() {
                location.reload();
            });

            document.getElementById('suivant').addEventListener('click', function() {
                window.location.href = "level.php?id=" + (<?php echo $levelNumber; ?> + 1);
            });
        });
    </script>
    <?php     

        function checkVictory($matrice){
            foreach ($matrice as $row) {
                if (in_array(12, $row)) {
                        return true;
                    }
            }
            return false;
        }

        // Vérifier si le bateau a atteint le coffre
        if (checkVictory($matrice) && !empty($_SESSION['pseudo'])) {
            if($_SESSION['progression'] == $levelNumber){
                $_SESSION['progression'] += 1;
                $update = $conn->prepare("UPDATE `comptes` SET `progression` = :progression WHERE pseudo = :pseudo");
                $update->execute(
                    array(
                    ':progression' => $_SESSION['progression'],
                    ':pseudo' => $_SESSION['pseudo'],
                ));
            }
        }
        if(checkVictory($matrice) && empty($_SESSION['pseudo'])){
            $_SESSION['progression'] += 1;
        }
    ?>
</body>
</html>
