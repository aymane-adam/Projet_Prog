<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/profil.css">
    <title>Profil de Pirate</title>
</head>
<body>
<?php 
   include('nav.php')
   ?>
<div class="profile-container">
    <div class="profile-header">
        <?php echo "<h1>Captain " . $_SESSION['pseudo'] . "</h1>"; ?>
    </div>
    
    <div class="profile-section">
        <h3>Statistiques</h3>
        <ul>
        <?php echo "<li>Trésors trouvés : " . $_SESSION['progression'] . "</li>"; ?>
        </ul>
    </div>
    
    <div class="profile-section">
        <h3>Création de maps :</h3>
        <ul>
        <?php
            // Connexion à la base de données
            require("bdd.php"); // Assurez-vous que ce fichier contient la connexion à la base de données

            // Requête SQL pour récupérer les niveaux créés par l'utilisateur
            $recup = "SELECT nom_niveau FROM niveaux WHERE createur = :pseudo";
            $stmt = $conn->prepare($recup);
            $stmt->bindParam(':pseudo', $_SESSION['pseudo']);
            $stmt->execute();
            $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Vérifier si des résultats ont été trouvés
            if (empty($resultat)) {
                echo "<li>Don't creation maps</li>";
            } else {
                // Affichage des résultats
                foreach ($resultat as $val) {
                    echo "<li>" . $val['nom_niveau'] . "</li>";
                }
            }
        ?>
        </ul>
    </div>
    
    <div class="profile-section">
        <h3>Contact</h3>
        <ul>
        <?php echo "<li>" . $_SESSION['mail'] . "</li>"; ?>
        </ul>
    </div>
</div>

<a href="deconnexion.php">Déconnexion</a>

</body>
</html>
