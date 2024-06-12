const grid = document.getElementById('grid');
const playBtn = document.getElementById('playBtn');
const gridSize = 16;
const audiob = new Audio('../audio/boomc.mp3');
let audiop = false;
let boatDirection = 'right';
let boatPosition = { x: 0, y: 0 };
let gameStarted = false;
let moveInterval;


// Function to place obstacles based on a 2D array
function placeObstacles(obstacleGrid) {
    grid.innerHTML = ''; // Clear existing grid
    for (let y = 0; y < obstacleGrid.length; y++) {
        for (let x = 0; x < obstacleGrid[y].length; x++) {
            const cell = document.createElement('div');
            cell.className = 'cell';
            cell.id = `cell-${x}-${y}`;

            switch (obstacleGrid[y][x]) {
                case 0:
                    
                    break;
                case 1:
                    cell.classList.add('rock');
                    cell.classList.add('rocher');
                    break;
                case 2:
                    cell.classList.add('rock');
                    cell.classList.add('pieuvre');
                    break;
                case 3:
                    cell.classList.add('rock');
                    cell.classList.add('rock1');
                    break;
                case 4:
                    cell.classList.add('rock');
                    cell.classList.add('krabby');
                    break;
                // Add more cases if needed for different obstacles
            }

            cell.addEventListener('dragover', handleDragOver);
            cell.addEventListener('drop', (event) => placeArrow(event, x, y));
            cell.addEventListener('dragleave', handleDragLeave);
            cell.addEventListener('click', () => removeArrow(x, y));
            grid.appendChild(cell);
        }
    }
}

// Example obstacle grid (16x16)
const obstacleGrid = [
    [0, 0, 0, 0, 0, 1, 0, 0, 0, 3, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 2, 0, 0, 0, 0, 0, 0, 4, 0, 0, 0, 0],
    [0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 3, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 4],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 0, 0, 0, 0, 0],
    [0, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0],
    [0, 0, 0, 0, 0, 4, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 3, 0, 0, 0, 0, 0, 0],
    [4, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 3, 0, 0]
  ];

// Place the obstacles using the grid
placeObstacles(obstacleGrid);

// Place boat
function placeBoat() {
    const boatCell = document.getElementById(`cell-${boatPosition.x}-${boatPosition.y}`);
    boatCell.classList.add('boat');
    sheet.insertRule('.boat { background:url(../pixel_art_projet/32x32/ship-left.png) center/cover; }', sheet.cssRules.length);
}

function removeBoat() {
    const boatCell = document.getElementById(`cell-${boatPosition.x}-${boatPosition.y}`);
    boatCell.classList.remove('boat');
}

// Move boat
function moveBoat() {
    var sheet = document.styleSheets[0];
    let nextPosition = { ...boatPosition };
    switch (boatDirection) {
        case 'up': nextPosition.y--;
            sheet.insertRule('.boat { background:url(../pixel_art_projet/32x32/ship-up.png) center/cover; }', sheet.cssRules.length);
            break;
        case 'down': nextPosition.y++; 
            sheet.insertRule('.boat { background:url(../pixel_art_projet/32x32/ship-down.png) center/cover; }', sheet.cssRules.length);
            break; 
        case 'left': nextPosition.x--; 
            sheet.insertRule('.boat { background:url(../pixel_art_projet/32x32/ship-left.png) center/cover; }', sheet.cssRules.length);
            break;
        case 'right': nextPosition.x++; 
            sheet.insertRule('.boat { background:url(../pixel_art_projet/32x32/ship-right.png) center/cover; }', sheet.cssRules.length);
            break;
    }

    // Check for collisions or boundary
    if (nextPosition.x < 0 || nextPosition.x >= gridSize || nextPosition.y < 0 || nextPosition.y >= gridSize ||
        document.getElementById(`cell-${nextPosition.x}-${nextPosition.y}`).classList.contains('rock')) {
        sheet.insertRule('.boat { background:url(../pixel_art_projet/32x32/boom.png) center/cover; }', sheet.cssRules.length);
        if (audiop === false){
            audiob.play();
            audiop=true;
        }
        return; // Prevent the boat from moving out of bounds or into a rock
    }

    removeBoat();
    boatPosition = nextPosition;

    // Check for arrows
    const boatCell = document.getElementById(`cell-${boatPosition.x}-${boatPosition.y}`);
    if (boatCell.dataset.direction) {
        boatDirection = boatCell.dataset.direction;
    }

    placeBoat();
}

