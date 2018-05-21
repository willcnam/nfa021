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
<title>Evenement</title>
<link rel="stylesheet" type="text/css" href="evenement.css" />
</head>
<header>
<?php
// echo ($_GET['id']);
try {
    // Request evenement
    $evt = $bmanager->getEvtById($_GET['id']);
    if (sizeof($evt) > 0) {
        echo ('<h1>' . $evt[0]["nom_evt"] . '</h1>');
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
		<li><a href="evenements.php" class="active">Liste des participants</a></li>
	</ul>
</nav>
<section>
	<?php
echo ('<p>Liste des participants à ' . $evt[0]["nom_evt"] . '</p>');
try {
    // Request inscrit list for this evt
    $inscrits = $bmanager->getInscritByEvt($_GET['id']);
    if (sizeof($inscrits) > 0) {
        echo ('<table>');
        foreach ($inscrits as $isncrit) {
            echo ('<tr><td><a href="">' . $isncrit["id_inscrit"] . ' ' . $isncrit["email_ut"] . '</a></td></tr>');
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