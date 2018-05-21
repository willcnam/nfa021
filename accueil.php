<?php
session_start();
if (empty($_SESSION['username'])) {
    header("Location: login.php");
}
?>
<html>
<head>
<meta charset="UTF-8">
<title>SharedGifts</title>
<link rel="stylesheet" type="text/css" href="evenement.css" />
</head>
<header>
	<h1>Cadeaux Communs</h1>
	<h3>Bienvenue <?php echo ($_SESSION['username']); ?> !</h3>
</header>
<nav>
	<ul>
		<li><a href="accueil.php" class="active">Accueil</a></li>
		<li><a href="listeDesEvenements.php">Evénements</a></li>
	</ul>
</nav>
<section>
	<p>Bienvenue dans Cadeaux Communs, une application dédié à la gestion
		... des cadeaux offerts à plusieurs.</p>

	<!--
            EXPLICATIONS
        -->

	<h3>Faire des cadeaux à plusieurs</h3>
	<br>
	<ol>
		<li>Il faut d'abord créer un événement, par exemple : Noêl 2018.</li>
		<li>Puis s'inscrire à cet événement, vous devenez alors un
			participant. Ce qui vous permet :
			<ul>
				<li>de proposer des idées de cadeaux pour vous ou pour les autres
					participants</li>
				<li>de proposer une participation financière aux cadeaux des autres
					participants</li>
				<li>et surtout de recevoir un cadeau !!</li>
			</ul>
		</li>
	</ol>

	<a href="evenement.php"> <img
		class="gallery"
		alt="Cadeaux.jpeg"
		src="img/gifts.jpeg" />
	</a>
</section>
<footer>
	<ul>
		<li><a href="disconnection.php">Déconnexion</a></li>
		<li><a href="register.php">Inscription</a></li>
	</ul>
</footer>
</body>

</html>