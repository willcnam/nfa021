<?php
session_start();
// include_once 'connection.php';
include_once 'bmanager.php';
// header('Content-type: text/html; charset=utf-8');
?>

<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
<title>Inscription</title>
<link rel="stylesheet" type="text/css" href="indexstyle.css" />
<script type="text/javascript" src="index.js"></script>
</head>

<body>
	<h1>Créer un compte</h1>
	<form action="register.php" method="post">
		<fieldset>
			<legend>Seuls  email et mot de passe sont obligatoires</legend>
			<div>
				<label for="nom">Nom :</label> <input type="text" id="nom"
					placeholder="votre nom" name="nom"  />
			</div>
			<div>
				<label for="prenom">Préom :</label> <input type="text" id="prenom"
					placeholder="votre prénom" name="prenom" />
			</div>
			<div>
				<label for="email">E-mail :</label> <input type="email" id="email"
					placeholder="votre e-mail" name="email" required autofocus/>
			</div>
			<div>
				<label for="password">Mot de passe :</label> <input type="password"
					id="password" placeholder="choisissez un mot de passe"
					name="password" required />
			</div>
			<div>
				<label for="passwordrepeat">Mot de passe (encore...) :</label> <input
					type="password" id="passwordrepeat"
					placeholder="confirmez votre mot de passe" name="passwordrepeat" required />
			</div>
			<div class="boutons">
				<div>
					<label for="submitbutton"></label><input type="submit"
						id="submitbutton" value="Créer mon compte" name="submitbutton" />
				</div>
				<div>
					<label for="effacer"></label><input type="reset" id="boutoneffacer"
						value="Effacer" name="boutoneffacer" />
				</div>
			</div>
		</fieldset>
	</form>
</body>

</html>

<?php
extract($_POST);
if (!empty($submitbutton) and !empty($email)){
    if (!empty($email) and !empty($password) and !empty($passwordrepeat)) {
        $bmanager = new Bmanager();
        $message = $bmanager->registerUser($email, $password, $passwordrepeat);
        echo ('<br>'.$message);
    }
}


// DEBUG Ask for a pdo statement
// $connection = new Connection('127.0.0.1:3306', 'sharedgifts', 'UTF-8', 'root', '');
// $pdo = $connection->dbconnect();

// try {
//     $requete = 'select * from utilisateur';
//     $sth = $pdo->prepare($requete);
//     $sth->execute();
//     while ($user = $sth->fetch()) {
//         echo ('</br>');
//         $data = $user[id_ut] . "\t" . $user[email_ut] . "\t" . $user[mdp_ut] . "\n";
//         print $data;
//     }
// } catch (Exception $e) {
//     trigger_error($e->getMessage(), E_USER_ERROR);
// }
?>