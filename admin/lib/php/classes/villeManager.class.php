<?php

class VilleManager extends Ville {

    private $_db;
    private $_villeArray = array();

    public function __construct($db) {
        $this->_db = $db;
    }

    public function getListeVille() {
        $query = "select * from ville";
        $resultset = $this->_db->prepare($query);
        $resultset->execute();
        $nbr = $resultset->rowCount();
        while ($data = $resultset->fetch()) {
            $_villeArray[] = new Ville($data);
        }
        return $_villeArray;
    }

    public function getVille($id) {
        $query = "select * from ville where id_ville=:id_ville";
        $resultset = $this->_db->prepare($query);
        $resultset->bindValue(1, $id, PDO::PARAM_INT);
        $resultset->execute();
        $nbr = $resultset->rowCount();
        while ($data = $resultset->fetch()) {
            $_villeArray[] = new Ville($data);
        }
        return $_villeArray;
    }

    public function addVille($idpays, $codepostal, $localite) {
        $query = "select add_ville(:idpays,:codepostal,:localite) as retour";
        try {
            $statement = $this->_db->prepare($query);
            $statement->bindValue(1, $idpays, PDO::PARAM_INT);
            $statement->bindValue(2, $codepostal, PDO::PARAM_INT);
            $statement->bindValue(3, $localite, PDO::PARAM_STR);
            $statement->execute();
            $retour = $statement->fetchColumn(0);
            return $retour;
        } catch (PDOException $e) {
            print "Echec de l'insertion : " . $e;
            $retour = 0;
            return $retour;
        }
    }

}
