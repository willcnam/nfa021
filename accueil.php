<?php
session_start();
if (empty($_SESSION['username'])) {
    header("Location: login.php");
}
include_once 'bmanager.php';
$bmanager = new Bmanager();
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
<!-- 	<img id="banner" alt="Hy folks !" src="img/banner.png"> -->
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
// Créer un nouvel événement
if (!empty($id_new_evt) and !empty($createEventButton)) {
    $retour = $bmanager->creerEvenements($id_new_evt);
    echo ($retour);
}
try {
    // Liste des evenements
    $evts = $bmanager->listeDesEvenements();
    if (sizeof($evts) > 0) {
        echo ('<table>');
        foreach ($evts as $evt) {
            echo ('<tr><td><a href="evenement.php?id=' . $evt["id_evenement"] . '">' . $evt["nom_evt"] . '</a></td></tr>');
        }
        echo ('</table>');
    } else {
        echo ('Aucun évênement actuellement. Cliquez sur Créer un évênement');
    }
} catch (Exception $e) {
    trigger_error($e->getMessage(), E_USER_ERROR);
}
?>
</section>
	<section>
		<!--
            EXPLICATIONS
        -->

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

		<a href="evenement.php"> <img class="gallery" alt="Cadeaux.jpeg"
			src="img/gifts.jpeg" />
		</a>
	</section>

	<footer>
		<ul>
			<li><a href="disconnection.php">Déconnexion <?php echo ($_SESSION['username'])?></a></li>
			<li><a href="register.php">Inscription</a></li>
		</ul>
	</footer>
</body>

</html>