<?php

class LivrerManager extends Livrer {

    private $_db;
    private $_livrerArray = array();

    public function __construct($db) {
        $this->_db = $db;
    }

    public function getLivrerCli($idcli) {
        $query = "select * from livrer where id_client=:id_client";
        $resultset = $this->_db->prepare($query);
        $resultset->bindValue(1, $idcli, PDO::PARAM_INT);
        $resultset->execute();
        $nbr = $resultset->rowCount();
        while ($data = $resultset->fetch()) {
            $_livrerArray[] = new Livrer($data);
        }
        return $_livrerArray;
    }

    public function getLivrer($idcli, $idadresselivr) {
        $query = "select * from livrer where id_client=:idclient and id_adresselivr=:idadresselivr";
        $resultset = $this->_db->prepare($query);
        $resultset->bindValue(1, $idcli, PDO::PARAM_INT);
        $resultset->bindValue(2, $idadresselivr, PDO::PARAM_INT);
        $resultset->execute();
        $nbr = $resultset->rowCount();
        while ($data = $resultset->fetch()) {
            $_livrerArray[] = new Livrer($data);
        }
        return $_livrerArray;
    }

    public function addAdresseLivr($idcli, $idadresselivr) {
        $query = "select add_livrer(:idclient,:idadresselivr) as retour";
        try {
            $statement = $this->_db->prepare($query);
            $statement->bindValue(1, $idcli, PDO::PARAM_INT);
            $statement->bindValue(2, $idadresselivr, PDO::PARAM_INT);
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
