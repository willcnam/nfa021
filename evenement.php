<?php
session_start();
if (empty($_SESSION['username'])) {
    header("Location: login.php");
}
include_once 'bmanager.php';
$bmanager = new Bmanager();
extract($_POST);

// Participer à l'evt courant
if (!empty($participerEvt)) {
    $bmanager->addCurrentUser2currentEvent($_SESSION['id_utilisateur'], $_SESSION["idEvtCourant"]);
}
?>
<html>
<head>
<meta charset="UTF-8">
<title>Evenement</title>
<link rel="stylesheet" type="text/css" href="evenement.css" />
</head>
<body id="evenement">
<?php
echo ('<header id="evenement">');
try {
    // Request evenement
    $particip = $bmanager->getEvtById($_GET['id']);
    if (sizeof($particip) > 0) {
        $_SESSION['evtCourant'] = $particip[0]["nom_evt"];
        $_SESSION['idEvtCourant'] = $particip[0]["id_evenement"];
        echo ('<h1>' . $_SESSION['evtCourant'] . '</h1>');
    } else {}
} catch (Exception $e) {
    trigger_error($e->getMessage(), E_USER_ERROR);
}
echo ('
<h3>...</h3>
</header>
<nav>
	<ul>
		<li><a href="accueil.php">Evénements</a></li>
		<li><a href="" class="active">' . $_SESSION['evtCourant'] . '</a></li>
	</ul>
</nav>
<section>');

// Liste des participants
echo ('<br><h3>Liste des participants à ' . $_SESSION['evtCourant'] . '</h3>');
try {
    // Request inscrit list for this evt
    $inscrits = $bmanager->getInscritsByEvt($_GET['id']);
    if (sizeof($inscrits) > 0) {
        echo ('<table>');
        foreach ($inscrits as $isncrit) {
            echo ('<tr><td><a href="participant.php?id=' . $isncrit["id_inscrit"] . '">' . $isncrit["id_inscrit"] . ' ' . $isncrit["email_ut"] . '</a></td></tr>');
        }
        echo ('</table>');
    } else {
        echo ('Aucun inscrit à cet évênement actuellement.');
    }
} catch (Exception $e) {
    trigger_error($e->getMessage(), E_USER_ERROR);
}
// Bouton Participer
echo ('</section>');
echo ('<form action="evenement.php?id='.$_GET['id'].'" method="post">');
echo ('		<input type="submit" id="participerEvt" value="Participer" name="participerEvt"/>
	</form>');
?>
	<footer>
		<ul>
			<li><a href="disconnection.php">Déconnexion</a></li>
			<li><a href="register.php">Inscription</a></li>
		</ul>
	</footer>

</body>

</html>