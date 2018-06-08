<?php
session_start();
if (empty($_SESSION['username'])) {
    header("Location: login.php");
}
include_once 'bmanager.php';
$bmanager = new Bmanager();
extract($_POST);

// NOUVELLE SUGGESTION DE CADEAU de l'utilisateur courant, pour l'evt courant et pour le participant de la page courante
if (!empty($suggestGiftButton) and !empty($nom_new_cad) ) {
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
    // Récupérer l'email du participant
    $particip = $bmanager->getparticipantById($_GET['id']);
    if (sizeof($particip) > 0) {
        $_SESSION['participantCourant'] = $particip[0]["email_ut"];
        echo ('<h1>Cadeaux pour ' . $_SESSION['participantCourant']. '</h1>');
    } else {}
} catch (Exception $e) {
    trigger_error($e->getMessage(), E_USER_ERROR);
}
echo(	'<h3>' . $_SESSION['username']. '</h3>');
?>
	</header>
	<nav>
		<ul>
			<li><a href="accueil.php">Evénements</a></li>
			<li><?php echo('<a href="evenement.php?id=' . $_SESSION['idEvtCourant'] . '">' . $_SESSION['evtCourant'] . '</a>')?></li>
			<li><a href="evenements.php" class="active"><?php echo($_SESSION['participantCourant'])?></a></li>
		</ul>
	</nav>
<!-- Proposer un cadeau  --> 
	<?php
//     L'utilisateur actuel participe-t-il à l'evt ?
if ( $bmanager->isParticipant($_SESSION['id_utilisateur'], $_SESSION['idEvtCourant'])) {
    echo ('<aside>
		<form action="participant.php?id=' . $_GET['id'] . '" method="post">
				<label for="nom_cad">Nouvelle suggestion de cadeau</label> <input type="text" id="nom_cad"
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
	</aside>');
} else {
    echo ('<div id="message">Pour faire une suggestion de cadeau, vous devez d\'abord participer à cet événement ('.$_SESSION['evtCourant'].')</div>');
}
echo ('<section>');
echo ('<br><h3>Les suggestions de cadeaux pour ' . $particip[0]["email_ut"] . '</h3>');

// Si l'utilisateur courant n'est pas le participant, on affiche les cadeaux
if ($_SESSION['username'] != $particip[0]["email_ut"]) {
    try {
        // Tableau des propositions de cadeaux
        $cadeaux = $bmanager->getCadeauxForParticipant($_GET['id']);
        if (sizeof($cadeaux) > 0) {
            echo ('<table>');
            foreach ($cadeaux as $cadeau) {
                // echo ('<tr><td>' . $cadeau["id_cadeau"] . '</td><td>' . $cadeau["nom_cad"] . '</td><td>' . $cadeau["prix_cad"] . '</td><td>' . $cadeau["id_inscrit_de_cad"] . '</td></tr>');
                echo ('<tr><td>' . $cadeau["nom_cad"] . '</td><td align="right">' . $cadeau["prix_cad"] . '</td><td>' . $cadeau["email_ut"] . '</td></tr>');
            }
            echo ('</table>');
        } else {
            echo ('<div id="message">... aucune suggestion pour l\'instant ...</div>');
        }
    } catch (Exception $e) {
        trigger_error($e->getMessage(), E_USER_ERROR);
    }
} else {
    echo ('<div id="message">Désolé !<br>Vous ne pouvez pas voir vos cadeaux,<br> mais vous pouvez en suggérer, les autres participants verront vos suggestions ;-)</div>');
}
echo ('</section>');

include_once 'footer.php';
?>
</body>

</html>