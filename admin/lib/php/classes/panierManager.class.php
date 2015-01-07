<?php

class PanierManager extends Panier {

    private $_db;
    private $_panierArray = array();

    public function __construct($db) {
        $this->_db = $db;
    }

    public function getListeProduits($id) {
        $query = "select * from panier where id_client = :id_client";
        $resultset = $this->_db->prepare($query);
        $resultset->bindValue(1, $id, PDO::PARAM_INT);
        $resultset->execute();
        $nbr = $resultset->rowCount();
        while ($data = $resultset->fetch()) {
            $_panierArray[] = new Modele($data);
        }
        return $_panierArray;
    }

    public function verifListeProduit($id) {
        $query = "select * from panier where id_client = :id_client";
        $resultset = $this->_db->prepare($query);
        $resultset->bindValue(1, $id, PDO::PARAM_INT);
        $resultset->execute();
        $nbr = $resultset->rowCount();
        return $nbr;
    }

    public function getModele($id) {
        $query = "select * from modele where id_modele = :id_modele";
        $resultset = $this->_db->prepare($query);
        $resultset->bindValue(1, $id, PDO::PARAM_INT);
        $resultset->execute();
        $data = $resultset->fetch();
        $_panierArray[] = new Modele($data);
        return $_panierArray;
    }

    public function addLignePanier($idcli, $idmodele, $qtte) {
        $query = "select add_panier(:id_client,:id_modele,:quantiteprod) as retour";
        try {
            $statement = $this->_db->prepare($query);
            $statement->bindValue(1, $idcli, PDO::PARAM_INT);
            $statement->bindValue(2, $idmodele, PDO::PARAM_INT);
            $statement->bindValue(3, $qtte, PDO::PARAM_INT);
            $statement->execute();
            $retour = $statement->fetchColumn(0);
            return $retour;
        } catch (PDOException $e) {
            //print "Echec de l'insertion : " . $e;
            $retour = 0;
            return $retour;
        }
    }

    public function updatePanier($idcli, $idmodele, $qtte) {
        $query = "select update_panier(:id_client,:id_modele,:quantiteprod) as retour";
        try {
            $statement = $this->_db->prepare($query);
            $statement->bindValue(1, $idcli, PDO::PARAM_INT);
            $statement->bindValue(2, $idmodele, PDO::PARAM_INT);
            $statement->bindValue(3, $qtte, PDO::PARAM_INT);
            $statement->execute();
            $retour = $statement->fetchColumn(0);
            return $retour;
        } catch (PDOException $e) {
            print "Echec de l'insertion : " . $e;
            $retour = 0;
            return $retour;
        }
    }

    public function suppMeuble($idcli, $idmodele, $qtte) {
        $query = "select supp_meuble(:id_client,:id_modele,:quantiteprod) as retour";
        try {
            $statement = $this->_db->prepare($query);
            $statement->bindValue(1, $idcli, PDO::PARAM_INT);
            $statement->bindValue(2, $idmodele, PDO::PARAM_INT);
            $statement->bindValue(3, $qtte, PDO::PARAM_INT);
            $statement->execute();
            $retour = $statement->fetchColumn(0);
            return $retour;
        } catch (PDOException $e) {
            print "Echec de l'insertion : " . $e;
            $retour = 0;
            return $retour;
        }
    }
    public function suppPanierCli($idcli) {
        $query = "select supp_paniercli(:id_client) as retour";
        try {
            $statement = $this->_db->prepare($query);
            $statement->bindValue(1, $idcli, PDO::PARAM_INT);
            $statement->execute();
            $retour = $statement->fetchColumn(0);
            return $retour;
        } catch (PDOException $e) {
            print "Echec de l'insertion : " . $e;
            $retour = 0;
            return $retour;
        }
    }

    public function suppLignePanier($idcli, $idmodele) {
        //var_dump($data);
        $query = "select supp_panier(:id_client,:id_modele) as retour";
        try {
            $statement = $this->_db->prepare($query);
            $statement->bindValue(1, $idcli, PDO::PARAM_INT);
            $statement->bindValue(2, $idmodele, PDO::PARAM_INT);
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
