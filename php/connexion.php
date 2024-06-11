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
    <link rel="stylesheet" href="../css/formulaire_conn.css">

</head>
       
<body>

<?php 
   include('nav.php')
   ?>

<div id="azerty">
<?php
	try{
		require("bdd.php");               
		if(!empty($_POST['try_pseudo']) AND !empty($_POST['try_mdp'])){
            $pseudo = $_POST['try_pseudo'];
            $mdp = sha1($_POST['try_mdp']);

			$recup = $conn->prepare("SELECT pseudo,mdp FROM comptes WHERE pseudo = :pseudo AND mdp = :mdp");
			$recup->execute(
                array(
                ':pseudo' => $pseudo,
                ':mdp' => $mdp,
            ));
			if($recup->rowCount()>0){
                $_SESSION['pseudo'] = $pseudo;
			header("Location:index.php");
            }
            else{
                echo "Email ou mot de passe incorect";
            }
		}
	}                 
	catch(Exception $e){
		die("Erreur : " . $e->getMessage());
	}
?>

    <form method="post">
        <label>Pseudo:</label>
        <input type="text" name="try_pseudo" />
        <br>
        <br>
        <label>Mot de passe:</label>
        <input type="password" name="try_mdp" />
        <br>
        <br>
        <input type="submit" value="Se connecter"/>
        <p><a href="inscription.php">S'inscrire</a></p>
    </form>

</div>

</body>

</html>