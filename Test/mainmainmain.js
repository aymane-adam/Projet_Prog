function getTuileFromNumber(num) {
    switch(num) {
        case 0: return "rock.webp";
        case 1: return "rock.webp";
        // case 2: return "diams.webp";
        // case 3: return "fer.webp";
        // case 4: return "herbe.webp";
        // case 5: return "rock.webp";
        // case 6: return "diams.webp";
        // case 7: return "fer.webp";
        // case 8: return "herbe.webp";
        // case 9: return "rock.webp";
        // case 0: return "diams.webp";
        // case 11: return "fer.webp";
        // case 112: return "herbe.webp";
        // case 13: return "rock.webp";
        // case 14: return "diams.webp";
        // case 15: return "fer.webp";
        // case 16: return "herbe.webp";
        default: return "herbe.jpg";
    }
}

// Fonction pour créer une grille de jeu
// function createGrid(rows, cols) {
//     const gridContainer = document.getElementById("grid-container");
//     gridContainer.innerHTML = ''; // Nettoie le conteneur avant de le remplir

//     for (let i = 0; i < rows; i++) {
//         for (let j = 0; j < cols; j++) {
//             const cell = document.createElement("div");
//             cell.className = "cell";
//             const imageUrl = getTuileFromNumber(i); // Vous pouvez utiliser d'autres numéros si vous avez d'autres images
//             cell.style.backgroundImage = `url(${imageUrl})`;
//             gridContainer.appendChild(cell);
//         }
//         gridContainer.appendChild(document.createElement("br")); // Ajoute un saut de ligne après chaque ligne de cellules   
//     }
// }


// Appel de la fonction pour créer une grille de jeu 16x16 (par exemple)
// createGrid(16, 16);

// Définition des tableaux pour les murs, le personnage et le fond
const rows = 16;
const cols = 16;
const gridContainer = document.getElementById("grid-container");

const walls = Array(rows).fill().map(() => Array(cols).fill(0)); // 0 pour aucun mur, 1 pour un mur
const character = Array(rows).fill().map(() => Array(cols).fill(0)); // 0 pour absence, 1 pour présence du personnage
const background = Array(rows).fill().map(() => Array(cols).fill(0)); // 0 pour le sol, autres valeurs pour différents types de fond

// Initialisation des valeurs pour les murs, le personnage et le fond
walls[5][5] = 1; // Exemple de mur à la position (5, 5)
walls[5][6] = 1;
walls[5][7] = 1;
walls[5][8] = 1;
walls[5][9] = 1;
walls[7][5] = 1;
walls[8][5] = 1;
character[7][7] = 1; // Position initiale du personnage
background.forEach(row => row.fill(0)); // Tout le fond initialisé à 0 (ex: herbe)

// Fonction pour créer la grille
function createGrid(rows, cols) {
    gridContainer.innerHTML = ''; // Nettoie le conteneur avant de le remplir

    for (let i = 0; i < rows; i++) {
        for (let j = 0; j < cols; j++) {
            const cell = document.createElement("div");
            cell.className = "cell";

            // Ajouter l'image de fond
            if (background[i][j] === 0) {
                cell.style.backgroundImage = 'url("herbe.jpg")'; // Exemple d'image pour le fond
            }

            // Ajouter les murs
            if (walls[i][j] === 1) {
                const wallImg = document.createElement("img");
                wallImg.src = 'rock.webp'; // Exemple d'image pour les murs
                cell.appendChild(wallImg);
            }

            // Ajouter le personnage
            if (character[i][j] === 1) {
                const characterImg = document.createElement("img");
                characterImg.src = 'perso.png'; // Exemple d'image pour le personnage
                cell.appendChild(characterImg);
            }

            gridContainer.appendChild(cell);
        }
        gridContainer.appendChild(document.createElement("br"));
    }
}

// Fonction pour déplacer le personnage
function moveCharacter(oldRow, oldCol, newRow, newCol) {
    if (walls[newRow][newCol] === 1) return; // Ne pas déplacer dans un mur
    if (newRow < 0 || newRow >= rows || newCol < 0 || newCol >= cols) return; // Ne pas sortir de la grille

    character[oldRow][oldCol] = 0; // Supprimer le personnage de l'ancienne position
    character[newRow][newCol] = 1; // Placer le personnage à la nouvelle position

    createGrid(rows, cols); // Rafraîchir la grille
}

// Gestion des touches pour déplacer le personnage
document.addEventListener('keydown', (event) => {
    let [characterRow, characterCol] = findCharacter();
    switch (event.key) {
        case 'ArrowUp':
            moveCharacter(characterRow, characterCol, characterRow - 1, characterCol);
            break;
        case 'ArrowDown':
            moveCharacter(characterRow, characterCol, characterRow + 1, characterCol);
            break;
        case 'ArrowLeft':
            moveCharacter(characterRow, characterCol, characterRow, characterCol - 1);
            break;
        case 'ArrowRight':
            moveCharacter(characterRow, characterCol, characterRow, characterCol + 1);
            break;
    }
});

// Fonction pour trouver la position actuelle du personnage
function findCharacter() {
    for (let i = 0; i < rows; i++) {
        for (let j = 0; j < cols; j++) {
            if (character[i][j] === 1) return [i, j];
        }
    }
    return [0, 0]; // Valeur par défaut si le personnage n'est pas trouvé
}

// Appel de la fonction pour créer la grille initiale
createGrid(rows, cols);

document.body.appendChild(musique.mp3);