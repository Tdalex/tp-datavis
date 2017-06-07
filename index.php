<!DOCTYPE html>
<html>
	<head>
		<title>Data Vizualisation - TP1</title>
		<!-- Inclusion CSS (librairie + perso) -->
		<link rel="stylesheet" type="text/css" href="css/jquery.jqplot.min.css">
		<link rel="stylesheet" type="text/css" href="css/dataviz.css">
		
		<!-- Inclusion JS (librairie + scripts de création de graph) -->
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/jquery.jqplot.min.js"></script>
		<script type="text/javascript" src="js/d3.min.js"></script>

		<script type="text/javascript" src="js/renderer/jqplot.pieRenderer.js"></script>
		
		<script type="text/javascript"> const user = <?php echo $_GET['user']; ?></script>
		<script type="text/javascript" src="js/dataviz.js"></script>
	</head>
	<body>
		<?php include ('structure/header.php'); ?>
		<div id="content">
			<h2>Evolution du nombre d’amis au fil du mois (en noir) et évolution de la popularité au fil du mois (en rouge)</h2>
			<div id="listeAmis"></div>
			<h2>Pourcentage des messages envoyés à des amis et à des non amis</h2>
			<div id="pie_chart"></div>
			<h2>Pourcentage d'amis masculins et féminins</h2>
			<div id="friend_chart"></div>
			
			<h2>Popularité de votre profil pour un sexe donné par tranche de notation </h2>
			<form>
				<input checked type="radio" id="radioH" name="gender" value="H"> Homme<br>
				<input type="radio" id="radioF" name="gender" value="F"> Femme<br>
			</form>
			<div id='divH' >
				<h3>Homme</h3>
				<div id="popularite_H"></div>
			</div>
			<div id='divF'>
				<h3>Femme</h3>
				<div id="popularite_F"></div>
			</div>
		</div>
		<?php include ('structure/footer.php'); ?>
	</body>
</html>