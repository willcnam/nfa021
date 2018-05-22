<?php
session_start();
if (empty($_SESSION['username'])) {
    header("Location: login.php");
}
include_once 'connection.php';
include_once 'bmanager.php';

$bmanager = new Bmanager();
?>
<html>
<head>
<meta charset="UTF-8">
<title>Participant</title>
<link rel="stylesheet" type="text/css" href="evenement.css" />
</head>
<header>
<?php
// echo ($_GET['id']);
try {
    // Request participant
    $particip = $bmanager->getparticipantById($_GET['id']);
    if (sizeof($particip) > 0) {
        echo ('<h1>' . $particip[0]["email_ut"] . '</h1>');
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
		<li><a href="listeDesEvenements.php">Evénements</a></li>
		<li><a href="evenements.php">Liste des participants</a></li>
		<li><a href="" class="active">Participant</a></li>
	</ul>
</nav>
<section>
	<?php
echo ('<p>Liste des cadeaux pour ' . $particip[0]["email_ut"] . '</p>');
try {
    // Request inscrit list for this evt
    $cadeaux = $bmanager->getCadeauxForParticipant($_GET['id']);
    if (sizeof($cadeaux) > 0) {
        echo ('<table>');
        foreach ($cadeaux as $cadeau) {
            echo ('<tr><td>' . $cadeau["id_cadeau"] . ' ' . $cadeau["nom_cad"] . ' ' . $cadeau["prix_cad"] . ' ' . $cadeau["id_inscrit_de_cad"] . '</td></tr>');
        }
        echo ('</table>');
    } else {
        echo ('Aucun inscrit à cet évênement actuellement.');
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
<body></body>

</html>