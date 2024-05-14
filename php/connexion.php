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
        if(isset($_COOKIE["id"])){
            $sql1 = $conn->prepare("SELECT * FROM comptes WHERE ID=:ID");
            $sql1->execute(array(':ID' => $_COOKIE["id"]));
            $compte = $sql1->fetchAll(PDO::FETCH_ASSOC);
            $_SESSION["Pseudo"]=$compte[0]['pseudo'];
            $_SESSION["Mail"]=$compte[0]['Mail'];
            $_SESSION["Mdp"]=$compte[0]['Mdp'];
            $_SESSION["id"]=intval($compte[0]['Id']);
            $_SESSION["auth"]=true;
            header("Location: "."compte.php");
            die();
        }

        if(isset($_POST["try_Mail"])){
            $try_Mdp=$_POST["try_Mdp"];
            $try_Mail=$_POST["try_Mail"];
            if(validedonee($try_Mail)!=false){
                $sql1 = $conn->prepare("SELECT * FROM comptes WHERE Mail=:Mail");
                $sql1->execute(array(':Mail' => $try_Mail));
                $compte = $sql1->fetchAll(PDO::FETCH_ASSOC);
                if(password_verify($try_Mdp,$compte[0]["Mdp"])==true){
                    $_SESSION["Pseudo"]=$compte[0]['pseudo'];
                    $_SESSION["Mail"]=$compte[0]['Mail'];
                    $_SESSION["Mdp"]=$compte[0]['Mdp'];
                    $_SESSION["id"]=intval($compte[0]['Id']);
                    $_SESSION["auth"]=true;
                    header("Location: "."index.php");
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
    
    <?php
        if($_SESSION['auth']==true){
            header("Location: "."index.php");
        }
    ?>
 
    <form method="post">
        <label>Mail:</label>
        <input type="email" name="try_Mail" />
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