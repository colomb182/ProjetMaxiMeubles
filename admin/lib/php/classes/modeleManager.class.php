<?php

class ModeleManager extends Modele {
    private $_db;
    private $_modeleArray=array();
    
    public function __construct($db) {
        $this->_db = $db;      
    }
    
    public function getListeSelection($id){
        $query="select * from modele where id_cat = :id_cat";
        $resultset = $this->_db->prepare($query);
        $resultset->bindValue(1,$id,PDO::PARAM_INT);
        $resultset->execute();
       
        $nbr=$resultset->rowCount();
        while($data = $resultset->fetch()) {
            $_modeleArray[] = new Modele($data);
        }
        return $_modeleArray;
    }
    public function getModele($id){
        $query="select * from modele where id_modele = :id_modele";
        $resultset = $this->_db->prepare($query);
        $resultset->bindValue(1,$id,PDO::PARAM_INT);
        $resultset->execute();
       
        $nbr=$resultset->rowCount();
        while($data = $resultset->fetch()) {
            $_modeleArray[] = new Modele($data);
        }
        return $_modeleArray;
    }   
}
    
