<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jeu de Grille</title>
    <link rel="stylesheet" href="mainmainmain.css">
</head>
<body>
    <button id="fullscreenBtn"></button>
    <div id="inventory">
        <div class="arrow" data-direction="up"><img src="../pixel_art_projet/32x32/down-arrow.png" alt="Up" /><span class="arrow-count" data-direction="up">2</span></div>
        <div class="arrow" data-direction="down"><img src="../pixel_art_projet/32x32/up-arrow.png" alt="Down" /><span class="arrow-count" data-direction="down">2</span></div>
        <div class="arrow" data-direction="left"><img src="../pixel_art_projet/32x32/left-arrow.png" alt="Left" /><span class="arrow-count" data-direction="left">2</span></div>
        <div class="arrow" data-direction="right"><img src="../pixel_art_projet/32x32/right-arrow.png" alt="Right" /><span class="arrow-count" data-direction="right">2</span></div>
    </div>
    <button id="playBtn">Play</button>
    <div id="grid"></div>
    <script src="mainmainmain.js"></script>
</body>
</html>
