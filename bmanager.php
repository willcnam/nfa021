<?php
// Gestion des utilisateurs en base
session_start();
include_once 'connection.php';

class Bmanager
{

    private $dbconf;

    public function __construct()
    {
        $this->dbconf = include ('config/localdb.php');
    }

    public function login($username, $password)
    {
        if (isset($username) and isset($password)) {
            try {
                // Ask for a pdo statement
                $connection = new Connection($this->dbconf);
                $pdo = $connection->dbconnect();
                // Look for $username with $password in db
                $requete = 'select id_utilisateur, email_ut from utilisateur where email_ut = :username and mdp_ut = :password';
                $preparedStatement = $pdo->prepare($requete);
                $preparedStatement->execute(array(
                    ':username' => $username,
                    ':password' => sha1($password)
                ));
                if ($preparedStatement->rowCount() == 1) {
                    $_SESSION['username'] = $username;
                    $_SESSION['password'] = sha1($password);
                    $row = $preparedStatement->fetch();
                    $_SESSION['id_utilisateur'] = $row["id_utilisateur"];
                    // var_dump($row);
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

    public function listeDesEvenements()
    {
        try {
            // Ask for a pdo statement
            $connection = new Connection($this->dbconf);
            $pdo = $connection->dbconnect();
            // Request evenement list
            $requete = 'select id_evenement, nom_evt from evenement order by id_evenement desc';
            $preparedStatement = $pdo->prepare($requete);
            $preparedStatement->execute();
            if ($preparedStatement->rowCount() > 0) {
                $rows = $preparedStatement->fetchAll();
                return $rows;
            } else {
                echo ('Aucun évênement actuellement. Cliquez sur Créer un évênement');
                return null;
            }
        } catch (Exception $e) {
            trigger_error($e->getMessage(), E_USER_ERROR);
        }
    }

    public function creerEvenements($id_new_evt)
    {
        if (isset($id_new_evt) and ! empty($id_new_evt)) {
            try {
                // Ask for a pdo statement
                $connection = new Connection($this->dbconf);
                $pdo = $connection->dbconnect();
                // Creer un evenement
                $requete = 'insert into evenement (nom_evt) values (:id_new_evt)';
                $preparedStatement = $pdo->prepare($requete);
                $preparedStatement->execute(array(
                    ':id_new_evt' => $id_new_evt
                ));
            } catch (Exception $e) {
                if ((int) $e->getCode() == 23000) {
                    return "Cet événement existe déjà !";
                } else {
                    trigger_error($e->getMessage(), E_USER_ERROR);
                }
            }
        }
    }

    public function addCurrentUser2currentEvent($currentUser, $currentEvent)
    {
        if (! empty($currentUser) and ! empty($currentEvent)) {
            try {
                // Ask for a pdo statement
                $connection = new Connection($this->dbconf);
                $pdo = $connection->dbconnect();
                // Request one evenement
                $requete = 'insert into inscrit (id_utilisateur_ins, id_evenement_ins) values (:currentUser, :currentEvent)';
                $preparedStatement = $pdo->prepare($requete);
                $preparedStatement->execute(array(
                    ':currentUser' => $currentUser,
                    ':currentEvent' => $currentEvent
                ));
            } catch (Exception $e) {
                if ((int) $e->getCode() == 23000) {
                    return "Vous participer déjà à cet événement !";
                } else {
                    trigger_error($e->getMessage(), E_USER_ERROR);
                }
            }
        }
    }

    public function getEvtById($id)
    {
        try {
            // Ask for a pdo statement
            $connection = new Connection($this->dbconf);
            $pdo = $connection->dbconnect();
            // Request one evenement
            $requete = 'select id_evenement, nom_evt from evenement where id_evenement=' . $id . ';';
            $preparedStatement = $pdo->prepare($requete);
            $preparedStatement->execute();
            if ($preparedStatement->rowCount() > 0) {
                $row = $preparedStatement->fetchAll();
                return $row;
            } else {
                echo ('Aucun évênement avec cet id !');
                return null;
            }
        } catch (Exception $e) {
            trigger_error($e->getMessage(), E_USER_ERROR);
        }
    }

    public function getInscritsByEvt($id_evt)
    {
        try {
            // Ask for a pdo statement
            $connection = new Connection($this->dbconf);
            $pdo = $connection->dbconnect();
            // Request inscrit list by evt
            $requete = 'select id_inscrit, id_utilisateur_ins, id_evenement_ins, email_ut
                from inscrit
                left join utilisateur
                 on id_utilisateur=id_utilisateur_ins where id_evenement_ins=' . $id_evt . ';';
            $preparedStatement = $pdo->prepare($requete);
            $preparedStatement->execute();
            if ($preparedStatement->rowCount() > 0) {
                $rows = $preparedStatement->fetchAll();
                return $rows;
            } else {
                echo ('Aucun inscrit à cet évênement actuellement.');
                return null;
            }
        } catch (Exception $e) {
            trigger_error($e->getMessage(), E_USER_ERROR);
        }
    }

    public function getCadeauxForParticipant($id_inscrit)
    {
        try {
            // Ask for a pdo statement
            $connection = new Connection($this->dbconf);
            $pdo = $connection->dbconnect();
            // Request liste des cadeaux d'un inscrit
            $requete = 'select id_cadeau, nom_cad, prix_cad, id_inscrit_de_cad
                from inscrit
                left join cadeau
                on id_inscrit = id_inscrit_pour_cad
                where id_inscrit =' . $id_inscrit . ';';
            $preparedStatement = $pdo->prepare($requete);
            $preparedStatement->execute();
            if ($preparedStatement->rowCount() > 0) {
                $rows = $preparedStatement->fetchAll();
                return $rows;
            } else {
                echo ('Aucun cadeau pour ce participant.');
                return null;
            }
        } catch (Exception $e) {
            trigger_error($e->getMessage(), E_USER_ERROR);
        }
    }

    public function getparticipantById($id_participant)
    {
        try {
            // Ask for a pdo statement
            $connection = new Connection($this->dbconf);
            $pdo = $connection->dbconnect();
            // Request participant
            $requete = 'select id_inscrit, id_utilisateur_ins, email_ut, id_evenement_ins
                from inscrit
                left join utilisateur
                on id_utilisateur_ins = id_utilisateur
                where id_inscrit =' . $id_participant . ';';
            $preparedStatement = $pdo->prepare($requete);
            $preparedStatement->execute();
            if ($preparedStatement->rowCount() > 0) {
                $rows = $preparedStatement->fetchAll();
                return $rows;
            } else {
                echo ('Aucun participant avec cet id.');
                return null;
            }
        } catch (Exception $e) {
            trigger_error($e->getMessage(), E_USER_ERROR);
        }
    }

    // Proposer un cadeau de l'utilisateur courant, pour l'evt courant et pour le participant de la page courante
    public function suggestGift($id_utilisateur, $idEvtCourant, $id_participant_pour, $nom_cad, $prix_cad)
    {
        if (! empty($id_utilisateur) and ! empty($idEvtCourant) and ! empty($id_participant_pour) and ! empty($nom_cad) and ! empty($prix_cad)) {
            try {
                // Trouver l'id_participant de l'utilisateur
                // Ask for a pdo statement
                $connection = new Connection($this->dbconf);
                $pdo = $connection->dbconnect();
                // Request participant
                $requete = "select id_inscrit
                        from inscrit
                         where id_utilisateur_ins = :id_utilisateur 
                            and id_evenement_ins = :idEvtCourant ;";
                $preparedStatement = $pdo->prepare($requete);
                $preparedStatement->execute(array(
                    ':id_utilisateur' => $id_utilisateur,
                    ':idEvtCourant' => $idEvtCourant
                ));
                if ($preparedStatement->rowCount() > 0) {
                    $row = $preparedStatement->fetch();
                    $id_participant_de = $row['id_inscrit'];
                } else {
                    echo ('Aucun participant avec cet id.');
                    return null;
                }
                // Créer le cadeau
                $requete = 'insert into cadeau (nom_cad, prix_cad, id_inscrit_de_cad, id_inscrit_pour_cad) 
                                                values (:nom_cad, :prix_cad, :id_inscrit_de_cad, :id_inscrit_pour_cad)';
                $preparedStatement = $pdo->prepare($requete);
                $preparedStatement->execute(array(
                    ':nom_cad' => $nom_cad,
                    ':prix_cad' => $prix_cad,
                    ':id_inscrit_de_cad' => $id_participant_de,
                    ':id_inscrit_pour_cad' => $id_participant_pour
                ));
            } catch (Exception $e) {
                if ((int) $e->getCode() == 23000) {
                    return "Cette proposition de cadeau existe déjà !";
                } else {
                    trigger_error($e->getMessage(), E_USER_ERROR);
                }
            }
        }
    }
}
