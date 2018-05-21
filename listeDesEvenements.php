<?php
session_start();
if (empty($_SESSION['username'])) {
    header("Location: login.php");
}
// include_once 'connection.php';
include_once 'bmanager.php';
?>
<html>
<head>
<meta charset="UTF-8">
<title>Evenements</title>
<link rel="stylesheet" type="text/css" href="evenement.css" />
</head>
<header>
	<h1>Liste des évênements</h1>
	<h3>Choisissez un évênement dans la liste</h3>
</header>
<nav>
	<ul>
		<li><a href="accueil.php">Accueil</a></li>
		<li><a href="listeDesEvenements.php" class="active">Evénements</a></li>
	</ul>
</nav>
<section>
	<p>Liste des évênements</p>
	<?php 
	try {
 	    // Request evenement list
	    $bmanager = new Bmanager();
	    $evts = $bmanager->listeDesEvenements();
	    if (sizeof($evts) > 0) {
 	        echo ('<table>');
 	        foreach ($evts as $evt) {
 	            echo ('<tr><td><a href="evenement.php?id='
 	                .$evt["id_evenement"]
 	                .'">'
 	                .$evt["nom_evt"]
 	                .'</a></td></tr>');
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
<footer>
	<ul>
		<li><a href="disconnection.php">Déconnexion</a></li>
		<li><a href="register.php">Inscription</a></li>
	</ul>
</footer>
</body>

</html>