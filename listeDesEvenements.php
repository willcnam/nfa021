<?php
session_start();
if (empty($_SESSION['username'])) {
    header("Location: login.php");
}
include_once 'connection.php';
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
	    // Ask for a pdo statement
	    $connection = new Connection('127.0.0.1:3306', 'sharedgifts', 'UTF-8', 'root', '');
	    $pdo = $connection->dbconnect();
	    // Request evenement list
	    $requete = 'select id_evenement, nom_evt from evenement order by id_evenement desc';
	    $preparedStatement = $pdo->prepare($requete);
	    $preparedStatement->execute();
	    if ($preparedStatement->rowCount() > 0) {
	        echo ('<table>');
	        while ($evt = $preparedStatement->fetch()) {
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