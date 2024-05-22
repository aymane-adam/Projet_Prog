// script.js
const grid = document.getElementById('tile-grid');
const character = document.getElementById('character');

// Taille de la grille
const rows = 16;
const cols = 16;

// Initialisation du tableau à deux dimensions pour les tuiles
let tileGrid = [];
for (let i = 0; i < rows; i++) {
    tileGrid[i] = [];
    for (let j = 0; j < cols; j++) {
        // Utiliser 1 pour une tuile normale (par exemple, l'eau) et 0 pour une tuile de collision (par exemple, un mur)
        tileGrid[i][j] = (Math.random() < 0.2) ? 'collision' : 'water'; // 20% des tuiles seront des obstacles
    }
}


function getTuileFromNumber(num){ //renvoie l'image en fonction du nomnbre
    switch(num){ 
     case 0: return "pixel art projet/32x32/vague.png"
     case 1: return "pixel art projet/32x32/rock.png"
     
    }


}
// Fonction pour initialiser la grille
function initGrid() {
    for (let i = 0; i < rows; i++) {
        for (let j = 0; j < cols; j++) {
            const tile = document.createElement('div');
            tile.classList.add('tile');
            tile.style.backgroundImage = `url("${tileGrid[i][j]}.png")`; // Assurez-vous que vous avez des images comme water.png et collision.png
            grid.appendChild(tile);
        }
    }
}

// Initialisation de la grille
initGrid();

// Position initiale du personnage
let characterPosition = { x: 0, y: 0 };

// Fonction pour mettre à jour la position du personnage
function updateCharacterPosition() {
    character.style.top = `${characterPosition.y * 32}px`;
    character.style.left = `${characterPosition.x * 32}px`;
}

// Mise à jour initiale de la position
updateCharacterPosition();

// Fonction de détection de collision
function collision(x, y) {
    // Vérifie les limites de la grille
    if (x < 0 || x >= rows || y < 0 || y >= cols) {
        return true;
    }
    // Conditions de collision basées sur les tuiles
    let tileValue = tileGrid[x][y];
    if (tileValue === 'collision') {
        return true;
    }
    // Ajoutez ici d'autres conditions de collision basées sur les entités ou les tuiles spécifiques
    return false;
}

// Gestion des entrées du clavier pour le mouvement
document.addEventListener('keydown', (event) => {
    let newX = characterPosition.x;
    let newY = characterPosition.y;

    switch(event.key) {
        case 'ArrowUp':
            newY--;
            break;
        case 'ArrowDown':
            newY++;
            break;
        case 'ArrowLeft':
            newX--;
            break;
        case 'ArrowRight':
            newX++;
            break;
    }

    if (!collision(newX, newY)) {
        characterPosition.x = newX;
        characterPosition.y = newY;
        updateCharacterPosition();
    }
});





// Fonction pour entrer en mode plein écran
const fullscreenBtn = document.getElementById('fullscreenBtn');
function enterFullscreen() {
    if (!(document.fullscreenElement)) {
        document.documentElement.requestFullscreen();
        fullscreenBtn.style.backgroundImage = "url('exit.png')"
    }
}
// Ajouter un écouteur d'événement au bouton
if (document.getElementById('fullscreenBtn').addEventListener('click', enterFullscreen)){
document.getElementById('fullscreenBtn').addEventListener('click', enterFullscreen);}

// Fonction pour sortir du mode plein écran
function exFullscreen() {
    if (document.fullscreenElement) {
        document.exitFullscreen()
        fullscreenBtn.style.backgroundImage = "url('fullscreen.png')"
    }
}
// Ajouter un écouteur d'événement au bouton
if (document.getElementById('fullscreenBtn').addEventListener('click', exFullscreen)){
document.getElementById('fullscreenBtn').addEventListener('click', exFullscreen);}