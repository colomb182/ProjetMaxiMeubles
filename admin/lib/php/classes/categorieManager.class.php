<?php
class CategorieManager extends Categorie {
    private $_db;
    private $_categorieArray = array();
    
    public function __construct($db) {
        $this->_db = $db;
    }
    
    public function getListeCategorie(){
        try {
            $query="select * from categorie";
            $resultset= $this->_db->prepare($query);
            $resultset->execute();            
        }catch(PDOException $e) {
            print "Echec de la requ&ecirc;te ".$e->getMessage();
        }
    
        while($data = $resultset->fetch()){
            $_categorieArray[] = new Categorie($data);
        }
        
        return $_categorieArray;
 } 
}
