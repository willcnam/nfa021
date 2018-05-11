<?php
session_start();
include_once 'connection.php';
include_once 'bmanager.php';
extract($_POST);

if (isset($loginbutton)) {
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
<link rel="stylesheet" type="text/css" href="indexstyle.css" />
</head>
<body>
	<h1>Login</h1>
	<?php if (!empty($message)) {
	    echo ($message.'<br><br>');
	} ?>
	<form action="login.php" method="post">
		<input type="text" placeholder="E-mail" name="username" id="username" required autofocus /><br> <br> 
		<input type="password" placeholder="Password" name="password" id="password" required /><br> <br> 
					<div class="boutons">
		<input type="submit" name="loginbutton" value="Login" id="loginbutton" />
		</div>
	</form>
	<br>
	<a href="register.php">Créer un compte</a>
</body>
</html>