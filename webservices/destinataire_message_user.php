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
	
		$query = "SELECT destinataire
				FROM messages";
		if($user != 0) {
			$query = $query." WHERE emetteur IN (".$user.")";
		}
		
		$query2 = "SELECT destinataire
				FROM messages";
		if($user != 0) {
			$query2 = $query2.",relations WHERE emetteur IN (".$user.") AND emetteur=user1 AND user2=destinataire";
		}

		$result = mysqli_query($conn, $query);
		$result2 = mysqli_query($conn, $query2);


		while ($row = mysqli_fetch_array($result2)) {
			$friends[] = $row[0];
		}

		$not_friend = 0;
		$friend = 0;
		$all=0;

		while ($row = mysqli_fetch_array($result)) {
			for($i=0; $i<sizeof($friends); $i++) {
				if($row[0] != $friends[$i]) {
					$not_friend++;
					$all++;
				}
				else {
					$friend++;
					$all++;
				}
			}
		}
		
		mysqli_free_result($result);
		mysqli_free_result($result2);

		//$result_request= array($friend/$all*100,$not_friend/$all*100);

		$result_request[] = array("Amis", intval($friend/$all*100));
		$result_request[] = array("Non ami", intval($not_friend/$all*100));
	
		// Déconnexion de la BDD
		include("../bdd/deconnexion_bdd.php");
	}
	
	// Renvoyer le résultat au javascript
	echo json_encode($result_request);

?>