// Reset boat to start
function resetBoat() {
    removeBoat(); // Ensure the boat is removed from the current position
    boatPosition = { x: 0, y: 0 };
    boatDirection = 'right';
    audiop=false;
    placeBoat();
}

// Arrow inventory
let selectedArrow = null;
document.querySelectorAll('#inventory .arrow').forEach(arrow => {
    arrow.draggable = true;
    arrow.addEventListener('dragstart', handleDragStart);
});

function handleDragStart(event) {
    if (gameStarted) return;
    selectedArrow = event.target.dataset.direction;
    event.target.classList.add('dragging');
    event.dataTransfer.setData('text/plain', selectedArrow);
    console.log(`Drag start: ${selectedArrow}`);
}

function handleDragOver(event) {
    if (gameStarted) return;
    event.preventDefault();
    event.target.classList.add('drag-over');
}

function handleDragLeave(event) {
    event.target.classList.remove('drag-over');
}

function placeArrow(event, x, y) {
    if (gameStarted) return;
    event.preventDefault();
    const cell = document.getElementById(`cell-${x}-${y}`);
    
    // Check if the cell contains a rock
    if (cell.classList.contains('rock')) {
        return; // Prevent placing an arrow on a rock
    }
    
    if (cell.dataset.direction) {
        removeArrow(x, y);
    }
    const arrowType = event.dataTransfer.getData('text/plain');
    if (arrowType) {
        const arrowCountSpan = document.querySelector(`.arrow-count[data-direction="${arrowType}"]`);
        let count = parseInt(arrowCountSpan.textContent);
        if (count > 0) {
            cell.dataset.direction = arrowType;
            const imgSrc = `../pixel_art_projet/32x32/${arrowType}-arrow.png`;
            console.log(`Placing arrow image: ${imgSrc} at (${x}, ${y})`);
            cell.innerHTML = `<img src="${imgSrc}" alt="${arrowType}" />`;
            count--;
            arrowCountSpan.textContent = count;
        }
    }
    document.querySelectorAll('.cell').forEach(cell => cell.classList.remove('drag-over'));
    document.querySelectorAll('.arrow').forEach(arrow => arrow.classList.remove('dragging'));
}

function removeArrow(x, y) {
    if (gameStarted) return;
    const cell = document.getElementById(`cell-${x}-${y}`);
    if (cell.dataset.direction) {
        const arrowType = cell.dataset.direction;
        const arrowCountSpan = document.querySelector(`.arrow-count[data-direction="${arrowType}"]`);
        let count = parseInt(arrowCountSpan.textContent);
        count++;
        arrowCountSpan.textContent = count;
        cell.innerHTML = '';
        delete cell.dataset.direction;
    }
}

// Play button functionality
playBtn.addEventListener('click', () => {
    if (!gameStarted) {
        gameStarted = true;
        playBtn.textContent = 'Stop';
        moveInterval = setInterval(moveBoat, 100);
    } else {
        stopGame();
        resetBoat();
    }
});

// Stop game function
function stopGame() {
    clearInterval(moveInterval);
    gameStarted = false;
    playBtn.textContent = 'Play';
    removeBoat(); // Remove the boat before resetting its position
}

// Fullscreen functionality
const fullscreenBtn = document.getElementById('fullscreenBtn');
fullscreenBtn.addEventListener('click', () => {
    if (!document.fullscreenElement) {
        document.documentElement.requestFullscreen();
        fullscreenBtn.style.backgroundImage = "url('exit.png')";
    } else {
        document.exitFullscreen();
        fullscreenBtn.style.backgroundImage = "url('fullscreen.png')";
    }
});

// Initialize the grid with obstacles
placeObstacles(obstacleGrid);

// Place the boat at the starting position
placeBoat();
