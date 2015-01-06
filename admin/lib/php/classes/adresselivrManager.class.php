<?php

class AdresselivrManager extends Adresselivr {
    private $_db;
    private $_adresseArray = array();

    public function __construct($db) {
        $this->_db = $db;
    }

    public function getAdresseLivre($id) {
        $query = "select * from adresse_livr where id_adresselivr=:id_adresse";
        $resultset = $this->_db->prepare($query);
        $resultset->bindValue(1, $id, PDO::PARAM_INT);
        $resultset->execute();
        $nbr = $resultset->rowCount();
        while ($data = $resultset->fetch()) {
            $_adresseArray[] = new Adresselivr($data);
        }
        return $_adresseArray;
    }
    public function getVilleLivr($id){
        $query = "select * from adresse_livr where id_ville=:id_ville";
        $resultset = $this->_db->prepare($query);
        $resultset->bindValue(1, $id, PDO::PARAM_INT);
        $resultset->execute();
        $nbr = $resultset->rowCount();
        while ($data = $resultset->fetch()) {
            $_adresseArray[] = new Adresselivr($data);
        }
        return $_adresseArray;
    }
    public function addAdresseLivr($idville,$ruelivr,$numlivre) {
        $query = "select add_adresselivr(:idville,:ruelivr,:numlivr) as retour";
        try {
            $statement = $this->_db->prepare($query);
            $statement->bindValue(1, $idville, PDO::PARAM_INT);
            $statement->bindValue(2, $ruelivr, PDO::PARAM_STR);
            $statement->bindValue(3, $numlivre, PDO::PARAM_INT);
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

