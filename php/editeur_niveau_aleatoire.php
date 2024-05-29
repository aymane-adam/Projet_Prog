<?php
// Exécuter le programme C et capturer sa sortie
$jsonMatrix = shell_exec('../C/coopteam/x64/Debug/coopteam.exe');

// Vérifier si la sortie est vide
if ($jsonMatrix === null || $jsonMatrix === '') {
    echo "<h1>Le programme n'a pas généré de sortie.</h1>";
    exit;
}

// Convertir le JSON en un tableau PHP
$matrixArray = json_decode($jsonMatrix, true);

// Vérifier si la conversion JSON a réussi
if ($matrixArray === null) {
    echo "<h1>Erreur : La conversion JSON a échoué.</h1>";
    echo "<pre>$jsonMatrix</pre>"; // Afficher la sortie brute pour le débogage
    exit;
}

// Afficher le JSON sur la page web
echo "<h1>Matrice générée :</h1>";
echo "<pre>$jsonMatrix</pre>";

// Afficher la matrice sous forme de tableau HTML
echo "<h1>Matrice sous forme de tableau HTML :</h1>";
echo "<table border='1'>";
foreach ($matrixArray as $row) {
    echo "<tr>";
    foreach ($row as $cell) {
        echo "<td>$cell</td>";
    }
    echo "</tr>";
}
echo "</table>";
?>
