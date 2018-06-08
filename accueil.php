<?php
session_start();
if (empty($_SESSION['username'])) {
    header("Location: login.php");
}
include_once 'bmanager.php';
$bmanager = new Bmanager();
include_once 'classeEvenement.php';
$evenement = new Evenement();

extract($_POST);
?>
<html>
<head>
<meta charset="UTF-8">
<title>SharedGifts</title>
<link rel="stylesheet" type="text/css" href="evenement.css" />
</head>
<body id="accueil">

	<header id="accueil">
		<h1>Cadeaux Communs</h1>
		<h3>Bienvenue <?php echo ($_SESSION['username']); ?> !</h3>
	</header>
	
	<nav>
		<ul>
			<li><a href="" class="active">Evénements</a></li>
		</ul>
	</nav>

	<section>
		<p>Bienvenue dans Cadeaux Communs, une application dédié à la gestion
			des cadeaux offerts à plusieurs.</p>
	</section>

	<!-- EXPLICATIONS -->
	<section>
		<br>
		<h3>Faire des cadeaux à plusieurs</h3>
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
<!-- 		<a href="evenement.php"> <img class="gallery" alt="Cadeaux.jpeg"
			src="img/gifts.jpeg" />
		</a>
 -->
 	</section>

<!-- EVENEMENTS  --> 
	<section id="liste-evts">
		<br>
		<h3>Liste des évênements</h3>
		
<!-- Créer un événement  --> 
	<aside>
		<form action="accueil.php" method="post">
				<label for="nom_evt">Nouvel événement :</label> <input type="text" id="nom"
					placeholder="Saisir un nom ..." name="id_new_evt" />
				<div class="boutons">
					<div>
						<label for="submitbutton"></label> 
						<input type="submit"
							id="createEventButton" value="Créer" name="createEventButton"/>
					</div>
				</div>
		</form>
	</aside>
	<?php
if (!empty($id_new_evt) and !empty($createEventButton)) {
    echo ($bmanager->creerEvenements($id_new_evt));
}

// Afficher la liste des événements
$evenement->getListe() ;
echo ('</section>');

include_once 'footer.php';
?>
	
</body>

</html>