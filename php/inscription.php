<!Doctype html>
<html lang="fr">

<head>

    <meta charset="UTF-8">
    <title> Inscription </title>

    <meta name="formulaire" content="inscription">
    <meta name="keyword" content="Nom,Prenom,Mail">
    <meta name="author" content="Morchain Alexis">

    <link rel="icon" type="images/x-icon" href="../img/logo.png">
    <link rel="stylesheet" href="../css/formulaire.css">

</head>
       
<body>
    <?php include_once("nav.php"); ?>

    <?php
        require("bdd.php");
        if(isset($_POST["Condition"])){
            if($_POST['mdp'] == $_POST['Cmdp']){
                $pseudo = $_POST['pseudo'];
                $mail = $_POST['mail'];
                $mdp = $_POST['mdp'];
                if(validedonee($pseudo)!=false && validedonee($mail)!=false && validedonee($mdp)!=false){
                    if(mailDejaPris($mail,$conn) == false){
                        $sql1 = $conn->prepare("INSERT INTO comptes(pseudo,mail,mdp)
                        VALUES (:pseudo,:mail,:mdp)"); // On prépare la requête SQL
        
                        $sql1->execute(
                            array(
                            ':pseudo' => $pseudo,
                            ':mail' => $mail,
                            ':mdp' => password_hash($mdp, PASSWORD_DEFAULT),
                        ));
                        header("Location: "."connexion.php");
                    }
                    else{
                        echo("Mail déjà utilisé");
                    }
                }
                else{
                    echo("Champ incorrecte ou innexistant");
                }
            }
            else{
                echo("Validation de mot de passe incorrecte");
            }
        }
    ?>
    
    <form method="post">
        <label>Pseudo:</label>
        <input type="text" name="pseudo" require/>
        <br>
        <br>
        <label>Mail:</label>
        <input type="email" name="mail" require/>
        <br>
        <br>
        <label>Mot de passe:</label>
        <input type="password" name="mdp" require/>
        <br>
        <br>
        <label>Confirmer mot de passe:</label>
        <input type="password" name="Cmdp" require/>
        <br>
        <br>
        <label>J'accepte les conditions générales </label>
        <input type="checkbox" name="Condition" require/>
        <br>
        <br>
        <input type="submit" value="S'insrire"/>
    </form>

    <?php include_once("footer.php"); ?>  
</body>
</html>