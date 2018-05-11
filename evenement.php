<?php
session_start();
if (empty($_SESSION['username'])) {
    header("Location: login.php");
}
?>
<html>
<head>
<meta charset="UTF-8">
<title>Evenements</title>
<link rel="stylesheet" type="text/css" href="evenement.css" />
</head>
<header>
	<h1>Liste des évênements</h1>
	<h3>Cliquez sur un évênement</h3>
</header>
<nav>
	<ul>
		<li><a href="accueil.php">Accueil</a></li>
		<li><a href="evenement.php" class="active">Evénements</a></li>
	</ul>
</nav>
<section>
	<p>Vous pouvez choisir l'évênement auquel participer</p>
</section>
<footer>
	<ul>
		<li><a href="disconnection.php">Déconnexion</a></li>
		<li><a href="register.php">Inscription</a></li>
	</ul>
</footer>
</body>

</html>