<?php
session_start();
include_once 'bmanager.php';

class Evenement {
    private $id;
    private $nom;
    private $dateDeCreation;
    private $dateDeModification;
    private $bmanager;
    
    public function __construct () {
        $this->bmanager = new Bmanager();
    }
    
    public function getListe() {
        try {
            // Liste des evenements sous forme de tableau html
            $evts = $this->bmanager->listeDesEvenements();
            if (sizeof($evts) > 0) {
                echo ('<table>');
                foreach ($evts as $evt) {
                    echo ('<tr><td><a href="evenement.php?id=' . $evt["id_evenement"] . '">' . $evt["nom_evt"] . '</a></td></tr>');
                }
                echo ('</table>');
            } else {
                echo ('Aucun évênement actuellement. Cliquez sur Créer un évênement');
            }
        } catch (Exception $e) {
            trigger_error($e->getMessage(), E_USER_ERROR);
        }
    }
    
}

?>
