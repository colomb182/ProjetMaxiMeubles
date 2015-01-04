<?php

class PaysManager extends Pays {

    private $_db;
    private $_paysArray = array();

    public function __construct($db) {
        $this->_db = $db;
    }

    public function getListePays() {
        $query = "select * from pays";
        $resultset = $this->_db->prepare($query);
        $resultset->execute();
        $nbr = $resultset->rowCount();
        while ($data = $resultset->fetch()) {
            $_paysArray[] = new Pays($data);
        }
        return $_paysArray;
    }

    public function getPays($id) {
        $query = "select * from pays where id_pays=:id_pays";
        $resultset = $this->_db->prepare($query);
        $resultset->bindValue(1, $id, PDO::PARAM_INT);
        $resultset->execute();
        $nbr = $resultset->rowCount();
        while ($data = $resultset->fetch()) {
            $_paysArray[] = new Pays($data);
        }
        return $_paysArray;
    }

    public function addPays($nompays) {
        $query = "select add_pays(:nompays) as retour";
        try {
            $statement = $this->_db->prepare($query);
            $statement->bindValue(1, $nompays, PDO::PARAM_STR);
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
