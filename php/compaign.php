<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/compaign.css">
    <title>Compaign Mode</title>
</head>
<body>
<h1>Compaign Mode</h1>
<a href="game.php" class="back-arrow">&#8592; Back</a>
    <div class="container">
        <div class="arrow" id="left-arrow">&#9664;</div>
        <div class="level-buttons" id="level-buttons">
            <button>Level 1</button>
            <button>Level 2</button>
            <button>Level 3</button>
            <button>Level 4</button>
        </div>
        <div class="arrow" id="right-arrow">&#9654;</div>
    </div>

    <script>
        const leftArrow = document.getElementById('left-arrow');
        const rightArrow = document.getElementById('right-arrow');
        const levelButtons = document.getElementById('level-buttons');

        let currentLevelSet = 1;

        leftArrow.addEventListener('click', () => {
            if (currentLevelSet > 1) {
                currentLevelSet--;
                updateLevels();
            }
        });

        rightArrow.addEventListener('click', () => {
            if (currentLevelSet < 2) { // assuming there are only 2 sets of levels (1-4 and 5-8)
                currentLevelSet++;
                updateLevels();
            }
        });

        function updateLevels() {
            const levels = [];
            for (let i = 1; i <= 4; i++) {
                const levelNumber = (currentLevelSet - 1) * 4 + i;
                levels.push(`<button>Level ${levelNumber}</button>`);
            }
            levelButtons.innerHTML = levels.join('');
            leftArrow.classList.toggle('disabled', currentLevelSet === 1);
            rightArrow.classList.toggle('disabled', currentLevelSet === 2);
        }

        updateLevels(); // initialize with the first set of levels
    </script>
</body>
</html>