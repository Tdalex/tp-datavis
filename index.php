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
		
		<script type="text/javascript"> const user = <?php echo $_GET['user']; ?></script>
		<script type="text/javascript" src="js/dataviz.js"></script>
	</head>
	<body>
		<?php include ('structure/header.php'); ?>
		<div id="content">
			<div class="listeAmis" id="bar_chart_random_values">
				<h1>Evolution du nombre d’amis au fil du mois (en noir) </h1>
				<h1>Evolution de la popularité au fil du mois (en rouge)</h1>
				<div id="listeAmis"></div>
			</div>
		</div>
		<?php include ('structure/footer.php'); ?>
	</body>
</html>