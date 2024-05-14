<?php	
	
	$servername ='localhost'; 
	$username ='root';
	$password ='root'; 
	$database ='projet_2024_g12_lostisland';
	
	$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	function validedonee($donnee){
		if($donnee!=Null){
			$donnee=trim($donnee);
			$donnee=stripslashes($donnee);
			$donnee=htmlspecialchars($donnee);
			return $donnee;
		}
		else{
			return false;
		}
	}

	function mailDejaPris($mail,$conn){  
		$sql1 = $conn->prepare("SELECT * FROM comptes WHERE Mail=:mail"); // On prépare la requête SQL
		$sql1->execute(array(':mail' => $mail));
		$resultat = $sql1->fetchAll(PDO::FETCH_ASSOC); //récupération du résultat 
		return sizeof($resultat);
	}
?>