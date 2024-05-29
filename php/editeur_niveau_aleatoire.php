<?php
// Définir le chemin de l'exécutable compilé
$executablePath = '../C/coopteam/x64/Debug/coopteam.exe';

// Exécuter l'exécutable et capturer la sortie JSON
$jsonMatrix = shell_exec($executablePath);

// Vérifier si la sortie JSON est valide
if ($jsonMatrix === null) {
    echo "Erreur lors de l'exécution du programme C.";
} else {
    // Convertir la sortie JSON en tableau PHP
    $matrix = json_decode($jsonMatrix, true);

    // Vérifier si la conversion JSON est valide
    if ($matrix === null) {
        echo "Erreur de conversion JSON.";
    } else {
        // Afficher la matrice
        echo "<h1>Matrice générée :</h1>";
        echo "<pre>";
        foreach ($matrix['matrix'] as $row) {
            foreach ($row as $value) {
                echo str_pad($value, 4, ' ', STR_PAD_LEFT);
            }
            echo "\n";
        }
        echo "</pre>";
    }
}
?>
