<?php
session_start();
include_once 'connection.php';
include_once 'bmanager.php';
extract($_POST);

if (isset($login)) {
    if (! empty($username) and ! empty($password)) {
        try {
            $bmanager = new Bmanager();
            $loginOk = $bmanager->login($username, $password);
            if ($loginOk) {
                header('Location: accueil.php');
            } else {
                echo ("Erreur d'authentification !");
            }
        } catch (Exception $e) {
            trigger_error($e->getMessage(), E_USER_ERROR);
        }
    } else {
        $message = 'Erreur d\'authentification...';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>A3E1 Login</title>
<!-- <link rel="stylesheet" type="text/css" href="main.css" /> -->
</head>
<body>
	<h1>Login</h1>
	<?php if (!empty($message)) {
	    echo ($message.'<br><br>');
	} ?>
	<form action="login.php" method="post">
		<input type="text" placeholder="E-mail" name="username"
			id="username" /><br> <br> <input type="password"
			placeholder="Password" name="password" id="password" /><br> <br> <input
			type="submit" name="login" value="Login" />
	</form>
	<br>
	<a href="register.php">Créer un compte</a>
</body>
</html>