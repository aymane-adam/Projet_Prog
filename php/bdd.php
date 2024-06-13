<?php
$servername = 'localhost';
$username = 'root';
$password = 'root';
$database = 'projet_2024_g12_lostisland';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage(); // Affiche l'erreur de connexion
    die();
}

function validedonee($donnee) {
    if ($donnee != null) {
        $donnee = trim($donnee);
        $donnee = stripslashes($donnee);
        $donnee = htmlspecialchars($donnee);
        return $donnee;
    } else {
        return false;
    }
}

function mailDejaPris($mail, $conn) {
    $sql1 = $conn->prepare("SELECT * FROM comptes WHERE Mail=:mail"); // On prépare la requête SQL
    $sql1->execute(array(':mail' => $mail));
    $resultat = $sql1->fetchAll(PDO::FETCH_ASSOC); //récupération du résultat 
    return sizeof($resultat);
}

function pseudoDejaPris($pseudo, $conn) {
    $sql = $conn->prepare("SELECT * FROM comptes WHERE Pseudo=:pseudo"); // On prépare la requête SQL
    $sql->execute(array(':pseudo' => $pseudo));
    $resultat = $sql->fetchAll(PDO::FETCH_ASSOC); // Récupération du résultat
    return sizeof($resultat) > 0;
}
?>
