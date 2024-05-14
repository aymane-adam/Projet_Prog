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
            if($_POST['Mdp'] == $_POST['Cmdp']){
                $nom = $_POST['Nom']; 
                $prenom = $_POST['Prenom'];
                $email = $_POST['Mail'];
                $password = $_POST['Mdp'];
                if(validedonee($nom)!=false && validedonee($prenom)!=false && validedonee($email)!=false && validedonee($password)!=false){
                    if(mailDejaPris($email,$conn) == false){
                        $sql1 = $conn->prepare("INSERT INTO comptes(Nom,Prenom,Mail,Mdp)
                        VALUES (:Nom,:Prenom,:Mail,:Mdp)"); // On prépare la requête SQL
        
                        $sql1->execute(
                            array(':Nom' => $nom,
                            ':Prenom' => $prenom,
                            ':Mail' => $email,
                            ':Mdp' => password_hash($password, PASSWORD_DEFAULT),
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
        <input type="email" name="Mail" require/>
        <br>
        <br>
        <label>Mot de passe:</label>
        <input type="password" name="Mdp" require/>
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