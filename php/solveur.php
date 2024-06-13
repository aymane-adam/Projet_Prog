<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/level.css">
        <title>Level Page</title>
    </head>

    <?php
        copy('..\C\coopteam\x64\Debug\solveur.exe','solveur\solveur.exe');

        require("bdd.php");
        $sq11 = $conn->prepare("SELECT * FROM `niveaux`"); // On prépare la requête SQL
        $sq11->execute();
        $resultat = $sq11->fetchAll(PDO::FETCH_ASSOC); //récupération du résultat 

        $json = $resultat[0]["contenu"]; //on prend le premier niveau json dans la base
        var_dump($json);

        $command = "main\solveur.exe";
        $escapedArgument = addcslashes($json, '"\\');
        $fullCommand = $command . '"' . $escapedArgument . '"';
        
        exec($fullCommand, $output);

        foreach ($output as $line) {
            echo $line . "<br>"; //affiche le retour du programme C.
            // Il sera ensuite simple de récupérer le résultat renvoyé par le C comme une résolution de niveau
        }
    ?>
</html>