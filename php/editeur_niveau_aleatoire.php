<?php

// Chemin vers l'exécutable du programme C
$executablePath = "/chemin/vers/votre/programme_c_executable";

// Commande pour exécuter le programme C avec une taille de grille aléatoire
$command = $executablePath;

// Exécution du programme C
exec($command, $output, $return_var);

// Vérification du statut de sortie
if ($return_var === 0) {
    // Affichage de la sortie du programme C
    foreach ($output as $line) {
        echo $line . "<br>";
    }
} 
else {
    // Affichage de la sortie d'erreur
    echo "Erreur lors de l'exécution du programme C : <br>";
    print_r($output);
}
?>