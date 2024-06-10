<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/compaign.css">
    <title>Compaign Mode</title>
</head>
<body>
<img src="../img/campaign.png" alt="Campaign" class="logo">
<div class="back">
    <a href="game.php" class="back-arrow">
        <img src="../img/bouton_retour.png" alt="Back" class="link-image">
    </a>
</div>
<div class="container">
    <div class="arrow" id="left-arrow">&#9664;</div>
    <div class="level-buttons" id="level-buttons"></div>
    <div class="arrow" id="right-arrow">&#9654;</div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const leftArrow = document.getElementById('left-arrow');
        const rightArrow = document.getElementById('right-arrow');
        const levelButtons = document.getElementById('level-buttons');

        let currentLevelSet = 1;
        const totalLevelSets = 2; // Update this value to reflect the total number of level sets (24 levels, 12 per page)

        leftArrow.addEventListener('click', () => {
            if (currentLevelSet > 1) {
                currentLevelSet--;
                updateLevels();
            }
        });

        rightArrow.addEventListener('click', () => {
            if (currentLevelSet < totalLevelSets) { 
                currentLevelSet++;
                updateLevels();
            }
        });

        function updateLevels() {
            const levels = [];
            for (let i = 1; i <= 9; i++) {
                const levelNumber = (currentLevelSet - 1) * 9 + i;
                levels.push(`<a href='level.php?id=${levelNumber}' class='level-link'><img src='../img/level${levelNumber}.png' alt='Level ${levelNumber}' /></a>`);
            }
            levelButtons.innerHTML = levels.join('');
            leftArrow.classList.toggle('disabled', currentLevelSet === 1);
            rightArrow.classList.toggle('disabled', currentLevelSet === totalLevelSets);
        }
        updateLevels(); 
    });
</script>
</body>
</html>
