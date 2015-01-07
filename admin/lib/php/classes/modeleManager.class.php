<?php

class ModeleManager extends Modele {

    private $_db;
    private $_modeleArray = array();

    public function __construct($db) {
        $this->_db = $db;
    }

    public function getListeSelection($id) {
        $query = "select * from modele where id_cat = :id_cat";
        $resultset = $this->_db->prepare($query);
        $resultset->bindValue(1, $id, PDO::PARAM_INT);
        $resultset->execute();

        $nbr = $resultset->rowCount();
        while ($data = $resultset->fetch()) {
            $_modeleArray[] = new Modele($data);
        }
        return $_modeleArray;
    }
    public function getListeModele() {
        $query = "select * from modele";
        $resultset = $this->_db->prepare($query);
        $resultset->execute();

        $nbr = $resultset->rowCount();
        while ($data = $resultset->fetch()) {
            $_modeleArray[] = new Modele($data);
        }
        return $_modeleArray;
    }

    /* public function getModele($id){
      $query="select * from modele where id_modele = :id_modele";
      $resultset = $this->_db->prepare($query);
      $resultset->bindValue(1,$id,PDO::PARAM_INT);
      $resultset->execute();

      $nbr=$resultset->rowCount();
      while($data = $resultset->fetch()) {
      $_modeleArray[] = new Modele($data);
      }
      return $_modeleArray;
      } */

    public function getModele($id) {
        $query = "select * from modele where id_modele = :id_modele";
        $resultset = $this->_db->prepare($query);
        $resultset->bindValue(1, $id, PDO::PARAM_INT);
        $resultset->execute();
        $data = $resultset->fetch();
        $_modeleArray[] = new Modele($data);
        return $_modeleArray;
    }
     public function getListeModelePage($idcat,$nbreModele,$debut){
        $query="select * from modele where id_cat=:idcat order by id_modele asc LIMIT :limit offset :debut";
        $resultset = $this->_db->prepare($query);
        $resultset->bindValue(1,$idcat,PDO::PARAM_INT);
        $resultset->bindValue(2,$nbreModele,PDO::PARAM_INT);
        $resultset->bindValue(3,$debut,PDO::PARAM_INT);
        try {
        $resultset->execute();
        } catch (PDOException $e) {
            print "Echec de l'insertion : " . $e;
        }
        $nbr=$resultset->rowCount();
        while($data = $resultset->fetch()) {
            $_modeleArray[] = new Modele($data);
        }
        return $_modeleArray;
    }

    
    public function getListeRechModele($motcle) {
        try {
            $query = "select * from modele where upper(type) like upper(:type)";
            $resultset = $this->_db->prepare($query);
            $resultset->bindValue(1, $motcle, PDO::PARAM_STR);
            $resultset->execute();
            $_resultatArray = array();
        } catch (PDOException $e) {
            print "Echec de la requ&ecirc;te " . $e->getMessage();
        }
        $nbr = $resultset->rowCount();
        if ($nbr > 0) {
            while ($data = $resultset->fetch()) {
                $_resultatArray[] = new Modele($data);
            }
            return $_resultatArray;
        }
    }

}
