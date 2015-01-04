<?php

class CategorieManager extends Categorie {

    private $_db;
    private $_categorieArray = array();

    public function __construct($db) {
        $this->_db = $db;
    }

    public function getListeCategorie() {
        try {
            $query = "select * from categorie";
            $resultset = $this->_db->prepare($query);
            $resultset->execute();
        } catch (PDOException $e) {
            print "Echec de la requ&ecirc;te " . $e->getMessage();
        }

        while ($data = $resultset->fetch()) {
            $_categorieArray[] = new Categorie($data);
        }

        return $_categorieArray;
    }
    public function getListeRechCat($motcle) {
        try {
            $query = "select * from categorie where upper(nom_cat) like upper(:nom_cat)";
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
                $_resultatArray[] = new Categorie($data);
            }
            return $_resultatArray;
        }
    }

}
