<?php
session_start();
if (empty($_SESSION['username'])) {
    header("Location: login.php");
}

// footer
echo ("	<br><br><footer>
		<ul>
			<li><a href=\"\"> ");
			echo ($_SESSION['username']);
echo ("</a></li>
			<li><a href=\"disconnection.php\">Déconnexion</a></li>
			<li><a href=\"register.php\">Créer un compte</a></li>
		</ul>
	</footer>");
			    
?>