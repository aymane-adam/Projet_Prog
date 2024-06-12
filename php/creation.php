<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/creation.css">
    <title>Editor</title>
</head>
<body>
<?php
    include("nav.php")
?>
    <div id="calliste">
        <div class="container">
            <img src="../img/planches.webp" alt="Image" style="width:30%">
            <div class="txt">
                <h1>Level Creator</h1>
            </div>
        </div>
        <a href="editeur_niveau_aleatoire.php" class="creationa">
            <h2>Random Creation</h2>
            <img src="../img/sword.png" class="sword" alt="Image">
            <img src="../img/sword1.png" class="sword1" alt="Image">
            <img src="../img/imgalea.png" class="imgalea" alt="Image" style="width:30%">
        </a>    
        <a href="editeur_niveau_manuel.php" class="creationm">
            <h2>Manual Creation</h2>
            <img src="../img/sword.png" class="sword" alt="Image">
            <img src="../img/sword1.png" class="sword1" alt="Image">
            <img src="../img/imgmanuel.png" class="imgmanuel" alt="Image" style="width:30%">
        </a>
    </div>
</body>
</html>