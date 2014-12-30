<?php
class MateriauManager extends Materiau {
    private $_db;
    private $_materiauArray = array();
    
    public function __construct($db) {
        $this->_db = $db;
    }
    
   public function getMateriau($id){
        $query="select * from materiau where id_mat = :id_mat";
        $resultset = $this->_db->prepare($query);
        $resultset->bindValue(1,$id,PDO::PARAM_INT);
        $resultset->execute();
       
        $nbr=$resultset->rowCount();
        while($data = $resultset->fetch()) {
            $_materiauArray[] = new Materiau($data);
        }
        return $_materiauArray;
    }   
}


