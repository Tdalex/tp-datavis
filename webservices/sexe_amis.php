<?php
	// Le tableau de résultat
	$result_request = array();
	
	/*
		On teste si le paramètre GET existe
		0 -> tous les utilisateurs
		id_unique -> un seul utilisateur
		plusieurs id séparés par des virgules -> plusieurs utilisateurs
	*/
	if(isset($_GET['user'])) {
		// Connexion à la BDD
		include("../bdd/connexion_bdd.php");
		
		$user = $_GET['user'];
	
		$query = "SELECT user2
				FROM relations";
		if($user != 0) {
			$query = $query." WHERE user1 IN (".$user.")";
		}
		
		$result = mysqli_query($conn, $query);
	
		$femme = 0;
		$homme = 0;
		$all = 0;

		while ($row = mysqli_fetch_array($result)) {
			$query2 = "SELECT sexe FROM utilisateurs WHERE id=".$row[0];
			$result2 = mysqli_query($conn, $query2);
			while ($sexe = mysqli_fetch_array($result2)) {
				if ($sexe[0] == 0) {
					$femme++;
					$all++;
				}
				else{
					$homme++;
					$all++;
				}
			}
		}

		mysqli_free_result($result);
		mysqli_free_result($result2);
	
		$result_request[] = array("Hommes", intval($homme/$all*100));
		$result_request[] = array("Femmes", intval($femme/$all*100));

		// Déconnexion de la BDD
		include("../bdd/deconnexion_bdd.php");
	}
	
	// Renvoyer le résultat au javascript
	echo json_encode($result_request);

?>