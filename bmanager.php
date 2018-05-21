<?php
// Gestion des utilisateurs en base
session_start();
include_once 'connection.php';

class Bmanager
{

    private $dbconf;
    
    public function __construct()
    {
        $this->dbconf = include('config/localdb.php');
    }

    public function login($username, $password)
    {
        if (isset($username) and isset($password)) {
            try {
                // Ask for a pdo statement
                $connection = new Connection($this->dbconf);
                $pdo = $connection->dbconnect();
                // Look for $username with $password in db
                $requete = 'select email_ut from utilisateur where email_ut = :username and mdp_ut = :password';
                $preparedStatement = $pdo->prepare($requete);
                $preparedStatement->execute(array(
                    ':username' => $username,
                    ':password' => sha1($password)
                ));
                if ($preparedStatement->rowCount() == 1) {
                    $_SESSION['username'] = $username;
                    $_SESSION['password'] = sha1($password);
                    return true;
                } else {
                    $_SESSION['username'] = '';
                    $_SESSION['password'] = '';
                    return false;
                }
            } catch (Exception $e) {
                trigger_error($e->getMessage(), E_USER_ERROR);
            }
        }
    }

    public function addUser($username, $password, $repeatPassword)
    {
        if ($password == $passwordrepeat) {
            try {
                // Ask for a pdo statement
                $connection = new Connection($this->dbconf);
                $pdo = $connection->dbconnect();
                $pdo = $requete = 'insert into utilisateur (email_ut, mdp_ut) values (:email, :password)';
                $sth = $pdo->prepare($requete);
                $sth->execute(array(
                    ':email' => $email,
                    ':password' => $password
                ));
            } catch (Exception $e) {
                trigger_error($e->getMessage(), E_USER_ERROR);
            }
        } else {
            echo ("! Vous n'avez pas saisie deux fois le même mot de passe !");
        }
    }

    public function registerUser($email, $password, $passwordrepeat)
    {
        // Register new user
        if (! empty($email) && ! empty($password) && ! empty($passwordrepeat)) {
            try {
                // Ask for a pdo statement
                $connection = new Connection($this->dbconf);
                $pdo = $connection->dbconnect();
                // Cet email existe-t-il déjà ?
                $CountEmail_sql = 'Select count(email_ut) from utilisateur where email_ut = :email';
                $CountEmail_statement = $pdo->prepare($CountEmail_sql);
                $CountEmail_Done = $CountEmail_statement->execute(array(
                    ':email' => $email
                ));
                if ($CountEmail_Done) {
                    $numberOfEmail = $CountEmail_statement->fetch()["count(email_ut)"];
                    if (intval($numberOfEmail) > O) {
                        $message = "L'email $email existe déjà $numberOfEmail fois en base !";
                    } else {
                        // Les 2 mots de passe sont-ils identiques ?
                        if ($password != $passwordrepeat) {
                            $message = "Vous avez saisi deux mots de passe différents !";
                        } else {
                            $requete = 'insert into utilisateur (email_ut, mdp_ut) values (:email, :password)';
                            $sth = $pdo->prepare($requete);
                            $sth->execute(array(
                                ':email' => $email,
                                ':password' => sha1($password)
                            ));
                            $this->login($email, $password);
                            $message = "Cool ! Le compte $email vient d'être crée.";
                        }
                    }
                }
                return $message;
            } catch (Exception $e) {
                trigger_error($e->getMessage(), E_USER_ERROR);
            }
        }
    }
    
    public function listeDesEvenements() {
        
    }
    
}
