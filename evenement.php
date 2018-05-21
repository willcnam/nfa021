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
<title>Evenement</title>
<link rel="stylesheet" type="text/css" href="evenement.css" />
</head>
<header>
<?php
// echo ($_GET['id']);
try {
    // Ask for a pdo statement
    $connection = new Connection('127.0.0.1:3306', 'sharedgifts', 'UTF-8', 'root', '');
    $pdo = $connection->dbconnect();
    // Request evenement list
    $requete = 'select id_evenement, nom_evt from evenement where id_evenement=' . $_GET['id'] . ';"';
    $preparedStatement = $pdo->prepare($requete);
    $preparedStatement->execute();
    if ($preparedStatement->rowCount() > 0) {
        while ($evt = $preparedStatement->fetch()) {
            echo ('<h1>' . $evt["nom_evt"] . '</h1>');
        }
    } else {}
} catch (Exception $e) {
    trigger_error($e->getMessage(), E_USER_ERROR);
}
?>
	<h3>...</h3>
</header>
<nav>
	<ul>
		<li><a href="accueil.php">Accueil</a></li>
		<li><a href="listeDesEvenements.php" class="active">Evénements</a></li>
	</ul>
</nav>
<section>
	<p>Liste des inscrits</p>
	<?php
try {
    // Ask for a pdo statement
    $connection = new Connection('127.0.0.1:3306', 'sharedgifts', 'UTF-8', 'root', '');
    $pdo = $connection->dbconnect();
    // Request inscrit list
    $requete = 'select id_inscrit, id_utilisateur_ins, id_evenement_ins, email_ut 
from inscrit 
left join utilisateur
on id_utilisateur=id_utilisateur_ins where id_evenement_ins=' . $_GET['id'] . ';';
    $preparedStatement = $pdo->prepare($requete);
    $preparedStatement->execute();
    if ($preparedStatement->rowCount() > 0) {
        echo ('<table>');
        while ($isncrit = $preparedStatement->fetch()) {
            echo ('<tr><td><a href="">' . $isncrit["id_inscrit"] . ' ' . $isncrit["email_ut"] . '</a></td></tr>');
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