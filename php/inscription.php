<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <meta name="formulaire" content="inscription">
    <meta name="keyword" content="Nom,Prenom,Mail">
    <meta name="author" content="Morchain Alexis">
    <link rel="icon" type="images/x-icon" href="../img/logo.png">
    <link rel="stylesheet" href="../css/formulaire_insc.css">
</head>
       
<body>
   <?php 
   include('nav.php')
   ?>
  <div id="azerty">
  <?php
    require("bdd.php");
    
    if(isset($_POST["Condition"])) {
        if($_POST['mdp'] == $_POST['Cmdp']) {
            $pseudo = $_POST['pseudo'];
            $mail = $_POST['mail'];
            $mdp = sha1($_POST['mdp']);
            $progression = 1;
            
            if(validedonee($pseudo) != false && validedonee($mail) != false && validedonee($mdp) != false) {
                if(mailDejaPris($mail, $conn) == false && pseudoDejaPris($pseudo, $conn) == false) {
                    $sql1 = $conn->prepare("INSERT INTO comptes(pseudo, mail, mdp, progression)
                        VALUES (:pseudo, :mail, :mdp, :progression)");
        
                    $sql1->execute(array(
                        ':pseudo' => $pseudo,
                        ':mail' => $mail,
                        ':mdp' => $mdp,
                        ':progression' => $progression,
                    ));
                    
                    if($sql1->rowCount() > 0) {
                        $_SESSION['pseudo'] = $pseudo;
                        $_SESSION['progression'] = $progression;
                        $_SESSION['mail'] = $mail;
                        header("Location: index.php");
                        exit(); // Assurez-vous de terminer le script après la redirection
                    }
                } 
                else if(mailDejaPris($mail, $conn) != false){
                    echo '<script>alert("Email déjà utilisé");</script>';
                }
                else if(pseudoDejaPris($pseudo, $conn) != false){
                    echo '<script>alert("Pseudo déjà utilisé");</script>';
                }
            } 
            else {
                echo '<script>alert("Champ incorrect ou inexistant");</script>';
            }
        } 
        else {
            echo '<script>alert("Validation de mot de passe incorrecte");</script>';
        }
    }
    ?>
    
    <form method="post">
        <label>Nickname:</label>
        <input type="text" name="pseudo" required/>
        <br>
        <br>
        <label>E-mail:</label>
        <input type="email" name="mail" required/>
        <br>
        <br>
        <label>Password:</label>
        <input type="password" name="mdp" required/>
        <br>
        <br>
        <label>Confirm password:</label>
        <input type="password" name="Cmdp" required/>
        <br>
        <br>
        <label>Accept the terms and conditions </label>
        <input type="checkbox" name="Condition" required/>
        <br>
        <br>
        <input type="submit" value="To register"/>
    </form> 

  </div>
    
</body>
</html>
