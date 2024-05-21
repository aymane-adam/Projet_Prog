<?php session_start(); ?>

<!Doctype html>
<html lang="fr">

<head>

    <meta charset="UTF-8">
    <title> Connexion </title>

    <meta name="formulaire" content="connexion">
    <meta name="keyword" content="Nom,Prenom,Mail">
    <meta name="author" content="Morchain Alexis">

    <link rel="icon" type="images/x-icon" href="../img/logo.png">
    <link rel="stylesheet" href="../css/formulaire.css">

</head>
       
<body>
    <?php include_once("nav.php"); ?>
   
    <?php
    require("bdd.php");

        if(isset($_POST["try_Pseudo"])){
            $try_Mdp=$_POST["try_Mdp"];
            $try_Pseudo=$_POST["try_Pseudo"];
            if(validedonee($try_Pseudo)!=false){
                $sql1 = $conn->prepare("SELECT * FROM comptes WHERE pseudo=:pseudo");
                $sql1->execute(array(':pseudo' => $try_Pseudo));
                $compte = $sql1->fetchAll(PDO::FETCH_ASSOC);
                if(password_verify($try_Mdp,$compte[0]['mdp'])==true){
                    $_SESSION["pseudo"]=$compte[0]['pseudo'];
                    $_SESSION["mail"]=$compte[0]['mail'];
                    $_SESSION["mdp"]=$compte[0]['mdp'];
                    $_SESSION["id_compte"]=intval($compte[0]['id_compte']);
                    $_SESSION["auth"]=true;
                    header("Location: "."../index.php");
                    die();
                }
                else{
                    echo("Mot de passe incorrecte");
                }
            }  
            else{
                echo("Veuillez saisir une adresse mail");
            }
        }        
    ?>

    <form method="post">
        <label>Pseudo:</label>
        <input type="Pseudo" name="try_Pseudo" />
        <br>
        <br>
        <label>Mot de passe:</label>
        <input type="password" name="try_Mdp" />
        <br>
        <br>
        <input type="submit" value="Se connecter"/>
    </form>
    <p><a href="inscription.php">S'inscrire</a></p>
    
    <?php include_once("footer.php"); ?> 

</body>

</html>