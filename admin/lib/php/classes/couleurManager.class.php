<?php

class CouleurManager extends Couleur {
    private $_db;
    private $_couleurArray=array();
  
    public function __construct($db) {
        $this->_db = $db;      
    }
    
    public function getCouleur($id){
        $query="select * from couleur where id_couleur = :id_couleur";
        $resultset = $this->_db->prepare($query);
        $resultset->bindValue(1,$id,PDO::PARAM_INT);
        $resultset->execute();
       
        $nbr=$resultset->rowCount();
        while($data = $resultset->fetch()) {
            $_couleurArray[] = new Couleur($data);
        }
        return $_couleurArray;
    }   
    
   
    
}
