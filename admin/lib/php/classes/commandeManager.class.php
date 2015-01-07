<?php
class CommandeManager extends Commande {
    private $_db;
    private $_commandeArray = array();

    public function __construct($db) {
        $this->_db = $db;
    }
    
     public function getCommande($idcom) {
        $query = "select * from commande where id_com = :id_com";
        $resultset = $this->_db->prepare($query);
        $resultset->bindValue(1, $idcom, PDO::PARAM_INT);
        $resultset->execute();
        $data=$resultset->fetch();
        $_commandeArray[] = new Commande($data);
        return $_commandeArray;
    }

    public function addCommande($idcli, $idadresseliv,$etat) {
        $query = "select add_commande(:id_client,:id_adresselivr,:etat) as retour";
        try {
            $statement = $this->_db->prepare($query);
            $statement->bindValue(1, $idcli, PDO::PARAM_INT);
            $statement->bindValue(2, $idadresseliv, PDO::PARAM_INT);
            $statement->bindValue(3, $etat, PDO::PARAM_STR);
            $statement->execute();
            $retour = $statement->fetchColumn(0);
            return $retour;
        } catch (PDOException $e) {
            print "Echec de l'insertion : " . $e;
            $retour = 0;
            return $retour;
        }
    }
     public function updatePrixCom($idcom,$total) {
        $query = "select update_commande(:id_com,:total) as retour";
        try {
            $statement = $this->_db->prepare($query);
            $statement->bindValue(1, $idcom, PDO::PARAM_INT);
            $statement->bindValue(2, $total, PDO::PARAM_INT);
            $statement->execute();
            $retour = $statement->fetchColumn(0);
            return $retour;
        } catch (PDOException $e) {
            print "Echec de mise à jour : " . $e;
            $retour = 0;
            return $retour;
        }
    }
   
}