<?php
session_start();
if (empty($_SESSION['username'])) {
    header("Location: login.php");
}
include_once 'bmanager.php';
$bmanager = new Bmanager();
extract($_POST);

// Proposer un cadeau de l'utilisateur courant, pour l'evt courant et pour le participant de la page courante
if (!empty($suggestGiftButton) and !empty($nom_new_cad) and !empty($prix_new_cad)) {
    //echo ('$suggestGiftButton n est pas vide ');
    //echo ($_SESSION['id_utilisateur'].' - '. $_SESSION['idEvtCourant'] .' - '. $_GET['id'].' - '. $_POST['nom_new_cad'].' - '. $_POST['prix_new_cad']);
    $bmanager->suggestGift($_SESSION['id_utilisateur'], $_SESSION['idEvtCourant'], $_GET['id'], $_POST['nom_new_cad'], $_POST['prix_new_cad']);
}
?>
<html>
<head>
<meta charset="UTF-8">
<title>Participant</title>
<link rel="stylesheet" type="text/css" href="evenement.css" />
</head>
<body id="participant">
	<header id="participant">
<?php
// echo ($_GET['id']);
try {
    // Request participant
    $particip = $bmanager->getparticipantById($_GET['id']);
    if (sizeof($particip) > 0) {
        $_SESSION['participantCourant'] = $particip[0]["email_ut"];
        echo ('<h1>' . $_SESSION['participantCourant'] . '</h1>');
    } else {}
} catch (Exception $e) {
    trigger_error($e->getMessage(), E_USER_ERROR);
}
?>
	<h3>...</h3>
	</header>
	<nav>
		<ul>
			<li><a href="accueil.php">Evénements</a></li>
			<li><?php echo('<a href="evenement.php?id=' . $_SESSION['idEvtCourant'] . '">' . $_SESSION['evtCourant'] . '</a>')?></li>
			<li><a href="evenements.php" class="active"><?php echo($_SESSION['participantCourant'])?></a></li>
		</ul>
	</nav>
<!-- Proposer un cadeau  --> 
	<aside>
		<form action="participant.php?id=<?php echo ($_GET['id'])?>" method="post">
				<label for="nom_cad">Nouvelle propositin de cadeau</label> <input type="text" id="nom_cad"
					placeholder="Saisir un nom ..." name="nom_new_cad" />
				<label for="prix_cad"></label> <input type="text" id="nom_cad"
					placeholder="Saisir un prix" name="prix_new_cad" />
				<div class="boutons">
					<div>
						<label for="submitbutton"></label> 
						<input type="submit"
							id="suggestGiftButton" value="Proposer" name="suggestGiftButton"/>
					</div>
				</div>
		</form>
	</aside>

	<section>
	<?php
echo ('<p>Idées de cadeaux pour ' . $particip[0]["email_ut"] . '</p>');
try {
    // Liste des propositions de cadeau
    $cadeaux = $bmanager->getCadeauxForParticipant($_GET['id']);
    if (sizeof($cadeaux) > 0) {
        echo ('<table>');
        foreach ($cadeaux as $cadeau) {
            echo ('<tr><td>' . $cadeau["id_cadeau"] . '</td><td>' . $cadeau["nom_cad"] . '</td><td>' . $cadeau["prix_cad"] . '</td><td>' . $cadeau["id_inscrit_de_cad"] . '</td></tr>');
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
			<li><a href="disconnection.php">Déconnexion <?php echo ($_SESSION['username'])?></a></li>
			<li><a href="register.php">Inscription</a></li>
		</ul>
	</footer>
</body>

</html>