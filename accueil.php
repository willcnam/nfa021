<?php
session_start();
if (empty($_SESSION['username'])) {
    header("Location: login.php");
}
?>
<html>
<head>
<meta charset="UTF-8">
<title>SharedGifts</title>
<link rel="stylesheet" type="text/css" href="main.css" />
</head>
<body>
	<h1>Accueil SharedGifts</h1>
	<h3>Bienvenue <?php echo ($_SESSION['username']); ?> dans SharedGifts</h3>
	<p> Votre mot de passe crypté : <?php echo ($_SESSION['password']); ?>
	</p>
	<p>
		Pour accéder à vos identifiants cliquez <a href="">ici</a>
	</p>
	<p>
		Si vous souhaitez partir, cliquez sur <a href="disconnection.php">déconnexion</a>

</body>
</html>